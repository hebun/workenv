namespace Verito
{
    partial class AddCategory
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
            this.treeView1 = new System.Windows.Forms.TreeView();
            this.vButton2 = new Verito.controls.VButton();
            this.vButton1 = new Verito.controls.VButton();
            this.textBox1 = new System.Windows.Forms.TextBox();
            this.vButton10 = new Verito.controls.VButton();
            this.vButton3 = new Verito.controls.VButton();
            this.vButton4 = new Verito.controls.VButton();
            this.SuspendLayout();
            // 
            // treeView1
            // 
            this.treeView1.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.treeView1.Location = new System.Drawing.Point(11, 62);
            this.treeView1.Name = "treeView1";
            this.treeView1.Size = new System.Drawing.Size(418, 435);
            this.treeView1.TabIndex = 0;
            this.treeView1.AfterSelect += new System.Windows.Forms.TreeViewEventHandler(this.treeView1_AfterSelect);
            // 
            // vButton2
            // 
            this.vButton2.Location = new System.Drawing.Point(297, 33);
            this.vButton2.Name = "vButton2";
            this.vButton2.Size = new System.Drawing.Size(132, 23);
            this.vButton2.TabIndex = 2;
            this.vButton2.Text = "Seçili Kategoriyi Sil";
            this.vButton2.UseVisualStyleBackColor = true;
            this.vButton2.Click += new System.EventHandler(this.vButton2_Click);
            // 
            // vButton1
            // 
            this.vButton1.Location = new System.Drawing.Point(12, 33);
            this.vButton1.Name = "vButton1";
            this.vButton1.Size = new System.Drawing.Size(133, 23);
            this.vButton1.TabIndex = 1;
            this.vButton1.Text = "Seçili Kategoriye Ekle";
            this.vButton1.UseVisualStyleBackColor = true;
            this.vButton1.Click += new System.EventHandler(this.vButton1_Click);
            // 
            // textBox1
            // 
            this.textBox1.Location = new System.Drawing.Point(12, 0);
            this.textBox1.Multiline = true;
            this.textBox1.Name = "textBox1";
            this.textBox1.Size = new System.Drawing.Size(214, 27);
            this.textBox1.TabIndex = 3;
            this.textBox1.Visible = false;
            // 
            // vButton10
            // 
            this.vButton10.Location = new System.Drawing.Point(262, 503);
            this.vButton10.Name = "vButton10";
            this.vButton10.Size = new System.Drawing.Size(119, 31);
            this.vButton10.TabIndex = 29;
            this.vButton10.Text = "Kapat";
            this.vButton10.UseVisualStyleBackColor = true;
            this.vButton10.Click += new System.EventHandler(this.vButton10_Click);
            // 
            // vButton3
            // 
            this.vButton3.Location = new System.Drawing.Point(157, 33);
            this.vButton3.Name = "vButton3";
            this.vButton3.Size = new System.Drawing.Size(134, 24);
            this.vButton3.TabIndex = 37;
            this.vButton3.Text = "Seçili Kategoriyi Değiştir";
            this.vButton3.UseVisualStyleBackColor = true;
            this.vButton3.Click += new System.EventHandler(this.vButton3_Click_1);
            // 
            // vButton4
            // 
            this.vButton4.Location = new System.Drawing.Point(47, 503);
            this.vButton4.Name = "vButton4";
            this.vButton4.Size = new System.Drawing.Size(120, 31);
            this.vButton4.TabIndex = 38;
            this.vButton4.Text = "Tamam";
            this.vButton4.UseVisualStyleBackColor = true;
            this.vButton4.Click += new System.EventHandler(this.vButton4_Click);
            // 
            // AddCategory
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(448, 539);
            this.Controls.Add(this.vButton4);
            this.Controls.Add(this.vButton3);
            this.Controls.Add(this.vButton10);
            this.Controls.Add(this.textBox1);
            this.Controls.Add(this.vButton2);
            this.Controls.Add(this.vButton1);
            this.Controls.Add(this.treeView1);
            this.Name = "AddCategory";
            this.Text = "Kategoriler";
            this.Load += new System.EventHandler(this.AddCategory_Load);
            this.Controls.SetChildIndex(this.treeView1, 0);
            this.Controls.SetChildIndex(this.vButton1, 0);
            this.Controls.SetChildIndex(this.vButton2, 0);
            this.Controls.SetChildIndex(this.textBox1, 0);
            this.Controls.SetChildIndex(this.vButton10, 0);
            this.Controls.SetChildIndex(this.vButton3, 0);
            this.Controls.SetChildIndex(this.vButton4, 0);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.TreeView treeView1;
        private controls.VButton vButton1;
        private controls.VButton vButton2;
        private System.Windows.Forms.TextBox textBox1;
        private controls.VButton vButton10;
        private controls.VButton vButton3;
        private controls.VButton vButton4;

    }
}