Ext.namespace("dd");
//function get

function getGridData(s) {

	var data = new Array();
	for (var i = 0; i < s.getCount(); ++i) {
		data[i] = s.data.items[i].data;
	}
	return Ext.util.JSON.encode(data);
}


AutoGridPanel = Ext.extend(Ext.grid.GridPanel, {
	reqArray:[],
	enableReorder : true,
	enableFormView : true,
	hasPaging : false,
	enablePaging : true,
	enableSearch : true,
	loadMask : true,
	frame : false,
	initComponent : function() {

		if ("undefined" !== this.rowEditor) {

		}
		this.id = "dynaGrid" + this.menuId + "_" + this.gridId;
		
		var _store = this.store;
		var config = {
			bbar : [new Ext.PagingToolbar({
						pageSize : 5,
						store : _store
					})]
		};

		if (this.columns && (this.columns instanceof Array)) {
			this.colModel = new Ext.grid.ColumnModel(this.columns);
			delete this.columns;
		}

		// boş model oluştur once
		if (!this.colModel) {
			this.colModel = new Ext.grid.ColumnModel([]);
		}

		// boş bottom bar oluştur
		if (!this.bbar) {
			this.bbar = []
		}

		// boş plugins oluştur
		/*
		 * if (!this.plugins) { this.plugins = [] }
		 */

	AutoGridPanel.superclass.initComponent.call(this);

		// event deÄtŸiştir..
		if (this.store) {
			this.store.on("metachange", this.onMetaChange, this);
		}

		// column model servera gÃ¶nderilir.. Å�imdilik kullanılmıyor..
		if (this.autoSave) {
			this.colModel.on("widthchange", this.saveColumModel, this);
			this.colModel.on("hiddenchange", this.saveColumModel, this);
			this.colModel.on("columnmoved", this.saveColumModel, this);
			this.colModel.on("columnlockchange", this.saveColumModel, this);
		}
		// Ext.apply(this, Ext.apply(this.initialConfig, config));

	},
	isReq:function(field){
		
	},
	firstLoad : function() {
		this.getStore().load({
					params : {
						meta : true,
						start : 0
					}
				})
	},
	onMetaChange : function(store, meta) {

		/**
		 * 
		 * serverdan gelen meta bilgi üzerinde gezilip yeni column model
		 * oluşturuluyor..
		 */
		var c;
		var config = [];
		var lookup = {};
		// console.info(store);
		if (typeof this.expander !== 'undefined') {
			config[0] = this.expander
			// lookup[0] = this.expander
		}
		if (meta.fields.length == 0) {
			var g=this;
			Ext.MessageBox.alert(LANG.WARNING,
					"Bu gridle ilgili veritabaninda kayit yok", function() {
						Util.insert({
									table : 'gridOption',
									fields : ["menuId", "gridId", "field",
											"header", "width", "sira"],
									values : [g.menuId, g.gridId,
											"RECNO", "Recn", "100", "0"]
								})
					});
			return;

		}
		for (var i = 0, len = meta.fields.length; i < len; i++) {
			c = meta.fields[i];

			if (c.header !== undefined) {
				if (typeof c.dataIndex == "undefined") {
					c.dataIndex = c.name;
				}
				if (typeof c.renderer == "string") {
					c.renderer = Ext.util.Format[c.renderer];
				}
				if (typeof c.id == "undefined") {
					c.id = 'c' + i;
				}
				if (c.editor && c.editor.isFormField) {
					c.editor = new Ext.grid.GridEditor(c.editor);
				}

				c.sortable = true;
				if (typeof this.renderColumn !== 'undefined') {
					if (c.name === this.renderColumn.column) {
						c.renderer = this.renderColumn.fn;
					}
				}
				if (typeof this.renderColumnSecond !== 'undefined') {
					if (c.name === this.renderColumnSecond.column) {
						c.renderer = this.renderColumnSecond.fn;
					}
				}
				if (typeof this.renderColumnThird !== 'undefined') {
					if (c.name === this.renderColumnThird.column) {
						c.renderer = this.renderColumnThird.fn;
					}
				}
				if (typeof this.alignRight !== 'undefined') {
					var rightFields = this.alignRight.join();

					if (rightFields.indexOf(c.name) !== -1) {

						c.align = 'right';
					}
				}
			
				config[config.length] = c;
				lookup[c.id] = c;
			}
		}

		/**
		 * 
		 * yeni oluşmuş model gride atanıyor
		 */
		this.colModel.config = config;
		this.colModel.lookup = lookup;

		this.pageSize = meta.pageSize;

		/**
		 * paging plugini dinamic olarak ekleniyor..
		 * 
		 * Birden fazla eklenmemesi için hasPaging propertysi kullanılır
		 * 
		 */
		if (!this.hasPaging) {
			this.hasPaging = true;
			if (this.enablePaging) {
				this.getBottomToolbar().add(new Ext.PagingToolbar({
							pageSize : this.pageSize,
							store : store

						}));
			}
			if (this.enableSearch) {
				// this.plugins.beforeRenderx(this);
			}
		}
		/**
		 * arama plugini varsa menüleri tekrar ayarlanır..
		 */
		if (this.plugins) {
			try {
				this.plugins.reconfigure();
			} catch (e) {
				try {
					this.plugins[0].reconfigure();
				} catch (x) {

				}
			}

		}
		/**
		 * 
		 * gridi tekrar çiz ( ki değişiklikler görünsün)
		 * 
		 */
		if (this.rendered) {
			this.view.refresh(true);
		}

		this.on({
			'rowcontextmenu' : function(grid, index, e) {
				if (this.externContext)
					return;
				e.stopEvent();
				this.getSelectionModel().selectRow(index);
				if (!this.contextMenu) {
					var _owner = this;

					this.contextMenu = new Ext.menu.Menu({
						id : 'gridCtxMenu',
						items : [{
							text : 'Tabloyu düzenle',
							ownerGrid : _owner,
							disabled : 'ADMIN' !== LoginInfo.kategori
									|| !_owner.enableReorder,
							handler : function() {
								/**
								 * Sadece admin column reorder yapabilir
								 * (31.07.2009)
								 */
								var userType = LoginInfo.kategori;
								if (userType !== 'ADMIN') {
									Ext.MessageBox
											.alert("Hata",
													"Sadece ADMIN kullanıcısı tabloyu düzenleyebilir");
									return;
								}
								var owner = this.ownerGrid;
								/**
								 * gridde var olan columların olduğu grid
								 */
								var fieldsGrid = new Ext.grid.EditorGridPanel({
									frame : true,
									ddGroup : 'testDDGroup',
									enableDragDrop : true,
									autoScroll : true,
									tbar : [{
										text : 'Sil',
										iconCls : 'icon-table_delete',
										handler : function() {
											Ext.Ajax.request({
												url :Baseurl
														+ '/application.php?way=system&case=deleteFields',
												method : 'post',
												params : {
													id : fieldsGrid
															.getSelectionModel()
															.getSelected()
															.get("id")
												},
												callback : function(options,
														success, response) {
													if (success) {
														fieldsGrid.getStore()
																.reload();
													}
												}
											});
											// fieldsGrid.getSelectionModel().getSelected()
										}
									}, {
										xtype : 'label',

										html : '<b>Değiştirmek için alanların üzerine çift tıklayın</b>'

									}],
									listeners : {
										render : function(g) {

											

											Ext.dd.ScrollManager.register(g
													.getView()
													.getEditorParent());
										},
										beforedestroy : function(g) {

											Ext.dd.ScrollManager.unregister(g
													.getView()
													.getEditorParent());
										}
									},

									store : new Ext.data.JsonStore({
										url : Baseurl
												+ '/application.php?way=system&case=getGridFields',
										totalProperty : "totalCount",
										root : "result",
										baseParams : {
											where : Ext.encode([{
														field : 'menuId',
														value : owner.menuId,
														whereType : 'and',
														searchType : 'default',
														queryType : 0
													}, {
														field : 'gridId',
														value : owner.gridId,
														whereType : 'and',
														searchType : 'default',
														queryType : 0
													}, {
														field : 'aktif',
														value : 1,
														whereType : 'and',
														searchType : 'default',
														queryType : 0
													}]),
											sort : 'sira',
											dir : 'ASC'
										},
										fields : [{
													name : 'id',
													mapping : 'id',
													type : 'int'
												}, {
													name : 'field',
													mapping : 'field',
													type : 'string'
												}, {
													name : 'header',
													mapping : 'header',
													type : 'string'
												}, {
													name : 'width',
													mapping : 'width',
													type : 'string'
												}]
									}),
									sm : new Ext.grid.RowSelectionModel({
												singleSelect : true
											}),
									cm : new Ext.grid.ColumnModel([{
												header : "Alan",
												width : 120,
												sortable : true,
												dataIndex : 'field'

											}, {
												header : "Başlık",
												width : 120,
												sortable : true,
												dataIndex : 'header',
												editor : new Ext.form.TextField(
														{
															allowBlank : false
														})

											}, {
												header : "Genişlik",
												width : 60,
												sortable : true,
												dataIndex : 'width',
												editor : new Ext.form.TextField(
														{
															maskRe : /^[0-9]$/,
															allowBlank : false

														})

											}]),
									width : 330,
									height : 300
								});

								/**
								 * Mustafa Eklenti Store URL sini çekmiyordu
								 * bende tekrar seninkini bozmadan araya kontrol
								 * koydum *
								 */
								var ownerURL = null;
								if (owner.getStore().url) {
									ownerURL = owner.getStore().url;
								} else {
									ownerURL = owner.getStore().proxy.conn.url;
								}
								/** Mustafa Eklenti bitti * */

								/**
								 * Alanları değiştirileceği panel ve grid
								 * bulundurur
								 */

								var gridOptionPanel = new Ext.form.FormPanel({
									items : {
										layout : 'form',
										frame : true,
										items : [{
											fieldLabel : 'Alanlar',
											name : 'alanlar',
											xtype : 'combo',
											anchor : '60%',
											pageSize : 0,
											displayField : 'item',

											valueField : 'id',
											mode : 'local',
											forceSelection : true,
											value : 0,
											/**
											 * Mustafa DeÄŸişiklik store: new
											 * Ext.data.JsonStore({ url:
											 * ownerURL, autoLoad: true,
											 * baseParams: { action: 'getFields' },
											 * fields: [{ name: 'id', mapping:
											 * 'id', type: 'int' }, { name:
											 * 'item', mapping: 'item', type:
											 * 'string' }] }),
											 */
											store : new Ext.data.JsonStore({
														url : ownerURL,
														autoLoad : true,
														/** Mustafa Eklenti * */
														root : "fields",
														/** Mustafa Eklenti bitti * */
														baseParams : {
															action : 'getFields'
														},
														fields : [{
																	name : 'id',
																	type : 'string'
																}, {
																	name : 'item',
																	type : 'string'
																}]
													}),
											listeners : {
												select : function(combo,
														record, index) {
													gridOptionPanel
															.findById("idHeader")
															.setValue(record
																	.get("item"));
												}
											}
										}, {
											name : 'size',
											id : 'idSize',
											xtype : 'textfield',
											fieldLabel : 'Genişlik',
											anchor : '40%',
											value : "100"
										}, {
											id : 'idHeader',
											name : 'header',
											xtype : 'textfield',
											fieldLabel : 'Başlık',
											anchor : '60%'
										}, {
											xtype : 'button',
											text : 'Ekle',
											handler : function() {
												// console.log(owner.getStore().url);
												var value = gridOptionPanel
														.getForm()
														.findField("alanlar")
														.getRawValue();
												var exist = fieldsGrid
														.getStore().find(
																"field", value);
												if (exist !== -1) {
													Ext.MessageBox
															.alert("uyarı",
																	"Bu alan zaten eklenmiş");
													return;
												}
												gridOptionPanel.getForm()
														.submit({
															url : Baseurl
																	+ '/application.php?way=system&case=insertFields',
															params : {
																menuId : owner.menuId,
																gridId : owner.gridId

															},
															success : function(
																	a) {

																fieldsGrid
																		.getStore()
																		.reload();
															},
															callback : function(
																	a, b, c) {

															}
														});
											}

										}, fieldsGrid, {

										}, {
											xtype : 'textfield',
											name : 'pageSize',
											fieldLabel : 'Sayfadaki Kayit Sayisi',
											anchor : '50%',
											value : owner.pageSize
										}]
									}
								});
								var gridOptionWindow = new Ext.Window({
									modal : true,
									title : "Tabloyu düzenle",
									width : 400,
									height : 500,
									items : gridOptionPanel,

									bbar : ['->', {
										text : "Tamam",
										handler : function() {
											Ext.Ajax.request({
												url :Baseurl
														+ '/application.php?way=system&case=updateFields',
												method : 'post',
												params : {
													menuId : owner.menuId,
													gridId : owner.gridId,
													gridData : getGridData(fieldsGrid
															.getStore()),
													pageSize : gridOptionPanel
															.getForm()
															.findField("pageSize")
															.getValue()
												},
												callback : function(options,
														success, response) {
													if (success) {
													}
												}
											});

											owner.getStore().load({
														params : {
															meta : true,
															start : 0
														}
													});
											owner.getView().refresh();
											gridOptionWindow.close();
										}
									}, {
										text : "Vazgeç",
										handler : function() {
											gridOptionWindow.close();
										}
									}]

								});
								gridOptionWindow.show();
								fieldsGrid.getStore().load();
							}

						}, {
							text : 'Kayıt ekle',
							ownerGrid : _owner,
							iconCls : 'icon-table_add',
							disabled : "undefined" === typeof _owner.addFunction,
							handler : function() {
								if ("undefined" !== typeof this.ownerGrid.addFunction)
									this.ownerGrid.addFunction(this.ownerGrid);
							}
						}, {
							text : 'Bu kaydı düzenle',
							ownerGrid : _owner,
							iconCls : 'icon-table_edit',
							disabled : "undefined" === typeof _owner.editFunction,
							handler : function() {
								if ("undefined" !== typeof this.ownerGrid.editFunction)
									this.ownerGrid.editFunction(this.ownerGrid);
							}
						}, {
							text : 'Bu kaydı Sil',
							iconCls : 'icon-table_delete',
							ownerGrid : _owner,
							disabled : "undefined" === typeof _owner.deleteFunction,
							handler : function() {
								if ("undefined" !== typeof this.ownerGrid.deleteFunction)
									this.ownerGrid
											.deleteFunction(this.ownerGrid);
							}
						}, {
							text : 'Form görünümü',

							ownerGrid : _owner,
							disabled : false === _owner.enableFormView,
							handler : function() {
								if (true === this.ownerGrid.enableFormView)
									
											DynaForm(this.ownerGrid);
							}
						}, {
							text : "Excel'e Gonder",
							ownerGrid : _owner,
							handler : function() {
								console.info("excel deleted")
							}
						}]
					});
				}
				var xy = e.getXY();

				this.contextMenu.showAt(xy);

			},
			'select' : function() {
			//	this.getView().refresh();
			},
			scope : this

		});
		if ("undefined" !== typeof this.updateColumn) {
			this.on("celldblclick", function(grid, row, col, e) {
						console.info("updateWindow deleted")
					})
		}
	},

	saveColumModel : function() {

		var c, config = this.colModel.config;
		var fields = [];
		for (var i = 0, len = config.length; i < len; i++) {
			c = config[i];
			fields[i] = {
				name : c.name,
				width : c.width
			};
			if (c.hidden) {
				fields[i].hidden = true;
			}
		}
	}

});


Ext.reg("dynaGrid", AutoGridPanel);

