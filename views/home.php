<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consume API</title>
</head>
<body>
    <h1> home Get air quality data of your area</h1>
        <form action="/api" method="post">
            <label for="">Your Area</label><br>
            <input type="text" placeholder="Input Your Area Here" name="data"><br>
            <button type="submit">Submit</button>
        </form>
</body>
</html>