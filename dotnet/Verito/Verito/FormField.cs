using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Verito
{
    class FormField
    {
        public bool required;
        public string type;
        public object comp;
        public FormField(bool required,        string type,        object comp)
        {
            this.required = required;
            this.type = type;
            this.comp = comp;
        }
    }
}
