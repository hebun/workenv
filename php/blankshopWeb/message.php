<?php
 if(isset($_POST["send"]))
	{
		$error;
		if(empty($_POST["name"]))
		{
			$error=" Ad soyad girmediniz.";
		}elseif(empty($_POST["email"]))
		{
			$error=" Mail adresinizi girmediniz.";
		}elseif(empty($_POST["message"]))
		{
			$error=" Mesaj boş  girilemez.";
		}else{
		
			require_once "db.php";
			$arr=array();
			$arr["name"]=$_POST["name"];
			$arr["email"]=$_POST["email"];
			$arr["title"]=$_POST["title"];
			$arr["message"]=$_POST["message"];
			
			$query =insert($arr,"message");
		  	myQuery($query);
		  	echo "<span style='color:black'> Mesajınız gönderildi.</span> ";
		}	
	}
?>

<h1>İLETİŞİM</h1>

Öneri , şikayet ve sorularınızı aşağıdaki form ile bizlere ulaştırabilirsiniz.<br>

<?php
  	if(!empty($error)){
		echo "<span style='color:red'> $error </span> ";
	}
 
?>


<form action="index.php?page=message" method="post">
	

<table style="border: 1px solid Black;" width="90%" >
    <tbody><tr>
    <td align="right">
    Adınız soyadınız* 
    </td>
    <td>

    :
    </td>
    <td>
        <input name="name" id="name" style="width: 200px;" type="text">
    </td>    
    </tr>
    <tr>
    <td align="right">
    E-posta Adresiniz*
    </td>
    <td>
    :
    </td>
    <td>
        <input name="email" id="email" style="width: 200px;" type="text">
    </td>    
    </tr>
    <tr>
    <td align="right">
    Mesaj Başlığı
    </td>
    <td>

    :
    </td>
    <td>
        <input name="title" id="title" style="width: 200px;" type="text">
    </td>    
    </tr>
    <tr>
    <td align="right">
    Mesajınız*
    </td>
    <td>
    :
    </td>
    <td>
        <textarea name="message" rows="2" cols="20" id="message" style="height: 150px; width:200px;"></textarea>

    </td>
    </tr>
      <tr>
      <td colspan="2"></td>

    <td colspan="2">
        <input name="send" class="button" value="Gönder" id="send" type="submit">
    </td>
    </tr>  

    </tbody></table>
    </td>
      </tr>
</tbody></table>
</form> 
<?php


?>