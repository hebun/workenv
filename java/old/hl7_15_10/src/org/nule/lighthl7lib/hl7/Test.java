package org.nule.lighthl7lib.hl7;

import java.awt.Color;
import java.awt.Container;
import java.awt.FlowLayout;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.awt.event.WindowEvent;
import java.awt.event.WindowListener;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.io.Writer;
import java.net.Socket;
import java.net.UnknownHostException;
import java.sql.Date;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.text.SimpleDateFormat;
import java.util.Timer;
import java.util.TimerTask;

import javax.swing.BorderFactory;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.JTextField;
import javax.swing.table.AbstractTableModel;
import javax.swing.table.JTableHeader;
import javax.swing.table.TableModel;

import com.sun.corba.se.impl.orbutil.threadpool.TimeoutException;

@SuppressWarnings("serial")
public class Test extends JFrame implements ActionListener, MouseListener {

	@SuppressWarnings("unused")
	private int inPort;
	private static final Color buttonColor = Color.ORANGE;
	private boolean firstAdd = true;
	AboutDialog messageBox;
	Hl7Connection connection;
	private boolean isAuto;
	private int refresh;

	public Test() {
		super("hl7 test");
		Options options = new Options();

		this.isAuto = options.isAuto();
		this.refresh = options.getRefreshTime();
		System.out.println(this.refresh);
		log("started");
		initVisualComponents();
		this.setResizable(false);
	}

	Object dataArray[][] = new Object[500][500];
	int colCount;
	int rowCount;
	String names[] = { "PNO", "MNO", "SIRA", "DOKTOR", "BUTKODU", "ACIKLAMA",
			"ADI", "SOYADI", "TARIH", "MCID" };

	public void doOnQuit() {

	}

	public void log(String str) {
		// PrintWriter writer = null;
		// try {
		// writer = new PrintWriter("logs.xml");
		// } catch (FileNotFoundException e) {
		// JOptionPane.showMessageDialog(this, "basdlf");
		// }
		// writer.append(str + "\n");
		// writer.flush();
		// writer.close();
		//
		Writer output = null;
		String text = str;
		File file = new File("logs.xml");
		try {
			output = new BufferedWriter(new FileWriter(file, true));
			output.append("\n[ "
					+ new Date(System.currentTimeMillis()).toString() + "]:"
					+ str);

			output.close();
		} catch (IOException e) {

		}

	}

	public void refreshDatabase(boolean isOptional) {

		jdbcTest1 jdbc = new jdbcTest1();
		grid.clearSelection();

		scrollPane.remove(grid);
		if (!firstAdd)
			c.remove(scrollpane);

		firstAdd = false;
		completeOutput = "";
		ResultSet data = null;
		int rowSay = 0;

		if (isOptional) {
			String conditon = "";
			if (sOptionPan.getTarihChecked()) {
				if (!sOptionPan.isValidTarih()) {
					dialog = new AboutDialog(this, "hata", "Geçersiz Tarih!");
					// return;
				} else
					conditon = "AND TARIH='" + sOptionPan.getTarih() + "' ";

			}
			if (sOptionPan.getPno().equals("") == false) {
				// if(sOptionPan.getPno().)
				conditon += " AND ";

				conditon += " PNO=" + sOptionPan.getPno() + " ";
			}
			if (sOptionPan.getSira().equals("") == false) {

				conditon += " AND ";

				conditon += " SIRA=" + sOptionPan.getSira() + " ";
			}
			// conditon += " AND MNO='1'";,
			boolean onay = new Options().isOnay();

			if (onay) {
				conditon += " and ONAY='E'";
			}
			try {
				data = jdbcTest1.selectDatabase(conditon);
			} catch (SQLException e) {
				if (isAuto)
					log("5:" + e.getMessage());
				else
					JOptionPane.showMessageDialog(this, "5:" + e.getMessage());
			}
		} else {
			try {
				data = jdbc.getAll();
			} catch (SQLException e) {
				if (isAuto)
					log("6:" + e.getMessage());
				else
					JOptionPane.showMessageDialog(this, "6:" + e.getMessage());
			}
		}

		try {

			for (rowSay = 0; data.next(); rowSay++) {
				// String numara = data.getInt("NUMARA");
				int no = data.getInt("NUMARA");// Integer.parseInt(numara.
				// substring(0,
				// numara.length()));
				// System.out.println("no:"+no);
				int j = 0;
				while (j < names.length) {
					dataArray[rowSay][j] = data.getString(names[j]);
					j++;
				}

			}
			colCount = names.length;
			rowCount = rowSay;
		} catch (SQLException e) {
			if (isAuto)
				log("5x:" + e.getMessage());
			else
				JOptionPane.showMessageDialog(this, "5x" + e.getMessage());
		}
		if (!isOptional) {
			jdbc.closeDatabase();
		}
		grid = new JTable(dataArray, names);
		TableModel dataModel = new AbstractTableModel() {
			public int getColumnCount() {
				return colCount;
			}

			public int getRowCount() {
				return rowCount;
			}

			public Object getValueAt(int row, int col) {
				return dataArray[row][col];
			}

			public String getColumnName(int column) {
				return names[column];
			}
		};
		table = new JTable(dataModel);
		scrollpane = new JScrollPane(table);
		scrollpane.setLocation(20, 100);
		scrollpane.setSize(900, 200);
		c.add(scrollpane);
		scrollPane.add(grid);
		grid.repaint();
		JTableHeader tableHeader = new JTableHeader();
		tableHeader.setTable(grid);
		c.add(tableHeader);
		messageBut.setEnabled(grid.getRowCount() != 0);
		setConnectPane();
	}

