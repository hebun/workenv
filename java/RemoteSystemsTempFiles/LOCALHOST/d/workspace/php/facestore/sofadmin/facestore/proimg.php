<table>	
<?php 
if($_GET["img"]!=="")
echo "<tr><td><img src='$_GET[img]' /></td></tr>";
else{
	
}
	
	?>
<tr>

	<td><input type="file" class="inputtext" required="true" size="16"
		value="" id="img" name="img"><input type="button"
		value="Yükle" />
	</td>
</tr>
</table>