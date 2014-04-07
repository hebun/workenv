package org.nule.lighthl7lib.hl7;

import java.io.IOException;
import java.sql.Connection;
import java.sql.Date;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;

public class jdbcTest1 {
	Connection con;
	Statement stm;

	public String[] ekle(int numara) throws SQLException {
		String url = "jdbc:odbc:HL7";

		ResultSet sonuc;
		String returnArray[] = new String[20];
		String Ssql;

		Ssql = "SELECT * FROM PACSTABLOSU WHERE NUMARA="
				+ String.valueOf(numara) + " AND GITTI ='H'";

		try {
			Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");

		}

		catch (java.lang.ClassNotFoundException e) {
			System.err.print("ClassNotFoundException: ");
			System.err.print(e.getMessage());
		}
		String mcid = "";

		con = DriverManager.getConnection(url, "sa", "");
		stm = con.createStatement();
		sonuc = stm.executeQuery(Ssql);
		while (sonuc.next()) {
			String pno = String.valueOf(sonuc.getString("PNO"));
			returnArray[0] = pno.substring(0, pno.length());

			String mno = String.valueOf(sonuc.getString("MNO"));
			returnArray[1] = mno.substring(0, mno.length());

			returnArray[2] = String.valueOf(sonuc.getString("TCK"));
			returnArray[3] = String.valueOf(sonuc.getString("SIRA"));
			returnArray[4] = sonuc.getString("SERVISID");
			returnArray[5] = sonuc.getString("BUTKODU");
			returnArray[6] = sonuc.getString("ACIKLAMA");
			returnArray[7] = sonuc.getString("ADI");
			returnArray[8] = sonuc.getString("SOYADI");
			returnArray[9] = returnArray[0] + returnArray[3]; // sonuc.getString("MCID");
			returnArray[10] = sonuc.getString("GRUP");
			returnArray[11] = sonuc.getString("CINSIYET");
			Date date = sonuc.getDate("DTARIHI");
			SimpleDateFormat formatDogum = new SimpleDateFormat("yyyyMMdd");
			if (date == null)
				returnArray[12] = "";
			else
				returnArray[12] = formatDogum.format(date);

			mcid = returnArray[0] + returnArray[3];

			insertMcid(mcid, numara);
			// int k = 0;
			// for (String string : returnArray) {
			//					
			// }
			// while(k<returnArray.length)
			// {
			// System.out.println(k+":"+returnArray[k]);
			// k++;
			// }
		}

		return returnArray;

	}

	public static void insertMcid(String mcid, int no) throws SQLException {
		Connection con;
		Statement stm;
		String url = "jdbc:odbc:HL7";

		String Ssql;

		Ssql = "UPDATE PACSTABLOSU SET MCID='" + mcid + "' WHERE NUMARA=" + no;

		try {
			Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
		}

		catch (java.lang.ClassNotFoundException e) {
			System.err.print("ClassNotFoundException: ");
			System.err.print(e.getMessage());
		}

		con = DriverManager.getConnection(url, "sa", "");
		stm = con.createStatement();
		stm.executeUpdate(Ssql);
		con.close();
		stm.close();

	}

	public static void insertHl7(String hl7, int numara) throws SQLException {

		Connection con;
		Statement stm;
		String url = "jdbc:odbc:HL7";

		String Ssql;

		Ssql = "UPDATE PACSTABLOSU SET HL7='" + hl7 + "' WHERE NUMARA="
				+ numara;

		try {
			Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
		}

		catch (java.lang.ClassNotFoundException e) {
			System.err.print("ClassNotFoundException: ");
			System.err.print(e.getMessage());
		}

		con = DriverManager.getConnection(url, "sa", "");
		stm = con.createStatement();
		stm.executeUpdate(Ssql);
		con.close();
		stm.close();

	}

	public static void insertDatabase(String column, String value,
			String condition) throws IOException, SQLException {
		Connection con;
		Statement stm;
		String url = "jdbc:odbc:HL7";

		String Ssql;
		// System.out.println("insertAciklama:aciklama=" + aciklama + "mcid:"
		// + mcid);
		Ssql = "UPDATE PACSTABLOSU SET " + column.toUpperCase() + "='" + value
				+ "'" + condition;
		System.out.println("Ssql:" + Ssql);

		try {
			Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
		}

		catch (java.lang.ClassNotFoundException e) {
			System.err.print("ClassNotFoundException: ");
			System.err.print(e.getMessage());
		}

		con = DriverManager.getConnection(url, "sa", "");
		stm = con.createStatement();
		stm.executeUpdate(Ssql);
		con.close();
		stm.close();

	}

	public static void insertAciklama(String aciklama, String mcid)
			throws SQLException {
		Connection con;
		Statement stm;
		String url = "jdbc:odbc:HL7";

		String Ssql;
		System.out.println("insertAciklama:aciklama=" + aciklama + "mcid:"
				+ mcid);
		Ssql = "UPDATE PACSTABLOSU SET RAPOR='" + aciklama + "' WHERE MCID='"
				+ mcid + "'";

		try {
			Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
		}

		catch (java.lang.ClassNotFoundException e) {
			System.err.print("ClassNotFoundException: ");
			System.err.print(e.getMessage());
		}

		con = DriverManager.getConnection(url, "sa", "");
		stm = con.createStatement();
		stm.executeUpdate(Ssql);
		con.close();
		stm.close();

	}

	public void update() throws SQLException {
		String url = "jdbc:odbc:HL7";

		String Ssql;

		Ssql = "UPDATE PACSTABLOSU SET GITTI='E' WHERE GITTI<>'E'";

		try {
			Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
		}

		catch (java.lang.ClassNotFoundException e) {
			System.err.print("ClassNotFoundException: ");
			System.err.print(e.getMessage());
		}

		con = DriverManager.getConnection(url, "sa", "");
		stm = con.createStatement();
		stm.executeUpdate(Ssql);
		this.closeDatabase();

	}

	public ResultSet getAll() throws SQLException {
		String url = "jdbc:odbc:HL7";

		ResultSet sonuc;

		String Ssql;

		Ssql = "SELECT * FROM PACSTABLOSU WHERE GITTI='H'";
		Options options = new Options();
		if (options.isOnay()) {
			Ssql += " and ONAY='E'";
		}
    System.out.println("\nisonay="+options.isOnay());
		try {
			Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
		}

		catch (java.lang.ClassNotFoundException e) {
			System.err.print("ClassNotFoundException: ");
			System.err.print(e.getMessage());
		}

		con = DriverManager.getConnection(url, "sa", "");
		stm = con.createStatement();
		sonuc = stm.executeQuery(Ssql);
		return sonuc;

	}

	public void closeDatabase() {
		try {
			stm.close();
			con.close();
		} catch (SQLException e) {

			e.printStackTrace();
		}

	}

	public static ResultSet selectDatabase(String condition)
			throws SQLException {

		String url = "jdbc:odbc:HL7";
		Connection con;
		Statement stm;

		String Ssql;
		ResultSet sonuc;

		Ssql = "SELECT * FROM PACSTABLOSU WHERE GITTI='H'" + condition;
		try {
			Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
		}

		catch (java.lang.ClassNotFoundException e) {
			System.err.print("ClassNotFoundException: ");
			System.err.print(e.getMessage());
		}

		con = DriverManager.getConnection(url, "sa", "");
		stm = con.createStatement();
		sonuc = stm.executeQuery(Ssql);
		return sonuc;

	}

}
