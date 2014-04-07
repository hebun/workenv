using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Drawing;

namespace Verito.controls
{
   public class VButton:Button
    {
        protected override bool ShowFocusCues
        {
            get
            {
                return false;
            }
        }

        public VButton():base()
        {

          
          
        }

        private void NewMethod()
        {
            FlatAppearance.BorderSize = 1;

            // Set up a blue border and back colors for the button
            FlatAppearance.BorderColor = Color.FromArgb(51, 153, 255);

            FlatAppearance.MouseDownBackColor = Color.FromArgb(153, 204, 255);
            FlatAppearance.MouseOverBackColor = Color.FromArgb(194, 224, 255);
            FlatStyle = System.Windows.Forms.FlatStyle.Flat;

            // Set the size for the button to be the same as a ToolStripButton
            Size = new System.Drawing.Size(23, 22);

            this.BackColor = Color.Blue;
        }

        private void InitializeComponent()
        {
            this.SuspendLayout();
            // 
            // VButton
            // 
            this.Paint += new System.Windows.Forms.PaintEventHandler(this.VButton_Paint);
            this.ResumeLayout(false);

        }

        protected void VButton_Paint(object sender, PaintEventArgs e)
        {
       
        }

    }
}
