using System;
using System.Data;
using System.Configuration;



using System.Collections;
using MySql.Data.MySqlClient;
using System.IO;
namespace Verito
{
    
    
    public class DoDatabase
    {
        public static string currendb = "veritob";

        public static string connectionString = "SERVER=localhost;" +
                "DATABASE=" + currendb + ";" +
                "UID=root;Character Set=latin5" +
                "";

        public static string getMax(string table)
        {
            string ret = DoDatabase.select("select max(id) as max_ from " + table).Rows[0]["max_"].ToString();
            return ret; ;
        }
        public static void initDatabase()
        {
           
            FileInfo file = new FileInfo("verito.sql");

            string script = file.OpenText().ReadToEnd();
           // Console.WriteLine(script);
            try
            {
                insert(script);
                //  insert(procs);
            }
            catch (Exception rc)
            {

                Console.WriteLine(rc.Message);
            }
            initProcs();
            
        }
        public static void initProcs()
        {
            connectionString = "SERVER=localhost;" +
                "DATABASE=" + currendb + ";" +
                "UID=root;Character Set=latin5" +
                "";
            FileInfo file = new FileInfo("procs.sql");

            string script = file.OpenText().ReadToEnd();
            // Console.WriteLine(script);
            
                insert(script);
                //  insert(procs);
            
        }
        public static bool checkDb()
        {
            return false;
        }
        public static System.Data.DataTable select(string MySql)
        {

            MySqlConnection con = null;
            //MySqlConnection
           
            con = new MySqlConnection(connectionString);
            // con.Provider = Provider;
            con.Open();
            string MySqlStatement = MySql;
                
            MySqlCommand cmd = new MySqlCommand(MySqlStatement, con);

            MySqlDataAdapter da = new MySqlDataAdapter(cmd);

            DataSet dataSet = new DataSet();
            da.Fill(dataSet);
            con.Close();
            return dataSet.Tables[0];
          
        }
        public static bool checkCon()
        {
            try{
            
                string _connectionString = "SERVER=localhost;" +
                
                "UID=root;Character Set=latin5" +
                "";
                MySqlConnection con = null;
                //MySqlConnection

                con = new MySqlConnection(_connectionString);
                // con.Provider = Provider;
                con.Open();

                return true;
            }
            catch (Exception)
            {
                return false;
            }
            
        }
        public static string selectSingle(string table,string col,string where)
        {

            MySqlConnection con = null;
            //MySqlConnection
           
                con = new MySqlConnection(connectionString);
                // con.Provider = Provider;
                con.Open();
                string MySqlStatement = "select "+col +" from "+table+" where "+where;

                MySqlCommand cmd = new MySqlCommand(MySqlStatement, con);

                MySqlDataAdapter da = new MySqlDataAdapter(cmd);

                DataSet dataSet = new DataSet();
                da.Fill(dataSet);
                con.Close();
                return dataSet.Tables[0].Rows[0][0].ToString();
           
        }
        public static bool checkActive(string id)
        {
            return true;
            // return select("select id  from Bildirim_uyeleri where Uye_id=" + id).Rows.Count>=5;
        }
        public static long update(string updateMySql)
        {

            return insert(updateMySql);
        }
       
      
        public static DataSet execSp(MyDBTool tool)
        {

            DataSet ds = new DataSet();
            using (var conn = new MySqlConnection(connectionString))
            {
                using (var command = new MySqlCommand(tool.getTable(), conn)
                {
                    CommandType = CommandType.StoredProcedure
                })
                {
                    foreach (DictionaryEntry item in tool.table)
                    {

                        command.Parameters.Add(new MySqlParameter(item.Key.ToString(), item.Value));
                    }

                    conn.Open();

                    using (MySqlDataAdapter da = new MySqlDataAdapter(command))
                    {

                        da.Fill(ds);

                        command.Parameters.Clear();

                    }
                    conn.Close();
                }
            }

            return ds;
        }
        public static long insert(string insertMySql)
        {

            MySqlConnection con = null;
            
                con = new MySqlConnection(connectionString);
                con.Open();
                MySqlCommand cmd = new MySqlCommand(insertMySql + "", con);
                cmd.ExecuteNonQuery();
                con.Close();
                long id = cmd.LastInsertedId;
           
                return id; 
          
        }

        public static void delete(string p)
        {
            insert(p);
        }
        public static string userId()
        {
            return "";
            //  return ((DataRow)Session["user"])["id"].ToString();
        }
        public static string getTarih()
        {
            string gun = DateTime.Now.Day.ToString();
            string ay = DateTime.Now.Month.ToString();
            string yil = DateTime.Now.Year.ToString();
            string saat = DateTime.Now.Hour.ToString();
            string dakika = DateTime.Now.Minute.ToString();
            string tarih = ay + "." + gun + "." + yil + " " + saat + ":" + dakika;
            return tarih;
        }
        //public static string fillCombo


        public static DataTable fillCombo(string table, string condition)
        {
            return select("select * from " + table + " where " + condition);
        }

      
    }
}