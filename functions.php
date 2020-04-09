<?php
function Method ($method , array $DATA=[]){
    $curl = curl_init('https://api.telegram.org/bot1018468566:AAEAsHjrxekeECgUNN1MknLsKUTSDg8cnbg/'.$method);
    curl_setopt_array($curl ,[
        CURLOPT_POSTFIELDS =>$DATA,
        CURLOPT_RETURNTRANSFER => 1,
    ]);
    $run = curl_exec($curl);
    return $run;
}
function Trans ($text){
    $url = "https://translate.yandex.net/api/v1.5/tr.json/translate?lang=fa-en&key=trnsl.1.1.20200307T105809Z.00b5d7ce3745b32f.62c7133a3e23d9d48657876e44f8d8950f0200a7&text=".$text;
    $res = file_get_contents($url);
    return json_decode($res, true);
}
?>