	JScrollPane scrollpane;
	JTable table;

	Hl7Record record;
	String message;

	public static void main(String[] args) {
		Date timeD = new Date(System.currentTimeMillis());
		SimpleDateFormat format = new SimpleDateFormat("yyyyMMddHHSS");
		String time = format.format(timeD);

		final Test pencere = new Test();

		pencere.addWindowListener(new WindowListener() {
			public void windowClosing(WindowEvent winEvt) {
				// Perhaps ask user if they want to save any unsaved files
				// first.

				// if (pencere.socket.isClosed() == false)
				// {
				// pencere.closeConnection();
				// }
				System.out.println("exited");
				System.exit(0);
			}

			public void windowActivated(WindowEvent e) {

			}

			public void windowClosed(WindowEvent e) {

			}

			public void windowDeactivated(WindowEvent e) {

			}

			public void windowDeiconified(WindowEvent e) {

			}

			public void windowIconified(WindowEvent e) {

			}

			public void windowOpened(WindowEvent e) {

			}

		});
		pencere.setSize(1020, 760);
		pencere.setLocationRelativeTo(null); // center it
		pencere.setVisible(true);

		pencere.refreshDatabase(false);
		pencere.listenHl7 = new HL7Listen(pencere);
		pencere.listenHl7.start();
		// pencere.initConnecton();
		pencere.setConnectPane();
		Timer timer = new Timer();

		timer.schedule(pencere.task, 1000 * 1, pencere.refresh * 1000);
		// timer.
		pencere.initConnecton();
	}

	public void setConnectPane() {
		String text = "<html><body> Bağlantı:   <br>";

		if (connection == null || !connection.isOpen()) {
			text += "<img src='file:pasif.PNG'></img>";

		} else {
			text += "<img src='file:aktif.PNG'></img>";
			text += "<br>Port:" + connection.port;
		}
		text += "<br><br> Dinleme: <br>";
		if (listenHl7 == null || !listenHl7.isOpen()) {
			text += "<img src='file:pasif.PNG'></img>";

		} else {
			text += "<img src='file:aktif.PNG'></img>";
			text += "<br>Port:" + listenHl7.port;
		}
		text += "</body></html>";
		listenKnowledgeLabel.setText(text);
		// sendAll();
	}

	public TimerTask task = new TimerTask() {

		@Override
		public void run() {
			setConnectPane();

			if (isAuto) {
				erase();
				sendAll();
				sOptionPan.setTarihText();
			}
			// sendRepeatly();
		}

	};
	HL7Listen listenHl7 = null;

	public boolean isSendOptional = false;

