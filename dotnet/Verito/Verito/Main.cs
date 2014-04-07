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
    public partial class Main : Form
    {
        public Main()
        {
            InitializeComponent();
        }
        ArrayList labs = new ArrayList();
        ArrayList labk = new ArrayList();
        ArrayList labc = new ArrayList();
        private void Main_Load(object sender, EventArgs e)
        {
            loadambar();
            loadSafha();
         //   loadCat();
        }

        private void loadSafha()
        {
            DataTable dt = DoDatabase.select("select k.kname as kname,sum(kp.pcount) as toplam " +
" from konum as k LEFT JOIN konumproduct as kp On kp.konumid=k.id group by k.kname");
            int secx = 0;
            foreach (DataRow row in dt.Rows)
            {

                Label lab = new Label();
                if (row["toplam"].ToString().Equals(""))
                {
                    lab.Text = row["kname"].ToString() + Environment.NewLine + "Ürün yok";
                }else
                lab.Text = row["kname"].ToString() + Environment.NewLine + row["toplam"].ToString() + " ürün";
                lab.Location = new Point(100 * secx + 20,70);
                lab.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
                lab.BorderStyle = BorderStyle.FixedSingle;
                secx++;
              //  lab.AutoSize = true;
                lab.Height = 50;
                lab.Width = 90;
                lab.MaximumSize = new Size(lab.Width, lab.Height);
                panel2.Controls.Add(lab);
                labk.Add(lab);

            }
        }
        private void loadCat()
        {
            DataTable dt = DoDatabase.select("select s.code,s.`name` as sname,s.len as leng,sum(sp.pcount) as toplam " +
 " from stock s LEFT JOIN stockproduct as sp On sp.stockcode=s.`code` group by s.code,s.name");
            int secx = 0;
            foreach (DataRow row in dt.Rows)
            {
                if (row["leng"].ToString() == "2")
                {
                    Label lab = new Label();
                    if (row["toplam"].ToString().Equals(""))
                    {
                        lab.Text = row["sname"].ToString() + Environment.NewLine + "Ürün yok";
                    }
                    else
                        lab.Text = row["sname"].ToString() + Environment.NewLine + row["toplam"].ToString() + " ürün";
                    lab.Location = new Point(200 * secx + 200, 70);
                    lab.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
                    lab.BorderStyle = BorderStyle.FixedSingle;
                    secx++;
                    lab.Width = 90;
                    lab.Height = 50;
                    lab.MaximumSize = new Size(lab.Width, lab.Height);
                    panel3.Controls.Add(lab);
                    labc.Add(lab);

                }
            }
        }
        private void loadambar()
        {
            DataTable dt = DoDatabase.select("select s.code,s.`name` as sname,s.len as leng,sum(sp.pcount) as toplam " +
 " from stock s LEFT JOIN stockproduct as sp On sp.stockcode=s.`code` group by s.code,s.name");
            int secx = 0;
            int thirx = 0;
            foreach (DataRow row in dt.Rows)
            {
                if (row["leng"].ToString() == "2")
                {
                    Label lab = new Label();
                    if (row["toplam"].ToString().Equals(""))
                    {
                        lab.Text = row["sname"].ToString() + Environment.NewLine + " ürün yok";
                    }
                    else
                    lab.Text = row["sname"].ToString() + Environment.NewLine + row["toplam"].ToString() + " ürün";
                    lab.Tag = row["code"].ToString();
                    lab.Location = new Point(200 * secx + 200, 70);
                    lab.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
                    lab.BorderStyle = BorderStyle.FixedSingle;
                    secx++;
                    lab.Width = 90;
                    lab.Height = 50;
                    lab.MaximumSize = new Size(lab.Width, lab.Height);
                    panel1.Controls.Add(lab);
                    labs.Add(lab);

                }
                else
                {
                    if (row["leng"].ToString() == "4")
                    {
                        Label lab = new Label();
                        if (row["toplam"].ToString().Equals(""))
                        {
                            lab.Text = row["sname"].ToString() + Environment.NewLine + "Ürün yok";
                        }
                        else
                            lab.Text = row["sname"].ToString() + Environment.NewLine + row["toplam"].ToString() + " ürün";

                        foreach (Label item in labs)
                        {
                            if (row["code"].ToString().StartsWith(item.Tag.ToString()))
                            {
                                lab.Location = new Point(200 * thirx + item.Location.X-100, 150);
                                lab.Tag = item;
                            }
                        }

                        
                        lab.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
                        lab.BorderStyle = BorderStyle.FixedSingle;
                        thirx++;
                        lab.Width = 90;
                        lab.Height = 50;
                        lab.MaximumSize = new Size(lab.Width, lab.Height);
                        panel1.Controls.Add(lab);
                        labs.Add(lab);
                    }
                }
            }
        }

        private void Main_Paint(object sender, PaintEventArgs e)
        {
         
        }

        private void panel1_PaddingChanged(object sender, EventArgs e)
        {

        }

        private void panel1_Paint(object sender, PaintEventArgs e)
        {
            Graphics g = e.Graphics;

            foreach (Label lab in labs)
            {
                Label pl = typeof(Label) == lab.Tag.GetType() ? lab.Tag as Label : label1;

                g.DrawLine(Pens.Black, new Point(pl.Location.X + 20, pl.Location.Y + pl.Height),
                    new Point(lab.Location.X + 20, lab.Location.Y));
           
            }
        }

        private void panel2_Paint(object sender, PaintEventArgs e)
        {
            Graphics g = e.Graphics;

            foreach (Label lab in labk)
            {
                g.DrawLine(Pens.Black, new Point(label3.Location.X + 20, label3.Location.Y + label3.Height),
                    new Point(lab.Location.X + 20, lab.Location.Y));
            }
        }

        private void panel3_Paint(object sender, PaintEventArgs e)
        {
            Graphics g = e.Graphics;

            foreach (Label lab in labc)
            {

                g.DrawLine(Pens.Black, new Point(label5.Location.X + 20, label5.Location.Y + label5.Height),
                    new Point(lab.Location.X + 20, lab.Location.Y));
            }
        }
    }
}
