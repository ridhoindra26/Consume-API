<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consume API</title>
</head>
<body>
    <h1>result Get air quality data of your area</h1>
    <?php
    echo '<h3>Area = '.$_SESSION['name'].'</h3>';
    echo '<img src="data:image/png;base64,' . base64_encode($_SESSION['img']) . '" style="border: 5px solid;border-radius: 10%"';
    ?>
</body>
</html>