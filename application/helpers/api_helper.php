<?php

function kirim_wa($phone, $message)
{
    $link = "https://jogja.wablas.com/api/send-message";
    $hp = substr($phone, 0,1);

    if ($hp == 0) {
        $phone = "62".substr($phone, 1);
    }
    $data = [
        'phone' => $phone,
        'message' => $message,
    ];


    $curl = curl_init();
    $token = "BMDFZwBie4pbJr8IC3OjliAo77brUmisoe6tNEDTcRs0R4Rkm3cegV5UmJkYdPrk";

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        "Authorization: $token",
    ));
    curl_setopt($curl, CURLOPT_URL, $link);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

?>