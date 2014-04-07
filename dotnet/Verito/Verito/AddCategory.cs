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
    public partial class AddCategory : DefineForm
    {
       
        public AddCategory(bool isDialog)
        {
            this.isDialog = isDialog;
            InitializeComponent();
        }

        private void AddCategory_Load(object sender, EventArgs e)
        {
            DoVerito.loadCategory(treeView1);
        }

       public string selected = null;

        private void treeView1_AfterSelect(object sender, TreeViewEventArgs e)
        {
            this.vButton1.Enabled = this.vButton2.Enabled = true;
            selected = e.Node.Name;
        }

        private void vButton1_Click(object sender, EventArgs e)
        {
            if (Form3.user.isAuth(1) == false)
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
            SmallAddForm pro = new SmallAddForm("Kategori İsmi");

            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {

                string code = node.Name + getnewNodeCode(node);
               
                MyDBTool tool = new MyDBTool("category");
                tool["code"] = code;
                tool["len"] = code.Length.ToString();
                tool["name"] = pro.retValue;

                DoDatabase.insert(tool.getInsert());
                DoVerito.loadCategory(treeView1);
                isChanged = true;
            }

        }
        public string getnewNodeCode(TreeNode parent)
        {
            int max = 0;

            foreach (TreeNode item in parent.Nodes)
            {
                int v = Convert.ToInt32(item.Name.Substring(item.Name.Length - 3, 3));

                if (v > max) max = v;
            }
            int ret = (max + 1);
            string pre = "";
            if (ret < 100)
                pre += "0";
            if (ret < 10)
                pre += "0";
            return pre + ret.ToString();
        }
        bool isChanged = false;
        private void vButton2_Click(object sender, EventArgs e)
        {
            if (Form3.user.isAuth(1) == false)
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
            string sql = "delete from category where code like '" + treeView1.SelectedNode.Name + "%'";
            textBox1.Text = sql;
            DoDatabase.delete(sql);

            string spq = "delete sp from stockproduct as sp inner join product as p on p.id=sp.productid where p.catcode='" + treeView1.SelectedNode.Name + "'";
            DoDatabase.delete(spq);

            string sps = "delete from product where catcode='" + treeView1.SelectedNode.Name + "'";
            DoDatabase.delete(sps);

            

            DoVerito.loadCategory(treeView1);
            isChanged = true;
        }

        private void vButton10_Click(object sender, EventArgs e)
        {
            this.DialogResult = isChanged ? DialogResult.Yes : DialogResult.No;
            this.Close();
            if (!isDialog)
            {
                ((this.Tag as TabPage).Parent as TabControl).TabPages.Remove((this.Tag as TabPage));
            }
        }

        private void vButton3_Click(object sender, EventArgs e)
        {
            this.DialogResult = isChanged ? DialogResult.Yes : DialogResult.No;
            this.Close();
            if (!isDialog)
            {
                ((this.Tag as TabPage).Parent as TabControl).TabPages.Remove((this.Tag as TabPage));
            }
        }

        private void vButton3_Click_1(object sender, EventArgs e)
        {
            if (Form3.user.isAuth(1) == false)
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
            SmallAddForm pro = new SmallAddForm("Kategori İsmi");

            pro.textBox1.Text = node.Text;
            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {

                MyDBTool tool = new MyDBTool("category");

                tool["name"] = pro.retValue;
                tool.where["code"] = node.Name;
                DoDatabase.insert(tool.getUpdate());
                DoVerito.loadCategory(treeView1);
                isChanged = true;
            }
        }

        private void vButton4_Click(object sender, EventArgs e)
        {
            this.DialogResult = selected!=null ? DialogResult.Yes : DialogResult.No;
            this.Close();
            if (!isDialog)
            {
                ((this.Tag as TabPage).Parent as TabControl).TabPages.Remove((this.Tag as TabPage));
            }
        }
    }
}
