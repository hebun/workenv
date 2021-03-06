package work;

import java.awt.Container;
import java.awt.FlowLayout;
import java.awt.Graphics;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowEvent;
import java.util.Calendar;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextField;

import Xpack.XButton;

@SuppressWarnings("serial")
public class Graph extends JPanel implements ActionListener, WorkbookListener {
	public int width, height;
	public JTextField textTable;
	public JButton butTable;
	public JLabel results;
	public JButton butMode;
	private Container container;
	private PaintArea paintArea;

	public Graph(String title) {
		super();

		// this.setTitle(title);

		this.width = 800;
		height = 600;

		this.container = this;

		container.setLayout(new FlowLayout());
		// container.setSize(300, 300);
		setLayout(null);

		// setDefaultCloseOperation(DISPOSE_ON_CLOSE);

		// initComps();

		this.setSize(this.width, height);

		setVisible(true);

		initComps();
		// container.add(chart);
		// setLocationRelativeTo(null);

	}

	public void paintComponent(Graphics g) {
		// g.drawLine(10, 10, 100, 100);

	}

	private void initComps() {

		paintArea = new PaintArea();

		paintArea.setLocation(10, 100);

		paintArea.setSize(800, 500);

		container.add(paintArea);

		butMode = new JButton("Change");

		butMode.setSize(100, 20);

		butMode.setLocation(400, 10);
		butMode.addActionListener(this);
		container.add(butMode);

		XButton button = new XButton(this, null, "Reload");
		button.addActionListener(new ActionListener() {

			@Override
			public void actionPerformed(ActionEvent e) {

				paintArea.load();
				setLastDate();
			}
		});
		button.setLocation(550, 10);
		JLabel label = new JLabel("Selected Date:");
		final JTextField text = new JTextField(20);
		// text.setLocation(20,20);
		JButton b = new JButton("popup");
		b.setLocation(300, 20);
		JPanel p = new JPanel();

		p.add(label);
		p.add(text);
		p.add(b);

		p.setLocation(10, 10);
		p.setSize(300, 20);
		p.setLayout(new GridLayout(1, 3));
		container.add(p);

		results = new JLabel("");

		String text2 = setLastDate();
		System.out.println(text2);
		results.setLocation(20, 40);
		results.setSize(400, 40);
		container.add(results);


		final JFrame fr = (JFrame) this.getParent();
		b.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent ae) {
				DatePicker datePicker = new DatePicker(fr);
				text.setText(datePicker.setPickedDate());

				Calendar cal = Calendar.getInstance();

				int i = cal.get(Calendar.DAY_OF_YEAR);
				int fark = datePicker.getDayOfYear() - i;
				System.out.println(i);
				paintArea.payForDay(fark);

			}
		});
	}

	private String setLastDate() {
		int reqDays = (int) ((700 - paintArea.getLast()) / paintArea.getSpeed());
		Calendar cal = Calendar.getInstance();
		cal.add(Calendar.DATE, reqDays);
		java.text.SimpleDateFormat sdf = new java.text.SimpleDateFormat(
				"dd-MM-yyyy");
		String text2 = "Last day: " + sdf.format(cal.getTime());
		results.setText(text2);
		return text2;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == butMode) {
			String str = JOptionPane.showInputDialog(this, "input");
			paintArea.changeMode(Integer.parseInt(str));

		}
	}

	@Override
	public boolean exiting(WindowEvent e) {

		return true;
	}

}
