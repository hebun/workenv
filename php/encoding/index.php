<html>
<head>

</head>

<body>
<script type="text/javascript" src="encoding.js">

</script>
<script type="text/javascript">
function encode(){
	var text=document.getElementById("ta").value;

	document.getElementById("tao").value=myencoder.set(text);
}
function decode(){
	var text=document.getElementById("tao").value;

	document.getElementById("ta").value=myencoder.get(text);
}
</script>
<textarea id="ta" cols="80" rows="10"></textarea>
<textarea id="tao" cols="80" rows="10"></textarea><br>

<input type="button" value="encode" onclick="encode()"/>
<input type="button" value="decode" onclick="decode()"/>

</body>
</html>