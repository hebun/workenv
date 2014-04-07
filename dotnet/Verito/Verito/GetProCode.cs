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
    public partial class GetProCode : Form
    {
        public GetProCode()
        {
            InitializeComponent();
            this.KeyPress += new System.Windows.Forms.KeyPressEventHandler(this.Form1_KeyPress);
            this.textBox1.KeyPress += new System.Windows.Forms.KeyPressEventHandler(this.Form1_KeyPress);
        }
        DateTime _lastKeystroke = new DateTime(0);
        List<char> _barcode = new List<char>(10);

        private void Form1_KeyPress(object sender, KeyPressEventArgs e)
        {
          
            // check timing (keystrokes within 100 ms)
            TimeSpan elapsed = (DateTime.Now - _lastKeystroke);
            if (elapsed.TotalMilliseconds > 5000)
                _barcode.Clear();

            // record keystroke & timestamp
            _barcode.Add(e.KeyChar);
            _lastKeystroke = DateTime.Now;

            // process barcode
            if (e.KeyChar == 13 && _barcode.Count > 0)
            {
                string msg = new String(_barcode.ToArray());
               
                _barcode.Clear();

                retvalue = msg.Trim();
                this.DialogResult = DialogResult.Yes;
                this.Close();

            }
        }
        public string retvalue = "";
        private void GetProCode_Load(object sender, EventArgs e)
        {

        }
    }
}
