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
    public partial class Safhalar : DefineForm
    {
        public Safhalar()
        {
            InitializeComponent();
        }

        private void Safhalar_Load(object sender, EventArgs e)
        {
            myGrid1.initGrid("select * from konum where id<>1");
            myGrid1.dataGridView1.CellClick += new DataGridViewCellEventHandler(safhaSelected);
            myGrid2.dynaBool = false;
            myGrid2.aktar = new MyGrid.Aktar(aktar);
            myGrid2.vButton2.Visible = false;
            //myGrid2.initGrid("select * from k
        }
        DataRow selectedRow;
        void aktar(DataRow row)
        {
            selectedRow = row;
            groupBox3.Visible = true;
            panel1.Visible = true;
            DoVerito.bindCombo(comboBox1, "kname", "konum", "1=1");
        }
        void safhaSelected(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex == -1) return;
            string sql="select kp.id,p.pname,kp.pcount from konumproduct as kp inner join product as p" +
                    "  on kp.productid=p.id where konumid=" + myGrid1.table.Rows[e.RowIndex]["id"].ToString();
            if (!myGrid2.dynaBool)
            {
                myGrid2.initGrid(sql);
                myGrid2.dynaBool = true;
            }
            else
            {
                myGrid2.sql = sql;
                myGrid2.refreshGrid();
            }
        }

        private void myGrid2_Load(object sender, EventArgs e)
        {

        }

        private void textBox1_KeyPress(object sender, KeyPressEventArgs e)
        {
            DoVerito.onlyNumbers(sender, e);
        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {

        }
        public override  void callback(TreeNode node)
        {
            textBox3.Text = node.Text;
            textBox3.Tag = node.Name;
            vButton5.Visible = true;
        }

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {
            if (comboBox1.SelectedValue.ToString().Equals("1"))
            {
                label7.Visible = textBox3.Visible = treeCombo.Visible = true;
                treeCombo.callback(this);
                treeCombo.loadStock();
            }
            else
            {

                label7.Visible = textBox3.Visible = treeCombo.Visible = false;
                if (!comboBox1.SelectedValue.ToString().Equals("0"))
                    vButton5.Visible = true;
                else
                {
                    vButton5.Visible = false;
                }
            }
        }

        private void vButton5_Click(object sender, EventArgs e)
        {
            if (textBox1.Text.Equals(""))
            {
                MessageBox.Show(Lang.FILL_REQUIREDS);
                return;
            }
            if (Convert.ToInt32(textBox1.Text) > Convert.ToInt32(selectedRow["pcount"]))
            {
                MessageBox.Show("Girilen miktar çok fazla.");
                return;
            }
            MyDBTool tool = new MyDBTool("moveproduct");
            tool["_oldid"] = selectedRow["id"].ToString();
            tool["_type"] = comboBox1.SelectedValue.ToString().Equals("1") ? "ktos" : "ktok";
            tool["_newid"] = comboBox1.SelectedValue.ToString().Equals("1") ? textBox3.Tag.ToString()
                : comboBox1.SelectedValue.ToString();
            tool["_count"] = textBox1.Text;
            try
            {
                DoDatabase.execSp(tool);
                MessageBox.Show("Ürün aktarıldı.");
            }
            catch (Exception ex)
            {

                MessageBox.Show(ex.Message);
                return;
            }
         
        }
    }
}
