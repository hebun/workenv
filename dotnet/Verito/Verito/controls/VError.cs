using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Drawing;
using System.Data;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace Verito.controls
{
    public partial class VError : Label
    {
        object lbl;

        public object Lbl
        {
            get { return lbl; }
            set { lbl = value; }
        }
        object comp;

        public object Comp
        {
            get { return comp; }
            set { comp = value; }
        }
        bool isReq;

        public bool IsReq
        {
            get { return isReq; }
            set { isReq = value; }
        }

        string id;

        public string Id
        {
            get { return id; }
            set { id = value; }
        }
        public VError()
        {
            InitializeComponent();
            this.Text = "";
            this.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, 
                System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.ForeColor = Color.Red;
        }

        private void VError_Load(object sender, EventArgs e)
        {

        }
    }
}
