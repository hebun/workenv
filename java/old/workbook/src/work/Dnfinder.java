package work;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowEvent;

import javax.swing.JButton;
import javax.swing.JPanel;
import javax.swing.JTextField;

@SuppressWarnings("serial")
public class Dnfinder extends JPanel implements WorkbookListener,
		ActionListener {

	JTextField field;
	JButton button;
	String all = "abcdefghijklmnoprusqwxyz";
	String sesli = "iaeuo";
	String sessiz = "bcdfghjklmnprsqwxyz";

	public Dnfinder(String title) {
		super();
		setLayout(new FlowLayout());
		setSize(300, 300);
		setLayout(null);
		field = new JTextField();
		field.setSize(100, 20);
		field.setLocation(20, 20);
		field.setText("tra*ian*");
		this.add(field);
		button = new JButton("run");
		button.setSize(100, 20);

		button.setLocation(140, 20);
		button.addActionListener(this);
		this.add(button);

	}

	@Override
	public boolean exiting(WindowEvent e) {
		// TODO Auto-generated method stub
		return true;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == button) {

			String inp = field.getText();
			findword(inp);

		}

	}

	/**
	 * @param inp
	 */
	public void findword(String inp) {
		String word = "";
		int k = 0;
		for (char ch : inp.toCharArray()) {
			if (ch == '*') {
				String word1 = "";
				for (char ch1 : all.toCharArray()) {
					word1 = word + ch1;
					word1 += inp.substring(k + 1, inp.length());
					System.out.println(word1);
					findword(word1);
				}
			} else if (ch == '-') {
				String word2 = "";
				for (char ch1 : sesli.toCharArray()) {
					word2 = word + ch1;
					word2 += inp.substring(k + 1, inp.length());
					System.out.println(word2);
					findword(word2);
				}
			} else if (ch == '?') {
				String word3 = "";
				for (char ch1 : sessiz.toCharArray()) {
					word3 = word + ch1;
					word3 += inp.substring(k + 1, inp.length());
					System.out.println(word3);
					findword(word3);
				}
			} else {
				word += ch;
			}
			k++;
		}
	}

}
