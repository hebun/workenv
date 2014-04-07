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
    public partial class Stock : DefineForm
    {
        bool isDialog;
        private bool isChanged=false;
        public Stock(bool isDialog)
        {
            this.isDialog = isDialog;
            InitializeComponent();
        }

        private void Stock_Load(object sender, EventArgs e)
        {

            myGrid2.dynaBool = false;
            myGrid2.aktar = new MyGrid.Aktar(aktar);
            myGrid2.vButton2.Visible = myGrid2.vButton1.Visible = false;
            DoVerito.loadStock(treeView1);
            treeCombo.callback(this);
            treeCombo.loadStock();

        }
        public override void callback(TreeNode node)
        {
            textBox3.Text = node.Text;
            textBox3.Tag = node.Name;
            vButton5.Visible = true;
        }
        DataRow selectedRow;
        string selectedId,selectedCount;

        bool isSevk = false;
        void aktar(DataRow row)
        {
            selectedRow = row;
            selectedCount = row["pcount"].ToString();
            selectedId = row["id"].ToString();
            groupBox3.Visible = true;
            panel1.Visible = true;
            textBox3.Visible = treeCombo.Visible = true;
            treeCombo.callback(this);
            treeCombo.loadStock();
            label4.Text = row["pname"].ToString();
            isSevk = true;
        }
        private void vButton1_Click(object sender, EventArgs e)
        {
            if (Form3.user.isAuth(2) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }
            TreeNode node = treeView1.SelectedNode;
            if (node == null)
            {
                MessageBox.Show("Bölüm seçiniz.");
                return;
            }
            SmallAddForm pro = new SmallAddForm("Bölüm İsmi");

            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                
                string code = node.Name  + getnewNodeCode(node);

                MyDBTool tool = new MyDBTool("stock");
                tool["code"] = code;
                tool["len"] = code.Length.ToString();
                tool["name"] = pro.retValue;

                DoDatabase.insert(tool.getInsert());
                DoVerito.loadStock(treeView1);
                isChanged = true;
            }

        }
        public string getnewNodeCode(TreeNode parent)
        {
            int max = 0;

            foreach (TreeNode item in parent.Nodes)
            {
                int v = Convert.ToInt32(item.Name.Substring(item.Name.Length-3,3));

                if (v > max) max = v;
            }
            int ret=(max + 1);
            string pre="";
            if(ret<100)
                pre+="0";
            if(ret<10)
                pre+="0";
            return pre+ret.ToString();
        }
        private void vButton2_Click(object sender, EventArgs e)
        {
            if (Form3.user.isAuth(2) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }
            TreeNode node = treeView1.SelectedNode;
            if (node == null)
            {
                MessageBox.Show("Bölüm seçiniz.");
                return;
            }
            string sql = "delete from stock where code like '" + treeView1.SelectedNode.Name + "%'";
      
            DoDatabase.delete(sql);

            string sps = "delete from stockproduct where stockcode='" + treeView1.SelectedNode.Name + "'";
            DoDatabase.delete(sps);

            DoVerito.loadStock(treeView1);
            isChanged = true;
        }

        private void vButton10_Click(object sender, EventArgs e)
        {
            DoVerito.closeTab(this);
        }
        string currentsql;
        private void treeView1_AfterSelect(object sender, TreeViewEventArgs e)
        {
            if (e.Node == null) return;
            string sql = "select kp.id,p.pname,kp.pcount from stockproduct as kp inner join product as p" +
                    "  on kp.productid=p.id where kp.stockcode like '" + e.Node.Name+"%'";
            currentsql = sql;
            Console.WriteLine(sql);
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
     
        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {
            
        }

        private void vButton5_Click(object sender, EventArgs e)
        {
            if (Form3.user.isAuth(2) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }
            if (textBox1.Text.Equals(""))
            {
                MessageBox.Show(Lang.FILL_REQUIREDS);
                return;
            }
            if (Convert.ToInt32(textBox1.Text) > Convert.ToInt32(selectedCount))
            {
                MessageBox.Show("Girilen miktar çok fazla.");
                return;
            }
            MyDBTool tool = new MyDBTool("moveproduct");
            tool["_oldid"] = selectedId;
            tool["_type"] = isSevk?"stos": "ntos";
            tool["_newid"] =  textBox3.Tag.ToString();
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

        private void groupBox2_Enter(object sender, EventArgs e)
        {

        }

        private void vButton3_Click(object sender, EventArgs e)
        {
            if (Form3.user.isAuth(2) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }
            SmallAddForm pro = new SmallAddForm("Bölüm İsmi");
            TreeNode node = treeView1.SelectedNode;
            if (node == null)
            {
                MessageBox.Show("Bölüm seçiniz.");
                return;
            }
            if (node == null)
            {
                MessageBox.Show("Bölüm seçiniz.");
                return;
            }
            pro.textBox1.Text = node.Text;
            DialogResult result = pro.ShowDialog();
         
            if (result == DialogResult.Yes)
            {
                
                MyDBTool tool = new MyDBTool("stock");               
                tool["name"] = pro.retValue;
                tool.where["code"] = node.Name;
                DoDatabase.insert(tool.getUpdate());
                DoVerito.loadStock(treeView1);
                isChanged = true;
            }
        }

        private void panel1_Paint(object sender, PaintEventArgs e)
        {

        }

        private void vButton4_Click(object sender, EventArgs e)
        {
            if (Form3.user.isAuth(2) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }
            label4.Text = "";
            isSevk = false;

            Products pro =new Products(true);

            pro.ShowDialog();

            label4.Text = pro.selectedPro;
            selectedId = pro.selectedId;
            selectedCount = Int32.MaxValue.ToString();
        }

        private void vButton6_Click(object sender, EventArgs e)
        {
            foreach (DataRow row in myGrid2.table.Rows)
            {
                string sql = myGrid2.sql;
                sql += " and p.minstock>=kp.pcount ";
                myGrid2.sql = sql;
                myGrid2.refreshGrid();
            }
        }

        private void vButton9_Click(object sender, EventArgs e)
        {
            AddCategory pro = new AddCategory(true);

            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                string sql = myGrid2.sql;
                sql += " and p.catcode like  '"+pro.selected+"%'";
                myGrid2.sql = sql;
                myGrid2.refreshGrid();
            }
        }

        private void vButton7_Click(object sender, EventArgs e)
        {
            Customers pro = new Customers(true);

            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                pro.selected["firma"].ToString();
                string sql = currentsql;
                sql += " and p.catcode like  '" + pro.selected + "%'";
                myGrid2.sql = sql;
                myGrid2.refreshGrid();
            }
        }

        private void vButton8_Click(object sender, EventArgs e)
        {
            Providers pro = new Providers(true);

            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                pro.selected["firma"].ToString();
                string sql = currentsql;
                sql += " and p.providerid=" + pro.selected["id"].ToString()+" ";
                myGrid2.sql = sql;
                myGrid2.refreshGrid();
            }
        }

        private void vButton7_Click_1(object sender, EventArgs e)
        {
            GetProCode gpc = new GetProCode();

            if (gpc.ShowDialog() == DialogResult.Yes)
            {
                string sql = currentsql;
                sql += " and p.pcode='"+gpc.retvalue+"' ";
                myGrid2.sql = sql;
                myGrid2.refreshGrid();
            }
        }
    }
}
