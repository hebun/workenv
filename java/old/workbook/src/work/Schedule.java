package work;
import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.FlowLayout;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowEvent;
import java.io.FileWriter;
import java.io.IOException;
import java.io.Writer;
import java.util.Calendar;
import java.util.Hashtable;
import java.util.Iterator;
import java.util.Map;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JPanel;

import org.dom4j.Document;
import org.dom4j.DocumentException;
import org.dom4j.Element;
import org.dom4j.io.SAXReader;

@SuppressWarnings("serial")
public class Schedule extends JPanel implements WorkbookListener {
	private int height;
	private int width;
	public DayCell cell[] = new DayCell[42];

	public Hashtable<Integer, String> hashtable = new Hashtable<Integer, String>();

public String weekTable[] =new String[7];
	
	
	public Schedule() {
		super();

		weekTable[0]="pzers";
		weekTable[1]="sadf";
		weekTable[3]="pzsdfers";
		weekTable[4]="pzdfers";
		weekTable[5]="pzcxvers";
		weekTable[6]="pzcvcvers";
		
		width = 800;
		height = 600;

		setLayout(new BorderLayout(0, 0));
		setSize(300, 300);
		this.setSize(this.width, height);

		setVisible(true);
		for (int i = 0; i < 42; i++) {

			cell[i] = new DayCell(this);
		}
		initComps();

	}

	public void writeXml() {
		String text = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><root>";
		for (Map.Entry<Integer, String> entry : hashtable.entrySet()) {

			int key = entry.getKey();
			String value = entry.getValue();

			text += "<day no=\"" + key + "\">" + value + "</day>";

		}
		text += "</root>";
		try {
			Writer writer = new FileWriter("schedule.xml");

			writer.write(text);

			writer.close();

		} catch (IOException e1) {

		}
	}

	private void initComps() {

		try {
			bar(parse("schedule.xml"));
		} catch (DocumentException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		// loadXml();
		for (int ele : hashtable.keySet()) {
			//System.out.println("-" + ele);
		}
		currentm = Calendar.getInstance().get(Calendar.MONTH);
		monthl = new JLabel("");
		initCal(currentm);

		JButton button = new JButton("Next");
		button.addActionListener(new ActionListener() {

			@Override
			public void actionPerformed(ActionEvent e) {

				setDisplay(++currentm);

			}
		});

		JButton priv = new JButton("Priv");
		priv.addActionListener(new ActionListener() {

			@Override
			public void actionPerformed(ActionEvent e) {

				setDisplay(--currentm);

			}
		});

		JPanel north = new JPanel();

		north.setLayout(new FlowLayout());
		north.add(priv);

		north.add(monthl);
		north.add(button);

		add(north, BorderLayout.PAGE_START);

	}

	@SuppressWarnings({ "rawtypes" })
	public void bar(Document document) throws DocumentException {

		Element root = document.getRootElement();

		// iterate through child elements of root with element name "day"
		for (Iterator i = root.elementIterator("day"); i.hasNext();) {
			Element foo = (Element) i.next();

			hashtable.put(Integer.parseInt(foo.attribute("no").getText()),
					foo.getText());
			// System.out.println();
		}
	
		
	}

	public Document parse(String url) throws DocumentException {
		SAXReader reader = new SAXReader();
		Document document = reader.read(url);
		return document;
	}

	public int currentm;
	private JLabel monthl;

	/**
	 * 
	 */
	public void initCal(int month) {

		JPanel calendar = new JPanel();

		calendar.setLayout(new BorderLayout());
		JPanel north = new JPanel();

		north.setLayout(new GridLayout(1, 7, 10, 10));
		String[] header = { "Mon", "Tue", "Wed", "Thur", "Fri", "Sat", "Sun" };
		for (int i = 0; i < 7; i++) {
			north.add(new JLabel(header[i], 0));
		}

		calendar.add(north, BorderLayout.PAGE_START);

		JPanel sch = new JPanel();

		sch.setLayout(new GridLayout(6, 7, 10, 10));

		sch.setBorder(BorderFactory.createLineBorder(Color.gray, 1));

		for (int i = 0; i < 42; i++) {

			sch.add(cell[i]);
		}
		calendar.add(sch, BorderLayout.CENTER);

		add(calendar, BorderLayout.CENTER);
		setDisplay(month);
	}

	public void setDisplay(int month) {

		java.util.Calendar cal = java.util.Calendar.getInstance();
		int dom = cal.get(Calendar.DAY_OF_MONTH);
		int thism=cal.get(Calendar.MONTH);
		cal.set(cal.get(Calendar.YEAR), month, 1);

		int dayOfYear = cal.get(java.util.Calendar.DAY_OF_YEAR);

		int dayOfWeek = cal.get(Calendar.DAY_OF_WEEK);

		int daysInMonth = cal.getActualMaximum(java.util.Calendar.DAY_OF_MONTH);
		dayOfWeek = (dayOfWeek + 5) % 7;
		
		for (int i = 0; i < 42; i++) {
			cell[i].setText("");
			int j = i - dayOfWeek;
			if (i >= dayOfWeek && j < daysInMonth) {
				int doy = dayOfYear + j;
				cell[i].setText(doy, j,i%7);
				if(j==dom-1&&month==thism){
					cell[i].setBorder(BorderFactory.createLineBorder(Color.red,1));
				}else{
					cell[i].setBorder(BorderFactory.createLineBorder(Color.GRAY,1));
				}
			}
		}
		java.text.SimpleDateFormat sdf = new java.text.SimpleDateFormat(
				"MMMM yyyy");
		monthl.setText(sdf.format(cal.getTime()));
	}

	@Override
	public boolean exiting(WindowEvent e) {
		// TODO Auto-generated method stub
		return true;
	}
}
