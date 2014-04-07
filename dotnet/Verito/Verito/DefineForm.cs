using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using Verito.controls;
using System.Collections;
using System.Reflection;
using System.Diagnostics;

namespace Verito
{
    public  partial  class DefineForm : Form
    {
        public int formid;
        public ArrayList fields;
        public bool isDialog;
        public DefineForm()
        {
            InitializeComponent();
            fields = new ArrayList();

        }
        public DefineForm(bool isDialog)
        {
            InitializeComponent();
            fields = new ArrayList();
            this.isDialog = isDialog;

        }

        private void vButton1_Click(object sender, EventArgs e)
        {

        }
        public virtual void  callback(TreeNode node)
        {
        }
        private void DefineForm_Load(object sender, EventArgs e)
        {
            foreach (Control item in this.Controls)
            {
              
                if (item.GetType() == typeof(VButton))
                    styleVbutton(item as VButton);
                if (item.GetType() == typeof(GroupBox))
                {
                    
                    foreach (Control sub in item.Controls)
                    {

                        if (sub.GetType() == typeof(VButton))
                        styleVbutton(sub as VButton);
                    }
                }
            }
       
        }

        public static void styleVbutton(VButton but)
        {
           
            but.FlatAppearance.BorderSize = 1;

            // Set up a blue border and back colors for the button
            but.FlatAppearance.BorderColor = Color.FromArgb(51, 153, 255);

            but.FlatAppearance.MouseDownBackColor = Color.FromArgb(153, 204, 255);
            but.FlatAppearance.MouseOverBackColor = Color.FromArgb(194, 224, 255);
            but.FlatStyle = System.Windows.Forms.FlatStyle.Flat;

            // Set the size for the button to be the same as a ToolStripButton
          //  but.Size = new System.Drawing.Size(100, 30);

            but.BackColor = Color.LightBlue;
        }

        private void pictureBox1_Click(object sender, EventArgs e)
        {
            ProcessStartInfo sInfo = new ProcessStartInfo("http://www.nethizmet.net/");
            Process.Start(sInfo);
        }
        public  void textBox8_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {
                SendKeys.Send("{TAB}");
            }
        }
    }
}
