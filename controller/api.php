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
    $lat = floor(((1-log(tan(($lat*pi())/180)+1/cos(($lat*pi())/180))/pi())/2)*$zoom);
    $heatmap = "https://airquality.googleapis.com/v1/mapTypes/UAQI_RED_GREEN/heatmapTiles/8/".$lng."/".$lat."?key=".$key;
    $img = file_get_contents($heatmap);

    // session_start();
    $_SESSION['name'] = $result->candidates[0]->name;
    $_SESSION['img'] = $img;
    session_write_close();

    header('Location: /result');
    exit();
?>