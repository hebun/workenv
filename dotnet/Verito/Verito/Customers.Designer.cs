namespace Verito
{
    partial class Customers
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
            this.SuspendLayout();
            // 
            // myGrid1
            // 
            this.myGrid1.DefaultSearchField = null;
            this.myGrid1.Id = 9;
            this.myGrid1.Location = new System.Drawing.Point(12, 23);
            this.myGrid1.Name = "myGrid1";
            this.myGrid1.OnlyGrid = false;
            this.myGrid1.Size = new System.Drawing.Size(775, 408);
            this.myGrid1.TabIndex = 0;
            this.myGrid1.Load += new System.EventHandler(this.myGrid1_Load);
            // 
            // Customers
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(793, 485);
            this.Controls.Add(this.myGrid1);
            this.Name = "Customers";
            this.Text = "Müşteriler";
            this.Load += new System.EventHandler(this.Customers_Load);
            this.ResumeLayout(false);

        }

        #endregion

        private MyGrid myGrid1;
    }
}