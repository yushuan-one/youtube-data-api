<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Data API v3</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <div>
        <h2 class="text-center">YouTube Data API v3</h2>
        <form action="main.php" method="get" name="authCode">
            Enter verification code: <input type="text" name="authCode">
            <input type="submit" name="submit">
        </form>
        
        <?php
            require 'get_auth_url.php';
            if (isset($_GET["authCode"])) {
                $authCode = $_GET["authCode"]; 
            }
              
            $response = array();
            if (isset($_GET["submit"])) {
                 // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Define service object for making API requests.
                $service = new Google_Service_YouTube($client);

                $queryParams = [
                    'channelId' => 'UCxnUFZ_e7aJFw3Tm8mA7pvQ',
                    'maxResults' => 10,
                    'order' => 'date'
                ];

                $response = $service->search->listSearch('snippet', $queryParams);

            }

            if(!empty($response->items)) {
                foreach($response->items as $item) {
                    if (isset($item->id->videoId)) {
                        ?>
                        <div class="col-md-auto">
                            <iframe width="280" height="150" 
                            src="https://www.youtube.com/embed/<?php echo $item->id->videoId; ?>"
                             framebolder="0" allowfullscreen></iframe>
                            <h4><?php echo $item->snippet->title; ?></h4>
                        </div>
                        <?php
                    }
                }
            }
 
        ?>
    </div>
    </div>
</body>
</html>