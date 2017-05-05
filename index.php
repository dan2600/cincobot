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


if($postback === "wifename")
{
   $jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
      },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Great. We\'re sending her the following VHS tape. You\'ve Chosen\n PIZZA BOY",
            "image_url":"http://cincobot.herokuapp.com/photos/pizzaboy.jpg",
            "buttons":[
                "type":"postback",
                "title":"THANKS",
                "payload":"pizb"
              }       
            ]      
          }
        ]
      }
    }
  }
}';
}

else if($postback === "namec")
{
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
      },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Great. I\'ve made the change. Your wife\'s new legal name is: TAARGÜS TAARGÜS/n Is this okay? ",
        "buttons":[
         {
            "type":"postback",
            "title":"YES",
            "payload":"wifename"
          },
          {
            "type":"postback",
            "title":"NO THANKS",
            "payload":"wifename"
          }
        ]
      }
    }
  }
}';
}


else if($postback === "fewmoret")
{
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
      },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Your name is/n'.$userinfo["first_name"].' TAARGÜS/n Is this correct? ",
        "buttons":[
         {
            "type":"postback",
            "title":"YES",
            "payload":"namec"
          },
          {
            "type":"postback",
            "title":"NO THANKS",
            "payload":"namec"
          }
        ]
      }
    }
  }
}';
}


else if($postback === "Boat_named")
{
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
      },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Just to make sure I\'ve gotten all the information correct, I\'m going to need you to confirm a few more things.",
        "buttons":[
         {
            "type":"postback",
            "title":"NEXT",
            "payload":"fewmoret"
          }
        ]
      }
    }
  }
}';
}


else if($postback === "Boat_name")
{
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
      },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Okay. I think you\'ve said TAARGÜS/nIS this correct?",
        "buttons":[
         {
            "type":"postback",
            "title":"YES",
            "payload":"Boat_named"
          },
            {
            "type":"postback",
            "title":"NO THANKS",
            "payload":"Boat_named"
          }
        ]
      }
    }
  }
}';
}

else if($postback === "Boat_Pick")
{
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
      },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Okay. I think you\'ve chosen COMMERCIAL FISHING. Now I\'m going to need your boat\'s name",
        "buttons":[
         {
            "type":"postback",
            "title":"NEXT",
            "payload":"Boat_name"
          }
        ]
      }
    }
  }
}';
}
else if($postback === "Boat_YES")
{
   $jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
      },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Okay. Let\'s move on. Is Your Boat a C-Class Licensed Boat or a Commercial Fishing Boat?",
            "image_url":"http://cincobot.herokuapp.com/photos/boats.png",
            "buttons":[
              {
                "type":"postback",
                "title":"C-Class",
                "payload":"Boat_Pick"
              },
               {
                "type":"postback",
                "title":"Fishing",
                "payload":"Boat_Pick"
              },
               {
                "type":"postback",
                "title":"No Thanks",
                "payload":"Boat_Pick"
              }            
            ]      
          }
        ]
      }
    }
  }
}';
}
else if($postback === "Boat_Party")
{
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
      },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Okay. I didn\'t get that. I think you chose BOAT. Is that right?",
        "buttons":[
         {
            "type":"postback",
            "title":"YES",
            "payload":"Boat_YES"
          }
        ]
      }
    }
  }
}';
}
else if($postback === "Next_NAME")
{
	 $jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
      },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Do You Live In a Hole or Boat?",
            "image_url":"http://cincobot.herokuapp.com/photos/boathole.png",
            "buttons":[
              {
                "type":"postback",
                "title":"Hole",
                "payload":"Boat_Party"
              },
               {
                "type":"postback",
                "title":"Boat",
                "payload":"Boat_Party"
              },
               {
                "type":"postback",
                "title":"No Thanks",
                "payload":"Boat_Party"
              }            
            ]      
          }
        ]
      }
    }
  }
}';
}
else
{
	$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
      },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Okay. I\'m almost finished setting up your account.\n'.$userinfo["first_name"].' '.$userinfo["last_name"].'\nBut I have a few more questions.",
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
error_log(print_r($jsonData, true));

?>

