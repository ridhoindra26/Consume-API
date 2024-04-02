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

            // $data = array(
            //     'name' => $result->candidates[0]->name,
            //     'img' => 'a'
            // );

            // $header = array(
            //     'Content-Type: application/x-www-form-urlencoded',
            //     'Content-Length: '.count($data)
            // );

            // $option = array(
            //     'http' => array(
            //         'method' => 'POST',
            //         'header' => $header,
            //         'content' => http_build_query($data)
            //     )
            // );

            // $context = stream_context_create($option);
            // // $url = '/';
            // $return = file_get_contents('http://localhost:8707/result', false, $context);

            // $ch = curl_init();
            // $url = 'http://localhost:8707/result';

            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // // Eksekusi curl
            // $response = curl_exec($ch);

            // // Tutup curl
            // curl_close($ch);

            // session_start();
            $_SESSION['name'] = $result->candidates[0]->name;
            $_SESSION['img'] = $img;
            session_write_close();

            header('Location: /result');
            exit();
            // echo '<h3>Area = '.$result->candidates[0]->name.'</h3>';
            // echo '<img src="data:image/png;base64,' . base64_encode($img) . '" style="border: 5px solid;border-radius: 10%"';
?>