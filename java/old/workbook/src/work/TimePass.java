package work;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowEvent;
import java.util.Calendar;
import java.util.GregorianCalendar;
import java.util.Timer;
import java.util.TimerTask;

import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JPanel;
public class TimePass extends JPanel implements WorkbookListener,
		ActionListener {

	private static final long serialVersionUID = 3992217048186698165L;
	private JLabel label;
	private JButton button;

	public <T> TimePass() {
		super();

		setSize(300, 300);
		setLayout(null);
		label = new JLabel("blblblal");
		label.setLocation(20, 20);
		label.setSize(500, 20);
		this.add(label);

		button = new JButton("Refresh");
		button.addActionListener(new ActionListener() {

			@Override
			public void actionPerformed(ActionEvent e) {
				refresh();

			}
		});
		this.add(button);
		button.setLocation(520, 20);
		button.setSize(100, 20);
		
		Timer timer=new Timer();
		
		timer.schedule(new TimerTask() {
			
			@Override
			public void run() {
				refresh();
				
			}
		}, 1000,1000);
		
		refresh();
	}

	private String getDiff(long diff) {
		long diffSeconds = diff / 1000 % 60;
		long diffMinutes = diff / (60 * 1000) % 60;
		long l = diff / (60 * 60 * 1000);
		long diffHours = l % 24;
		long diffDays = diff / (24 * 60 * 60 * 1000);
		String ret = "";
		ret += diffDays > 0 ? diffDays + " day(s) " : "";
		ret += diffHours > 0 ? diffHours + " hour(s) " : "";
		ret += diffMinutes > 0 ? diffMinutes + " minute(s) " : "";

		ret += diffSeconds > 0 ? diffSeconds + " second(s) " : "";

		ret += l > 0 ? ". " + l + " hours in total" : "";
		return ret;
	}

	public String getText() {
		return label.getText();
	}

	@Override
	public void actionPerformed(ActionEvent e) {

	}

	@Override
	public boolean exiting(WindowEvent e) {

		return false;
	}

	public void refresh() {
		Calendar calendar = new GregorianCalendar(2014, 2, 25, 12, 0, 0);

		long diff = Calendar.getInstance().getTimeInMillis()
				- calendar.getTimeInMillis();

		label.setText(getDiff(diff));

	}

}
