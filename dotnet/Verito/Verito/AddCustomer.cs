using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace Verito
{
    public partial class AddCustomer : DefineForm
    {
        private bool isDialog;
        public AddCustomer(bool isDialog)
        {
            this.isDialog = isDialog;
            InitializeComponent();
        }

        private void vButton3_Click(object sender, EventArgs e)
        {
            if (isDialog)
            {
                this.DialogResult = DialogResult.No;
                this.Close();
            }
            else
            {
                ((this.Tag as TabPage).Parent as TabControl).TabPages.Remove((this.Tag as TabPage));
            }
        }

        private void vButton2_Click(object sender, EventArgs e)
        {
            if (textBox1.Text.Equals("") || textBox2.Text.Equals("") || textBox4.Text.Equals(""))
            {
                MessageBox.Show(Lang.FILL_REQUIREDS);
                return;
            }
            MyDBTool tool = new MyDBTool("customer");
            tool["firma"] = textBox1.Text;
            tool["ctext"] = textBox2.Text;
            tool["authorized"] = textBox4.Text;
            tool["col1"] = textBox6.Text;
            tool["col2"] = textBox7.Text;
            tool["address"] = textBox3.Text;
            tool["tel"] = textBox5.Text;
            tool["email"] = textBox8.Text;
            tool["website"] = textBox9.Text;
            tool["ccode"] = textBox10.Text;
            DoDatabase.insert(tool.getInsert());
            if (isDialog)
            {
                this.DialogResult = DialogResult.Yes;
                this.Close();
            }
            else
            {
                MessageBox.Show("Müşteri eklendi.");
                foreach (Control item in this.groupBox1.Controls)
                {
                    if (item.GetType() == typeof(TextBox))
                    {
                        (item as TextBox).Text = "";
                    }
                }

            }
            
        }

        private void AddCustomer_Load(object sender, EventArgs e)
        {

        }

       

        
    }
}
