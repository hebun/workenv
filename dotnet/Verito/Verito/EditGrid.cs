using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Collections;

namespace Verito
{
    public partial class EditGrid : Form
    {
        DataTable map;
        DataTable table;
        public EditGrid(DataTable map)
        {
            InitializeComponent();
         
            this.map = map;
            dataGridView1.RowHeadersVisible = false;
             table = new DataTable();
            
            table.Columns.Add("cname", typeof(String));
             table.Columns.Add("cshow", typeof(bool));
            table.Columns.Add("id",typeof(int));
            foreach (DataRow    item in map.Rows)
            {
                table.Rows.Add(item["ctext"].ToString(),item["cshow"].ToString()=="1", item["id"].ToString());
            }
            dataGridView1.DataSource = table;
            dataGridView1.Columns["cname"].HeaderText = "Alan İsmi";
            dataGridView1.Columns["cshow"].HeaderText = "Gösterilsin mi?";
            dataGridView1.Columns["id"].Visible=false;
            table.AcceptChanges();
        }

        private void vButton1_Click(object sender, EventArgs e)
        {

            if (table.GetChanges()!=null)
            {
                foreach (DataRow item in table.GetChanges().Rows)
                {
                    MyDBTool tool = new MyDBTool("updatefield");
                    tool["vctext"] = item["cname"].ToString();
                    tool["vcshow"] = (bool.Parse(item["cshow"].ToString()) ? "1" : "0");
                    tool["vid"] = item["id"].ToString();
                    DoDatabase.execSp(tool);

                }
                table.AcceptChanges();
                this.DialogResult = DialogResult.Yes;
                this.Close();
            }
        }

        private void vButton2_Click(object sender, EventArgs e)
        {
            this.DialogResult = DialogResult.No;
            this.Close();

        }

        private void EditGrid_Load(object sender, EventArgs e)
        {

        }
    }
}
