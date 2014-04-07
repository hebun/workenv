using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Collections;

namespace Verito
{
  public  class User
    {
        public string id;
        public string uname;
        public string password;
        public string type;
        public ArrayList yetkis = new ArrayList();
        public User()
        {

        }
        public User(string id, string uname, string password, string type)
        {
            this.id = id;
            this.uname= uname;
            this.password = password;
            this.type= type;
        }
        public bool isAuth(int yetki)
        {
            if(this.type.Equals("0")) return true;

            if(this.yetkis.Contains(yetki.ToString())) return true;

            return false;
        }
    }
}
