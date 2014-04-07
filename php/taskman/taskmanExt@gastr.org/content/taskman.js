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
	 var outp="";
    var treeView = {  
    data:{
     childData : {     
      },        
      visibleData : [  
 
      ]
	  },
      treeBox: null,  
      selection: null,  
      
      get rowCount()                     { return this.data.visibleData.length; },  
      setTree: function(treeBox)         { this.treeBox = treeBox; },  
      getCellText: function(idx, column) {outp+=this.data.visibleData[idx][column.id]; return this.data.visibleData[idx][column.id]; },  
      isContainer: function(idx)         { return this.data.visibleData[idx][2]; },  
      isContainerOpen: function(idx)     { return this.data.visibleData[idx][3]; },  
      isContainerEmpty: function(idx)    { return false; },  
      isSeparator: function(idx)         { return false; },  
      isSorted: function()               { return false; },  
      isEditable: function(idx, column)  { return false; },  
      
      getParentIndex: function(idx) {  
        if (this.isContainer(idx)) return -1;  
        for (var t = idx - 1; t >= 0 ; t--) {  
          if (this.isContainer(t)) return t;  
        }  
      },  
      getLevel: function(idx) {  
        if (this.isContainer(idx)) return 0;  
        return 1;  
      },  
      hasNextSibling: function(idx, after) {  
        var thisLevel = this.getLevel(idx);  
        for (var t = after + 1; t < this.data.visibleData.length; t++) {  
          var nextLevel = this.getLevel(t);  
          if (nextLevel == thisLevel) return true;  
          if (nextLevel < thisLevel) break;  
        }  
        return false;  
      },  
      toggleOpenState: function(idx) {  
        var item = this.data.visibleData[idx];  
        if (!item[2]) return;  
      
        if (item[3]) {  
          item[3] = false;  
      
          var thisLevel = this.getLevel(idx);  
          var deletecount = 0;  
          for (var t = idx + 1; t < this.data.visibleData.length; t++) {  
            if (this.getLevel(t) > thisLevel) deletecount++;  
            else break;  
          }  
          if (deletecount) {  
            this.data.visibleData.splice(idx + 1, deletecount);  
            this.treeBox.rowCountChanged(idx + 1, -deletecount);  
          }  
        }  
        else {  
          item[3] = true;  
      
          var label = this.data.visibleData[idx][0];  
          var toinsert = this.data.childData[label];  
          for (var i = 0; i < toinsert.length; i++) {  
            this.data.visibleData.splice(idx + i + 1, 0, [toinsert[i], "xxx"]);  
          }  
          this.treeBox.rowCountChanged(idx + 1, toinsert.length);  
        }  
        this.treeBox.invalidateRow(idx);  
      },  
      
      getImageSrc: function(idx, column) {},  
      getProgressMode : function(idx,column) {},  
      getCellValue: function(idx, column) {},  
      cycleHeader: function(col, elem) {},  
      selectionChanged: function() {},  
      cycleCell: function(idx, column) {return false;},  
      performAction: function(action) {},  
      performActionOnCell: function(action, index, column) {},  
      getRowProperties: function(idx, prop) {},  
      getCellProperties: function(idx, column, prop) {},  
      getColumnProperties: function(column, element, prop) {},  
    };  
function showSelected(){
	col={id:0}
	out(treeView.getCellText(treeView.treeBox.view.selection.currentIndex,col));

}
function getSel(){
col={id:0};
return treeView.getCellText(treeView.treeBox.view.selection.currentIndex,col);
}
function addNew(){
	var col={id:"namecol"}
	//out(treeView.getCellText(treeView.treebox.view.selection.currentIndex,col));
//	var name = prompt("What is your name", "");

var dt=treeView.data;
dt.childData["newchild"]=[];
dt.visibleData.push(["newchild","2columnx",true,true])
	document.getElementById("elementList").view = treeView; 
	
}

function init() {  

	readFile("taskman.json", function(data) {		

	eval("var dt="+data);

	treeView.data=dt;

	document.getElementById("elementList").view = treeView;  
	});

	  
 // alert(outp);
} 
function readFile(filename, callback) {

	Components.utils.import("resource://gre/modules/FileUtils.jsm");

	var file = 0;
	try {
		file = FileUtils.getFile("ProfD", [ filename ]);
	} catch (e) {

	}

	Components.utils.import("resource://gre/modules/NetUtil.jsm");
	try {
		NetUtil.asyncFetch(file, function(inputStream, status) {
			if (!Components.isSuccessCode(status)) {

				callback(null);
			}

			var data = NetUtil.readInputStreamToString(inputStream, inputStream
					.available());
			callback(data);
		});

	} catch (e1) {
		/**
		 * file not found. first installation.
		 */
		callback(null);

	}

}
function remChild(){
 showSelected();
}
function get(id){
	return document.getElementById(id);
}

function saveToJson(){
addNew();
//return;
/*var n=get("istanimi").value;
if(n==="")
{
alert("İş tanımı giriniz.");
return;
}
var t=get("stime").value;

out(t)*/


writeToFile("taskman.json",toJson(treeView.data),function(par){});

}
function toJson(obj) {  
    var t = typeof (obj);  
    if (t != "object" || obj === null) {  
        // simple data type  
        if (t == "string") obj = '"'+obj+'"';  
        return String(obj);  
    }  
    else {  
        // recurse array or object  
        var n, v, json = [], arr = (obj && obj.constructor == Array);  
        for (n in obj) {  
            v = obj[n]; t = typeof(v);  
            if (t == "string") v = '"'+v+'"';  
            else if (t == "object" && v !== null) v = JSON.stringify(v);  
            json.push((arr ? "" : '"' + n + '":') + String(v));  
        }  
        return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");  
    }  
};
function writeToFile(filename, dataw, callback) {
	Components.utils.import("resource://gre/modules/NetUtil.jsm");
	Components.utils.import("resource://gre/modules/FileUtils.jsm");

	var file = FileUtils.getFile("ProfD", [ filename ]);

	var data = dataw;

	var ostream = FileUtils.openSafeFileOutputStream(file);

	var converter = Components.classes["@mozilla.org/intl/scriptableunicodeconverter"]
			.createInstance(Components.interfaces.nsIScriptableUnicodeConverter);
	converter.charset = "UTF-8";
	var istream = converter.convertToInputStream(data);

	NetUtil.asyncCopy(istream, ostream, function(status) {
		if (!Components.isSuccessCode(status)) {

			callback(null);

			return;

		}
		callback(true);

	});

}