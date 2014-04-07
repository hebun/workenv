using System;
using System.Collections.Generic;

using System.Web;
using System.Collections;
using System.Data;
using System.Text;
namespace Verito
{
    /// <summary>
    /// Summary description for DoJson
    /// </summary>
    public class DoJson
    {
        public string json;
        public DoJson(string json)
        {
            this.json = json;
        }
        public static string datatableToJson(DataTable dt)
        {

            StringBuilder JsonString = new StringBuilder();

            JsonString.Append("{ ");
            JsonString.Append("\"TABLE\":[{ ");
            JsonString.Append("\"ROW\":[ ");

            for (int i = 0; i < dt.Rows.Count; i++)
            {

                JsonString.Append("{ ");
                // JsonString.Append("\" ");

                for (int j = 0; j < dt.Columns.Count; j++)
                {
                    if (j < dt.Columns.Count - 1)
                    {
                        JsonString.Append("" + "\"" + dt.Columns[j].ColumnName + "\":\"" +
                                          dt.Rows[i][j].ToString() + "\",");
                    }
                    else if (j == dt.Columns.Count - 1)
                    {
                        JsonString.Append("" + "\"" + dt.Columns[j].ColumnName + "\":\"" +
                                          dt.Rows[i][j].ToString() + "\"");
                    }
                }
                /*end Of String*/
                if (i == dt.Rows.Count - 1)
                {
                    JsonString.Append("} ");
                }
                else
                {
                    JsonString.Append("}, ");
                }
            }
            JsonString.Append("]}]}");
            return JsonString.ToString();
        }

        public Hashtable getHashTable()
        {
            Hashtable ret = new Hashtable();

            string str = json.Substring(1, json.Length - 1).Substring(0, json.Length - 2);

            string[] eles = str.Split(',');
            int k = 0;
            foreach (string item in eles)
            {
                string[] entries = item.Split(':');

                string key = entries[0];

                //json injection controle. ignore ':' chars in values
                string allvalue = "";
                int vc = 0;
                foreach (string v in entries)
                {
                    if (vc++ == 0) continue;

                    allvalue += v;
                }

                string value = allvalue.Substring(1, allvalue.Length - 1).Substring(0, allvalue.Length - 2);

                ret.Add(key, value);
            }

            return ret;
        }
    }
}