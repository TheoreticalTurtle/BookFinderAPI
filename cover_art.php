<?php

    $isbn = $_GET['ISBN'];
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://reststop.randomhouse.com/resources/titles/$isbn");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "testuser:testpassword");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: image/*", "Accept: image/*"));
    
    $api_return = curl_exec($ch);
    
    if (!curl_errno($ch) && (strpos($api_return, "GlassFish") === false)) {
        echo $api_return;
        curl_close($ch);
        exit();
    }
    //echo $api_return;
    //curl_close($ch);
    //exit();
    $contents = file_get_contents("https://www.cameronmorrow.com/BookApp/missing.png");
    //$base64 = base64_encode($contents);
    echo $contents;
    exit();

?>