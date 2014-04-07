<?php
error_reporting(0);
##############SETTING BOT####################
$bot['like'] = true; //Bot Like
$bot['ck_k'] = true; // Comment
$bot['ck_u'] = true; // General Comment
$bot['time'] = true; // Date
$bot['aces'] = "USE YOUR TOKEN IN HERE !! "; // YOUR TOKEN
##############END OF SETTING#############

com_like($cl,$ck,$cu,$tm,$access_token);


com_like($bot['like'],$bot['ck_k'],$bot['ck_u'],$bot['time'],$bot['aces']);

function cmn($text,$ck,$cu){
##########umum
$cmn_umum = array("Hello I like Your Stat :D ",
                  "This is awesome Quote i like it ;) ",
                  "Hello <name> <aku> always like your post.. ",
                  "ωσω?? Ļιкє тнιѕ <name>, ",
                  "Iam coming <name> .. please dont angry again :P.. ",
                  "<name> Like Back Oke :D ",
                  "<name> How Are you ? ",
                  "Dont Sad :) <name> ",
                  "I will back <name> on your stat ;) тнχ",
                  "This is Robot ? <name> ●●●ωωкωкωкωк ?",
                  "Dont Cry <name>,  hope you happy anytime ",
                  "Hello <name> dont forget to join at madleets ",
                  "Iam Mad member, How about you ? <name>●●",
                  "Iam comming again Bro <name> :)",
                  "<name> Like + Comment Back Ok ! (у) ",
                  "Whats that ? :O <name> ",
                  "Gud Post ;) ",
                  "Dont Sad Bro <name> :) ",
                  "Happy Birthday Bro <name> lol haha ",
                  "<name> Ļιкє+¢σммєηт ѕυ¢¢єđєđ :) ",
                  "<name> time for Ļιкє+¢σммєηт ●● :đ",
                  "<name> Nice POST and i will like it ;)  ",
                  "нαι <name> ؟ ",
                  " Assalamualaikum <name>... :) ",
                  "What :O ..!! <name> ",
);

//comment automatically depending on the situation

$comment = array(
array(
      array("Night",
            "Sleep",
            "where",
           ),
      array("Dont SLeep Please :( ",
            "anywhere :) ",
            "you want to sleep ? <name> ?",
           )
     ),
array(
      array("Hope",
            "hopefully",
            "amin",
           ),
      array("αмιη <name>●● ",
            "why <name>●?",
            "Allah Bless you <name>",
           )
     ),
array(
      array("morning",
            "goodmorning",
            "m0rning",
            "mornng",
            "Good morning",
            "m0rn1ng",
            "page",
           ),
      array("yes morning bro <name> ",
            "good morning to <name>",
            "Thank you <name>",
           )
     ),
array(
      array("night",
            "good night",
            "godninght",
            "ni9ht",
           ),
      array("Good night <name> ",
            "нι <name> Sweet dream ",
            "yes night <name> dont forget to pray?",
           )
     ),
array(
      array("sweet child of mine",
            "my heart is broken",
           ),
      array("who sings ? i think Obama lol :v hahah ",
           )
     ),
array(
      array("sick",
            "damn",
            "hurt",
           ),
      array("dont sad <name> pray will make you happy ",
            " hope Allah bless you :) ",
           )
     ),
array(
      array("God",
            "Allah",
            "ya allah",
           ),
      array("Dont Sad Bro <name> Allah bless you anywhere",
           )
     ),
array(
      array("cool",
            "handsome",
            "rock",
            "beautiful",
           ),
      array("yes iam very cool <name> ",
            "you say <aku> handsome ? Thank you :) ",
           )
     ),
array(
      array("promise",
            "InsyaAllah",
           ),
      array("dont promise <name> i believe you ",
           )
     ),
array(
      array("Hot",
            "very hot",
            "weather hot",
            "h0t",
           ),
      array("swimming bro <name> lol :v ",
           )
     ),
array(
      array("fasting",
            "imsak",
            "sahur",
            "iftar",
            "waiting afternoon",
           ),
      array("Masya Allah <name>",
            "awesome <name> :) ",
            "Good Job <name> :D ",
           )
     ),
);
$komentar = '';
$cr_kondisi=false;
foreach($comment as $cx){
    foreach($cx[0] as $ct){
        if(ereg($ct,$text)){
            $cr_kondisi=true;
            $komentar = $cx[1][rand(0,count($cx[1]) - 1)];
        }
    }
}
if($cr_kondisi==true && $ck==true){
    return $komentar;
}else{
    if($cu==true){ return $cmn_umum[rand(0,count($cmn_umum) - 1)]; }
}
}
#######################################
function com_like($cl,$ck,$cu,$tm,$access_token){
    $beranda = json_decode(httphit("https://graph.facebook.com/me/home?fields=id,from,type,message&limit=100&access_token=".$access_token))->data;
    $saya_cr = json_decode(httphit("https://graph.facebook.com/me?access_token=".$access_token));
    if($beranda){
        foreach($beranda as $cr_post){
            if(!ereg($saya_cr->id,$cr_post->id)){
                $log_cr = simlog($cr_post->id);
                if($log_cr==true){
                    if($ck==true){
                        $url_ck = cmn($cr_post->message,$ck,$cu);
                        $url_ck = str_replace("<name>",$cr_post->from->name,$url_ck);
                  $url_ck   = str_replace("<aku>",$saya_cr->first_name,$url_ck);
                        if($tm==true){ $url_ck = $url_ck.wkthit().kecepatan().konter() ; }
                        $url_ck = urlencode($url_ck);
                        if($ck==true OR $cu==true){
                            httphit("https://graph.facebook.com/".$cr_post->id."/comments?method=POST&message=".$url_ck."&access_token=".$access_token);
                        }
                        if($cl==true){
                            httphit("https://graph.facebook.com/".$cr_post->id."/likes?method=POST&access_token=".$access_token);
                        }
                    }
                }
            }
        }
    }
}
#######################################
function httphit($url){
    return file_get_contents($url);
}

