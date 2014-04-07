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
    public partial class Options : DefineForm
    {
        public Options(bool isDialog)
        {
            InitializeComponent();
            this.isDialog = isDialog;
        }

        private void Options_Load(object sender, EventArgs e)
        {
            bindCombo(comboBox2, "uname", "unittype", "1=1");
            bindCombo(comboBox1, "cname", "currency", "1=1");
        }
        private void bindCombo(ComboBox cb, string display, string dtable, string where)
        {
            cb.DisplayMember = display;
            cb.ValueMember = "id";
            DataTable table = DoDatabase.fillCombo(dtable, where);

            DataRow row = table.NewRow();

            row[display] = "Seçiniz..";
            row["id"] = "0";

            table.Rows.InsertAt(row, 0);


            cb.DataSource = table;

        }

        private void vButton1_Click(object sender, EventArgs e)
        {

        }
    }
}
