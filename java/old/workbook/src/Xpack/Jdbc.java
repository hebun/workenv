package Xpack;

//STEP 1. Import required packages
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Hashtable;
import java.util.List;
import java.util.logging.Logger;

public  class Jdbc {
	// JDBC driver name and database URL
	static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
	static final String DB_URL = "jdbc:mysql://localhost/betting";
	static Connection conn = null;
	static Statement stmt = null;

	// Database credentials
	static final String USER = "root";
	static final String PASS = "2882";
	public static boolean started = false;
	private final static Logger log = Logger.getLogger(Jdbc.class
			.getName());

	public static void start(String caller) {
		try {
			Class.forName("com.mysql.jdbc.Driver");

			// STEP 3: Open a connection
			System.out.println("Caller "+caller);
			conn = DriverManager.getConnection(DB_URL, USER, PASS);
			
			stmt = conn.createStatement();

		} catch (ClassNotFoundException e) {

			e.printStackTrace();
		} catch (SQLException e) {

			e.printStackTrace();
		}
		started = true;
	}

	public static void close(String caller) {
		System.out.println("closing ..."+caller);
		try {
			stmt.close();
			conn.close();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		started = false;
	}

	private static int say = 0;

	public static void query(String sql) {
		if (!started)
			start("query not started");
		try {
			say++;
			if (say % 100 == 0)
				System.out.print(say + ".");

			int rs = stmt.executeUpdate(sql);

		} catch (SQLException se) {
			log.info(sql);
			se.printStackTrace();
		} catch (Exception e) {

			e.printStackTrace();
		} finally {

		}// end try

	}

	public static List<Hashtable<String, String>> select(String sql) {
		if (false == started)
			start("select not started");
		List<Hashtable<String, String>> list = null;
		try {
			say++;
			if (say % 100 == 0)
				System.out.print(say + ".");

			ResultSet rs = stmt.executeQuery(sql);
			ResultSetMetaData data = rs.getMetaData();
			int colCount = data.getColumnCount();
			list = new ArrayList<Hashtable<String, String>>();
			while (rs.next()) {

				Hashtable<String, String> hash = new Hashtable<String, String>();
				for (int i = 1; i <= colCount; i++) {

					String value = rs.getString(i) == null ? "NULL" : rs
							.getString(i);
					hash.put(data.getColumnLabel(i), value);
				}
				list.add(hash);

			}
		} catch (SQLException se) {

			se.printStackTrace();
		} catch (Exception e) {

			e.printStackTrace();
		} finally {

		}// end try
		return list;
	}
}// end FirstExample