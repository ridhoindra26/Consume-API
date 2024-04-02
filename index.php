<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consume API</title>
</head>
<body>
    <h1>Get air quality data of your area</h1>

    <?php
        if ( 'post' === strtolower($_SERVER['REQUEST_METHOD'])) {
    ?>
            <?php 
            $key = "AIzaSyBGr_Mzjw025m1jTs-YnbWMXVNeQ1WgCjw";
            $input = $_POST['data'];
            $request = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=".$input."&inputtype=textquery&fields=name%2Cgeometry&key=".$key;
            $get = file_get_contents($request);
            $result = json_decode($get);
            // $a = $result->candidates[0]->geometry->location->lat;
            

            $zoom = pow(2,8);
            $lng = $result->candidates[0]->geometry->location->lng;
            $lat = $result->candidates[0]->geometry->location->lat;
            // Math.floor(((1.0 -Math.log(Math.tan((lat * Math.PI) / 180.0) +1.0 / Math.cos((lat * Math.PI) / 180.0)) /Math.PI) /2.0) *xyTilesCount);

            $lng = floor((($lng+180.0)/360.0)*$zoom);
            $lat = floor
            (
                (
                    (
                        1-log(tan(($lat*pi())/180)+1/cos(($lat*pi())/180))/pi()
                    )
                    /2
                )
                *$zoom
            );
            $heatmap = "https://airquality.googleapis.com/v1/mapTypes/UAQI_RED_GREEN/heatmapTiles/8/".$lng."/".$lat."?key=".$key;
            $img = file_get_contents($heatmap);
            echo '<h3>Area = '.$result->candidates[0]->name.'</h3>';
            echo '<img src="data:image/png;base64,' . base64_encode($img) . '" style="border: 5px solid;border-radius: 10%"';
            ?>
    <?php
    } else {
        ?>
        <form method="post">
            <label for="">Your Area</label><br>
            <input type="text" placeholder="Input Your Area Here" name="data"><br>
            <button type="submit">Submit</button>
        </form>
    <?php
    }?>
</body>
</html>