<?php
function getlist(){
$url="http://open-api.uex.com/open/api/common/symbols";
$get=file_get_contents($url);
$json=json_decode($get);
$isipesan="";
  $no=0;
  $headpesan="UEX%0A%0A";
  foreach ($json->data as $data) {
    $no++;
	$pair = $data->symbol;

    if ($no==1){
      $isipesan="$no. /$pair";
    }else {$isipesan="$isipesan%0A$no. /$pair";}
    }
    $isipesan="$headpesan%0A$isipesan";
    return $isipesan;
}

function getpair($gettext){

  $url="http://open-api.uex.com/open/api/common/symbols";
  $get=file_get_contents($url);
  $json=json_decode($get);
  $isipesan="";
  $headpesan="UEX%0A%0A";
  foreach($json->data as $data){
      $pair=$data->symbol;
      $api="https://open-api.uex.com/open/api/get_ticker?symbol=".$pair;
      $gets=file_get_contents($api);
      $jsons=json_decode($gets)->data;
      $last=number_format($jsons->last,8);
      $low=number_format($jsons->low,8);
      $high=number_format($jsons->high,8);
      if($gettext == "/$pair" || $gettext == "/$pair@excuexbot"){
        $fpair="Pair : $pair";
        $flast="last ????: $last";
        $flow="Low ????: $low";
        $fhigh="High ????: $high";
        $isipesan="$headpesan%0A$fpair%0A$flast%0A$flow%0A$fhigh";
      }
  }
  return $isipesan;
}

$token= "689954645:AAETQ7KllClGoKbDPWQFiVTFlVHSrkoKRNg";
$api= "https://api.telegram.org/bot".$token;
$content= file_get_contents("php://input");
$update = json_decode($content,TRUE);
$message = $update["message"];
$chatid = $message["chat"]["id"];
$text =$message["text"];

if ($text == "/help@excuexbot"){
  $balas="UEX%0ACommand list :%0A/help for help %0A/list for market list %0A/kel18 for exchange list ";
}
else if ($text == "/uex@excuexbot" || $text == "/uex"){
  $balas1=getlist();
  $balas="Kelompok 18%0A%0A$balas1";
}
else if ($text == "/kel18@excuexbot"){
  $balas="Kelompok 18%0A%0A1./therocktrading%0A2./tidex%0A3./uex";
}
else if ($text == "/tidex@excuexbot"){
  $balas="/tidex@exctidexbot";
}
else if ($text == "/list@excuexbot"){
  $balas=getlist();
}else {
  $balas=getpair($text);
}

if($balas!=null){
file_get_contents($api."/sendmessage?chat_id=".$chatid."&parse_mode=Markdown"."&text=".$balas);
}
//https://api.telegram.org/bot6899544645:AAETQ7KllClGoKbDPWQFiVTFlVHSrkoKRNg/setwebhook?url=https://gamekel1.000webhostapp.com//tguex.php

?>
