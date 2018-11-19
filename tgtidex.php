<?php
function getlist(){
$url="https://api.tidex.com/api/3/info";
$get=file_get_contents($url);
$json=json_decode($get);
  $no=0;
  $headpesan="Tidex%0A%0A";

    $cek=0;
    foreach ($json->pairs as $data=>$pairs) {
      if($cek==0){
      $kumpul="$data";
      }
      else{
        $kumpul="$kumpul-$data";
      }
      $cek++;
    }
    $url1="https://api.tidex.com/api/3/ticker/$kumpul";
    $get1=file_get_contents($url1);
    $json1=json_decode($get1);
    foreach ($json1 as $pair=>$coin) {
      $last=$coin->last;
      $low=$coin->low;
      $high=$coin->high;

$cekbtc=preg_match("/btc/", $pair);
$ceketh=preg_match("/eth/", $pair);
$cekusdt=preg_match("/usdt/", $pair);
$cekwaves=preg_match("/waves/", $pair);
$cekwusd=preg_match("/wusd/", $pair);
$cekweur=preg_match("/weur/", $pair);

      if (!isset($isipesan[1])&& $cekbtc==1){
        $ii=1;
        $no1=1;
        $isipesan[$ii]="$no1. /$pair";
      }else if ($cekbtc==1){
        $ii=1;
        $no1++;
        $isipesan[$ii]="$isipesan[$ii]%0A$no1. /$pair";
      }
            if (!isset($isipesan[2])&& $ceketh==1){
              $ii=2;
              $no2=1;
              $isipesan[$ii]="$no2. /$pair";
            }else if ($ceketh==1){
              $ii=2;
              $no2++;
              $isipesan[$ii]="$isipesan[$ii]%0A$no2. /$pair";
            }
                  if (!isset($isipesan[3])&& $cekusdt==1){
                    $ii=3;
                    $no3=1;
                    $isipesan[$ii]="$no3. /$pair";
                  }else if ($cekusdt==1){
                    $ii=3;
                    $no3++;
                    $isipesan[$ii]="$isipesan[$ii]%0A$no3. /$pair";
                  }
                        if (!isset($isipesan[4])&& $cekwaves==1){
                          $ii=4;
                          $no4=1;
                          $isipesan[$ii]="$no4. /$pair";
                        }else if ($cekwaves==1){
                          $ii=4;
                          $no4++;
                          $isipesan[$ii]="$isipesan[$ii]%0A$no4. /$pair";
                        }
                              if (!isset($isipesan[5])&& $cekwusd==1){
                                $ii=5;
                                $no5=1;
                                $isipesan[$ii]="$no5. /$pair";
                              }else if ($cekwusd==1){
                                $ii=5;
                                $no5++;
                                $isipesan[$ii]="$isipesan[$ii]%0A$no5. /$pair";
                              }
                                    if (!isset($isipesan[6])&& $cekweur==1){
                                      $ii=6;
                                      $no6=1;
                                      $isipesan[$ii]="$no6. /$pair";
                                    }else if ($cekweur==1){
                                      $ii=6;
                                      $no6++;
                                      $isipesan[$ii]="$isipesan[$ii]%0A$no6. /$pair";
                                    }

      }
      $isipesan[1]="$headpesan$isipesan[1]";
      $isipesan[2]="$headpesan$isipesan[2]";
      $isipesan[3]="$headpesan$isipesan[3]";
      $isipesan[4]="$headpesan$isipesan[4]";
      $isipesan[5]="$headpesan$isipesan[5]";
      $isipesan[6]="$headpesan$isipesan[6]";
      $datapesan=['pesan1' => $isipesan[1] , 'pesan2' => $isipesan[2] , 'pesan3' => $isipesan[3] , 'pesan4' => $isipesan[4] , 'pesan5' => $isipesan[5] , 'pesan6' => $isipesan[6] ];
      return $datapesan;
}
function getpair($gettext){

  $url="https://api.tidex.com/api/3/info";
  $get=file_get_contents($url);
  $json=json_decode($get);
  $isipesan="";
    $no=0;
    $headpesan="Tidex%0A%0A";


        $cek=0;
        foreach ($json->pairs as $data=>$pairs) {
          if($cek==0){
          $kumpul="$data";
          }
          else{
            $kumpul="$kumpul-$data";
          }
          $cek++;
        }
        $url1="https://api.tidex.com/api/3/ticker/$kumpul";
        $get1=file_get_contents($url1);
        $json1=json_decode($get1);
        $no=0;
        foreach ($json1 as $pair=>$coin) {
          $no++;
          $last=number_format($coin->last,8);
          $low=number_format($coin->low,8);
          $high=number_format($coin->high,8);
  if ($gettext == "/$pair" || $gettext == "/$pair@exctidexbot"){
    $fpair="Pair : $pair";
    $flast="last 💙🍊: $last";
    $flow="Low ❤️🍎: $low";
    $fhigh="High 💚🍏: $high";
    $isipesan="$headpesan%0A$fpair%0A$flast%0A$flow%0A$fhigh";
  }
  }
  return $isipesan;
}


$token= "638468260:AAHKySsq9YnIvvlMKGX5ZbRgrkDZAowmZcw";
$api= "https://api.telegram.org/bot".$token;
$content= file_get_contents("php://input");
$update = json_decode($content,TRUE);
$message = $update["message"];
$chatid = $message["chat"]["id"];
$text =$message["text"];

if ($text == "/help@exctidexbot" ){
  $balas="Tidex%0ACommand list :%0A/help for help %0A/list for market list ";
}
else if ($text == "/tidex@exctidexbot" || $text == "/list@exctidexbot"){
  $balas="Kelompok 18%0ATidex%0A%0A1. /pairBTC%0A2. /pairETH%0A3. /pairUSDT%0A4. /pairWAVES%0A5. /pairWUSD%0A6. /pairWUER";
}
else if ($text == "/therocktrading@exctidexbot"){
  $balas="/therocktrading@exctherocktradingbot";
}
else if ( $text == "/pairBTC@exctidexbot"){
  $balass=getlist();
    $balas=$balass['pesan1'];
}
else if ( $text == "/pairETH@exctidexbot"){
  $balass=getlist();
    $balas=$balass['pesan2'];
}
else if ( $text == "/pairUSDT@exctidexbot"){
  $balass=getlist();
    $balas=$balass['pesan3'];
}
else if ( $text == "/pairWAVES@exctidexbot"){
  $balass=getlist();
    $balas=$balass['pesan4'];
}
else if ( $text == "/pairWUSD@exctidexbot"){
  $balass=getlist();
    $balas=$balass['pesan5'];
}
else if ( $text == "/pairWUER@exctidexbot"){
  $balass=getlist();
    $balas=$balass['pesan6'];
}else {
  $balas=getpair($text);
}
if($balas!=null){
file_get_contents($api."/sendmessage?chat_id=".$chatid."&text=".$balas);
}
//https://api.telegram.org/bot638468260:AAHKySsq9YnIvvlMKGX5ZbRgrkDZAowmZcw/setwebhook?url=https://game095.000webhostapp.com/tgtidex.php
?>
