<?php

@session_start();
if(!(isset($_SESSION['adm_logged']) && ($_SESSION['adm_logged'] == true))){
	header("Location: index.php");
	exit;
}
require_once("../inc/config.inc.php");
require_once("../inc/database.inc.php");
require_once("../inc/settings.inc.php");
require_once("../inc/functions.inc.php");

$db=new Database();
$db->open();


$mode = isset($_GET['meng_mode']) ? removeBadChars($_GET['meng_mode']) : "";
$rid = isset($_GET['meng_rid']) ? (int)$_GET['meng_rid'] : "";
$msg = isset($_GET['msg']) ? removeBadChars($_GET['msg']) : "";
$mgid = isset($_GET['mgid']) ? (int)$_GET['mgid'] : "";
$act = isset($_GET['act']) ? removeBadChars($_GET['act']) : "";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
<title><?php echo _SITE_NAME; ?> :: Admin Panel :: Home</title>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<link href="../css/style_<?php echo _CSS_STYLE;?>.css" type=text/css
	rel=stylesheet>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function fillIlce(ilid,ilceid){

	$.ajax({
	url : 'getIlce.php',
	type: 'POST',
	data:{
	'ilId':$('#'+ilid).val()	
	},
	success: function(data, textStatus, jqXHR)
	{
		var dataj=$.parseJSON(data);
		var options = $('#'+ilceid);
		options.empty();
		$.each(dataj, function() {
		
		options.append($('<option />').val(this.id).text(this.ilname));
		});
	
	},
	error: function (jqXHR, textStatus, errorThrown)
	{
	
	}
	});
}
jQuery(document).ready(function($) {
	$('#ilcefilter').change(function(){document.location.href='points.php?ilceid='+$('#ilcefilter').val()+'&ilid='+$('#ilfilter').val()});
	var ilceid=getParameterByName('ilceid');
	console.info(ilceid);
	$('#ilcefilter').val(ilceid);
}

)

