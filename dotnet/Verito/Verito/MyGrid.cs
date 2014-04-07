using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Drawing;
using System.Data;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Collections;
using System.IO;

namespace Verito
{
    public partial class MyGrid : UserControl
    {
       public DataTable table,cmap;
        int id;
        Hashtable map;
        string defaultSearchField;
        bool onlyGrid = false;
        public delegate void EditRow(DataRow row);
        public delegate void DeleteRow(DataRow row);
        public delegate void Aktar(DataRow row);
        public delegate void AddRow();
        public bool dynaBool;
         public  EditRow edit;
         public DeleteRow delete;
         public Aktar aktar;
         public AddRow add;
        public bool OnlyGrid
        {
            
            get { return onlyGrid; }
            set { onlyGrid = value; }
        }
        public string DefaultSearchField
        {
            get { return defaultSearchField; }
            set { defaultSearchField = value; }
        }
        public int Id
        {
            get { return id; }
            set { id = value; }
        }
      public  string sql;
        public MyGrid()
        {
            InitializeComponent();
        }
        internal void initGrid(DataTable products)
        {
            this.table = products;
            dataGridView1.DataSource = table;
        }
        internal void initGrid(string p)
        {
            this.sql = p;
            try
            {
                table = DoDatabase.select(p);
            }
            catch (Exception ex)
            {
                MessageBox.Show(p+ex.Message);
                return;
            }
            

            dataGridView1.DataSource = table;
            if (!onlyGrid)
            {
                this.setMap();

                comboBox1.DisplayMember = "ctext";
                comboBox1.ValueMember = "cname";
                comboBox1.DataSource = cmap;
                if(DefaultSearchField!=null)
                comboBox1.SelectedValue = DefaultSearchField;
            }
        }
        public void refreshGrid()
        {

            try
            {
                table = DoDatabase.select(this.sql);
                dataGridView1.DataSource = table;
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);

            }
        }
        public void setMap(string[] columns)
        {
            dataGridView1.Columns[0].Visible = false;
            for (int i = 0; i < columns.Length; i++)
            {

                dataGridView1.Columns[i+1].HeaderText = columns[i].ToString();


            }
        }
        private void textBox1_TextChanged(object sender, EventArgs e)
        {
            if (textBox1.Text.Length > 0)
            {
                DataView dv = new DataView(table);
                
                dv.RowFilter ="Convert("+comboBox1.SelectedValue+",'System.String')"+ "  like '" + textBox1.Text + "%'";
                dataGridView1.DataSource = dv;
            }
            else if (textBox1.Text.Length==0)
            {
                dataGridView1.DataSource = table;
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {

        }

        internal void setMap()
        {

            map = new Hashtable();
            MyDBTool tool = new MyDBTool("getfield");
            tool["id"] = this.Id.ToString();
            cmap = DoDatabase.execSp(tool).Tables[0];

            foreach (DataGridViewColumn col in dataGridView1.Columns)
            {
                col.Visible=false;
            }

            foreach (DataRow row in cmap.Rows)
            {
                map[row["cname"].ToString()] = row["ctext"].ToString();

                dataGridView1.Columns[row["cname"].ToString()].HeaderText = row["ctext"].ToString();
                dataGridView1.Columns[row["cname"].ToString()].Visible = row["cshow"].ToString().Equals("1");
            }

        }

        private void vButton1_Click(object sender, EventArgs e)
        {
            EditGrid editGrid = new EditGrid(this.cmap);
            if (editGrid.ShowDialog() == DialogResult.Yes)
            {
                this.initGrid(this.sql);
            }

        }

        private void MyGrid_Load(object sender, EventArgs e)
        {
            dataGridView1.ContextMenuStrip = this.contextMenuStrip1;
           
            label1.Visible = comboBox1.Visible = textBox1.Visible = vButton1.Visible = vButton2.Visible = !OnlyGrid;
            this.dataGridView1.Location = new Point(3, OnlyGrid ? 5 : 40);
          this.dataGridView1.Size=new Size( this.Width - 10,this.Size.Height-50);
            //this.dataGridView1.Size = new Size(400, 200);
            vButton1.Location = new Point(this.Width - 115, 15);
            DefineForm.styleVbutton(vButton2);
            DefineForm.styleVbutton(vButton1);
            DefineForm.styleVbutton(vButton3);
        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void dataGridView1_CellMouseDown(object sender, DataGridViewCellMouseEventArgs e)
        {
            if (e.Button == MouseButtons.Right)
            {
                int rowSelected = e.RowIndex;
                if (e.RowIndex != -1)
                {
                    dataGridView1.ClearSelection();
                    this.dataGridView1.Rows[rowSelected].Selected = true;
                }
                // you now have the selected row with the context menu showing for the user to delete etc.
            }

        }

        private void silToolStripMenuItem_Click(object sender, EventArgs e)
        {
          //  DoVerito.info(table.Rows[dataGridView1.SelectedRows[0].Index]);
            if(delete!=null)
                if (dataGridView1.SelectedRows.Count > 0)
                delete(table.Rows[dataGridView1.SelectedRows[0].Index]);
        }

        private void düzenleToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (edit != null)
                if (dataGridView1.SelectedRows.Count > 0)
                edit(table.Rows[dataGridView1.SelectedRows[0].Index]);
        }

        private void vButton2_Click(object sender, EventArgs e)
        {
            refreshGrid();
        }

        //to use aktar for adding(exceptional)
        public void renameAktar(string text)
        {
            aktarToolStripMenuItem.Text = text;
        }
        private void contextMenuStrip1_Opening(object sender, CancelEventArgs e)
        {
            if (this.delete == null)
            {
                this.contextMenuStrip1.Items.Remove(silToolStripMenuItem);
            }
            if (this.edit== null)
            {
                this.contextMenuStrip1.Items.Remove(düzenleToolStripMenuItem);
            }
            if (this.aktar == null)
            {
                this.contextMenuStrip1.Items.Remove(aktarToolStripMenuItem);
            }
            if (this.add== null)
            {
                this.contextMenuStrip1.Items.Remove(toolStripMenuItem1);
            }
            if (contextMenuStrip1.Items.Count == 0)
            {
                e.Cancel = true;
            }
        }

        private void aktarToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (aktar != null)
            {
                if (dataGridView1.SelectedRows.Count > 0)
                      aktar(table.Rows[dataGridView1.SelectedRows[0].Index]);
                
            }
        }

        private void toolStripMenuItem1_Click(object sender, EventArgs e)
        {
            if (add != null)
            {
                
                    add();

            }
        }

        private void vButton3_Click(object sender, EventArgs e)
        {
          
            saveFileDialog1.Filter = "Excel Dosyası|*.xls|HTML Dosyası|*.html";
            saveFileDialog1.AddExtension = true;
            saveFileDialog1.InitialDirectory = Environment.ExpandEnvironmentVariables("%HOMEDRIVE%%HOMEPATH%\\documents");
            if (saveFileDialog1.ShowDialog() == DialogResult.OK)
            {

                try
                {
                    StreamWriter sw = new StreamWriter(saveFileDialog1.FileName);
                    string op = DoVerito.ExportToExcel(this.table);
                    sw.WriteLine(op);
                    sw.Close();
                }
                catch (Exception ex)
                {

                    MessageBox.Show("Dosya kaydedilirken hata oluştu"+ex.Message);
                }
            }
        }
    
    }
}
