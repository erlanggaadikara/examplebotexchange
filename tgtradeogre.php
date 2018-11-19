<?php
function getlist(){
$url="https://tradeogre.com/api/v1/markets";
$get=file_get_contents($url);
$json=json_decode($get);
$isipesan="";
  $no=0;
  $headpesan="Trade Ogre%0A%0A";
  foreach ($json as $data) {
  $no++;
  $pair=key($data);
  $cekpair=preg_replace("/[^A-Z ]/","", $pair);
  $last=$data->{"$pair"}->price;
  $low=$data->{"$pair"}->low;
  $high=$data->{"$pair"}->high;

    if ($no==1){
      $isipesan="$no. /$cekpair";
    }else {$isipesan="$isipesan%0A$no. /$cekpair";}
    }
    $isipesan="$headpesan%0A$isipesan";
    return $isipesan;
}
function getpair($gettext){

  $url="https://tradeogre.com/api/v1/markets";
  $get=file_get_contents($url);
  $json=json_decode($get);
  $isipesan="";
    $no=0;
    $headpesan="Trade Ogre%0A%0A";
    foreach ($json as $data) {
      $no++;
      $pair=key($data);
      $cekpair=preg_replace("/[^A-Z ]/","", $pair);
      $last=number_format($data->{"$pair"}->price,8);
      $low=number_format($data->{"$pair"}->low,8);
      $high=number_format($data->{"$pair"}->high,8);
  if ($gettext == "/$cekpair" || $gettext == "/$cekpair@exctradeogreBot"){
    $fpair="Pair : $pair";
    $flast="last 💙🍊: $last";
    $flow="Low ❤️🍎: $low";
    $fhigh="High 💚🍏: $high";
    $isipesan="$headpesan%0A$fpair%0A$flast%0A$flow%0A$fhigh";
  }
  }
  return $isipesan;
}

$token= "687095968:AAF4Eq0e2PyLxUq9-JFFINBohdoec0_yxSM";
$api= "https://api.telegram.org/bot".$token;
$content= file_get_contents("php://input");
$update = json_decode($content,TRUE);
$message = $update["message"];
$chatid = $message["chat"]["id"];
$text =$message["text"];

if ($text == "/help@exctradeogreBot"){
  $balas="Trade Ogre%0ACommand list :%0A/help for help %0A/list for market list %0A/kel18 for exchange list ";
}
else if ($text == "/tradeogre@exctradeogreBot"){
  $balas1=getlist();
  $balas="Kelompok 18%0A%0A$balas1";
}
else if ($text == "/kel18@exctradeogreBot"){
  $balas="Kelompok 18%0A%0A1./tradeogre%0A2./tradeogre";
}
else if ($text == "/tradeogre@exctradeogreBot"){
  $balas="/tradeogre@exctradeogreBot";
}
else if ($text == "/list@exctradeogreBot"){
  $balas=getlist();
}else {
  $balas=getpair($text);
}

if($balas!=null){
file_get_contents($api."/sendmessage?chat_id=".$chatid."&parse_mode=Markdown"."&text=".$balas);
}
//https://api.telegram.org/bot687095968:AAF4Eq0e2PyLxUq9-JFFINBohdoec0_yxSM/setwebhook?url=https://tradeogre.000webhostapp.com//tgtradeogre.php
?>
