using System;
using System.Collections.Generic;
using System.Text;
using System.Collections;
using System.Data.SqlClient;
namespace Verito
{

    public class MyDBTool
    {
        public Hashtable table = new Hashtable();
        public Hashtable where = new Hashtable();

        public string this[string key]
        {
            get
            {
                return table[key].ToString();
            }
            set
            {
                table[key] = value;
            }
        }

        string tableName;
        public MyDBTool(string table)
        {
            this.tableName = table;
        }

        public override string ToString()
        {
            string ret = "";
            foreach (DictionaryEntry var in table)
            {
                ret += var.Value.ToString();

            }
            return ret;
        }
        public string getInsert()
        {
            string insertSql = "insert into `" + tableName + "`(";
            foreach (DictionaryEntry var in table)
            {
                insertSql += var.Key.ToString() + ",";
            }
            insertSql = insertSql.Substring(0, insertSql.Length - 1);
            insertSql += ") values(";
            foreach (DictionaryEntry var in table)
            {
                insertSql += "'" + var.Value.ToString() + "',";
            }
            insertSql = insertSql.Substring(0, insertSql.Length - 1);
            insertSql += ")";
            return insertSql;
        }
        public string getUpdate()
        {
            string updateSql = "update `" + tableName + "` set ";
            foreach (DictionaryEntry var in table)
            {
                updateSql += var.Key.ToString() + "='" + var.Value.ToString() + "',";
            }
            updateSql = updateSql.Substring(0, updateSql.Length - 1);

            updateSql += " where ";

            foreach (DictionaryEntry var in where)
            {
                updateSql += " " + var.Key + "='" + var.Value + "' and";
            }
            updateSql = updateSql.Substring(0, updateSql.Length - 3);
            return updateSql;
        }

        public static string today()
        {
            return DateTime.Now.Year.ToString() + DateTime.Now.DayOfYear.ToString();
        }
        public static string getDaysFromDateTime(DateTime date)
        {
            string ret = date.Year.ToString();
            if (date.Month < 10)
                ret += "0" + date.Month;
            else
            {
                ret += date.Month.ToString();
            }
            return ret;
        }
        public static string getDaysFromDateTimeAll(DateTime date)
        {
            string ret = date.Year.ToString();
            if (date.Month < 10)
                ret += "0" + date.Month;
            else
            {
                ret += date.Month.ToString();
            }

            if (date.Day < 10)
                ret += "0" + date.Day;
            else
            {
                ret += date.Day.ToString();
            }
            return ret;
        }
        public static DateTime getDateFromDays(string days)
        {
            int year = int.Parse(days.Substring(0, 4));
            int month = int.Parse(days.Substring(4, 2));
            int day = int.Parse(days.Substring(6, 2));
            DateTime date = new DateTime(year, month, day);
            return date;

        }

        internal string getTable()
        {
            return tableName;
        }
    }

}