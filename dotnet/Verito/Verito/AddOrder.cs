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
    public partial class AddOrder : DefineForm
    {
     
        public DataTable products;
        public DataRow row;
        public bool isUpdate = false;
        public AddOrder(bool isDialog)
        {
            this.isDialog = isDialog;
            InitializeComponent();
        }
        public AddOrder(bool isDialog, DataRow row)
        {
            this.isDialog = isDialog;
            this.isUpdate = true;
            this.row=row;
            InitializeComponent();
            groupBox2.Visible = true;
            groupBox1.Text = "Siparişi Düzenle";
            this.Text = "Siparişi Düzenle";
            vButton4.Text = row["state"].ToString().Equals("2") ? "Sipariş Aktif Et" : vButton4.Text;
            vButton3.Enabled = !row["state"].ToString().Equals("2");
            this.dateTimePicker1.Value = DateTime.Parse(row["odate"].ToString());
            this.textBox1.Text = row["orderNo"].ToString();
            
          //  MessageBox.Show(row["odate"].ToString());
        }

        private void AddOrder_Load(object sender, EventArgs e)
        {
            bindCombo(comboBox3, "firma", "provider", "1=1");

            bindCombo(comboBox5, "firma", "customer", "1=1");
            if (isUpdate)
            {
                if (!row["pid"].ToString().Equals(""))
                {
                    comboBox3.SelectedValue = row["pid"].ToString();
                }
                if (!row["cid"].ToString().Equals(""))
                {
                    comboBox5.SelectedValue = row["cid"].ToString();
                }
                              
            }

            string[] cols = { "Ürün İsmi", "Ürün Özelliği" };
            string[] cols1 = { "Ürün İsmi","Ürün Kodu", "Adet" };

            products = new DataTable();
            products.Columns.Add("id");
            products.Columns.Add("pname");
            products.Columns.Add("pcode");
            products.Columns.Add("pcount");

            myGrid2.initGrid(products);
            myGrid2.setMap(cols1);

            if (isUpdate)
            {
              DataTable otable=null;

              try
              {
                  otable = DoDatabase.select("select op.id as id,p.ptext as ptext,pcount"+
                      " from orderproduct as op inner join product as p on p.id=op.productid where orderid=" +
                      row["id"].ToString());
              }
              catch (Exception ex)
              {

                  MessageBox.Show(ex.Message);
              }
              foreach (DataRow r in otable.Rows)
              {
                  products.Rows.Add(r["id"].ToString(), r["ptext"].ToString(), r["pcount"].ToString());
              }
            }

          

            myGrid2.dataGridView1.CellDoubleClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.dataGridView2_CellDoubleClick);


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
        private void groupBox1_Enter(object sender, EventArgs e)
        {

        }
        private void dataGridView2_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {
         
            DataRow row = myGrid2.table.Rows[e.RowIndex];
            products.Rows.Remove(row);


        }
        private void dataGridView1_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {
            SmallAddForm pro = new SmallAddForm("Ürün Adedi");
            pro.textBox1.KeyPress += new KeyPressEventHandler(DoVerito.onlyNumbers);
            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
           
            }

        }

        private void vButton8_Click(object sender, EventArgs e)
        {
            AddProvider pro = new AddProvider(true);

            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                bindCombo(comboBox3, "firma", "provider", "1=1");
             
            }

        }

        private void vButton2_Click(object sender, EventArgs e)
        {
            AddCustomer pro = new AddCustomer(true);

            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {
                bindCombo(comboBox5, "firma", "customer", "1=1");

            }
        }

        private void vButton10_Click(object sender, EventArgs e)
        {
            DoVerito.closeTab(this);
        }

        private void vButton1_Click(object sender, EventArgs e)
        {
            if (!check()) return;

            MyDBTool tool = new MyDBTool("order");
            tool["orderNo"] = textBox1.Text;
            tool["odate"] = dateTimePicker1.Value.ToString("yyyy-M-dd");
            tool["providerid"] = comboBox3.SelectedValue.ToString();
            tool["customerid"] = comboBox5.SelectedValue.ToString();
            //user id
            long id;
            if (!isUpdate)
            {
                id = DoDatabase.insert(tool.getInsert());


                string opsql = "insert into orderproduct(orderid,productid,pcount) values ";

                foreach (DataRow row in products.Rows)
                {
                    opsql += "(" + id + "," + row["id"].ToString() + "," + row["pcount"] + "),";
                }
                opsql = opsql.Substring(0, opsql.Length - 1);

                //  textBox1.Text = opsql;
                try
                {
                    DoDatabase.insert(opsql);
                    MessageBox.Show("Sipariş kaydedildi.");
                    foreach (Control item in this.groupBox1.Controls)
                    {
                        if (item.GetType() == typeof(TextBox))
                        {
                            (item as TextBox).Text = "";
                        }
                    }
                }
                catch (Exception)
                {

                    MessageBox.Show("Sipariş kaydedilirken hata oluştu.");
                }
            }
            else
            {
                id = long.Parse(row["id"].ToString());

                tool.where["id"] = id.ToString();

                DoDatabase.update(tool.getUpdate());

                DoDatabase.delete("delete from orderproduct where orderid=" + id);

                string opsql = "insert into orderproduct(orderid,productid,pcount) values ";

                foreach (DataRow rowx in products.Rows)
                {
                    opsql += "(" + id + "," + rowx["id"].ToString() + "," + rowx["pcount"] + "),";
                }
                opsql = opsql.Substring(0, opsql.Length - 1);

                //  textBox1.Text = opsql;
                try
                {
                    DoDatabase.insert(opsql);
                    MessageBox.Show("Sipariş güncellendi.");
                 
                }
                catch (Exception)
                {

                    MessageBox.Show("Sipariş güncelenirken hata oluştu.");
                }
            }

          
        }

        private bool check()
        {
            if (textBox1.Text.Equals(""))
            {
                MessageBox.Show("Sipariş numarası giriniz.");
                return false;
            }
            if (comboBox3.SelectedValue.ToString().Equals("0") && comboBox5.SelectedValue.ToString().Equals("0"))
            {
                MessageBox.Show("Bir müşteri yada tedarikçi seçiniz.");
                return false;
            }
            if (!comboBox3.SelectedValue.ToString().Equals("0"))
            {
                if (Form3.user.isAuth(4)==false )
                {
                    MessageBox.Show(Lang.UNAUTH);
                    return false;
                }
            }
            if (!comboBox5.SelectedValue.ToString().Equals("0"))
            {
                if (Form3.user.isAuth(5)==false )
                {
                    MessageBox.Show(Lang.UNAUTH);
                    return false;
                }
            }
            return true;
        }

        private void myGrid1_Load(object sender, EventArgs e)
        {

        }

        private void vButton4_Click(object sender, EventArgs e)
        {
            if (!row["state"].ToString().Equals("2"))
            {
                if (MessageBox.Show("Bu siparişi iptal etmek istediğinize emin misiniz?", "Onay", MessageBoxButtons.YesNo) == DialogResult.Yes)
                {
                    DoDatabase.update("update `order` set state=2 where id=" + row["id"].ToString());
                    vButton4.Text = "Sipariş Aktif Et";
                    row["state"] = "2";
                    vButton3.Enabled = !row["state"].ToString().Equals("2");
                    MessageBox.Show("Sipariş iptal edildi.");
                }
            }
            else
            {
                DoDatabase.update("update `order` set state=0 where id=" + row["id"].ToString());
                vButton4.Text = "Sipariş İptal Et";
                row["state"] = "0";
                MessageBox.Show("Sipariş Aktif edildi.");
                vButton3.Enabled = !row["state"].ToString().Equals("2");
                
            }
        }
        public override void callback(TreeNode node)
        {
            textBox3.Text = node.Text;
            textBox3.Tag = node.Name;
            vButton5.Visible = true;
            //  MessageBox.Show(node.Name);
        }
        private void vButton3_Click(object sender, EventArgs e)
        {
            panel1.Visible = true;
            textBox3.Visible = treeCombo.Visible = true;
            treeCombo.callback(this);
            treeCombo.loadStock();
          //  bindCombo(comboBox1, "kname", "konum", "1=1");
        }


        private void vButton5_Click(object sender, EventArgs e)
        {
            if (MessageBox.Show("Bu siparişi sevk etmek istediğinize emin misiniz?", "Onayla", MessageBoxButtons.YesNo) 
                == DialogResult.Yes)
            {


                MyDBTool tool = new MyDBTool("moveorder");
                tool["_orderid"] = row["id"].ToString();
                tool["_type"] = "stock";
                tool["_mastercode"] = textBox3.Tag.ToString();
                try
                {
                    DoDatabase.execSp(tool);
                    MessageBox.Show("Sipariş sevk edildi.");
                }
                catch (Exception ex)
                {

                    MessageBox.Show(ex.Message);
                    return;
                }
            }
        }

        private void treeCombo_SelectedIndexChanged(object sender, EventArgs e)
        {

        }

        private void myGrid2_Load(object sender, EventArgs e)
        {

        }

        private void vButton6_Click(object sender, EventArgs e)
        {
            Products pros = new Products(true);

            DialogResult res = pros.ShowDialog();
            if (res == DialogResult.Yes)
            {
                SmallAddForm pro = new SmallAddForm("Ürün Adedi");
                pro.textBox1.KeyPress += new KeyPressEventHandler(DoVerito.onlyNumbers);
                DialogResult result = pro.ShowDialog();

                if (result == DialogResult.Yes)
                {
                    string id = pros.selectedId;

                    products.Rows.Add(id, pros.selectedPro,pros.selectedCode, pro.retValue);
                }
            }
        }

        private void vButton7_Click(object sender, EventArgs e)
        {
            GetProCode gpc = new GetProCode();
            if (gpc.ShowDialog() != DialogResult.Yes) return;

            SmallAddForm pro = new SmallAddForm("Ürün Adedi");
            pro.textBox1.KeyPress += new KeyPressEventHandler(DoVerito.onlyNumbers);
            DialogResult result = pro.ShowDialog();

            if (result == DialogResult.Yes)
            {

                DataTable dt = DoDatabase.select("select id,pname,pcode,"+pro.retValue+" from product where pcode='" + gpc.retvalue + "'");
                if (dt.Rows.Count == 0)
                {
                    MessageBox.Show("Ürün kodu bulunamadı.");
                    return;
                }

                DataRow pror = dt.Rows[0];



                products.Rows.Add(pror.ItemArray);
            }
        }
      
    }
}
