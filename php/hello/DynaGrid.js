console.log("filed called");
Ext.define("DataModel", {
    extend : "Ext.data.Model",
    fields : []
});

Ext.define("DynaGrid", {
    extend : "Ext.tab.Panel",
    alias : "dynaGrid",
    height:500,
    name : 'Unknown',
    region : "center",
    store : null,
    buts : [],
    tabPosition : 'bottom',
    grid : null,
    items : [],
    initComponent : function() {


	console.log(this);
	this.doToolbar();

	/**
	 * data fetching
	 */
	var store = Ext.create("Ext.data.Store", {
	    model : "DataModel",
	    autoLoad : false,
	    columns : []
	});

	var grid = Ext.create("Ext.grid.Panel", {
	    columns : []
	});

	this.store = store;
	this.grid = grid;

	this.items = [{
	    title : 'Home',
	    items : [grid],
	    itemId : 'home'

	}, {
	    title : 'Detay',
	    html : 'Users'

	}];
	this.callParent(this);

    },
    firstLoad : function() {

	var me = this;
	Ext.Ajax.request({
	    url : "server/dynaGrid.php",
	    success : function(response) {
		var data = Ext.decode(response.responseText);
		me.store.model.setFields(data.fields);
		me.grid.reconfigure(me.store, data.columns);
		me.store.loadRawData(data.data, false);
	    }
	})
    },
    doToolbar : function() {

	this.dockedItems = [{
	    xtype : 'toolbar',
	    dock : 'top',
	    items : []
	}];

	if (this.buts[2] == 1) {
	    this.dockedItems[0].items.push({
		xtype : 'button',
		text : 'Add',
		iconCls : 'addbutton',
		handler : function(e) {
		    Ext.MessageBox.alert("bla bla ",
					 "blabjkdfj");
		    console.info(e);
		}
	    });
	}
	if (this.buts[1] == 1) {
	    this.dockedItems[0].items.push({
		xtype : 'button',
		text : 'Edit',
		iconCls : 'editbutton'
	    });
	}
	if (this.buts[0] == 1) {
	    this.dockedItems[0].items.push({
		xtype : 'button',
		text : 'Delete',
		iconCls : 'deletebutton'
	    });
	}
    }
});

var grid = Ext.create("DynaGrid", {
    buts : "111"
});
