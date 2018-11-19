<?php
function getlist(){
$url="https://api.therocktrading.com/v1/funds/tickers";
$get=file_get_contents($url);
$json=json_decode($get);
$isipesan="";
  $no=0;
  $headpesan="The Rock Trading%0A%0A";
  foreach ($json->tickers as $data) {
    $no++;
    $pair=$data->fund_id;
    $last=$data->last;
    $low=$data->low;
    $high=$data->high;

    if ($no==1){
      $isipesan="$no. /$pair";
    }else {$isipesan="$isipesan%0A$no. /$pair";}
    }
    $isipesan="$headpesan%0A$isipesan";
    return $isipesan;
}
function getpair($gettext){

  $url="https://api.therocktrading.com/v1/funds/tickers";
  $get=file_get_contents($url);
  $json=json_decode($get);
  $isipesan="";
    $no=0;
    $headpesan="The Rock Trading%0A%0A";
    foreach ($json->tickers as $data) {
      $no++;
      $pair=$data->fund_id;
      $last=number_format($data->last,8);
      $low=number_format($data->low,8);
      $high=number_format($data->high,8);
  if ($gettext == "/$pair" || $gettext == "/$pair@exctherocktradingbot"){
    $fpair="Pair : $pair";
    $flast="last 💙🍊: $last";
    $flow="Low ❤️🍎: $low";
    $fhigh="High 💚🍏: $high";
    $isipesan="$headpesan%0A$fpair%0A$flast%0A$flow%0A$fhigh";
  }
  }
  return $isipesan;
}


$token= "624060179:AAGFLzirZn_Hx3yGQ_Rf3o6PcGJ6as3mQ80";
$api= "https://api.telegram.org/bot".$token;
$content= file_get_contents("php://input");
$update = json_decode($content,TRUE);
$message = $update["message"];
$chatid = $message["chat"]["id"];
$text =$message["text"];

if ($text == "/help@exctherocktradingbot"){
  $balas="The Rock Trading%0ACommand list :%0A/help for help %0A/list for market list";
}
else if ($text == "/therocktrading@exctherocktradingbot"){
  $balas1=getlist();
  $balas="Kelompok 18%0A%0A$balas1";
}
else if ($text == "/tidex@exctherocktradingbot"){
  $balas="/tidex@exctidexbot";
}
else if ($text == "/list@exctherocktradingbot"){
  $balas=getlist();
}else {
  $balas=getpair($text);
}

if($balas!=null){
file_get_contents($api."/sendmessage?chat_id=".$chatid."&parse_mode=Markdown"."&text=".$balas);
}
//https://api.telegram.org/bot624060179:AAGFLzirZn_Hx3yGQ_Rf3o6PcGJ6as3mQ80/setwebhook?url=https://game095.000webhostapp.com/tgtherocktrading.php
?>
