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
    public partial class UnitTypes : Form
    {
        public UnitTypes()
        {
            InitializeComponent();
        }

        private void UnitTypes_Load(object sender, EventArgs e)
        {
            myGrid1.initGrid("select * from unittype");
            myGrid1.add = new MyGrid.AddRow(addUnit);
            myGrid1.edit = new MyGrid.EditRow(editUnit);
            myGrid1.delete= new MyGrid.DeleteRow(deleteUnit);

            myGrid1.vButton1.Visible = false;

        }
        public void addUnit()
        {
            SmallAddForm pro = new SmallAddForm(1, "unittype", "uname,Birim İsmi", "");

            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                myGrid1.refreshGrid();
                MessageBox.Show("Birim cinsi eklendi.");
            }
        
        }
        public void deleteUnit(DataRow row)
        {

            if (MessageBox.Show("Bu birimi silmek istediğinize emin misiniz?", "Onayla", MessageBoxButtons.YesNo) == DialogResult.Yes)
            {

                DoDatabase.delete("delete from unittype where id=" + row["id"].ToString());
                myGrid1.refreshGrid();
                MessageBox.Show("Birim cinsi silindi");
            }
        }
        public void editUnit(DataRow row)
        {
            SmallAddForm pro = new SmallAddForm("Birim Cins İsmi");

            pro.textBox1.Text = row["uname"].ToString();
            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {

                MyDBTool tool = new MyDBTool("unittype");

                tool["uname"] = pro.retValue;
                tool.where["id"] = row["id"].ToString();
                DoDatabase.insert(tool.getUpdate());
                myGrid1.refreshGrid();
              
            }
        }

    }
}
