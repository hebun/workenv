namespace Verito
{
    partial class EditGrid
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
            this.dataGridView1 = new System.Windows.Forms.DataGridView();
            this.vButton1 = new Verito.controls.VButton();
            this.vButton2 = new Verito.controls.VButton();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView1)).BeginInit();
            this.SuspendLayout();
            // 
            // dataGridView1
            // 
            this.dataGridView1.AllowUserToAddRows = false;
            this.dataGridView1.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.Fill;
            this.dataGridView1.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridView1.Location = new System.Drawing.Point(12, 41);
            this.dataGridView1.Name = "dataGridView1";
            this.dataGridView1.Size = new System.Drawing.Size(284, 423);
            this.dataGridView1.TabIndex = 0;
            // 
            // vButton1
            // 
            this.vButton1.BackColor = System.Drawing.Color.LightBlue;
            this.vButton1.FlatAppearance.BorderColor = System.Drawing.Color.FromArgb(((int)(((byte)(51)))), ((int)(((byte)(153)))), ((int)(((byte)(255)))));
            this.vButton1.FlatAppearance.MouseDownBackColor = System.Drawing.Color.FromArgb(((int)(((byte)(153)))), ((int)(((byte)(204)))), ((int)(((byte)(255)))));
            this.vButton1.FlatAppearance.MouseOverBackColor = System.Drawing.Color.FromArgb(((int)(((byte)(194)))), ((int)(((byte)(224)))), ((int)(((byte)(255)))));
            this.vButton1.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.vButton1.Location = new System.Drawing.Point(12, 491);
            this.vButton1.Name = "vButton1";
            this.vButton1.Size = new System.Drawing.Size(116, 23);
            this.vButton1.TabIndex = 1;
            this.vButton1.Text = "Değişiklikleri Kaydet";
            this.vButton1.UseVisualStyleBackColor = false;
            this.vButton1.Click += new System.EventHandler(this.vButton1_Click);
            // 
            // vButton2
            // 
            this.vButton2.BackColor = System.Drawing.Color.LightBlue;
            this.vButton2.FlatAppearance.BorderColor = System.Drawing.Color.FromArgb(((int)(((byte)(51)))), ((int)(((byte)(153)))), ((int)(((byte)(255)))));
            this.vButton2.FlatAppearance.MouseDownBackColor = System.Drawing.Color.FromArgb(((int)(((byte)(153)))), ((int)(((byte)(204)))), ((int)(((byte)(255)))));
            this.vButton2.FlatAppearance.MouseOverBackColor = System.Drawing.Color.FromArgb(((int)(((byte)(194)))), ((int)(((byte)(224)))), ((int)(((byte)(255)))));
            this.vButton2.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.vButton2.Location = new System.Drawing.Point(167, 491);
            this.vButton2.Name = "vButton2";
            this.vButton2.Size = new System.Drawing.Size(129, 23);
            this.vButton2.TabIndex = 2;
            this.vButton2.Text = "Vazgeç";
            this.vButton2.UseVisualStyleBackColor = false;
            this.vButton2.Click += new System.EventHandler(this.vButton2_Click);
            // 
            // EditGrid
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(323, 544);
            this.Controls.Add(this.vButton2);
            this.Controls.Add(this.vButton1);
            this.Controls.Add(this.dataGridView1);
            this.MaximizeBox = false;
            this.Name = "EditGrid";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterParent;
            this.Text = "Tabloyu Düzenle";
            this.Load += new System.EventHandler(this.EditGrid_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView1)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.DataGridView dataGridView1;
        private controls.VButton vButton1;
        private controls.VButton vButton2;


    }
}