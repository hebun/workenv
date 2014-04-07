package org.nule.lighthl7lib.hl7;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintStream;
import java.net.ServerSocket;
import java.net.Socket;
import java.sql.SQLException;

import javax.swing.JOptionPane;

public class HL7Listen extends Thread {
	int port = 13020;
	private Test frame;
	ServerSocket serverSocket = null;
	Socket socket = null;

	public HL7Listen(Test frame) {
		super("listenThread");

		Options option = new Options("options.xml");
		this.port = option.getInPort();
		this.frame = frame;
	}

	BufferedReader rd = null;
	PrintStream writer;

	 private String createACK(String message, boolean ackOrNack) {
	
	 Hl7Record record = new Hl7Record(message);
	 Hl7Segment msh = record.get("MSH");
	 Hl7Field micdField = msh.field(10);
	 String mcid = micdField.toString();
	
	 String result = ackOrNack ? "AA" : "AE";
	
	 String time = String.valueOf(System.currentTimeMillis());
	 String ACK = MLLPMessage.B + "MSH|^~\\&|||MELSOFTcreate|HIS|" + time
	 + "||ACK|" + mcid + "|P|2.3" + MLLPMessage.D + "MSA|" + result
	 + "|" + MessageAsistant.getMcid(message, true) + MLLPMessage.D
	 + MLLPMessage._1C + MLLPMessage.D;
	
	 return ACK;
	 }

	public String connectText = "";

	String lastResult = "";

	public void run() {

		try {
			serverSocket = new ServerSocket(port);
		} catch (IOException e1) {
			frame.dialog = new AboutDialog(frame, "hata", port
					+ " portu başka bir uygulama tarafından kullanılıyor!");
			return;
		}

		connectText = "";
	//	System.out.println("serverSocket created!");
		frame.listenKnowledgeLabel.setText(connectText);
		try {
			socket = serverSocket.accept();
			connectText += "<font color=red>"
					+ socket.getPort()
					+ "</font>  portuna bağlantı sağlandı..<br><br> Dinleme aktif. </body></html>";
			frame.listenKnowledgeLabel.setText(connectText);
			System.out.println("Bağlantı sağlandı.\nClient portu:"
					+ socket.getPort() + "\n client adresi:"
					+ socket.getRemoteSocketAddress());
			rd = new BufferedReader(new InputStreamReader(socket
					.getInputStream()));

			writer = new PrintStream(socket.getOutputStream());
			while (true) {
				String message = "";
				while (true) {
					int get = 0;
					get = rd.read();

					char ch = (char) get;
					message += ch;
					if (ch == MLLPMessage._1C)
						break;
				}

				frame.inputTextField.setText(frame
						.formatMessageForShow(message));

				// frame.outputACKField.setText(frame.formatMessageForShow(ack));

				Hl7Record record = new Hl7Record(message);

				Hl7Segment mshSeg = record.get("MSH");

				Hl7Field messageType = mshSeg.field(9);

				String type = messageType.getComp(1).toString();
				String mcid = MessageAsistant.getMcid(message, false);

				if (messageType.getComp(1).toString().equals("ORM")) {
					Hl7Segment orcSegment = record.get("ORC");
					Hl7Field orderControl = orcSegment.field(1);
					if (orderControl.toString() == "SN") {
						lastResult = "SN";
					}
					 String ack = createACK(message, true);
					
					 writer.print(ack);
					 writer.flush();
					 frame.outputACKField.setText(frame
					 .formatMessageForShow(ack));
				} else if (messageType.getComp(1).toString().equals("ORU")) {
				
					 String ack = createACK(message, true);
					
					 writer.print(ack);
					 writer.flush();
					 frame.outputACKField.setText(frame
					 .formatMessageForShow(ack));
					Hl7Segment obrSeg = record.get("OBR");

					Hl7Field butkoduField = obrSeg.field(4);

					// String butkoduComp = butkoduField.getComp(1).toString();
					String butkodu = butkoduField.getComp(1).toString();

//					System.out.println("butkodu:" + butkodu);
//					System.out.println("\n charat2:" + butkodu.charAt(2));

					if (butkodu.charAt(2) != '.') {
						// String ack = createACK(message, false);
						//
						// writer.print(ack);
						// writer.flush();
						// frame.outputACKField.setText(frame
						// .formatMessageForShow(ack));
					//	continue;
					}
					try {
						jdbcTest1.insertDatabase("DONENBUTKODU", butkodu,
								"where MCID='" + mcid + "'");
					} catch (SQLException e) {
						JOptionPane.showMessageDialog(frame, "21:" + e.getMessage());
					}
//					System.out.println("lastResult:" + lastResult);
					Hl7Segment obxSegment = record.get("OBX");
					Hl7Field diagnoseText = obxSegment.field(5);

					jdbcTest1.insertDatabase("RAPOR", diagnoseText.toString(),
							"where MCID='" + mcid + "'");

				}
				// String ack = createACK(message, false);
				//
				// writer.print(ack);
				// writer.flush();
				// frame.outputACKField.setText(frame.formatMessageForShow(ack));

				jdbcTest1.insertDatabase("DONENHL7", message, " WHERE MCID='"
						+ mcid + "'");

			}
		} catch (IOException e) {
			JOptionPane.showMessageDialog(frame, "23:" + e.getMessage());
		} catch (SQLException e) {
			JOptionPane.showMessageDialog(frame, "24:" + e.getMessage());
		}
	}

	public boolean isOpen() {
		if (serverSocket == null) {
			return false;
		}

		if (serverSocket.isClosed())
			return false;
		if (socket == null)
			return false;

		return !socket.isClosed();

	}

	public void listenStop() {

	}
}
