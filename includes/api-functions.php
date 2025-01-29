<?php
    function zoekDomeinen($domeinenData) {
        $url = "https://dev.api.mintycloud.nl/api/v2.1/domains/search?with_price=true";
    
        $headers = [
            "Authorization: Basic 072dee999ac1a7931c205814c97cb1f4d1261559c0f6cd15f2a7b27701954b8d",
            "Content-Type: application/json"
        ];
    
        $ch = curl_init($url);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($domeinenData));
    
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($httpCode !== 200) {
            return ["error" => "API-fout, HTTP-status: " . $httpCode];
        }
    
        return json_decode($response, true);
    }    

?>