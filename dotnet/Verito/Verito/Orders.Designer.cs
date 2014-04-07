namespace Verito
{
    partial class Orders
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
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.myGrid1 = new Verito.MyGrid();
            this.groupBox1.SuspendLayout();
            this.SuspendLayout();
            // 
            // groupBox1
            // 
            this.groupBox1.Controls.Add(this.myGrid1);
            this.groupBox1.Location = new System.Drawing.Point(12, 24);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new System.Drawing.Size(797, 503);
            this.groupBox1.TabIndex = 1;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "Siparişler";
            // 
            // myGrid1
            // 
            this.myGrid1.BackColor = System.Drawing.SystemColors.Control;
            this.myGrid1.DefaultSearchField = null;
            this.myGrid1.Id = 3;
            this.myGrid1.Location = new System.Drawing.Point(6, 19);
            this.myGrid1.Name = "myGrid1";
            this.myGrid1.OnlyGrid = false;
            this.myGrid1.Size = new System.Drawing.Size(775, 459);
            this.myGrid1.TabIndex = 0;
            // 
            // Orders
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.SystemColors.Control;
            this.ClientSize = new System.Drawing.Size(900, 577);
            this.Controls.Add(this.groupBox1);
            this.Name = "Orders";
            this.Text = "Siparişler";
            this.Load += new System.EventHandler(this.Orders_Load);
            this.groupBox1.ResumeLayout(false);
            this.ResumeLayout(false);

        }

        #endregion

        private MyGrid myGrid1;
        private System.Windows.Forms.GroupBox groupBox1;
    }
}