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
    public partial class yetki : DefineForm
    {
        string userid;
        public yetki(string userid)
        {
            InitializeComponent();
            isDialog = false;
            this.userid = userid;
        }

        private void yetki_Load(object sender, EventArgs e)
        {
            myGrid1.initGrid("select * from yetki where id not in (select yetkiid from useryetki where userid="+userid+")");
            myGrid1.dataGridView1.CellDoubleClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.dataGridView2_CellDoubleClick);
            myGrid1.dataGridView1.Columns["yname"].HeaderText = "Yetki Adı";
            myGrid1.dataGridView1.Columns["id"].HeaderText = "Yetki No";
        }
       public DataRow row;
        private void dataGridView2_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex == -1) return;
            this.row = myGrid1.table.Rows[e.RowIndex];
            this.DialogResult = DialogResult.OK;
            this.Close();
           
        }
    }
}
