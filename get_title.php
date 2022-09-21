<?php
    $isbn = $_GET['ISBN'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://reststop.randomhouse.com/resources/titles/$isbn");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "testuser:testpassword");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
    $api_return = curl_exec($ch);
    curl_close($ch);
    $api_return = json_decode($api_return);
    echo $api_return->titleweb;
?>