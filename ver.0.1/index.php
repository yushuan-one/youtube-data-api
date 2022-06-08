
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
    <?php
        // Enter a valdi api key
        $api_key = "API_KEY";
        $channel_id = "UCxnUFZ_e7aJFw3Tm8mA7pvQ";
        $base_url = "https://www.googleapis.com/youtube/v3/";
        $max_result = 10;

        $api_url = $base_url . "search?order=date&part=snippet&channelId=".$channel_id
        ."&maxResult=".$max_result."&key=".$api_key;

        $videos = json_decode( file_get_contents($api_url) );

        if(!empty($videos->items)) {
            foreach($videos->items as $item) {
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