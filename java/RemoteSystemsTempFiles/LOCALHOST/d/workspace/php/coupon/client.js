
var allurl=location.href.split('/');

var temp="";
for(var k=0;k<allurl.length;k++){
	if(k!=allurl.length-1)
	temp+=allurl[k]+"/";
}
var currentUrl=temp;

function deleteUser(id){
	
	if(confirm("Bu kullanıcıyı silmek istediğinize emin misiniz?")){
	    Ajax.call({
	        url: currentUrl + 'users.php',
	        params: {
	        		
	        	del:true,
	            id:id
	        },
	        load: function () {

	          
	        },
	        success: function (res) {
	           
	        	if(res==="success"){
	        		
	        		alert("Kullanıcı silindi");
	        		
	        		location.href=location.href;
	        		
	        	}

	        }
	    });
	}
	
}
function deleteFormpublisher(id){
	
	if(confirm("Bu kaydı silmek istediğinize emin misiniz?")){
	    Ajax.call({
	        url: currentUrl + 'formpublisher.php',
	        params: {
	        		
	        	del:true,
	            id:id
	        },
	        load: function () {

	          
	        },
	        success: function (res) {
	           
	        	if(res==="success"){
	        		
	        		alert("Kayıt silindi");
	        		
	        		location.href=location.href;
	        		
	        	}

	        }
	    });
	}
	
}
function deleteSite(id){
	
	if(confirm("Bu siteyi silmek istediğinize emin misiniz?")){
	    Ajax.call({
	        url: currentUrl + 'plugin.php',
	        params: {
	        		
	        	del:true,
	            id:id
	        },
	        load: function () {

	          
	        },
	        success: function (res) {
	           
	        	if(res==="success"){
	        		
	        		alert("Site silindi");
	        		
	        		location.href=location.href;
	        		
	        	}

	        }
	    });
	}
	
}
function deleteForm(id){
	
	if(confirm("Bu formu silmek istediğinize emin misiniz?")){
	    Ajax.call({
	        url: currentUrl + 'forms.php',
	        params: {
	        		
	        	del:true,
	            id:id
	        },
	        load: function () {

	          
	        },
	        success: function (res) {
	           
	        	if(res==="success"){
	        		
	        		alert("Form silindi");
	        		
	        		location.href=location.href;
	        		
	        	}

	        }
	    });
	}
	
}