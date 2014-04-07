
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Hashtable;

import com.mysql.jdbc.Connection;
import com.mysql.jdbc.Statement;

/**
 * 
 */

/**
 * @author ismet
 * 
 */
public class Main {

	public static Connection conn;
	public static void initJdbc() {
		try {
			Class.forName("com.mysql.jdbc.Driver").newInstance();
			String url = "jdbc:mysql://localhost/face";
			 conn = (Connection) DriverManager.getConnection(url, "root",
					"");

		
		} catch (ClassNotFoundException ex) {
			System.out.println("here");
			System.err.println(ex.getMessage());
		} catch (IllegalAccessException ex1) {
			System.err.println(ex1.getMessage());
		} catch (InstantiationException ex2) {
			System.err.println(ex2.getMessage());
		} catch (SQLException ex3) {
			System.err.println(ex3.getMessage());
		}
	}
	  public static Hashtable<String, String> select(String table)
	  {
	    System.out.println("[OUTPUT FROM SELECT]");
	    String query = "show columns from "+table;
	    Hashtable<String, String> hash=new Hashtable<>();
	    
	    
	    try
	    {
	      Statement st = (Statement) conn.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE,ResultSet.CONCUR_UPDATABLE);
	     ResultSet rs = st.executeQuery(query);
	      while (rs.next())
	      {
	    	
	        String s = rs.getString("Field");
	        String n = rs.getString("Type");
	        
	        hash.put(s, n);
	        
	       // System.out.println(s + "   " + n);
	      }
	    }
	    catch (SQLException ex)
	    {
	      System.err.println(ex.getMessage());
	    }
	    return hash;
	  }
	/**
	 * @param args
	 */
	public static void main(String[] args) {

		Frame f = new Frame("hello");
        initJdbc();
     
       
	}

}
