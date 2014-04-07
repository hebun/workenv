namespace Verito
{
    partial class yetki
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
            this.label1 = new System.Windows.Forms.Label();
            this.SuspendLayout();
            // 
            // myGrid1
            // 
            this.myGrid1.DefaultSearchField = null;
            this.myGrid1.Id = 8;
            this.myGrid1.Location = new System.Drawing.Point(12, 57);
            this.myGrid1.Name = "myGrid1";
            this.myGrid1.OnlyGrid = true;
            this.myGrid1.Size = new System.Drawing.Size(355, 454);
            this.myGrid1.TabIndex = 0;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(22, 25);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(187, 13);
            this.label1.TabIndex = 1;
            this.label1.Text = "Eklemek istediğiniz yetkiye çift tıklayın.";
            // 
            // yetki
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(390, 521);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.myGrid1);
            this.Name = "yetki";
            this.Text = "yetki";
            this.Load += new System.EventHandler(this.yetki_Load);
            this.Controls.SetChildIndex(this.myGrid1, 0);
            this.Controls.SetChildIndex(this.label1, 0);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private MyGrid myGrid1;
        private System.Windows.Forms.Label label1;
    }
}