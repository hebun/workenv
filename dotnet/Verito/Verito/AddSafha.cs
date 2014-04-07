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
    public partial class AddSafha : DefineForm
    {
    

        public AddSafha()
        {
            InitializeComponent();
        }

        public AddSafha(bool p)
        {
            this.isDialog = p;
            InitializeComponent();
        }

        private void AddSafha_Load(object sender, EventArgs e)
        {
            myGrid1.Id = 2;
            myGrid1.initGrid("select * from konum");

            myGrid1.delete = new MyGrid.DeleteRow(deleteSafha);
            myGrid1.edit= new MyGrid.EditRow(editSafha);
        }
        void deleteSafha(DataRow row)
        {
            if (row["id"].ToString().Equals("1"))
            {
                MessageBox.Show("Bu kaydı silemezsiniz.");
                return;
            }
            if (MessageBox.Show(this, Lang.SURE_TO_DELETE, "Onay", MessageBoxButtons.YesNo) == DialogResult.Yes)
            {
                DoDatabase.delete("delete from konum where id=" + row["id"].ToString());
                myGrid1.refreshGrid();
                //myGrid1.r
            }
        }
        void editSafha(DataRow row)
        {

            SmallAddForm pro = new SmallAddForm("Safha Adı");
            pro.textBox1.Text = row["kname"].ToString();
            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                DoDatabase.update("update konum set kname='" + pro.retValue + "' where id=" + row["id"].ToString());
                myGrid1.refreshGrid();
            }

            
            //    DoDatabase.delete("delete from konum where id=" + row["id"].ToString());
              //  
                //myGrid1.r
            
        }

        private void vButton1_Click(object sender, EventArgs e)
        {
            if (textBox1.Text.Equals(""))
            {
                MessageBox.Show(Lang.FILL_REQUIREDS);
                return;
            }
            DoDatabase.insert("insert into konum(kname) values('"+textBox1.Text+"')");

            myGrid1.refreshGrid();
            textBox1.Text = "";
            MessageBox.Show("Safha Eklendi");
        }
    }
}
