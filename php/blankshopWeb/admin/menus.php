<script type="text/javascript">
function editMenu(id){
	popup(600,420,"editMenu.php?type=edit&id="+id);
}
function addMenu(){
	popup(600,420,"editMenu.php?type=add");
}
</script>

<?php
 function listMenu(){

 $query= mysql_query("select id,name,hasFile from menu ");
echo "<h1>Menüler</h1>";
echo "Not:Bu panelden resimli içerik menüleri hazırlanamaz.Eğer resimli içerikler eklemek istiyorsanız sayfa içeriğinizi herhangi bir şekilde oluşturduktan sonra  destek@dicleeseryazilim.com adresine mail atın.<br>" ;
		
echo '<input type="button" class="" onclick="addMenu();" name="addMenu" value="Yeni Menü Ekle" />';
  echo "<table width = '100%'  border='1'>";
  $k=0;   
  while($row=mysql_fetch_assoc($query))
  {	
  	if($k===0)  	
  	{ 
  		$headers=array_keys($row);
  		echo "<tr>";  	
  		
  			echo "<td><b>Menü Adı</b></td>";
  		
  		echo "<td><b>İşlem</b></td></tr>";
  		$k++;  		
  	}  	
  	echo "<tr>";
 	echo "<td>$row[name]</td>";
  	
	?>
	<td>
	 <input type="button" <?php if($row["hasFile"]=="1") echo "disabled"; ?> onclick="editMenu(this.id);" class="" id="<?php echo $row['id'];?>" name="name" 
	 		value="Düzenle" />
  &nbsp;&nbsp; <a href='adminMain.php?page=delete&table=menu&ref=menus&id=<?php echo $row["id"];?>' > 
		Bu Menüyü Sil </a>
	</td>
	 
	 <?php
 	
  	 	
	echo "</tr>";
		 
  }
  echo "</table>";
 }
listMenu();

?>