
function	out(object) {
var debug=true;
		if (!debug)
			return;

		var output = '';
		if (typeof (object) === "object") {
			for (property in object) {
				output += property + ': ' + object[property] + '\n ';
			}
		}

		else {
			output = object;
		}
		//var d = document.getElementById("dframe");
		 alert(output);

	}
var treeView = {  
    rowCount : 2,  
    getCellText : function(row,column){  
	
      if (column.id == "namecol") return "Row "+row;  
      else return "February 18";  
    },  
    setTree: function(treebox){ this.treebox = treebox; },  
    isContainer: function(row){ return false; },  
    isSeparator: function(row){ return false; },  
    isSorted: function(){ return false; },  
    getLevel: function(row){ return 0; },  
    getImageSrc: function(row,col){ return null; },  
    getRowProperties: function(row,props){},  
    getCellProperties: function(row,col,props){},  
    getColumnProperties: function(colid,col,props){}  
};  

function init(){
document.getElementById('my-tree').view = treeView;
}

function showSelected(){
var col={id:"namecol"}
out(treeView.getCellText(treeView.treebox.view.selection.currentIndex,col));
//out(treeView.treebox.);
}

window.addEventListener("load", init, false);