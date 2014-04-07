namespace Verito
{
    partial class Safhalar
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
            this.groupBox3 = new System.Windows.Forms.GroupBox();
            this.vButton5 = new Verito.controls.VButton();
            this.panel1 = new System.Windows.Forms.Panel();
            this.textBox1 = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.treeCombo = new Verito.controls.TreeCombo();
            this.textBox3 = new System.Windows.Forms.TextBox();
            this.label7 = new System.Windows.Forms.Label();
            this.comboBox1 = new System.Windows.Forms.ComboBox();
            this.label6 = new System.Windows.Forms.Label();
            this.groupBox2 = new System.Windows.Forms.GroupBox();
            this.myGrid2 = new Verito.MyGrid();
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.myGrid1 = new Verito.MyGrid();
            this.groupBox3.SuspendLayout();
            this.panel1.SuspendLayout();
            this.groupBox2.SuspendLayout();
            this.groupBox1.SuspendLayout();
            this.SuspendLayout();
            // 
            // groupBox3
            // 
            this.groupBox3.Controls.Add(this.vButton5);
            this.groupBox3.Controls.Add(this.panel1);
            this.groupBox3.Location = new System.Drawing.Point(703, 30);
            this.groupBox3.Name = "groupBox3";
            this.groupBox3.Size = new System.Drawing.Size(234, 477);
            this.groupBox3.TabIndex = 2;
            this.groupBox3.TabStop = false;
            this.groupBox3.Text = "Ürünü Aktar";
            this.groupBox3.Visible = false;
            // 
            // vButton5
            // 
            this.vButton5.Location = new System.Drawing.Point(16, 262);
            this.vButton5.Name = "vButton5";
            this.vButton5.Size = new System.Drawing.Size(134, 23);
            this.vButton5.TabIndex = 34;
            this.vButton5.Text = "Sevk Et";
            this.vButton5.UseVisualStyleBackColor = true;
            this.vButton5.Visible = false;
            this.vButton5.Click += new System.EventHandler(this.vButton5_Click);
            // 
            // panel1
            // 
            this.panel1.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.panel1.Controls.Add(this.textBox1);
            this.panel1.Controls.Add(this.label1);
            this.panel1.Controls.Add(this.treeCombo);
            this.panel1.Controls.Add(this.textBox3);
            this.panel1.Controls.Add(this.label7);
            this.panel1.Controls.Add(this.comboBox1);
            this.panel1.Controls.Add(this.label6);
            this.panel1.Location = new System.Drawing.Point(6, 54);
            this.panel1.Name = "panel1";
            this.panel1.Size = new System.Drawing.Size(198, 181);
            this.panel1.TabIndex = 33;
            this.panel1.Visible = false;
            // 
            // textBox1
            // 
            this.textBox1.Location = new System.Drawing.Point(9, 32);
            this.textBox1.Name = "textBox1";
            this.textBox1.Size = new System.Drawing.Size(89, 20);
            this.textBox1.TabIndex = 33;
            this.textBox1.TextChanged += new System.EventHandler(this.textBox1_TextChanged);
            this.textBox1.KeyPress += new System.Windows.Forms.KeyPressEventHandler(this.textBox1_KeyPress);
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(6, 16);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(62, 13);
            this.label1.TabIndex = 32;
            this.label1.Text = "Ürün adedi:";
            // 
            // treeCombo
            // 
            this.treeCombo.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.treeCombo.FormattingEnabled = true;
            this.treeCombo.Location = new System.Drawing.Point(143, 134);
            this.treeCombo.Name = "treeCombo";
            this.treeCombo.Size = new System.Drawing.Size(44, 21);
            this.treeCombo.TabIndex = 31;
            this.treeCombo.Visible = false;
            // 
            // textBox3
            // 
            this.textBox3.Enabled = false;
            this.textBox3.Location = new System.Drawing.Point(9, 135);
            this.textBox3.Name = "textBox3";
            this.textBox3.Size = new System.Drawing.Size(128, 20);
            this.textBox3.TabIndex = 30;
            this.textBox3.Visible = false;
            // 
            // label7
            // 
            this.label7.AutoSize = true;
            this.label7.Location = new System.Drawing.Point(6, 119);
            this.label7.Name = "label7";
            this.label7.Size = new System.Drawing.Size(78, 13);
            this.label7.TabIndex = 29;
            this.label7.Text = "Ambar Bölümü:";
            this.label7.Visible = false;
            // 
            // comboBox1
            // 
            this.comboBox1.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.comboBox1.FormattingEnabled = true;
            this.comboBox1.Location = new System.Drawing.Point(9, 84);
            this.comboBox1.Name = "comboBox1";
            this.comboBox1.Size = new System.Drawing.Size(125, 21);
            this.comboBox1.TabIndex = 1;
            this.comboBox1.SelectedIndexChanged += new System.EventHandler(this.comboBox1_SelectedIndexChanged);
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Location = new System.Drawing.Point(6, 68);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(98, 13);
            this.label6.TabIndex = 0;
            this.label6.Text = "Aktarılacak konum:";
            // 
            // groupBox2
            // 
            this.groupBox2.Controls.Add(this.myGrid2);
            this.groupBox2.Location = new System.Drawing.Point(265, 30);
            this.groupBox2.Name = "groupBox2";
            this.groupBox2.Size = new System.Drawing.Size(432, 487);
            this.groupBox2.TabIndex = 3;
            this.groupBox2.TabStop = false;
            this.groupBox2.Text = "Safhadaki Ürünler";
            // 
            // myGrid2
            // 
            this.myGrid2.DefaultSearchField = null;
            this.myGrid2.Id = 5;
            this.myGrid2.Location = new System.Drawing.Point(6, 19);
            this.myGrid2.Name = "myGrid2";
            this.myGrid2.OnlyGrid = false;
            this.myGrid2.Size = new System.Drawing.Size(404, 408);
            this.myGrid2.TabIndex = 1;
            this.myGrid2.Load += new System.EventHandler(this.myGrid2_Load);
            // 
            // groupBox1
            // 
            this.groupBox1.Controls.Add(this.myGrid1);
            this.groupBox1.Location = new System.Drawing.Point(12, 30);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new System.Drawing.Size(238, 487);
            this.groupBox1.TabIndex = 2;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "Safhalar";
            // 
            // myGrid1
            // 
            this.myGrid1.DefaultSearchField = null;
            this.myGrid1.Id = 4;
            this.myGrid1.Location = new System.Drawing.Point(6, 40);
            this.myGrid1.Name = "myGrid1";
            this.myGrid1.OnlyGrid = true;
            this.myGrid1.Size = new System.Drawing.Size(226, 416);
            this.myGrid1.TabIndex = 0;
            // 
            // Safhalar
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(1005, 683);
            this.Controls.Add(this.groupBox3);
            this.Controls.Add(this.groupBox2);
            this.Controls.Add(this.groupBox1);
            this.Name = "Safhalar";
            this.Text = "Safhalar";
            this.Load += new System.EventHandler(this.Safhalar_Load);
            this.groupBox3.ResumeLayout(false);
            this.panel1.ResumeLayout(false);
            this.panel1.PerformLayout();
            this.groupBox2.ResumeLayout(false);
            this.groupBox1.ResumeLayout(false);
            this.ResumeLayout(false);

        }

        #endregion

        private MyGrid myGrid1;
        private MyGrid myGrid2;
        private System.Windows.Forms.GroupBox groupBox1;
        private System.Windows.Forms.GroupBox groupBox2;
        private System.Windows.Forms.GroupBox groupBox3;
        private controls.VButton vButton5;
        private System.Windows.Forms.Panel panel1;
        private controls.TreeCombo treeCombo;
        private System.Windows.Forms.TextBox textBox3;
        private System.Windows.Forms.Label label7;
        private System.Windows.Forms.ComboBox comboBox1;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.TextBox textBox1;
        private System.Windows.Forms.Label label1;
    }
}