function kecepatan() {
        $waktu="
";

   $gentime = microtime(); 
   $gentime = explode(' ',$gentime); 
   $gentime =  $gentime[0]; 
   $pg_end = $gentime; 
   $totaltime = ($pg_end - $pg_start); 
   $showtime = number_format($totaltime, 1, '.', ''); 
   return "$waktu ★ Comment Late $showtime Second ";
}
function konter() {
        $sempak="
";
$filename = 'hitcount.txt';
$handle = fopen($filename, 'r');
$hits = trim(fgets($handle)) + 1;
fclose($handle);

$handle = fopen($filename, 'w');
fwrite($handle, $hits);
fclose($handle);
   return "$sempak ★ Sequence $hits Complete :ᴅ ..!!";
}
function wkthit(){
    $ent="
";
    $hari=gmdate("D", time()+60*60*7);
    if((gmdate("D", time()+60*60*7))=="Sun"){ $hari="Sunday"; }
    if((gmdate("D", time()+60*60*7))=="Mon"){ $hari="Monday"; }
    if((gmdate("D", time()+60*60*7))=="Tue"){ $hari="Tuesday"; }
    if((gmdate("D", time()+60*60*7))=="Wed"){ $hari="Wednesday"; }
    if((gmdate("D", time()+60*60*7))=="Thu"){ $hari="Thursday"; }
    if((gmdate("D", time()+60*60*7))=="Fri"){ $hari="Friday"; }
    if((gmdate("D", time()+60*60*7))=="Sat"){ $hari="Saturday"; }
    $jam="Time : ".gmdate("g:i a", time()+60*60*7);
    return $ent.$ent."★ ".$hari." -  Date : ".gmdate("j - m - Y", time()+60*60*7)." - ".$jam." $showtime";
}
function simlog($cr_id) {
    $fname = "cr_log.txt";
    $lihatiplist=fopen ($fname, "rb");
    $text='';
    if($lihatiplist){
        $spasipol = "";
        do {
            $barislistip = fread($lihatiplist, 512);
            if(strlen($barislistip) == 0){ break; }
            $spasipol .= $barislistip;
        } while(true);
        fclose ($lihatiplist);
        for ($i = 1; $i <= 10; $i++) {$spasipol = str_replace(" ","",$spasipol);}
        $text=$text.$spasipol;
    }else{$text="";}
    if(ereg($cr_id,$text)){
        return false;
    }else{
        $text = $text.$cr_id;
        $w_file=@fopen($fname,"w") or bberr();
        if($w_file) {
            @fputs($w_file,$text);
            @fclose($w_file);
        }
        return true;
    }
}
?>
