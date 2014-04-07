package work;
import java.awt.Container;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowEvent;
import java.io.BufferedInputStream;
import java.io.DataInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.net.MalformedURLException;
import java.net.URL;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextField;

import Xpack.XButton;
@SuppressWarnings("serial")
public class Calcs extends JPanel implements ActionListener,WorkbookListener {

	public int width, height;
	public JTextField total;
	public JTextField speed;
	// public JTextField textTable;
	public JButton butTable;
	public JButton butFon;
	public JLabel labFon;
	private Container container;
	public XButton button;
	public JComboBox<String> birim;

	public double ux30 = 0;
	private XButton button1;

	public Calcs(String title) {
		super();

		//this.setTitle(title);

		this.width = 800;
		height = 600;

		this.container = this;

		container.setLayout(new FlowLayout());
		container.setSize(300, 300);
		setLayout(null);
	
		total = new JTextField("");

		container.add(total);

		total.setSize(100, 20);
		total.setLocation(20, 20);

		speed = new JTextField("");

		container.add(speed);

		speed.setSize(100, 20);
		speed.setLocation(120, 20);

		birim = new JComboBox<String>();

		container.add(birim);

		birim.setSize(100, 20);
		birim.setLocation(20, 50);

		birim.addItem("MB");
		birim.addItem("GB");

		butTable = new JButton("but");
		container.add(butTable);
		butTable.setSize(100, 20);
		butTable.setLocation(240, 20);
		butTable.addActionListener(this);

		butFon = new JButton("get");
		container.add(butFon);
		butFon.setSize(100, 20);
		butFon.setLocation(240, 120);
		butFon.addActionListener(this);

		button = new XButton();
		button.setLocation(200, 200);
		button.onClick("butonclick");


		button1 = new XButton();
		button1.setLocation(300, 200);
		button1.onClick("butonclick1");

		labFon = new JLabel("sdfsdf");
		// labFon.set
		container.add(labFon);
		labFon.setSize(400, 420);
		labFon.setLocation(200, 120);

		this.setSize(this.width, height);

		setVisible(true);

	}

	public void butonclick() {
		JOptionPane.showMessageDialog(this, "here it works");
	}

	public static String capitalizeString(String string) {
		char[] chars = string.toLowerCase().toCharArray();
		boolean found = false;
		for (int i = 0; i < chars.length; i++) {
			if (!found && Character.isLetter(chars[i])) {
				chars[i] = Character.toUpperCase(chars[i]);
				found = true;
			} else if (Character.isWhitespace(chars[i]) || chars[i] == '.'
					|| chars[i] == '\'') { // You can add other chars here
				found = false;
			}
		}
		return String.valueOf(chars);
	}

	@SuppressWarnings("deprecation")
	@Override
	public void actionPerformed(ActionEvent e) {

		for (XButton but : XButton.buts) {
			if(e.getSource()==but){
				but.click();
			}
		}
		
		if (e.getSource() == butFon) {
			if (this.ux30 == 0) {
				URL url;
				InputStream is = null;
				DataInputStream dis;
				String line;
				String all = "";
				try {
					url = new URL(
							"http://report.paragaranti.com/ref018_frm2.asp?fname=GAE");
					is = url.openStream(); // throws an IOException
					dis = new DataInputStream(new BufferedInputStream(is));

					while ((line = dis.readLine()) != null) {
						all += line + "\n";
						// ;
					}
				} catch (MalformedURLException mue) {
					mue.printStackTrace();
				} catch (IOException ioe) {
					ioe.printStackTrace();
				} finally {
					try {
						is.close();
					} catch (IOException ioe) {
						// nothing to see here
					}
				}// System.out.println(all);

				all = all.split(" &nbsp;&nbsp;")[1].split("</td>")[0];

				all = all.replace(',', '.');

				this.ux30 = Double.parseDouble(all);
			}
			String text = "<html>";
			text += "Start:0.017913<br>Now=" + this.ux30 + "<br> Oran:"
					+ (this.ux30 / 0.0179113);
			text += "<br> Result:" + this.ux30 * 16010 + "</html>";
			labFon.setText(text);
		}

		if (e.getSource() == butTable) {

			double sn = (double) ((Double.parseDouble(total.getText()) * 1024) / Integer
					.parseInt(speed.getText()));

			if (birim.getSelectedIndex() == 1) {
				sn *= 1024;
			}

			int hour = (int) sn / (60 * 60);

			String.valueOf(hour);

			String res = hour + " saat ";

			int min = ((int) sn / 60) % (60);

			res += min + " dakika";
			;
			JOptionPane.showMessageDialog(this, res);

		}

	}

	@Override
	public boolean exiting(WindowEvent e) {
		
		return true;
	}

}
