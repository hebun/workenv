package work;
import java.awt.Color;
import java.awt.Dialog.ModalityType;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextPane;

@SuppressWarnings("serial")
public class DayCell extends JPanel implements MouseListener {
	JLabel label;
	String string,mtext;
	int doy;
	Schedule parent;

	public DayCell(Schedule schedule) {
		super();
		setLayout(null);
		parent = schedule;
		setBorder(BorderFactory.createLineBorder(Color.gray, 1));
		label = new JLabel();
		//label.setToolTipText("bla bla");
		label.setVerticalTextPosition(JLabel.TOP);
		label.setHorizontalTextPosition(JLabel.LEFT);
		label.setLocation(1,1);
		label.setSize(200, 100);
		label.setBorder(BorderFactory.createLineBorder(Color.gray, 1));
		add(label);
		addMouseListener(this);
	}

	public void setText(int doy, int day,int dow) {
		this.doy = doy;
		String string = parent.hashtable.get(doy);
		if (string == null) {
			label.setText("" + (day + 1));
			this.string = string;
			mtext=string;
		} else {
			this.string = string;
			mtext=string;
			String text = "<html><div style='font-size:x-small'><i>" + (day + 1) + "</i><br>"
					+ this.string.replace("\n", "<br>") +"</div></html>";
			label.setText(text);
			// System.out.println(text);
		}
	}

	private void openFile() {
		final JTextPane text = new JTextPane();
		text.setLocation(20, 40);
		text.setSize(400, 400);

		Console panel = new Console(text);
		panel.setPreferredSize(new Dimension(400, 400));
		panel.setVerticalScrollBarPolicy(JScrollPane.VERTICAL_SCROLLBAR_ALWAYS);
		panel.setSize(600, 500);
		panel.setLocation(20, 20);

		JDialog dialog = new JDialog();
		dialog.setLayout(new FlowLayout());
		dialog.add(panel);

		dialog.setModalityType(ModalityType.APPLICATION_MODAL);

		JButton button = new JButton("Save");
		button.addActionListener(new ActionListener() {

			public void actionPerformed(ActionEvent e) {
				parent.hashtable.put(doy, text.getText());
				parent.setDisplay(parent.currentm);
				parent.writeXml();
			}
		});
		dialog.add(button);
		dialog.pack();

		text.setText(string);
		dialog.setLocationRelativeTo(null);
		dialog.setVisible(true);
	}

	@Override
	public void mouseClicked(MouseEvent e) {
		// TODO Auto-generated method stub

	}

	@Override
	public void mousePressed(MouseEvent e) {
		openFile();

	}

	@Override
	public void mouseReleased(MouseEvent e) {
		// TODO Auto-generated method stub

	}

	@Override
	public void mouseEntered(MouseEvent e) {
		// TODO Auto-generated method stub

	}

	@Override
	public void mouseExited(MouseEvent e) {
		// TODO Auto-generated method stub

	}

	public void setText(String string2) {
		label.setText(string2);

	}

}
