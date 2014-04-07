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
    public partial class Users : DefineForm
    {
        public Users()
        {
            InitializeComponent();
        }

        private void Users_Load(object sender, EventArgs e)
        {
            try
            {
                myGrid1.initGrid("select * from user where type<>0");
                myGrid1.dataGridView1.CellClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.userClick);
                myGrid2.dataGridView1.CellDoubleClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.yetkiDoubleClick);

                myGrid1.edit = new MyGrid.EditRow(editUser);
                myGrid1.delete = new MyGrid.DeleteRow(deleteUser);
                myGrid1.add = new MyGrid.AddRow(addUser);
             
            }
            catch (Exception ex)
            {

                MessageBox.Show(ex.Message);
            }
            myGrid1.vButton3.Visible = myGrid2.vButton3.Visible = false;
        }
        void editUser(DataRow row)
        {
            SmallAddForm saf = new SmallAddForm(2, "user", "uname,Kullanıcı Adı", "password,Şifre")
            {
                IsSave=false
            };
            saf.textBox1.Text = row["uname"].ToString();
            saf.textBox2.Text = row["password"].ToString();


            if (saf.ShowDialog() == DialogResult.Yes)
            {
                myGrid1.refreshGrid();
            }
        }
        void deleteUser(DataRow row)
        {
            if (MessageBox.Show("Bu kullanıcıyı silmek istediğinize emin misiniz?", "Onayla", MessageBoxButtons.YesNo) == DialogResult.Yes)
            {
                MyDBTool tool = new MyDBTool("deluseryetki");

                tool["_userid"] = row["id"].ToString();

                DoDatabase.execSp(tool);
            }
            myGrid1.refreshGrid();
        }
        void addUser()
        {
            SmallAddForm saf = new SmallAddForm(2, "user", "uname,Kullanıcı Adı", "password,Şifre") { 
            IsSave=true
            
            };
            if (saf.ShowDialog() == DialogResult.Yes)
            {
                myGrid1.refreshGrid();
            }

        }
        DataRow selectedrow=null;
        public void yetkiDoubleClick(object sender, DataGridViewCellEventArgs args)
        {
            
            if (args.RowIndex < 0) return;
             DataRow yrow = myGrid2.table.Rows[args.RowIndex];
             DoDatabase.delete("delete from useryetki where id=" + yrow["id"].ToString());
            myGrid2.table.Rows.Remove(yrow);
        }
        public void userClick(object sender, DataGridViewCellEventArgs args)
        {
            
            if (args.RowIndex < 0) return;
            selectedrow = myGrid1.table.Rows[args.RowIndex];
            string sql = "select y.yname as Yetki,uy.id as id from useryetki as uy inner join yetki as y on y.id=uy.yetkiid where userid="+selectedrow["id"].ToString();
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
            myGrid2.dataGridView1.Columns[1].Visible = false;
        }

        private void vButton1_Click(object sender, EventArgs e)
        {
            if (selectedrow == null)
            {
                MessageBox.Show("Yetki eklenecek kullanıcıyı seçin.");
                return;
            }

            yetki yet = new yetki(selectedrow["id"].ToString());

            if (yet.ShowDialog() == DialogResult.OK)
            {

                MyDBTool tool = new MyDBTool("useryetki");
                tool["userid"] = selectedrow["id"].ToString();
                tool["yetkiid"] = yet.row["id"].ToString();
                DoDatabase.insert(tool.getInsert());

                myGrid2.table.Rows.Add(yet.row["yname"], yet.row["id"]);
            }
        }

        private void groupBox2_Enter(object sender, EventArgs e)
        {

        }
    }
}
