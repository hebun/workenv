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
    public partial class Customers : Form
    {
        bool isDialog;
        public Customers(bool isDialog)
        {
            InitializeComponent();
            this.isDialog = isDialog;
            myGrid1.dataGridView1.CellDoubleClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.dataGridView1_CellDoubleClick);

        }
        public DataRow selected; 
        private void dataGridView1_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {

        selected= myGrid1.table.Rows[e.RowIndex];

        this.DialogResult = selected != null ? DialogResult.Yes : DialogResult.No;
        this.Close();
        if (!isDialog)
        {
            ((this.Tag as TabPage).Parent as TabControl).TabPages.Remove((this.Tag as TabPage));
        }

        }
        private void Customers_Load(object sender, EventArgs e)
        {
            myGrid1.initGrid("select * from customer");
            myGrid1.edit = new MyGrid.EditRow(editPro);
            myGrid1.delete = new MyGrid.DeleteRow(deletePro);
        }

        private void myGrid1_Load(object sender, EventArgs e)
        {

        }
        void editPro(DataRow row)
        {
            if (Form3.user.isAuth(3) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }

        }
        void deletePro(DataRow row)
        {
            if (Form3.user.isAuth(3) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }
            if (MessageBox.Show("Bu müşteriyi silmek istediğinize emin misiniz?", "Onayla", MessageBoxButtons.YesNo) == DialogResult.Yes)
            {

                DoDatabase.delete("delete from customer where id=" + row["id"].ToString());
                myGrid1.refreshGrid();
                MessageBox.Show("Müşteri silindi");
            }

        }
    }
}
