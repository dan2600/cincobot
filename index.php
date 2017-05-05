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


 
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$postback = $input['entry'][0]['messaging'][0]['postback']['payload'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];

$userinfo = json_decode(file_get_contents('https://graph.facebook.com/v2.6/'.$sender.'?access_token='.$access_token), true);




if($postback === "USER_DEFINED_PAYLOAD")
{
	$text = "yayi";
}
else
{
	$jsonData = '{
    "recipient":{
        "id":'.$sender.'
    },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Okay. I\'m almost finished setting up your account.'.chr(10).$userinfo["first_name"].' '.$userinfo["last_name"].chr(10).'But I have a few more questions.",
        "buttons":[
         {
            "type":"postback",
            "title":"NEXT",
            "payload":"Next_NAME"
          }
        ]
      }
    }
  }
}';
}

error_log(print_r($jsonData, true));

$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
$ch = curl_init($url);



$jsonDataEncoded = $jsonData;
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
if(!empty($input['entry'][0]['messaging'][0]['message']) || $input['entry'][0]['messaging'][0]['postback']){
    $result = curl_exec($ch);
}

?>

