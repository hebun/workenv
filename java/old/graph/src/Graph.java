import java.awt.Container;
import java.awt.FlowLayout;
import java.awt.Graphics;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.util.Calendar;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextField;

@SuppressWarnings("serial")
public class Graph extends JFrame implements ActionListener {
	public int width, height;
	public JTextField textTable;
	public JButton butTable;
	public JButton butMode;
	private Container container;
	private PaintArea paintArea;

	public Graph(String title) {
		super();

		this.setTitle(title);

		this.width = 800;
		height = 600;

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

		initComps();

		this.setSize(this.width, height);

		setVisible(true);
		setLocationRelativeTo(null);

	}

	public void paintComponent(Graphics g) {
		g.drawLine(10, 10, 100, 100);

	}

	private void initComps() {

		paintArea = new PaintArea();

		paintArea.setLocation(10, 100);

		paintArea.setSize(700, 500);

		container.add(paintArea);

		butMode = new JButton("Change");

		butMode.setSize(100, 20);

		butMode.setLocation(600, 20);
		butMode.addActionListener(this);
		container.add(butMode);

		JLabel label = new JLabel("Selected Date:");
		final JTextField text = new JTextField(20);
		// text.setLocation(20,20);
		JButton b = new JButton("popup");
		// b.setLocation(200,200);
		JPanel p = new JPanel();

		p.add(label);
		p.add(text);
		p.add(b);

		p.setLocation(10, 10);
		p.setSize(300, 100);
		container.add(p);
		final JFrame fr = this;
		b.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent ae) {
				DatePicker datePicker = new DatePicker(fr);
				text.setText(datePicker.setPickedDate());

				Calendar cal = Calendar.getInstance();

				int i = cal.get(Calendar.DAY_OF_YEAR);
				int fark = datePicker.getDayOfYear()
						- i;
				System.out.println(i);
				paintArea.payForDay(fark);

			}
		});
	}

	public static void main(String args[]) {
		@SuppressWarnings("unused")
		Graph f = new Graph("hello");

	}

	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == butMode) {
			String str = JOptionPane.showInputDialog(this, "input");
			paintArea.changeMode(Integer.parseInt(str));

		}
	}

}
