using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Data;
using System.ComponentModel;
using System.IO;
//using Excel = Microsoft.Office.Interop.Excel; 
namespace Verito
{
    public static class DoVerito
    {
        public static bool debug = false;
        public static void loadCategory(TreeView tree)
        {
            tree.Nodes.Clear();
            TreeNode root = tree.Nodes.Add("Ürün Kategorileri");

            DataTable table = DoDatabase.select("select * from category");
            int derece = 3;
            addTree(root, table, derece);
            tree.ExpandAll();
            tree.SelectedNode = null;
        }

        static int k = 0;
        private static void addTree(TreeNode node, DataTable table, int derece)
        {
            k++;
            foreach (DataRow row in table.Rows)
            {

                if (Convert.ToInt32(row["len"]) == derece && (row["code"].ToString().StartsWith(node.Name)))
                {
                    TreeNode newNode = node.Nodes.Add(row["code"].ToString(), row["name"].ToString());
                    addTree(newNode, table, derece + 3);
                }
            }
        }
        public static void onlyNumbers(object sender, KeyPressEventArgs e)
        {
            if (!char.IsControl(e.KeyChar)
        && !char.IsDigit(e.KeyChar)
        && e.KeyChar != '.')
            {
                e.Handled = true;
            }

            // only allow one decimal point
            if (e.KeyChar == '.'
                && (sender as TextBox).Text.IndexOf('.') > -1)
            {
                e.Handled = true;
            }
        }
        internal static void loadStock(TreeView tree)
        {
            tree.Nodes.Clear();
            TreeNode root = tree.Nodes.Add("Ambar");

            DataTable table = DoDatabase.select("select * from stock");
            int derece = 3;
            addTree(root, table, derece);
            tree.ExpandAll();
            tree.SelectedNode = null;
        }

        internal static void closeTab(Form frm)
        {
            ((frm.Tag as TabPage).Parent as TabControl).TabPages.Remove((frm.Tag as TabPage));
        }
        public static void bindCombo(ComboBox cb, string display, string dtable, string where)
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
        public static void openForm(Form opener,Form frm)
        {

            frm.TopLevel = false;
            frm.Visible = true;
            frm.FormBorderStyle = FormBorderStyle.None;
            frm.Dock = DockStyle.Fill;
            TabPage tp = new TabPage(frm.Text + "    ");
            tp.Tag = frm;
            frm.Tag = tp;
            tp.Controls.Add(frm);
            ((opener.Tag as TabPage).Parent as TabControl).TabPages.Add(tp);
            //vButton2.Visible = true;
            ((opener.Tag as TabPage).Parent as TabControl).SelectedTab = tp;
        }
        public static string ExportToExcel(DataTable table)
        {
            string outp = "";

            outp += "<html><head><META  charset=utf-8></head><body><table border='1'><tr>";
            foreach (DataColumn column in table.Columns)
            {
                outp+="<td><b>" + column.ColumnName + "</b></td>";
            }
            outp+="</tr>";
            //context.Response.Write(Environment.NewLine);
            foreach (DataRow row in table.Rows)
            {
                outp+="<tr>";
                for (int i = 0; i < table.Columns.Count; i++)
                {
                    outp+="<td>" + row[i].ToString() + "</td>";
                }
                outp+=Environment.NewLine;
            }
            outp+="</tr></table></body></html>";


            return outp;
        }
        public static void info(object obj)
        {
            string outp="";
            foreach (PropertyDescriptor descriptor in TypeDescriptor.GetProperties(obj))
            {
                string name = descriptor.Name;
                object value = descriptor.GetValue(obj);
               outp+= String.Format("{0}={1}\n", name, value);
            }
            MessageBox.Show(outp);
        }
      
        
    }
}
