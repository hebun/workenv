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
    public partial class AddProvider : DefineForm
    {
        bool isDialog;
        public AddProvider(bool isDialog)
        {
            this.isDialog = isDialog;
            InitializeComponent();
        }

        private void AddProvider_Load(object sender, EventArgs e)
        {

        }

        private void vButton2_Click(object sender, EventArgs e)
        {
            if (textBox1.Text.Equals("") )
            {
                MessageBox.Show(Lang.FILL_REQUIREDS);
                return;
            }
            MyDBTool tool=new MyDBTool("provider");
            tool["firma"] = textBox1.Text;
            tool["ptext"]=textBox2.Text;
            tool["address"] = textBox3.Text;
            tool["tel"] = textBox5.Text;
            tool["email"] = textBox8.Text;
            tool["website"] = textBox9.Text;
            tool["authorized"]=textBox4.Text;
            tool["col1"] = textBox6.Text;
            tool["col2"] = textBox7.Text;
            tool["pcode"] = textBox10.Text;
            DoDatabase.insert(tool.getInsert());
            if (isDialog)
            {
                this.DialogResult = DialogResult.Yes;
                this.Close();
            }
            else
            {
                MessageBox.Show("Tedarikçi eklendi.");
                foreach (Control item in this.groupBox1.Controls)
                {
                    if (item.GetType() == typeof(TextBox))
                    {
                        (item as TextBox).Text = "";
                    }
                }

            }
            
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

        private void groupBox1_Enter(object sender, EventArgs e)
        {

        }

        private void textBox8_TextChanged(object sender, EventArgs e)
        {

        }
        private void textBox8_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {
                SendKeys.Send("{TAB}");
            }
        }
    }
}