	public void actionPerformed(ActionEvent e) {

		if (e.getSource() == exitButton) {
			if (socket != null) {
				if (socket.isClosed() == false)
					closeConnection();
			}

			if (connection != null) {
				if (connection.isOpen()) {
					connection.close();
				}
			}
			System.exit(0);
		}
		if (e.getSource() == messageBut) {
			erase();

			sendRepeatly();
		}
		if (e.getSource() == refreshBut) {
			isSendOptional = false;
			refreshDatabase(false);
		}
		if (e.getSource() == listenButton) {
			// isConnected = !isConnected;
			// if (isConnected) {
			//				
			// if (ilk) {
			//					
			// }
			// ilk = false;
			//
			// listenButton.setIcon(null);
			// listenButton.setIcon(stopIcon);
			// listenButton.setText("Durdur");
			// } else {
			// listenButton.setIcon(startIcon);
			// listenButton.setText("Başlat");
			// listenKnowledgeLabel.setText(startText);
			// }
		}
	}

	private void sendRepeatly() {

		sendAll();
	}

	private void erase() {

		// outputTextField.setText("");
		// inputTextField.setText("");
		// outputACKField.setText("");
		// inputACKField.setText("");
		// this.repaint();

	}

	AboutDialog dialog;

	private void sendAll() {

		out = "";
		jdbcTest1 jdbc = new jdbcTest1();
		ResultSet data = null;
		if (isSendOptional) {
			String conditon = "";
			if (sOptionPan.getTarihChecked()) {

				conditon = " AND TARIH='" + sOptionPan.getTarih() + "' ";

			}
			if (sOptionPan.getPno().equals("") == false) {

				conditon += " AND ";

				conditon += " PNO=" + sOptionPan.getPno() + " ";
			}
			if (sOptionPan.getSira().equals("") == false) {

				conditon += " AND ";

				conditon += " SIRA=" + sOptionPan.getSira() + " ";
			}
			boolean onay = new Options().isOnay();

			if (onay) {
				conditon += " and ONAY='E'";
			}
			// System.out.println("condition bu:" + conditon + "\n");
			// conditon += " AND MNO=1";
			try {
				data = jdbcTest1.selectDatabase(conditon);
			} catch (SQLException e) {
				if (isAuto)
					log("7:" + e.getMessage());
				else
					JOptionPane.showMessageDialog(this, "7:" + e.getMessage());
			}
		} else {
			try {
				data = jdbc.getAll();
			} catch (SQLException e) {
				if (isAuto)
					log("8:" + e.getMessage());
				else
					JOptionPane.showMessageDialog(this, "8:" + e.getMessage());
			}
		}

		try {
			// for (int i = 0; data.next(); i++) {
			if (data.next()) {
				int no = data.getInt("NUMARA");
				// int no = Integer.parseInt(numara.substring(0,
				// numara.length()));

				makeMessage(no);

			}

		} catch (NumberFormatException e) {
			System.out.println("sendAllnumberFormat:");
			e.printStackTrace();
		} catch (SQLException e) {
			System.out.println("sendAllSQLExeptiob:");
			e.printStackTrace();
		}
		if (!isSendOptional) {
			jdbc.closeDatabase();
		}
		if (out.equals("") == false)
			sendAndGetACK(out);
	}

	boolean ilk = true;

	private void makeMessage(int no) {
		jdbcTest1 con = new jdbcTest1();
		String result[] = null;
		try {
			result = con.ekle(no);
		} catch (SQLException e) {
			if (isAuto)
				log("10:" + e.getMessage());
			else
				JOptionPane.showMessageDialog(this, "10:" + e.getMessage());
		}
		MessageMaker messageMaker = new MessageMaker(result);
		message = messageMaker.toString();
		try {
			jdbcTest1.insertHl7(message, no);
		} catch (SQLException e) {
			if (isAuto)
				log("11:" + e.getMessage());
			else
				JOptionPane.showMessageDialog(this, "11:" + e.getMessage());
		}
		out += message;

		// sendAndGetACK(message);
	}

	String completeOutput = "";

	String lineToBeSent;

	private String server;

	private int port;
	String out = "";
	Socket socket;
	BufferedReader input;
	InputStreamReader inputStream = null;
	PrintWriter output = null;

