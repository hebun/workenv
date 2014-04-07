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
    public partial class Form3 : Form
    {
        // kategori ve depoya göre stok-visual, siparişte kullanıcı id'si,kullanıcı ve yetkilendirme
        //current:sevk et button,yetki ekle,edit user

        //yetki kontrol,ayar ekle
        bool debug = true;
        public Form3()
        {
            InitializeComponent();
         
        }
        public static User user;
        private void button1_Click(object sender, EventArgs e)
        {
        
        }

  

        private void button2_Click(object sender, EventArgs e)
        {
            closeTab();
        }

        private void closeTab()
        {
            try
            {
                (tabControl1.SelectedTab.Tag as Form).Close();
            }
            catch (Exception) { }
            tabControl1.TabPages.Remove(tabControl1.SelectedTab);

            if (tabControl1.TabPages.Count == 0)
            {
                vButton2.Visible = false;
            }
        }

        private void Form3_Load(object sender, EventArgs e)
        {

            if (!DoDatabase.checkCon())
            {
                MessageBox.Show("Veritabanına bağlanılamadı!");
                Application.Exit();
            }
        
                login l = new login();
                if (l.ShowDialog() != DialogResult.OK)
                {
                    Application.Exit();
                }
            
         
            openForm(new Start());
            try
            {

                kullanıcılarToolStripMenuItem.Visible = user.type.Equals("0");
               birimCinsiTanımlaToolStripMenuItem.Visible = user.type.Equals("0");
                paraBirimTanımlaToolStripMenuItem.Visible = user.type.Equals("0");

            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);

            }


        }

        private void vButton1_Click(object sender, EventArgs e)
        {
            DoDatabase.initProcs();
        }

        private void menuStrip1_ItemClicked(object sender, ToolStripItemClickedEventArgs e)
        {

        }

        private void ürünTanımlaToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (Form3.user.isAuth(1) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }
            openForm(new AddProduct() );
        }

        public  void openForm(Form frm)
        {
            
            frm.TopLevel = false;
            frm.Visible = true;
            frm.FormBorderStyle = FormBorderStyle.None;
            frm.Dock = DockStyle.Fill;
            TabPage tp = new TabPage(frm.Text + "    ");
            tp.Tag = frm;
            frm.Tag = tp;
            tp.Controls.Add(frm);
            tabControl1.TabPages.Add(tp);
            vButton2.Visible = true;
            tabControl1.SelectedTab = tp;
        }

        private void vButton2_Click(object sender, EventArgs e)
        {
            closeTab();
        }

        private void tedarikçiTanımlaToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (Form3.user.isAuth(3) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }
            openForm(new AddProvider(false));
        }

        private void kategorilerToolStripMenuItem_Click(object sender, EventArgs e)
        {
           
            openForm(new AddCategory(false));
        }

        private void ambarToolStripMenuItem_Click(object sender, EventArgs e)
        {
            
        }

        private void müşteriTanımlaToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (Form3.user.isAuth(3) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }
            openForm(new AddCustomer(false));
        }

        private void siparişToolStripMenuItem_Click(object sender, EventArgs e)
        {
           
            openForm(new AddOrder(false));
        }

        private void safhaTanımlaToolStripMenuItem_Click(object sender, EventArgs e)
        {
            openForm(new AddSafha(false));
        }

        private void siparişlerToolStripMenuItem_Click(object sender, EventArgs e)
        {
            openForm(new Orders());
        }

        private void sevklerToolStripMenuItem_Click(object sender, EventArgs e)
        {
            openForm(new Safhalar());
        }

        private void ambarToolStripMenuItem_Click_1(object sender, EventArgs e)
        {
            openForm(new Stock(false));
        }

        private void ürünlerToolStripMenuItem_Click(object sender, EventArgs e)
        {
            openForm(new Products(false));
        }

        private void ayarlarToolStripMenuItem_Click(object sender, EventArgs e)
        {
            openForm(new Options(false));
        }

        private void kullanıcılarToolStripMenuItem_Click(object sender, EventArgs e)
        {
            openForm(new Users());
        }

        private void müşterilerToolStripMenuItem_Click(object sender, EventArgs e)
        {
            openForm(new Customers(false));
        }

        private void tedarikçilerToolStripMenuItem_Click(object sender, EventArgs e)
        {
            openForm(new Providers(false));
        }

        private void birimCinsiTanımlaToolStripMenuItem_Click(object sender, EventArgs e)
        {
            openForm(new UnitTypes());
        }

        private void paraBirimTanımlaToolStripMenuItem_Click(object sender, EventArgs e)
        {
            openForm(new Currencies());
        
        }

    }
}
