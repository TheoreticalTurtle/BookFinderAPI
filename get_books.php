<?php
    $search = $_POST['search'];
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://reststop.randomhouse.com/resources/titles?start=0&max=10&expandLevel=1&search=".urlencode($search));
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "testuser:testpassword");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
   
    $api_return = curl_exec($ch);
    
    echo $api_return;
    
    curl_close($ch);
?>