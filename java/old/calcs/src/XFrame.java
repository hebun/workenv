import java.awt.Container;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;

import javax.swing.JFrame;
import javax.swing.JTextField;

public class XFrame extends JFrame implements ActionListener {

	
	private static final long serialVersionUID = 1L;
	public int width, height;
	public JTextField textTable;
	public XButton butTable;
	private Container container;

	public XFrame(String title) {
		super();

		this.setTitle(title);

		this.width = 400;
		height = 400;

		this.container = this.getContentPane();

		container.setLayout(new FlowLayout());
		container.setSize(this.width, this.height);
		setLayout(null);
		this.addWindowListener(new WindowAdapter() {
			public void windowClosing(WindowEvent e) {
				System.exit(0);
			}

		});
		setDefaultCloseOperation(DISPOSE_ON_CLOSE);
		textTable = new JTextField("");

		container.add(textTable);

		textTable.setSize(100, 20);
		textTable.setLocation(20, 20);

		butTable = new XButton(this);
		butTable.setLocation(140, 20);
		butTable.onClick("butonclick");
		
		this.setSize(this.width, height);

		setVisible(true);
		setLocationRelativeTo(null);
	}

	public void butonclick() {
		System.out.println("buton click");
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

	@Override
	public void actionPerformed(ActionEvent e) {

		for (XButton but : XButton.buts) {
			if (e.getSource() == but) {
				but.click();
			}
		}
	}

}
