import java.awt.Container;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.awt.event.WindowListener;
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.Collection;
import java.util.Enumeration;
import java.util.Hashtable;
import java.util.Iterator;
import java.util.Map;
import java.util.Set;
import java.util.regex.Matcher;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JTextField;

@SuppressWarnings("serial")
public class Frame extends JFrame implements ActionListener {

	public int width, height;
	public JTextField textTable;
	public JButton butTable;
	private Container container;

	public Frame(String title) {
		super();

		this.setTitle(title);

		this.width = 400;
		height = 400;

		this.container = this.getContentPane();

		container.setLayout(new FlowLayout());
		container.setSize(300, 300);
		setLayout(null);
		this.addWindowListener(new WindowAdapter() {
			public void windowClosing(WindowEvent e) {
				System.exit(0);
			}

		});
		setDefaultCloseOperation(DISPOSE_ON_CLOSE);
		textTable = new JTextField("pages");

		container.add(textTable);

		textTable.setSize(100, 20);
		textTable.setLocation(20, 20);

		butTable = new JButton("but");
		container.add(butTable);
		butTable.setSize(100, 20);
		butTable.setLocation(140, 20);
		butTable.addActionListener(this);
		this.setSize(this.width, height);

		setVisible(true);
		setLocationRelativeTo(null);
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
		if (e.getSource() == butTable) {
			String templ = "";
			try {
				BufferedReader in = new BufferedReader(new FileReader(
						"template"));
				String str;
				while ((str = in.readLine()) != null) {
					templ += str + "\n";
				}
				in.close();
			} catch (IOException e1) {
				System.err.println(e1.getMessage());
			}

			templ = templ.replaceAll("#classname#", capitalizeString(textTable
					.getText().substring(0, textTable.getText().length() - 1)));

			templ = templ.replaceAll("#tablename#", textTable.getText());

			Hashtable<String, String> hash = Main.select(textTable.getText());
			Set set = hash.entrySet();
			Iterator it = set.iterator();

			String fields = "",sets="";

			while (it.hasNext()) {
				Map.Entry entry = (Map.Entry) it.next();
				fields += "public $" + entry.getKey() + ";\n\t";
			
				sets += "$this->" + entry.getKey() + "=$row[\""+entry.getKey()+"\"];\n\t\t";
			}
			templ=templ.replaceAll("#fields#",Matcher.quoteReplacement(fields));
			templ=templ.replaceAll("#sets#",Matcher.quoteReplacement(sets));
			System.out.println(templ);
		}

	}

}
