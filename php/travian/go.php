<html>


<body>
<script type="text/javascript">
var cont='<div class="contractCosts">'+
'<div class="contractLink">'+
'<button class="build" onclick="window.location.href = \'dorf1.php?a=2&c=4d0209\';'+
'return false;" value="Bu seviyeye geliştir: 6" type="button">'+
'</div>'+
'</div>'+
'<div class=';


var sec=cont.split("dorf1.php?a=2&c=")[1];

var token=sec.substr(0,6);
console.info(token);

</script>

<h1>main page</h1>
<br><br>
<?php 
$src="";
$code="";
echo "src=$src";

?>
<br>
<iframe src="<?php echo $src;?>" width="400" height="400" ></iframe>

</body>

</html>