	public void sendAndGetACK(String text) {

		lineToBeSent = text;
		if (connection == null) {
			initConnecton();
		}
		try {
			connection.send(text);
		} catch (CustomException e) {
			dialog = new AboutDialog(this, "hata:", e.getMessage());
			return;
		}

		outputTextField.setText(formatMessageForShow(lineToBeSent));

		String message = null;
		try {
			message = connection.readACK();

		} catch (IOException e1) {
			dialog = new AboutDialog(this, "!", "Cevap alınamadı!");
			return;
		} catch (TimeoutException e1) {
			dialog = new AboutDialog(this, "!", "Cevap alınamadı!");
			return;

		}
		String formatedMessage = formatMessageForShow(message);

		inputACKField.setText(formatedMessage);

	}

	public void initConnecton() {
		try {
			connection = new Hl7Connection();
		} catch (UnknownHostException e) {
			dialog = new AboutDialog(this, "hata:", " Geçersiz Host");
		} catch (IOException e) {
			dialog = new AboutDialog(this, "hata:", " bağlantı sağlanamadı!");
		}
	}

	public void closeConnection() {
	}

	public String formatMessageForShow(String message) {
		String newString = "<html><body backcolor=white>";
		for (int index = 0; index < message.length(); index++) {
			char ch = message.charAt(index);
			if (ch == MLLPMessage.D) {
				newString += "<font color=blue>[0x0D]</font><br>";
			} else if (ch == MLLPMessage._1C) {
				newString += "<font color=blue>[0x1C]</font>";
			} else if (ch == MLLPMessage.B) {
				newString += "<font color=blue>[0x0B]</font><br>";
			} else if (ch == '|') {
				newString += "<font color=red> | </font>";
			} else if (ch == '^') {
				newString += "<font color=green><b>^</b></font>";
			} else
				newString += "" + ch + "";
		}

		return newString += "</body></html>";
	}

	// public void paint(Graphics g)
	// {
	//		
	// super.paint(g);
	// g.setColor(Color.red);
	// g.fillRect(10, 340, 300, 300);
	// }

	public void mouseClicked(MouseEvent arg0) {

	}

	JButton exitButton;
	JLabel lab1;
	JButton but2;
	JLabel lab2;
	JTextField textField2;
	JLabel outputTextField;
	JButton conBut;
	JLabel inputACKField;

	private JLabel gidenHl7Label;
	private JLabel gelenHl7Label;

	private JTable grid;
	private JButton refreshBut;

	Container c;

	private JScrollPane scrollPane;
	public JButton messageBut;
	public JLabel inputTextField;

	private JLabel gelenACKLabel;

	public JLabel outputACKField;

	private JLabel gidenACKLabel;
	private JButton listenButton;

	boolean isConnected = false;
	ImageIcon startIcon;
	private ImageIcon stopIcon;
	private JLabel baslik;
	public JPanel listenPanel;
	public JLabel listenKnowledgeLabel;
	public static final String startText = "<html><br><br>Dinleyiciyi başlatmak "
			+ " için<br><br> başlat bütonuna basınız..</html> .";

