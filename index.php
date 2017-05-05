<?php
$access_token = "EAAac4GEwobQBAH3Y2qfQdD9ZCLVYNgb4mPgNVZC0DiiNph0fyZAZBf9PfXszfzfyhrJjBvSHmktwhmlI2C7gufL5Gmo19OSorXcAznaoeQZBGw5WxMRXK56ZBzb1YLBUuOZBR54S3t5Fc0N8dBOPT5666mGpm4wcVlc8t6WM4Qz2wZDZD";
$verify_token = "cinco";
$hub_verify_token = null;

if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}


if ($hub_verify_token === $verify_token) {
    echo $challenge;
}



$input = json_decode(file_get_contents('php://input'), true);
error_log(print_r($input, true));

 
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$postback = $input['entry'][0]['messaging'][0]['postback']['payload'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];
error_log($postback);

if($postback === "USER_DEFINED_PAYLOAD")
{
	$text = "yay";
}
else
{
	$text = "nay";
}

$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
$ch = curl_init($url);

$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
   "message":{
  "text":"'.$text.'"
}
}';
$jsonDataEncoded = $jsonData;
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
if(!empty($input['entry'][0]['messaging'][0]['message']) || $input['entry'][0]['messaging'][0]['postback']){
    $result = curl_exec($ch);
}

?>

