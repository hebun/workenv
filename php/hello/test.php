<?php

function getRest($str)
{
  $len = strlen($str);
  $ret="";

  for($i=$len-1,$k=0; $i>=0; $i--,$k++)
    {
      $ret.=intval(9-intval($str[$i]));
    }
  return $ret;
}

$key = 'facebookauthen2.0';

//To Encrypt:
$encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, '8f07f1193311759837812dfcdc7e82c8', MCRYPT_MODE_ECB);


echo 'here:<br>';
$r=getRest("1234567890");
//echo $r;
//echo ';kjl;j';
echo getRest(getRest("1234567890"));
echo '<br>';
//..echo getRest("9012345678");
?>