namespace Verito
{
    partial class Form3
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Form3));
            this.menuStrip1 = new System.Windows.Forms.MenuStrip();
            this.tanımlarToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.ürünTanımlaToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.müşteriTanımlaToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.tedarikçiTanımlaToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.kategorilerToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.müşterilerToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.tedarikçilerToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.birimCinsiTanımlaToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.paraBirimTanımlaToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.hareketlerToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.ambarToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.siparişToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.siparişlerToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.ürünlerToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.araçlarToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.ayarlarToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.kullanıcılarToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.ımageList1 = new System.Windows.Forms.ImageList(this.components);
            this.tabControl1 = new System.Windows.Forms.TabControl();
            this.vButton2 = new Verito.controls.VButton();
            this.vButton1 = new Verito.controls.VButton();
            this.menuStrip1.SuspendLayout();
            this.SuspendLayout();
            // 
            // menuStrip1
            // 
            this.menuStrip1.Items.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.tanımlarToolStripMenuItem,
            this.hareketlerToolStripMenuItem,
            this.araçlarToolStripMenuItem});
            this.menuStrip1.Location = new System.Drawing.Point(0, 0);
            this.menuStrip1.Name = "menuStrip1";
            this.menuStrip1.Size = new System.Drawing.Size(984, 24);
            this.menuStrip1.TabIndex = 0;
            this.menuStrip1.Text = "menuStrip1";
            this.menuStrip1.ItemClicked += new System.Windows.Forms.ToolStripItemClickedEventHandler(this.menuStrip1_ItemClicked);
            // 
            // tanımlarToolStripMenuItem
            // 
            this.tanımlarToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.ürünTanımlaToolStripMenuItem,
            this.müşteriTanımlaToolStripMenuItem,
            this.tedarikçiTanımlaToolStripMenuItem,
            this.kategorilerToolStripMenuItem,
            this.müşterilerToolStripMenuItem,
            this.tedarikçilerToolStripMenuItem,
            this.birimCinsiTanımlaToolStripMenuItem,
            this.paraBirimTanımlaToolStripMenuItem});
            this.tanımlarToolStripMenuItem.Name = "tanımlarToolStripMenuItem";
            this.tanımlarToolStripMenuItem.Size = new System.Drawing.Size(66, 20);
            this.tanımlarToolStripMenuItem.Text = "Tanımlar";
            // 
            // ürünTanımlaToolStripMenuItem
            // 
            this.ürünTanımlaToolStripMenuItem.Name = "ürünTanımlaToolStripMenuItem";
            this.ürünTanımlaToolStripMenuItem.Size = new System.Drawing.Size(177, 22);
            this.ürünTanımlaToolStripMenuItem.Text = "Ürün Tanımla";
            this.ürünTanımlaToolStripMenuItem.Click += new System.EventHandler(this.ürünTanımlaToolStripMenuItem_Click);
            // 
            // müşteriTanımlaToolStripMenuItem
            // 
            this.müşteriTanımlaToolStripMenuItem.Name = "müşteriTanımlaToolStripMenuItem";
            this.müşteriTanımlaToolStripMenuItem.Size = new System.Drawing.Size(177, 22);
            this.müşteriTanımlaToolStripMenuItem.Text = "Müşteri Tanımla";
            this.müşteriTanımlaToolStripMenuItem.Click += new System.EventHandler(this.müşteriTanımlaToolStripMenuItem_Click);
            // 
            // tedarikçiTanımlaToolStripMenuItem
            // 
            this.tedarikçiTanımlaToolStripMenuItem.Name = "tedarikçiTanımlaToolStripMenuItem";
            this.tedarikçiTanımlaToolStripMenuItem.Size = new System.Drawing.Size(177, 22);
            this.tedarikçiTanımlaToolStripMenuItem.Text = "Tedarikçi Tanımla";
            this.tedarikçiTanımlaToolStripMenuItem.Click += new System.EventHandler(this.tedarikçiTanımlaToolStripMenuItem_Click);
            // 
            // kategorilerToolStripMenuItem
            // 
            this.kategorilerToolStripMenuItem.Name = "kategorilerToolStripMenuItem";
            this.kategorilerToolStripMenuItem.Size = new System.Drawing.Size(177, 22);
            this.kategorilerToolStripMenuItem.Text = "Kategoriler";
            this.kategorilerToolStripMenuItem.Click += new System.EventHandler(this.kategorilerToolStripMenuItem_Click);
            // 
            // müşterilerToolStripMenuItem
            // 
            this.müşterilerToolStripMenuItem.Name = "müşterilerToolStripMenuItem";
            this.müşterilerToolStripMenuItem.Size = new System.Drawing.Size(177, 22);
            this.müşterilerToolStripMenuItem.Text = "Müşteriler";
            this.müşterilerToolStripMenuItem.Click += new System.EventHandler(this.müşterilerToolStripMenuItem_Click);
            // 
            // tedarikçilerToolStripMenuItem
            // 
            this.tedarikçilerToolStripMenuItem.Name = "tedarikçilerToolStripMenuItem";
            this.tedarikçilerToolStripMenuItem.Size = new System.Drawing.Size(177, 22);
            this.tedarikçilerToolStripMenuItem.Text = "Tedarikçiler";
            this.tedarikçilerToolStripMenuItem.Click += new System.EventHandler(this.tedarikçilerToolStripMenuItem_Click);
            // 
            // birimCinsiTanımlaToolStripMenuItem
            // 
            this.birimCinsiTanımlaToolStripMenuItem.Name = "birimCinsiTanımlaToolStripMenuItem";
            this.birimCinsiTanımlaToolStripMenuItem.Size = new System.Drawing.Size(168, 22);
            this.birimCinsiTanımlaToolStripMenuItem.Text = "Birim Cinsleri";
            this.birimCinsiTanımlaToolStripMenuItem.Click += new System.EventHandler(this.birimCinsiTanımlaToolStripMenuItem_Click);
            // 
            // paraBirimTanımlaToolStripMenuItem
            // 
            this.paraBirimTanımlaToolStripMenuItem.Name = "paraBirimTanımlaToolStripMenuItem";
            this.paraBirimTanımlaToolStripMenuItem.Size = new System.Drawing.Size(177, 22);
            this.paraBirimTanımlaToolStripMenuItem.Text = "Para Birimleri";
            this.paraBirimTanımlaToolStripMenuItem.Click += new System.EventHandler(this.paraBirimTanımlaToolStripMenuItem_Click);
            // 
            // hareketlerToolStripMenuItem
            // 
            this.hareketlerToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.ambarToolStripMenuItem,
            this.siparişToolStripMenuItem,
            this.siparişlerToolStripMenuItem,
            this.ürünlerToolStripMenuItem});
            this.hareketlerToolStripMenuItem.Name = "hareketlerToolStripMenuItem";
            this.hareketlerToolStripMenuItem.Size = new System.Drawing.Size(73, 20);
            this.hareketlerToolStripMenuItem.Text = "Hareketler";
            // 
            // ambarToolStripMenuItem
            // 
            this.ambarToolStripMenuItem.Name = "ambarToolStripMenuItem";
            this.ambarToolStripMenuItem.Size = new System.Drawing.Size(152, 22);
            this.ambarToolStripMenuItem.Text = "Ambar";
            this.ambarToolStripMenuItem.Click += new System.EventHandler(this.ambarToolStripMenuItem_Click_1);
            // 
            // siparişToolStripMenuItem
            // 
            this.siparişToolStripMenuItem.Name = "siparişToolStripMenuItem";
            this.siparişToolStripMenuItem.Size = new System.Drawing.Size(152, 22);
            this.siparişToolStripMenuItem.Text = "Yeni Sipariş";
            this.siparişToolStripMenuItem.Click += new System.EventHandler(this.siparişToolStripMenuItem_Click);
            // 
            // siparişlerToolStripMenuItem
            // 
            this.siparişlerToolStripMenuItem.Name = "siparişlerToolStripMenuItem";
            this.siparişlerToolStripMenuItem.Size = new System.Drawing.Size(152, 22);
            this.siparişlerToolStripMenuItem.Text = "Siparişler";
            this.siparişlerToolStripMenuItem.Click += new System.EventHandler(this.siparişlerToolStripMenuItem_Click);
            // 
            // ürünlerToolStripMenuItem
            // 
            this.ürünlerToolStripMenuItem.Name = "ürünlerToolStripMenuItem";
            this.ürünlerToolStripMenuItem.Size = new System.Drawing.Size(152, 22);
            this.ürünlerToolStripMenuItem.Text = "Ürünler";
            this.ürünlerToolStripMenuItem.Click += new System.EventHandler(this.ürünlerToolStripMenuItem_Click);
            // 
            // araçlarToolStripMenuItem
            // 
            this.araçlarToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.ayarlarToolStripMenuItem,
            this.kullanıcılarToolStripMenuItem});
            this.araçlarToolStripMenuItem.Name = "araçlarToolStripMenuItem";
            this.araçlarToolStripMenuItem.Size = new System.Drawing.Size(56, 20);
            this.araçlarToolStripMenuItem.Text = "Araçlar";
            // 
            // ayarlarToolStripMenuItem
            // 
            this.ayarlarToolStripMenuItem.Name = "ayarlarToolStripMenuItem";
            this.ayarlarToolStripMenuItem.Size = new System.Drawing.Size(152, 22);
            this.ayarlarToolStripMenuItem.Text = "Ayarlar";
            this.ayarlarToolStripMenuItem.Visible = false;
            this.ayarlarToolStripMenuItem.Click += new System.EventHandler(this.ayarlarToolStripMenuItem_Click);
            // 
            // kullanıcılarToolStripMenuItem
            // 
            this.kullanıcılarToolStripMenuItem.Name = "kullanıcılarToolStripMenuItem";
            this.kullanıcılarToolStripMenuItem.Size = new System.Drawing.Size(132, 22);
            this.kullanıcılarToolStripMenuItem.Text = "Kullanıcılar";
            this.kullanıcılarToolStripMenuItem.Click += new System.EventHandler(this.kullanıcılarToolStripMenuItem_Click);
            // 
            // ımageList1
            // 
            this.ımageList1.ImageStream = ((System.Windows.Forms.ImageListStreamer)(resources.GetObject("ımageList1.ImageStream")));
            this.ımageList1.TransparentColor = System.Drawing.Color.Transparent;
            this.ımageList1.Images.SetKeyName(0, "close");
            // 
            // tabControl1
            // 
            this.tabControl1.ImageList = this.ımageList1;
            this.tabControl1.Location = new System.Drawing.Point(12, 39);
            this.tabControl1.Name = "tabControl1";
            this.tabControl1.RightToLeft = System.Windows.Forms.RightToLeft.No;
            this.tabControl1.SelectedIndex = 0;
            this.tabControl1.Size = new System.Drawing.Size(972, 648);
            this.tabControl1.TabIndex = 1;
            // 
            // vButton2
            // 
            this.vButton2.BackColor = System.Drawing.Color.LightBlue;
            this.vButton2.FlatAppearance.BorderColor = System.Drawing.Color.FromArgb(((int)(((byte)(51)))), ((int)(((byte)(153)))), ((int)(((byte)(255)))));
            this.vButton2.FlatAppearance.CheckedBackColor = System.Drawing.Color.FromArgb(((int)(((byte)(153)))), ((int)(((byte)(204)))), ((int)(((byte)(255)))));
            this.vButton2.FlatAppearance.MouseDownBackColor = System.Drawing.Color.FromArgb(((int)(((byte)(153)))), ((int)(((byte)(204)))), ((int)(((byte)(255)))));
            this.vButton2.FlatAppearance.MouseOverBackColor = System.Drawing.Color.FromArgb(((int)(((byte)(194)))), ((int)(((byte)(224)))), ((int)(((byte)(255)))));
            this.vButton2.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.vButton2.Location = new System.Drawing.Point(892, 37);
            this.vButton2.Name = "vButton2";
            this.vButton2.Size = new System.Drawing.Size(89, 22);
            this.vButton2.TabIndex = 5;
            this.vButton2.Text = "Sekmeyi Kapat";
            this.vButton2.UseVisualStyleBackColor = true;
            this.vButton2.Click += new System.EventHandler(this.vButton2_Click);
            // 
            // vButton1
            // 
            this.vButton1.BackColor = System.Drawing.Color.LightBlue;
            this.vButton1.FlatAppearance.BorderColor = System.Drawing.Color.FromArgb(((int)(((byte)(51)))), ((int)(((byte)(153)))), ((int)(((byte)(255)))));
            this.vButton1.FlatAppearance.MouseDownBackColor = System.Drawing.Color.FromArgb(((int)(((byte)(153)))), ((int)(((byte)(204)))), ((int)(((byte)(255)))));
            this.vButton1.FlatAppearance.MouseOverBackColor = System.Drawing.Color.FromArgb(((int)(((byte)(194)))), ((int)(((byte)(224)))), ((int)(((byte)(255)))));
            this.vButton1.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.vButton1.Location = new System.Drawing.Point(567, 0);
            this.vButton1.Name = "vButton1";
            this.vButton1.Size = new System.Drawing.Size(75, 23);
            this.vButton1.TabIndex = 4;
            this.vButton1.Text = "vButton1";
            this.vButton1.UseVisualStyleBackColor = false;
            this.vButton1.Visible = false;
            this.vButton1.Click += new System.EventHandler(this.vButton1_Click);
            // 
            // Form3
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.SystemColors.ButtonFace;
            this.ClientSize = new System.Drawing.Size(984, 712);
            this.Controls.Add(this.vButton2);
            this.Controls.Add(this.vButton1);
            this.Controls.Add(this.tabControl1);
            this.Controls.Add(this.menuStrip1);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MainMenuStrip = this.menuStrip1;
            this.MaximizeBox = false;
            this.Name = "Form3";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Verito";
            this.Load += new System.EventHandler(this.Form3_Load);
            this.menuStrip1.ResumeLayout(false);
            this.menuStrip1.PerformLayout();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.MenuStrip menuStrip1;
        private System.Windows.Forms.ToolStripMenuItem tanımlarToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem ürünTanımlaToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem müşteriTanımlaToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem hareketlerToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem siparişToolStripMenuItem;
        private System.Windows.Forms.ImageList ımageList1;
        private System.Windows.Forms.TabControl tabControl1;
        private controls.VButton vButton1;
        private controls.VButton vButton2;
        private System.Windows.Forms.ToolStripMenuItem tedarikçiTanımlaToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem kategorilerToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem siparişlerToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem ambarToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem ürünlerToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem araçlarToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem ayarlarToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem kullanıcılarToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem müşterilerToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem tedarikçilerToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem birimCinsiTanımlaToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem paraBirimTanımlaToolStripMenuItem;
    }
}