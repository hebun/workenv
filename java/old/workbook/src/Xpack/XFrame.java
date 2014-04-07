package Xpack;

import java.awt.Container;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JPanel;
import javax.swing.JTextField;

public class XFrame extends JPanel implements ActionListener {

	private static final long serialVersionUID = 1L;
	public int width, height;
	public JTextField textTable;
	public XButton butTable;
	private Container container;

	public VTable table;

	public Container getCont() {
		return container;
	}

	public XFrame(String title) {
		super();

		//this.setTitle(title);

		this.width = 860;
		height = 600;

		this.container = this;

		container.setLayout(new FlowLayout());
		container.setSize(this.width, this.height);
		setLayout(null);
		
		//setDefaultCloseOperation(DISPOSE_ON_CLOSE);
		textTable = new JTextField("");

		container.add(textTable);

		this.setSize(this.width, height);

		setVisible(true);
	//	setLocationRelativeTo(null);

		table = new VTable(10, 10, this.width - 20, this.height - 20);

	}


	@Override
	public void actionPerformed(ActionEvent e) {

		for (XButton but : XButton.buts) {
			if (e.getSource() == but) {
				but.click();
			}
		}
	}

	public void eraseTable() {

		table.isDraw = false;
	}

	public void drawTable() {

		table.draw();

		container.add(table);

	}

}
