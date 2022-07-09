<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icon.png">
    <title>IP-Info</title>
<style>
    body {
        color: red;
        font-size: xx-large;
        background-color: darkgrey;
        text-align: center;
        font-family: Fantasy;
    }
    input {
        font-size: large;
        border-radius: 10px;
    }
</style>
</head>
<body>
    <div class="div_1_text">Your IP Address Information :</div><hr>
    <form method="post">
        <label>Enter IP Address : </label><br>
        <input type="search" name="input" id="input" autofocus>
        <input type="submit" value="search"><br><hr>
    </form>
</body>
</html>


<?php

error_reporting(E_ERROR | E_PARSE);

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])){
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    }

    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    else if (isset($_SERVER['HTTP_X_FORWARDED'])){
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    }

    else if (isset($_SERVER['HTTP_FORWARDED_FOR'])){
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    }

    else if (isset($_SERVER['HTTP_FORWARDED'])){
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    }

    else if (isset($_SERVER['REMOTE_ADDR'])){
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    }

    else {
        $ipaddress = "UNKNOWN";
    }
    return $ipaddress;
}

if (empty($publicIP = $_POST['input'])) {
    $publicIP = get_client_ip();
}
else {
    $publicIP = $_POST['input'];
}
     
$json = file_get_contents("http://ipinfo.io/$publicIP/geo");
$json = json_decode($json,true);
$host = "Host Name ==> ".$json['hostname'];
$ip_info = "IP Address ==> ".$json['ip'];
$city_info = "City ==> ".$json['city'];
$reg = "Region ==> ".$json['region'];   
$country_info = "Country ==> ". $json['country'];
$loc_info = "Location ==> ".$json['loc'];
$time_info = "Time Zone ==> ".$json['timezone'];

echo $ip_info,"<br>","<br>";
echo $host,"<br>","<br>";
echo $country_info,"<br>","<br>";
echo $reg,"<br>","<br>";
echo $city_info,"<br>","<br>";
echo $loc_info,"<br>","<br>";
echo $time_info;

?>