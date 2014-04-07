namespace Verito
{
    partial class Stock
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
            this.label2 = new System.Windows.Forms.Label();
            this.groupBox3 = new System.Windows.Forms.GroupBox();
            this.panel1 = new System.Windows.Forms.Panel();
            this.vButton4 = new Verito.controls.VButton();
            this.label4 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.vButton5 = new Verito.controls.VButton();
            this.textBox1 = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.treeCombo = new Verito.controls.TreeCombo();
            this.textBox3 = new System.Windows.Forms.TextBox();
            this.label6 = new System.Windows.Forms.Label();
            this.groupBox2 = new System.Windows.Forms.GroupBox();
            this.vButton8 = new Verito.controls.VButton();
            this.vButton9 = new Verito.controls.VButton();
            this.vButton6 = new Verito.controls.VButton();
            this.myGrid2 = new Verito.MyGrid();
            this.treeView1 = new System.Windows.Forms.TreeView();
            this.vButton3 = new Verito.controls.VButton();
            this.vButton10 = new Verito.controls.VButton();
            this.vButton2 = new Verito.controls.VButton();
            this.vButton1 = new Verito.controls.VButton();
            this.vButton7 = new Verito.controls.VButton();
            this.groupBox3.SuspendLayout();
            this.panel1.SuspendLayout();
            this.groupBox2.SuspendLayout();
            this.SuspendLayout();
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(9, 17);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(87, 13);
            this.label2.TabIndex = 37;
            this.label2.Text = "Seçilime Bölüme;";
            // 
            // groupBox3
            // 
            this.groupBox3.Controls.Add(this.panel1);
            this.groupBox3.Location = new System.Drawing.Point(720, 12);
            this.groupBox3.Name = "groupBox3";
            this.groupBox3.Size = new System.Drawing.Size(213, 562);
            this.groupBox3.TabIndex = 34;
            this.groupBox3.TabStop = false;
            this.groupBox3.Text = "Ürün Ekle/Aktar";
            // 
            // panel1
            // 
            this.panel1.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.panel1.Controls.Add(this.vButton4);
            this.panel1.Controls.Add(this.label4);
            this.panel1.Controls.Add(this.label3);
            this.panel1.Controls.Add(this.vButton5);
            this.panel1.Controls.Add(this.textBox1);
            this.panel1.Controls.Add(this.label1);
            this.panel1.Controls.Add(this.treeCombo);
            this.panel1.Controls.Add(this.textBox3);
            this.panel1.Controls.Add(this.label6);
            this.panel1.Location = new System.Drawing.Point(6, 60);
            this.panel1.Name = "panel1";
            this.panel1.Size = new System.Drawing.Size(198, 238);
            this.panel1.TabIndex = 33;
            this.panel1.Paint += new System.Windows.Forms.PaintEventHandler(this.panel1_Paint);
            // 
            // vButton4
            // 
            this.vButton4.Location = new System.Drawing.Point(14, 13);
            this.vButton4.Name = "vButton4";
            this.vButton4.Size = new System.Drawing.Size(167, 23);
            this.vButton4.TabIndex = 38;
            this.vButton4.Text = "Yeni Ürün Ekle";
            this.vButton4.UseVisualStyleBackColor = true;
            this.vButton4.Click += new System.EventHandler(this.vButton4_Click);
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(84, 63);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(0, 13);
            this.label4.TabIndex = 36;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(29, 62);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(33, 13);
            this.label3.TabIndex = 35;
            this.label3.Text = "Ürün:";
            // 
            // vButton5
            // 
            this.vButton5.Location = new System.Drawing.Point(3, 185);
            this.vButton5.Name = "vButton5";
            this.vButton5.Size = new System.Drawing.Size(134, 23);
            this.vButton5.TabIndex = 34;
            this.vButton5.Text = "Ekle/Aktar";
            this.vButton5.UseVisualStyleBackColor = true;
            this.vButton5.Visible = false;
            this.vButton5.Click += new System.EventHandler(this.vButton5_Click);
            // 
            // textBox1
            // 
            this.textBox1.Location = new System.Drawing.Point(81, 85);
            this.textBox1.Name = "textBox1";
            this.textBox1.Size = new System.Drawing.Size(89, 20);
            this.textBox1.TabIndex = 33;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(0, 85);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(62, 13);
            this.label1.TabIndex = 32;
            this.label1.Text = "Ürün adedi:";
            // 
            // treeCombo
            // 
            this.treeCombo.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.treeCombo.FormattingEnabled = true;
            this.treeCombo.Location = new System.Drawing.Point(137, 138);
            this.treeCombo.Name = "treeCombo";
            this.treeCombo.Size = new System.Drawing.Size(44, 21);
            this.treeCombo.TabIndex = 31;
            // 
            // textBox3
            // 
            this.textBox3.Enabled = false;
            this.textBox3.Location = new System.Drawing.Point(3, 139);
            this.textBox3.Name = "textBox3";
            this.textBox3.Size = new System.Drawing.Size(128, 20);
            this.textBox3.TabIndex = 30;
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Location = new System.Drawing.Point(0, 113);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(153, 13);
            this.label6.TabIndex = 0;
            this.label6.Text = "Aktarılacak/eklenecek konum:";
            // 
            // groupBox2
            // 
            this.groupBox2.Controls.Add(this.vButton7);
            this.groupBox2.Controls.Add(this.vButton8);
            this.groupBox2.Controls.Add(this.vButton9);
            this.groupBox2.Controls.Add(this.vButton6);
            this.groupBox2.Controls.Add(this.myGrid2);
            this.groupBox2.Location = new System.Drawing.Point(380, 12);
            this.groupBox2.Name = "groupBox2";
            this.groupBox2.Size = new System.Drawing.Size(334, 562);
            this.groupBox2.TabIndex = 35;
            this.groupBox2.TabStop = false;
            this.groupBox2.Text = "Ambardaki Ürünler";
            this.groupBox2.Enter += new System.EventHandler(this.groupBox2_Enter);
            // 
            // vButton8
            // 
            this.vButton8.Location = new System.Drawing.Point(6, 60);
            this.vButton8.Name = "vButton8";
            this.vButton8.Size = new System.Drawing.Size(176, 23);
            this.vButton8.TabIndex = 4;
            this.vButton8.Text = "Tedarikçiye Göre Listele";
            this.vButton8.UseVisualStyleBackColor = true;
            this.vButton8.Click += new System.EventHandler(this.vButton8_Click);
            // 
            // vButton9
            // 
            this.vButton9.Location = new System.Drawing.Point(188, 31);
            this.vButton9.Name = "vButton9";
            this.vButton9.Size = new System.Drawing.Size(140, 23);
            this.vButton9.TabIndex = 5;
            this.vButton9.Text = "Kategoriye Göre Ara";
            this.vButton9.UseVisualStyleBackColor = true;
            this.vButton9.Click += new System.EventHandler(this.vButton9_Click);
            // 
            // vButton6
            // 
            this.vButton6.Location = new System.Drawing.Point(6, 31);
            this.vButton6.Name = "vButton6";
            this.vButton6.Size = new System.Drawing.Size(176, 23);
            this.vButton6.TabIndex = 2;
            this.vButton6.Text = "Min. Stoğun Altındakileri Listele";
            this.vButton6.UseVisualStyleBackColor = true;
            this.vButton6.Click += new System.EventHandler(this.vButton6_Click);
            // 
            // myGrid2
            // 
            this.myGrid2.DefaultSearchField = "pname";
            this.myGrid2.Id = 5;
            this.myGrid2.Location = new System.Drawing.Point(6, 104);
            this.myGrid2.Name = "myGrid2";
            this.myGrid2.OnlyGrid = false;
            this.myGrid2.Size = new System.Drawing.Size(322, 458);
            this.myGrid2.TabIndex = 1;
            // 
            // treeView1
            // 
            this.treeView1.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.treeView1.Location = new System.Drawing.Point(12, 66);
            this.treeView1.Name = "treeView1";
            this.treeView1.Size = new System.Drawing.Size(362, 508);
            this.treeView1.TabIndex = 30;
            this.treeView1.AfterSelect += new System.Windows.Forms.TreeViewEventHandler(this.treeView1_AfterSelect);
            // 
            // vButton3
            // 
            this.vButton3.Location = new System.Drawing.Point(144, 33);
            this.vButton3.Name = "vButton3";
            this.vButton3.Size = new System.Drawing.Size(76, 23);
            this.vButton3.TabIndex = 36;
            this.vButton3.Text = "Değiştir";
            this.vButton3.UseVisualStyleBackColor = true;
            this.vButton3.Click += new System.EventHandler(this.vButton3_Click);
            // 
            // vButton10
            // 
            this.vButton10.Location = new System.Drawing.Point(101, 580);
            this.vButton10.Name = "vButton10";
            this.vButton10.Size = new System.Drawing.Size(119, 31);
            this.vButton10.TabIndex = 33;
            this.vButton10.Text = "Kapat";
            this.vButton10.UseVisualStyleBackColor = true;
            this.vButton10.Visible = false;
            this.vButton10.Click += new System.EventHandler(this.vButton10_Click);
            // 
            // vButton2
            // 
            this.vButton2.Location = new System.Drawing.Point(283, 33);
            this.vButton2.Name = "vButton2";
            this.vButton2.Size = new System.Drawing.Size(77, 23);
            this.vButton2.TabIndex = 32;
            this.vButton2.Text = "Sil";
            this.vButton2.UseVisualStyleBackColor = true;
            this.vButton2.Click += new System.EventHandler(this.vButton2_Click);
            // 
            // vButton1
            // 
            this.vButton1.Location = new System.Drawing.Point(12, 33);
            this.vButton1.Name = "vButton1";
            this.vButton1.Size = new System.Drawing.Size(84, 23);
            this.vButton1.TabIndex = 31;
            this.vButton1.Text = "Ekle";
            this.vButton1.UseVisualStyleBackColor = true;
            this.vButton1.Click += new System.EventHandler(this.vButton1_Click);
            // 
            // vButton7
            // 
            this.vButton7.Location = new System.Drawing.Point(189, 59);
            this.vButton7.Name = "vButton7";
            this.vButton7.Size = new System.Drawing.Size(139, 23);
            this.vButton7.TabIndex = 6;
            this.vButton7.Text = "Ürün Kodu İle Ara";
            this.vButton7.UseVisualStyleBackColor = true;
            this.vButton7.Click += new System.EventHandler(this.vButton7_Click_1);
            // 
            // Stock
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(996, 629);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.vButton3);
            this.Controls.Add(this.groupBox3);
            this.Controls.Add(this.groupBox2);
            this.Controls.Add(this.vButton2);
            this.Controls.Add(this.vButton10);
            this.Controls.Add(this.vButton1);
            this.Controls.Add(this.treeView1);
            this.Name = "Stock";
            this.Text = "Ambar";
            this.Load += new System.EventHandler(this.Stock_Load);
            this.Controls.SetChildIndex(this.treeView1, 0);
            this.Controls.SetChildIndex(this.vButton1, 0);
            this.Controls.SetChildIndex(this.vButton10, 0);
            this.Controls.SetChildIndex(this.vButton2, 0);
            this.Controls.SetChildIndex(this.groupBox2, 0);
            this.Controls.SetChildIndex(this.groupBox3, 0);
            this.Controls.SetChildIndex(this.vButton3, 0);
            this.Controls.SetChildIndex(this.label2, 0);
            this.groupBox3.ResumeLayout(false);
            this.panel1.ResumeLayout(false);
            this.panel1.PerformLayout();
            this.groupBox2.ResumeLayout(false);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private controls.VButton vButton10;
        private controls.VButton vButton2;
        private controls.VButton vButton1;
        private System.Windows.Forms.TreeView treeView1;
        private System.Windows.Forms.GroupBox groupBox3;
        private controls.VButton vButton5;
        private System.Windows.Forms.Panel panel1;
        private System.Windows.Forms.TextBox textBox1;
        private System.Windows.Forms.Label label1;
        private controls.TreeCombo treeCombo;
        private System.Windows.Forms.TextBox textBox3;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.GroupBox groupBox2;
        private MyGrid myGrid2;
        private controls.VButton vButton3;
        private System.Windows.Forms.Label label2;
        private controls.VButton vButton4;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label4;
        private controls.VButton vButton9;
        private controls.VButton vButton8;
        private controls.VButton vButton6;
        private controls.VButton vButton7;
    }
}