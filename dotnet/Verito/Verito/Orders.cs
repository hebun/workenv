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
    public partial class Orders : Form
    {
        public Orders()
        {
            InitializeComponent();
        }

        private void Orders_Load(object sender, EventArgs e)
        {
            
            myGrid1.initGrid("select * from orders where state<>1");

            myGrid1.edit =new  MyGrid.EditRow(editOrder);
        }
        void editOrder(DataRow row)
        {
            if (Form3.user.isAuth(4) == false)
            {
                MessageBox.Show(Lang.UNAUTH);
                return;
            }
            DoVerito.openForm(this, new AddOrder(false, row));                    
        }
    }
}
