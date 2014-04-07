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
    public partial class Currencies : Form
    {
        public Currencies()
        {
            InitializeComponent();
        }

        private void Currencies_Load(object sender, EventArgs e)
        {
            myGrid1.initGrid("select * from currency");
            myGrid1.add = new MyGrid.AddRow(addUnit);
            myGrid1.edit = new MyGrid.EditRow(editUnit);
            myGrid1.delete = new MyGrid.DeleteRow(deleteUnit);

            myGrid1.vButton1.Visible = false;
        }
        public void addUnit()
        {
            SmallAddForm pro = new SmallAddForm(1, "currency", "cname,Para Birimi İsmi", "");

            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                myGrid1.refreshGrid();
                MessageBox.Show("Para birimi  eklendi.");
            }

        }
        public void deleteUnit(DataRow row)
        {

            if (MessageBox.Show("Bu para birimini silmek istediğinize emin misiniz?", "Onayla", MessageBoxButtons.YesNo) == DialogResult.Yes)
            {

                DoDatabase.delete("delete from currency where id=" + row["id"].ToString());
                myGrid1.refreshGrid();
                MessageBox.Show("Para birimi silindi");
            }
        }
        public void editUnit(DataRow row)
        {
            SmallAddForm pro = new SmallAddForm("Para Birimi İsmi");

            pro.textBox1.Text = row["cname"].ToString();
            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {

                MyDBTool tool = new MyDBTool("currency");

                tool["cname"] = pro.retValue;
                tool.where["id"] = row["id"].ToString();
                DoDatabase.insert(tool.getUpdate());
                myGrid1.refreshGrid();

            }
        }
    }
}
