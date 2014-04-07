using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using Verito.controls;

namespace Verito
{
    public partial class AddProduct : DefineForm
    {
       
        public AddProduct()
        {
            InitializeComponent();
         //   base.label1.Text = "Yeni Ürün Tanımla";
            formid = 1;
        }
        private void General_KeyDown(object sender, KeyPressEventArgs e)
        {
            if (e.KeyChar == 13)
            {

                if (this.GetNextControl(ActiveControl, true) != null)
                {
                    e.Handled = true;
                    this.GetNextControl(ActiveControl, true).Focus();
                }
            }
        }

        private void AddProduct_Load(object sender, EventArgs e)
        {
            bindCombo(comboBox1, "uname", "unittype", "1=1");
            bindCombo(comboBox2, "cname", "currency", "1=1");
            bindCombo(comboBox3, "firma", "provider", "1=1");
            bindCombo(comboBox4, "firma", "provider", "1=1");
            bindCombo(comboBox5, "firma", "provider", "1=1");
            treeCombo.callback(this);
            treeCombo.load();

        
        }

      
        public void ondd(object sender, EventArgs e)
        {
      
        }
        public override void callback(TreeNode node)
        {
            textBox3.Text = node.Text;
            textBox3.Tag = node.Name;
            
          //  MessageBox.Show(node.Name);
        }
    
        private void bindCombo(ComboBox cb,string display,string dtable,string where)
        {
            cb.DisplayMember = display;
            cb.ValueMember = "id";
            DataTable table=DoDatabase.fillCombo(dtable, where);
            
            DataRow row = table.NewRow();

            row[display] = "Seçiniz..";
            row["id"] = "0";
            
            table.Rows.InsertAt(row, 0);


            cb.DataSource = table;
          
        }
     

        public  void  vButton1_Click(object sender, EventArgs e)
        {
            
        }

        private void vButton8_Click(object sender, EventArgs e)
        {
            AddProvider pro = new AddProvider(true);
           
            DialogResult result= pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                bindCombo(comboBox3, "firma", "provider", "1=1");
                bindCombo(comboBox4, "firma", "provider", "1=1");
            }


        }

        private void vButton5_Click(object sender, EventArgs e)
        {
            SmallAddForm pro = new SmallAddForm(1, "unittype", "uname,Birim İsmi","");

            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                bindCombo(comboBox1, "uname", "unittype", "1=1");
            }
        }

        private void vButton7_Click(object sender, EventArgs e)
        {
            SmallAddForm pro = new SmallAddForm(2, "currency", "cname,Para Birimi İsmi", "symbol,Simge");

            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                bindCombo(comboBox2, "cname", "currency", "1=1");
            }
        }

        private void groupBox1_Enter(object sender, EventArgs e)
        {

        }

        private void vButton9_Click(object sender, EventArgs e)
        {
            vButton8_Click(sender, e);
        }

        private void vButton2_Click(object sender, EventArgs e)
        {
          //  MessageBox.Show(comboBox1.SelectedValue.ToString());
        }

        private void vButton1_Click_1(object sender, EventArgs e)
        {
            if (!check()) return;
            MyDBTool tool = new MyDBTool("product");
            tool["pname"] = textBox1.Text;
            tool["ptext"] = textBox2.Text;
            tool["pcode"] = textBox8.Text;
            tool["unittypeid"] = comboBox1.SelectedValue.ToString() ;
            tool["categoryid"] = DoDatabase.selectSingle("category", "id", "code='"+textBox3.Tag.ToString()+"'");
            tool["price"] = textBox4.Text;
            tool["currencyid"] = comboBox2.SelectedValue.ToString();
            tool["providerid"] = comboBox3.SelectedValue.ToString();
            tool["provider2id"] = comboBox4.SelectedValue.ToString();
            tool["provider3id"] = comboBox4.SelectedValue.ToString();
            tool["minstock"] = textBox5.Text.Equals("") ? "-1" : textBox5.Text;
            tool["col1"] = textBox6.Text;
            tool["col2"] = textBox7.Text;
            tool["catcode"] = textBox3.Tag.ToString();
            try
            {
                DoDatabase.insert(tool.getInsert());

                MessageBox.Show("Ürün eklendi.");

                foreach (Control item in this.groupBox1.Controls)
                {
                    if (item.GetType() == typeof(TextBox))
                    {
                        (item as TextBox).Text = "";
                    }
                }
            }
            catch (Exception)
            {
                MessageBox.Show("Ürün eklenirken hata oluştu.");

            }
        }

        private bool check()
        {
            foreach (Control item in panel2.Controls)
            {
                item.Visible = false;
            }
            bool error=false;
            if (textBox1.Text.Equals(""))
            {
                label1.Visible = true;
                error = true;
            }
            if (textBox3.Text.Equals(""))
            {
                label15.Visible = true;
                error = true;
            }

            return !error;
          // textBox1.bb
        }

        private void vButton10_Click(object sender, EventArgs e)
        {

            DoVerito.closeTab(this);
            
        }

       

        private void vButton3_Click(object sender, EventArgs e)
        {

        }

        private void vButton4_Click(object sender, EventArgs e)
        {

        }

        private void vButton6_Click(object sender, EventArgs e)
        {
            AddCategory pro = new AddCategory(true);

            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                treeCombo.load();
            }

        }

        private void treeCombo_DropDown(object sender, EventArgs e)
        {
          
            treeCombo.Items.Clear();
        }

        private void textBox4_KeyPress(object sender, KeyPressEventArgs e)
        {
            onlyNumbers(sender, e);

        }

        private static void onlyNumbers(object sender, KeyPressEventArgs e)
        {
            if (!char.IsControl(e.KeyChar)
        && !char.IsDigit(e.KeyChar)
        && e.KeyChar != '.')
            {
                e.Handled = true;
            }

            // only allow one decimal point
            if (e.KeyChar == '.'
                && (sender as TextBox).Text.IndexOf('.') > -1)
            {
                e.Handled = true;
            }
        }

        private void textBox5_KeyPress(object sender, KeyPressEventArgs e)
        {
            onlyNumbers(sender, e);
        }

        private void textBox4_TextChanged(object sender, EventArgs e)
        {

        }

        private void treeCombo_SelectedIndexChanged(object sender, EventArgs e)
        {

        }

        private void textBox3_TextChanged(object sender, EventArgs e)
        {

        }

        private void label5_Click(object sender, EventArgs e)
        {

        }

        private void vButton3_Click_1(object sender, EventArgs e)
        {
            vButton8_Click(sender, e);
        }

        private void General_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {

                if (this.GetNextControl(ActiveControl, true) != null)
                {
                    e.Handled = true;
                    this.GetNextControl(ActiveControl, true).Focus();
                }
            }
        }

        private void textBox8_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {
                SendKeys.Send("{TAB}");
            }
        }

        private void vButton4_Click_1(object sender, EventArgs e)
        {
            GetProCode gpc = new GetProCode();
            gpc.ShowDialog();

            textBox8.Text=  gpc.retvalue;
        }
    }
}
