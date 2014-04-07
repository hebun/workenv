using System;
using System.Data;
using System.Windows.Forms;

namespace Verito
{
    public partial class login : Form
    {
       
        public login()
        {
            
            InitializeComponent();
        }
        int wpc = 0;
        private void button1_Click(object sender, EventArgs e)
        {
            string back = DoDatabase.connectionString;
            try
            {

                DoDatabase.connectionString = "SERVER=localhost;" +

                "UID=root;Character Set=latin5" +
                "";
                DataTable dtx = DoDatabase.select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" 
                    + DoDatabase.currendb + "'");

                if (dtx.Rows.Count == 0)
                {
                    if (MessageBox.Show("Veritabaný kurulumu yapýlmamýþ. Þimdi kurmak istiyor musunuz?", "Veritabaný kurulumu", MessageBoxButtons.YesNo) == DialogResult.Yes)
                    {
                        Cursor = Cursors.WaitCursor;
                        DoDatabase.initDatabase();
                        Cursor = Cursors.Default;
                            
                    }
                    else
                    {
                        Application.Exit();
                    }

                }
            

            }
            catch (Exception ex)
            {

                MessageBox.Show(ex.Message);
                return;
            }
            finally
            {
                DoDatabase.connectionString = back;
            }
            
            DataTable dt = DoDatabase.select("select * from user where uname='" + textBox1.Text + "' and password='" + textBox2.Text + "'");

            if(dt.Rows.Count==0)
            {
                
                MessageBox.Show("Kullanýcý adý ve/veya þifre yanlýþ!");
                if (wpc++ > 2) Application.Exit();           
                return;
            }

            DataRow row=dt.Rows[0];

            

            Form3.user = new User()
            {
                type=row["type"].ToString(),
                id=row["id"].ToString(),
                password=row["password"].ToString(),
                uname=row["uname"].ToString()
            };

            DataTable dtyetki = DoDatabase.select("select yetkiid from useryetki where userid=" + Form3.user.id);

            foreach (DataRow ry in dtyetki.Rows)
            {
                Form3.user.yetkis.Add(ry["yetkiid"].ToString());
            }

            DialogResult = DialogResult.OK;
            this.Close();
        }

        private void login_FormClosed(object sender, FormClosedEventArgs e)
        {
            //Application.Exit();
        }

        private void login_Load(object sender, EventArgs e)
        {
            if (DoVerito.debug)
            {
                textBox1.Text = "admin";
                textBox2.Text = "veritoadm";
            }
        }
    }
}