</script>
</head>
<!-- BEGIN MAIN CONTENT ARE -->
<body style="background: #ffffff;">

	<br />

	<?php

	if($msg == "1"){
		echo "<center><font color='#009a00'>message 1 !</font></center><br>";
	}


	$dbil=new Database();
	if($dbil->open()){
	
		$dbil->query("select id,iname from il  ");
		echo "<div width='%80' style=!padding-left: 40px;'>İl: <select id='ilfilter' onchange='fillIlce(\"ilfilter\",\"ilcefilter\")'>";
		while($row=$dbil->fetchAssoc()){
			echo "<option value='$row[id]'";
			if(isset($_GET['ilid'])){
	
			if($_GET['ilid']==$row['id'])
					echo " selected ";
			}
			echo " >$row[iname]</option>";
		}
		echo "</select>";
	}
	
	
	
	
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;İlçe: <select id='ilcefilter'>";
	if(isset($_GET['ilid'])){
	
		$dbilce=new Database();
		if($dbilce->open()){
		
			$dbilce->query("select id,ilname from ilce where ilId=$_GET[ilid]  ");
			
			while($row=$dbilce->fetchAssoc()){
				echo "<option value='$row[id]'";
				if(isset($_GET['ilceid'])){
		
				if($_GET['ilceid']==$row['id'])
				echo " selected ";
			}
				echo " >$row[ilname]</option>";
			}
		
	}
	}
	
	echo "</select></div>";
	
	define ("DATAGRID_DIR", "../modules/datagrid/");                     /* Ex.: "datagrid/" */
	define ("PEAR_DIR", "../modules/datagrid/pear/");                    /* Ex.: "datagrid/pear/" */

	require_once(DATAGRID_DIR.'datagrid.class.php');
	require_once(PEAR_DIR.'PEAR.php');
	require_once(PEAR_DIR.'DB.php');
	##
	##  *** creating variables that we need for database connection

	ob_start();

	$db_conn = DB::factory('mysql');  /* don't forget to change on appropriate db type */

	$config = new Config();
	$DB_USER = $config->user;
	$DB_PASS = $config->password;
	$DB_HOST = $config->host;
	$DB_NAME = $config->database;

	$result_conn = $db_conn->connect(DB::parseDSN('mysql://'.$DB_USER.':'.$DB_PASS.'@'.$DB_HOST.'/'.$DB_NAME));
	if(DB::isError($result_conn)){
		die($result_conn->getDebugInfo());
	}
	##  *** put a primary key on the first place
	$sql = "SELECT
		p.id as id,
		p.name as name,
			ilId,ilceId,
		cno,
		address,
		e.name as uname
			
			
		,semt,il,telno,mudur,mudurtel,sef,seftel,warnday
		FROM "._DB_PREFIX."point as p left join bolge as e on e.id=p.bolgeId where 1=1 ";
	
	if(isset($_GET['ilid'])){
		
		$sql=$sql." and ilId=$_GET[ilid] and ilceId=$_GET[ilceid] ";
		
	}
	##  *** set needed options and create a new class instance
	$debug_mode = false;        /* display SQL statements while processing */
	$messaging = true;          /* display system messages on a screen */
	$unique_prefix = "meng_";    /* prevent overlays - must be started with a letter */
	$dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);

	##  *** set data source with needed options
	$default_order_field = "id";
	$default_order_type = "ASC";
	$dgrid->dataSource($db_conn, $sql, $default_order_field, $default_order_type);


	$bottom_paging = array("results"=>true, "results_align"=>"left", "pages"=>true, "pages_align"=>"center", "page_size"=>true, "page_size_align"=>"right");
	$top_paging = array();
	$pages_array = array("100"=>"100", "25"=>"25", "50"=>"50", "100"=>"100", "250"=>"250", "500"=>"500", "1000"=>"1000");
	$default_page_size = 100;
	$paging_arrows = array("first"=>"|&lt;&lt;", "previous"=>"&lt;&lt;", "next"=>"&gt;&gt;", "last"=>"&gt;&gt;|");
	$dgrid->setPagingSettings($bottom_paging, $top_paging, $pages_array, $default_page_size, $paging_arrows);

	$dg_language = $SETTINGS['site_language'];
	$dgrid->setInterfaceLang($dg_language);

	$modes = array(
			"add"	=>array("view"=>true, "edit"=>false, "type"=>"link"),
			"edit"	=>array("view"=>true, "edit"=>true,  "type"=>"link", "byFieldValue"=>""),
			"cancel"   =>array("view"=>true, "edit"=>true,  "type"=>"link"),
			"details"  =>array("view"=>false, "edit"=>false, "type"=>"link"),
			"delete"   =>array("view"=>true, "edit"=>false,  "type"=>"image")
	);
	$dgrid->setModes($modes);

	$css_class = $SETTINGS['datagrid_css_style'];
	$dgrid->setCssClass($css_class);

	$dg_caption = "Satış Noktaları";
	$dgrid->setCaption($dg_caption);

	##  *** set printing option: true(default) or false
	$printing_option = true;
	$dgrid->allowPrinting($printing_option);

	$exporting_option = false;
	$exporting_directory = "export/";
	$dgrid->allowExporting($exporting_option, $exporting_directory);

	$vm_table_properties = array("width"=>"100%");
	$dgrid->setViewModeTableProperties($vm_table_properties);
	$sqluser="select * from  bolge";
	$users=array();

	$dbx=new Database();
	if($dbx->open()){
		$dbx->query($sqluser);
		while($row=$dbx->fetchAssoc()){
			$users[$row["id"]]=$row["name"];

		}
	}
	$vm_colimns = array(
			"name"              =>array("header"=>"Mağaza ismi", "type"=>"label",      "align"=>"left", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "tooltip"=>false, "tooltip_type"=>"floating|simple", "case"=>"normal|upper|lower", "summarize"=>"true|false", "sort_by"=>"", "visible"=>"true", "on_js_event"=>""),
			"cno"      =>array("header"=>"Cari No", "type"=>"label",      "align"=>"center", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "tooltip"=>false, "tooltip_type"=>"floating|simple", "case"=>"normal|upper|lower", "summarize"=>"true|false", "sort_by"=>"", "visible"=>"true", "on_js_event"=>""),
			"address"      =>array("header"=>"Adres", "type"=>"label",      "align"=>"left", "width"=>"300", "wrap"=>"nowrap", "text_length"=>"-1", "tooltip"=>false, "tooltip_type"=>"floating|simple", "case"=>"normal|upper|lower", "summarize"=>"true|false", "sort_by"=>"", "visible"=>"true", "on_js_event"=>""),
			"uname"         =>array("header"=>"Bolge",  "type"=>"label",      "req_type"=>"st", "width"=>"300px", "wrap"=>"nowrap","title"=>"", "readonly"=>false, "maxlength"=>"-1", "default"=>"0", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>"", "source"=>$users, "view_type"=>"dropdownlist", "radiobuttons_alignment"=>"horizontal|vertical", "multiple"=>false, "multiple_size"=>"4"),
			"semt"              =>array("header"=>"Semt", "type"=>"label",      "align"=>"left", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "tooltip"=>false, "tooltip_type"=>"floating|simple", "case"=>"normal|upper|lower", "summarize"=>"true|false", "sort_by"=>"", "visible"=>"true", "on_js_event"=>""),
			"il"              =>array("header"=>"İl", "type"=>"label",      "align"=>"left", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "tooltip"=>false, "tooltip_type"=>"floating|simple", "case"=>"normal|upper|lower", "summarize"=>"true|false", "sort_by"=>"", "visible"=>"true", "on_js_event"=>""),
			"telno"              =>array("header"=>"Tel. No.", "type"=>"label",      "align"=>"left", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "tooltip"=>false, "tooltip_type"=>"floating|simple", "case"=>"normal|upper|lower", "summarize"=>"true|false", "sort_by"=>"", "visible"=>"true", "on_js_event"=>""),
			"mudur"              =>array("header"=>"Müdür Adı", "type"=>"label",      "align"=>"left", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "tooltip"=>false, "tooltip_type"=>"floating|simple", "case"=>"normal|upper|lower", "summarize"=>"true|false", "sort_by"=>"", "visible"=>"true", "on_js_event"=>""),
			"mudurtel"              =>array("header"=>"Müdür Tel.", "type"=>"label",      "align"=>"left", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "tooltip"=>false, "tooltip_type"=>"floating|simple", "case"=>"normal|upper|lower", "summarize"=>"true|false", "sort_by"=>"", "visible"=>"true", "on_js_event"=>""),
			"sef"              =>array("header"=>"Rayon Şefi", "type"=>"label",      "align"=>"left", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "tooltip"=>false, "tooltip_type"=>"floating|simple", "case"=>"normal|upper|lower", "summarize"=>"true|false", "sort_by"=>"", "visible"=>"true", "on_js_event"=>""),
			"seftel"              =>array("header"=>"R. Şef Tel.", "type"=>"label",      "align"=>"left", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "tooltip"=>false, "tooltip_type"=>"floating|simple", "case"=>"normal|upper|lower", "summarize"=>"true|false", "sort_by"=>"", "visible"=>"true", "on_js_event"=>""),
			"warnday"              =>array("header"=>"Z.Gün", "type"=>"label",      "align"=>"left", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "tooltip"=>false, "tooltip_type"=>"floating|simple", "case"=>"normal|upper|lower", "summarize"=>"true|false", "sort_by"=>"", "visible"=>"true", "on_js_event"=>""),
	);
	$dgrid->setColumnsInViewMode($vm_colimns);

	##  *** set add/edit mode table properties
	$em_table_properties = array("width"=>"70%");
	$dgrid->setEditModeTableProperties($em_table_properties);

	$table_name  = _DB_PREFIX."point";
	$primary_key = "id";
	$condition   = "";//"table_name.field = ".$_REQUEST['abc_rid'];
	$dgrid->setTableEdit($table_name, $primary_key, $condition);

	$fill_from_array_hidden = array("0"=>"No", "1"=>"Yes"); /* as "value"=>"option" */
	$fill_from_array_removable = array("0"=>"No", "1"=>"Yes");
	$fill_from_array_dashboard = array("0"=>"No", "1"=>"Yes");


	$em_columns = array(
			"name"              =>array("header"=>"Mağaza İsmi", "type"=>"textbox",   "req_type"=>"rt", "width"=>"210px", "title"=>"İ", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
			"cno"       =>array("header"=>"Müşteri No", "type"=>"textbox",   "req_type"=>"st", "width"=>"210px", "title"=>"Kullanıcı Adı", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
			"address"       =>array("header"=>"Adres", "type"=>"textbox",   "req_type"=>"rt", "width"=>"210px", "title"=>"Şifre", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
			"bolgeId"         =>array("header"=>"Bolge",  "type"=>"enum",      "req_type"=>"st", "width"=>"210px", "title"=>"", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>"", "source"=>$users, "view_type"=>"dropdownlist", "radiobuttons_alignment"=>"horizontal|vertical", "multiple"=>false, "multiple_size"=>"4"),
			"semt"       =>array("header"=>"Semt", "type"=>"textbox",   "req_type"=>"st", "width"=>"210px", "title"=>"Kullanıcı Adı", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
			"il"       =>array("header"=>"İl", "type"=>"textbox",   "req_type"=>"st", "width"=>"210px", "title"=>"Kullanıcı Adı", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
			"telno"       =>array("header"=>"Telefon Numarası", "type"=>"textbox",   "req_type"=>"st", "width"=>"210px", "title"=>"Kullanıcı Adı", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
			"mudur"       =>array("header"=>"Mağaza Müdürü", "type"=>"textbox",   "req_type"=>"st", "width"=>"210px", "title"=>"Kullanıcı Adı", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
			"mudurtel"       =>array("header"=>"Müdür Telefonu", "type"=>"textbox",   "req_type"=>"st", "width"=>"210px", "title"=>"Kullanıcı Adı", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
			"sef"       =>array("header"=>"Rayon Şefi", "type"=>"textbox",   "req_type"=>"st", "width"=>"210px", "title"=>"Kullanıcı Adı", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
			"seftel"       =>array("header"=>"Şef Telefonu", "type"=>"textbox",   "req_type"=>"st", "width"=>"210px", "title"=>"Kullanıcı Adı", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
			"warnday"       =>array("header"=>"Z.Gün", "type"=>"textbox",   "req_type"=>"si", "width"=>"210px", "title"=>"Uyari Suresi", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
	);
	$dgrid->setColumnsInEditMode($em_columns);

	$add_msg = "Başarıyla eklendi!";
	$update_msg = "Başarıyla güncellendi!";
	$delete_msg = "Başarıyla silindi!";

	$dgrid->SetDgMessages($add_msg, $update_msg, $delete_msg);
	$dgrid->bind();

	ob_end_flush();

	if($mode == "update"){
    echo "<script>
					setTimeout('top[1].location.href=top[1].location.href', 1000);
					</script>";
  }

  if($act != ""){
    echo "<script>
					setTimeout('top[1].location.href=top[1].location.href', 1000);
					</script>";
  }

  ?>
	<br />

</body>
</html>
