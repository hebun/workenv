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
    public partial class SmallAddForm : Form
    {
        int fcount;
        string table, f1, f2,c1,c2;
        bool isSave = true;
       public string retValue;
     
        public int noField=0;
        public bool IsSave
        {
            get { return isSave; }
            set { isSave = value; }
        }
        public SmallAddForm(string label)
        {
            fcount = 1;
            IsSave = false;
            this.f1 = label;
            InitializeComponent();
        }
        public SmallAddForm(int fcount,string table, string f1, string f2)
        {
            this.fcount = fcount;
            this.table = table;
            this.f1 = f1.Split(',')[1];
            if (fcount == 2)
            this.f2 = f2.Split(',')[1];
            this.c1 = f1.Split(',')[0];
            this.c2 = f2.Split(',')[0];
            InitializeComponent();
        }

        private void InputForm_Load(object sender, EventArgs e)
        {
            Size=new Size(308, 150 + (fcount-1) * 50);
            if (fcount == 1)
            {
                label2.Visible = false;
                textBox2.Visible = false;
            }
            label1.Text = f1+":";
            if (fcount == 2)
            label2.Text = f2+":";
            vButton2.Location = new Point(30, Size.Height - 80);
            vButton1.Location = new Point(160, Size.Height - 80);
            textBox1.Focus();
            textBox1.Select();
            
        }

        private void vButton2_Click(object sender, EventArgs e)
        {
            if (textBox1.Text.Equals(""))
            {
                MessageBox.Show("Lütfen gerekli alanları doldurun.");
                return;
            }
            if (fcount==2 && textBox2.Text.Equals(""))
            {
                MessageBox.Show("Lütfen gerekli alanları doldurun.");
                return;
            }
            if (IsSave)
            {
                MyDBTool tool = new MyDBTool(table);
                tool[c1] = textBox1.Text;
                if (fcount == 2)
                {
                    tool[c2] = textBox2.Text;
                }

                DoDatabase.insert(tool.getInsert());
            }
            else
            {
                this.retValue = textBox1.Text;
            }
            this.DialogResult = DialogResult.Yes;
            this.Close();
        }

        private void vButton1_Click(object sender, EventArgs e)
        {
            this.DialogResult = DialogResult.No;
            this.Close();
        }
    }
}
