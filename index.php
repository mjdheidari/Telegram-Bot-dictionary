<?php
include 'functions.php';
$updates = json_decode(file_get_contents("php://input"),1);
file_put_contents("data.txt",print_r($updates , 1)); //برای اینکه تست کنید رباتتون درست پیام ها و آپدیت ها رو دریافت میکنه یا نه
$text = $updates['message']['text'];
if ($text == '/start' || $text == 'منوی اصلی'){

    Method('sendMessage',[
        'chat_id'=>$updates['message']['from']['id'],
        'text'=>"عبارت یا کلمه فارسی را برای ترجمه وارد کنید.\n",
    ]);
}else{
    $matn = Trans($text);
    Method('sendMessage',[
        'chat_id'=>$updates['message']['from']['id'],
        'text'=> $matn['text'][0],
    ]);
}
if(isset($updates["inline_query"])){
    $inlineQuery = $updates["inline_query"];
    $queryId = $inlineQuery["id"];
    $queryText = $inlineQuery["query"];
    $matn = Trans($queryText);
    if (isset($queryText)) {
        $mResult = [
            [
                "type" => "article",
                "id" => "trnslate",
                "title" => $matn['text'][0],
                "input_message_content" => ["message_text" => "معادل انگیلیسی عبارت : \n".$queryText . " \n " . "برابر است با : ".$matn['text'][0]],
                "description"=>"معادل عبارت : "." ".$queryText,
                "thumb_url" => "https://mjdheidari.ir/fatoen.jpg"
            ]
        ];
        $url= "https://api.telegram.org/bot" . "token" . "/answerInlineQuery?inline_query_id={$queryId}&results=" . json_encode($mResult);
        file_get_contents($url);
    }
}
?>
