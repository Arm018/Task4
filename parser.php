<?php

 $api_key = '';
 $city = '';
 $api = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$api_key}&units=metric";

 $curl = curl_init();
 curl_setopt($curl, CURLOPT_URL, $api);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 $resp = curl_exec($curl);
 curl_close($curl);

$data = json_decode($resp, true);

 file_put_contents('data.json', json_encode($data));

if ($data['cod'] == 200) {
    $temp = $data['main']['temp'];
    $description = $data['weather'][0]['description'];
    $humidity = $data['main']['humidity'];
    $windSpeed = $data['wind']['speed'];
//    echo "<pre>";
//    var_dump($windSpeed,$humidity,$temp,$description);
//    echo "</pre>";
} else {
    $error = 'Unable to fetch weather data.';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .weather-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .weather-container h2 {
            margin-top: 0;
        }
        .weather-detail {
            margin: 10px 0;
        }
    </style>
</head>
<body>
<div class="weather-container">
    <h2>Weather Information for <?= $city ?></h2>
        <div class="weather-detail">Temperature: <?= $temp ?>°C</div>
        <div class="weather-detail">Description: <?= $description ?></div>
        <div class="weather-detail">Humidity: <?=$humidity ?>%</div>
        <div class="weather-detail">Wind Speed: <?= $windSpeed; ?> m/s</div>

</div>
</body>
</html>

