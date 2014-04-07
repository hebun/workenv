//Ext.require(["Ext.grid.Panel", "Ext.data.*"]);
var item2 = Ext.create('Ext.Panel', {
	title : 'Accordion Item 2',
	html : '&lt;empty panel&gt;',
	cls : 'empty'
});

var item3 = Ext.create('Ext.Panel', {
	title : 'Accordion Item 3',
	html : '&lt;empty panel&gt;',
	cls : 'empty'
});

var item4 = Ext.create('Ext.Panel', {
	title : 'Accordion Item 4',
	html : '&lt;empty panel&gt;',
	cls : 'empty'
});

var item5 = Ext.create('Ext.Panel', {
	title : 'Accordion Item 5',
	html : '&lt;empty panel&gt;',
	cls : 'empty'
});
var accordion = Ext.create('Ext.Panel', {
	title : 'Accordion',
	collapsible : true,
	region : 'west',
	margins : '5 0 5 5',
	split : true,
	width : 210,
	layout : 'accordion',
	items : [ item2, item3, item4, item5 ]
});
var tabs = Ext.create('Ext.tab.Panel', {
	region : "center",
	items : [ {
		title : 'Home',
		items:[grid],
		itemId : 'home'
	
	}, {
		title : 'Users',
		html : 'Users',
		itemId : 'users'
	}, {
		title : 'Tickets',
		html : 'Tickets',
		itemId : 'tickets'
	} ]
});
Ext.application({
	name : 'HelloExt',
	launch : function() {
		Ext.create('Ext.container.Viewport', {

			layout : {
				type : 'border',
				padding : 5
			},
			items : [ accordion, tabs

			]
		});
		grid.firstLoad();
	}
});