	private void initVisualComponents() {
		c = getContentPane();
		c.setLayout(new FlowLayout());
		c.setSize(800, 700);
		setLayout(null);

		startIcon = new ImageIcon("res/start.gif");
		stopIcon = new ImageIcon("res/stop.gif");

		listenPanel = new JPanel();
		listenPanel.setLocation(700, 360);
		listenPanel.setSize(250, 250);
		listenPanel
				.setBorder(BorderFactory.createLineBorder(Color.darkGray, 3));

		listenPanel.setForeground(Color.red);
		listenPanel.setBackground(Color.LIGHT_GRAY);
		listenButton = new JButton("Başlat");

		listenButton.setSize(200, 20);
		listenPanel.add(new JLabel("  "));
		// listenPanel.add(listenButton);

		listenButton.setIcon(startIcon);
		listenButton.setIconTextGap(10);

		listenButton.addActionListener(this);

		listenKnowledgeLabel = new JLabel(startText);
		listenKnowledgeLabel.setForeground(Color.blue);
		listenPanel.add(listenKnowledgeLabel);
		// listenPanel.add(Box.createVerticalGlue());
		c.add(listenPanel);

		grid = new JTable();

		// refreshDatabase();

		refreshBut = new JButton("Hepsini Getir");
		c.add(refreshBut);
		refreshBut.setLocation(150, 300);
		refreshBut.setSize(150, 20);
		refreshBut.addActionListener(this);

		messageBut = new JButton("Kayıtları Sisteme Gönder");
		c.add(messageBut);
		messageBut.setLocation(350, 300);
		messageBut.setSize(180, 20);
		messageBut.addActionListener(this);

		exitButton = new JButton("Çıkış");
		c.add(exitButton);
		exitButton.setLocation(750, 630);
		exitButton.setSize(100, 20);
		exitButton.addActionListener(this);
		// exitButton.setBackground(buttonColor);

		baslik = new JLabel("MELSOFT PACS SİSTEMİ", JLabel.CENTER);
		// cal
		baslik.setFont(new Font("Serif", Font.BOLD, 24));
		baslik.setForeground(Color.BLUE);

		JPanel titlePanel = new JPanel();
		titlePanel.setBackground(Color.orange);
		titlePanel.add(baslik); // adds to center of panel's default
		// BorderLayout.
		titlePanel.setLocation(30, 5);
		titlePanel.setSize(800, 40);
		c.add(titlePanel);

		gelenHl7Label = new JLabel("Gelen HL7 Kodu");
		gelenHl7Label.setLocation(350, 341);
		gelenHl7Label.setSize(100, 20);
		c.add(gelenHl7Label);

		outputTextField = new JLabel("");
		outputTextField.setOpaque(true);
		outputTextField.setBackground(Color.white);
		outputTextField.setFont(new Font("Serif", Font.PLAIN, 12));
		JScrollPane outputTextFieldPane = new JScrollPane(outputTextField);
		outputTextFieldPane.setLocation(10, 360);
		outputTextFieldPane.setSize(300, 160);
		c.add(outputTextFieldPane);
		gidenHl7Label = new JLabel("<html>Giden HL7 Kodu</html>");
		gidenHl7Label.setLocation(10, 341);
		gidenHl7Label.setSize(100, 20);
		c.add(gidenHl7Label);

		gelenACKLabel = new JLabel("Gelen ACK ");
		gelenACKLabel.setLocation(10, 525);
		gelenACKLabel.setSize(100, 20);
		c.add(gelenACKLabel);

		gidenACKLabel = new JLabel("Gönderilen ACK ");
		gidenACKLabel.setLocation(350, 525);
		gidenACKLabel.setSize(100, 20);
		c.add(gidenACKLabel);

		lab1 = new JLabel("");
		lab1.setText(isAuto ? "OTOMATAİK MOD" : "MANUEL MOD");
		lab1.setLocation(50, 700);
		lab1.setSize(250, 20);
		c.add(lab1);

		inputTextField = new JLabel();

		inputTextField.setOpaque(true);
		inputTextField.setBackground(Color.white);
		inputTextField.setFont(new Font("Serif", Font.PLAIN, 12));

		JScrollPane inputTextFieldPane = new JScrollPane(inputTextField);
		inputTextFieldPane.setLocation(350, 360);
		inputTextFieldPane.setSize(300, 160);
		c.add(inputTextFieldPane);

		inputACKField = new JLabel();
		inputACKField.setOpaque(true);
		inputACKField.setBackground(Color.white);
		inputACKField.setFont(new Font("Serif", Font.PLAIN, 12));
		JScrollPane inputACKFieldPane = new JScrollPane(inputACKField);
		inputACKFieldPane.setLocation(10, 545);
		inputACKFieldPane.setSize(300, 100);
		c.add(inputACKFieldPane);

		outputACKField = new JLabel();
		outputACKField.setOpaque(true);
		outputACKField.setBackground(Color.white);
		outputACKField.setFont(new Font("Serif", Font.PLAIN, 12));
		JScrollPane outputACKFieldPane = new JScrollPane(outputACKField);
		outputACKFieldPane.setLocation(350, 545);
		outputACKFieldPane.setSize(300, 100);
		c.add(outputACKFieldPane);

		scrollPane = new JScrollPane();
		c.add(scrollPane);

		scrollPane.add(grid);

		sOptionPan = new SearchOptionPanel(c, this);
		sOptionPan.createAndShow(80, 50);
	}

	SearchOptionPanel sOptionPan;

	public void mouseEntered(MouseEvent arg0) {

	}

	public void mouseExited(MouseEvent arg0) {

	}

	public void mousePressed(MouseEvent arg0) {

	}

	public void mouseReleased(MouseEvent arg0) {

	}

}
