<?php

//create a function to pass the access token value to the other pages

function token()
{

    $ch = curl_init();
    $clientId = "AXCV2eC0BCFG1olo6HIqpYYdvXm3Q8QKo0ZLGI1RafbEngDL1FsnOk8uzCdTKfZ8ILGovNgiWae3U6oa";
    $secret = "ECLSzbgWl3Uf52ozuGMcxr-bH5SEDHSZCE7Ntqo1DfVHiBhJPLmMRC5RQZX-w_Mq47JHbxcVn00UKhkz";


    curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $secret);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

    $result = curl_exec($ch);
    //save the response into the $result variable

    if (empty($result)) die("Error: No response.");
    //if the response is empty shows error

    else {
        $json = json_decode($result);
        //otherwise, turns the response into an object

        file_put_contents('access_token_log.json', $result);
        //saves de content into a json log file

        return $json->access_token;
        //and return the access token
    }

    curl_close($ch);
}
