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
    public partial class Products : DefineForm
    {
        public string selectedPro = "";
        public string selectedId = "";
        public string selectedCode = "";
        public Products(bool isDialog)
        {
            InitializeComponent();
            this.isDialog = isDialog;
        }

        private void Products_Load(object sender, EventArgs e)
        {
            myGrid1.initGrid("select * from vproduct");
            myGrid1.dataGridView1.CellDoubleClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.dataGridView2_CellDoubleClick);
            myGrid1.edit = new MyGrid.EditRow(editPro);
            myGrid1.delete = new MyGrid.DeleteRow(deletePro);
        }
        private void dataGridView2_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {
            if (!isDialog) return;

            DataRow row = myGrid1.table.Rows[e.RowIndex];
            selectedPro = row["pname"].ToString();
            selectedId = row["id"].ToString();
            selectedCode = row["pcode"].ToString();
            this.DialogResult = DialogResult.Yes;
            this.Close();

        }
        void editPro(DataRow row)
        {
            if (Form3.user.isAuth(1) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }
        
        }
        void deletePro(DataRow row)
        {
            if (Form3.user.isAuth(1) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }
            if (MessageBox.Show("Bu ürünü silmek istediğinize emin misiniz?", "Onayla", MessageBoxButtons.YesNo) == DialogResult.Yes)
            {
             
                DoDatabase.delete("delete from product where id="+row["id"].ToString());
                myGrid1.refreshGrid();
                MessageBox.Show("Ürün silindi");
            }
            
        }

        private void myGrid1_Load(object sender, EventArgs e)
        {

        }
    }
}
