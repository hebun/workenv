namespace Verito
{
    partial class Users
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
            this.myGrid1 = new Verito.MyGrid();
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.label1 = new System.Windows.Forms.Label();
            this.groupBox2 = new System.Windows.Forms.GroupBox();
            this.vButton1 = new Verito.controls.VButton();
            this.label2 = new System.Windows.Forms.Label();
            this.myGrid2 = new Verito.MyGrid();
            this.groupBox1.SuspendLayout();
            this.groupBox2.SuspendLayout();
            this.SuspendLayout();
            // 
            // myGrid1
            // 
            this.myGrid1.DefaultSearchField = null;
            this.myGrid1.Id = 7;
            this.myGrid1.Location = new System.Drawing.Point(6, 56);
            this.myGrid1.Name = "myGrid1";
            this.myGrid1.OnlyGrid = false;
            this.myGrid1.Size = new System.Drawing.Size(500, 478);
            this.myGrid1.TabIndex = 1;
            // 
            // groupBox1
            // 
            this.groupBox1.Controls.Add(this.label1);
            this.groupBox1.Controls.Add(this.myGrid1);
            this.groupBox1.Location = new System.Drawing.Point(12, 26);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new System.Drawing.Size(509, 548);
            this.groupBox1.TabIndex = 2;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "Kullanıcılar";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(6, 29);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(450, 26);
            this.label1.TabIndex = 2;
            this.label1.Text = "  Kullanıcı işlemleri için gerekli kayda sağ tıklayın. Kullanıcı yetkileri için g" +
                "erekli kayda sol tıklayıp\r\nsağ taraftaki panelden işlem yapabilirsiniz.";
            // 
            // groupBox2
            // 
            this.groupBox2.Controls.Add(this.vButton1);
            this.groupBox2.Controls.Add(this.label2);
            this.groupBox2.Controls.Add(this.myGrid2);
            this.groupBox2.Location = new System.Drawing.Point(527, 26);
            this.groupBox2.Name = "groupBox2";
            this.groupBox2.Size = new System.Drawing.Size(414, 548);
            this.groupBox2.TabIndex = 3;
            this.groupBox2.TabStop = false;
            this.groupBox2.Text = "Kullanıcı Yetkileri";
            this.groupBox2.Enter += new System.EventHandler(this.groupBox2_Enter);
            // 
            // vButton1
            // 
            this.vButton1.Location = new System.Drawing.Point(9, 70);
            this.vButton1.Name = "vButton1";
            this.vButton1.Size = new System.Drawing.Size(109, 23);
            this.vButton1.TabIndex = 2;
            this.vButton1.Text = "Yetki Ekle";
            this.vButton1.UseVisualStyleBackColor = true;
            this.vButton1.Click += new System.EventHandler(this.vButton1_Click);
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(6, 29);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(288, 13);
            this.label2.TabIndex = 1;
            this.label2.Text = "Seçili kullanıcıdan yetki silmek için gerekli kayda çift tıklayın.";
            // 
            // myGrid2
            // 
            this.myGrid2.DefaultSearchField = null;
            this.myGrid2.Id = 0;
            this.myGrid2.Location = new System.Drawing.Point(6, 90);
            this.myGrid2.Name = "myGrid2";
            this.myGrid2.OnlyGrid = true;
            this.myGrid2.Size = new System.Drawing.Size(402, 458);
            this.myGrid2.TabIndex = 0;
            // 
            // Users
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(967, 631);
            this.Controls.Add(this.groupBox2);
            this.Controls.Add(this.groupBox1);
            this.Name = "Users";
            this.Text = "Kullanıcılar";
            this.Load += new System.EventHandler(this.Users_Load);
            this.Controls.SetChildIndex(this.groupBox1, 0);
            this.Controls.SetChildIndex(this.groupBox2, 0);
            this.groupBox1.ResumeLayout(false);
            this.groupBox1.PerformLayout();
            this.groupBox2.ResumeLayout(false);
            this.groupBox2.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion

        private MyGrid myGrid1;
        private System.Windows.Forms.GroupBox groupBox1;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.GroupBox groupBox2;
        private MyGrid myGrid2;
        private System.Windows.Forms.Label label2;
        private controls.VButton vButton1;
    }
}