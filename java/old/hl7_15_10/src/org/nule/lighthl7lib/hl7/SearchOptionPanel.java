package org.nule.lighthl7lib.hl7;

import java.awt.Container;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;

import javax.swing.JButton;
import javax.swing.JCheckBox;
import javax.swing.JLabel;
import javax.swing.JTextArea;
import javax.swing.JTextField;

@SuppressWarnings("serial")
public class SearchOptionPanel implements ActionListener
{
	Test frame;
	Container parent;

	SearchOptionPanel(Container container, Test frame)
	{
		parent = container;
		this.frame = frame;
	}

	// JCalendarCombo calendar1 = new
	// JCalendarCombo(JCalendarCombo.DISPLAY_DATE,
	// true);

	int posX;
	int posY;

	public void createAndShow(int x, int y)
	{
		this.posX = x;
		this.posY = y;

		// JLabel startDateLabel = new JLabel("ba�lang��:");
		// startDateLabel.setLocation(this.posX + 10, this.posY + 5);
		// startDateLabel.setSize(100,20);
		// parent.add(startDateLabel);

		// MyDateListener listener = new MyDateListener();

		// calendar1.setDateFormat(new SimpleDateFormat("dd.MM.yyyy"));
		// calendar1.addDateListener(listener);
		//
		// // Set fonts rather than using defaults
		//
		// calendar1.setFont(new Font("DialogInput", Font.PLAIN, 16));
		//
		// calendar1.setTitleFont(new Font("Serif", Font.BOLD | Font.ITALIC,
		// 24));
		// calendar1.setDayOfWeekFont(new Font("SansSerif", Font.PLAIN, 12));
		// calendar1.setDayFont(new Font("SansSerif", Font.BOLD, 12));
		// calendar1.setTimeFont(new Font("DialogInput", Font.PLAIN, 12));
		// calendar1.setTodayFont(new Font("Dialog", Font.PLAIN, 12));
		// calendar1.setEnabled(false);
		// calendar2.setDateFormat(new SimpleDateFormat("dd.MM.yyyy"));
		// calendar2.addDateListener(listener);
		// calendar2.setFont(new Font("DialogInput", Font.PLAIN, 16));
		// calendar2.setTitleFont(new Font("Serif", Font.BOLD | Font.ITALIC,
		// 24));
		// calendar2.setDayOfWeekFont(new Font("SansSerif", Font.PLAIN, 12));
		// calendar2.setDayFont(new Font("SansSerif", Font.BOLD, 12));
		// calendar2.setTimeFont(new Font("DialogInput", Font.PLAIN, 12));
		// calendar2.setTodayFont(new Font("Dialog", Font.PLAIN, 12));

		tarihText = new JTextArea();
		tarihText.setSize(120, 20);
		tarihText.setLocation(posX + 50, posY + 10);

		setTarihText();

		// JPanel searchOptionPanel = new JPanel();
		// // searchOptionPanel.add(startDateLabel);
		// // searchOptionPanel.add(calendar1);
		// // searchOptionPanel.add(calendar2);
		// searchOptionPanel.setLocation(this.posX + 60, posY);
		// searchOptionPanel.setSize(160, 40);
		// parent.add(searchOptionPanel);

		JLabel pnoLabel = new JLabel("SIRA:");
		pnoLabel.setLocation(posX + 240, posY + 10);
		pnoLabel.setSize(60, 20);
		parent.add(pnoLabel);
		
		JLabel siraLabel = new JLabel("PNO:");
		siraLabel.setLocation(posX + 400, posY + 10);
		siraLabel.setSize(60, 20);
		parent.add(siraLabel);

		JLabel tarihLabel = new JLabel("Tarih:");
		tarihLabel.setSize(100, 20);
		tarihLabel.setLocation(posX, posY + 10);
		parent.add(tarihLabel);

		pnoTextField = new JTextField();
		pnoTextField.setSize(60, 20);
		pnoTextField.setLocation(posX + 300, posY + 10);
		parent.add(pnoTextField);
		
		siraTextField = new JTextField();
		siraTextField.setSize(60, 20);
		siraTextField.setLocation(posX + 450, posY + 10);
		parent.add(siraTextField);

		
		
		
		searchBut = new JButton("Ara");
		searchBut.setLocation(posX + 600, posY + 5);
		searchBut.setSize(80, 25);
		searchBut.addActionListener(this);
		parent.add(searchBut);

		// tarihCheck = new JCheckBox();
		// tarihCheck.setLocation(posX + 40, posY + 5);
		// tarihCheck.setSize(30, 30);
		// tarihCheck.addActionListener(this);
		// parent.add(tarihCheck);

	}

	public void setTarihText() {
		DateFormat format = new SimpleDateFormat("dd.MM.yyyy");

		tarihText.setText(format.format(new Date()));
		parent.add(tarihText);
	}

	JTextField pnoTextField;
	JTextField siraTextField;
	JButton searchBut;
	JCheckBox tarihCheck;

	// date validation using SimpleDateFormat
	// it will take a string and make sure it's in the proper
	// format as defined by you, and it will also make sure that
	// it's a legal date

	public boolean isValidDate(String date)
	{

		SimpleDateFormat sdf = new SimpleDateFormat("dd.MM.yyyy");

		Date testDate = null;

	
		try
		{
			testDate = sdf.parse(date);
		} catch (ParseException e)
		{

			return false;
		}

		

		if (!sdf.format(testDate).equals(date))
		{

			return false;
		}


		return true;

	} // end isValidDate

	public void actionPerformed(ActionEvent e)
	{
		// System.out.println(e.getSource());
		if (e.getSource() == searchBut)
		{
			frame.refreshDatabase(true);
			frame.isSendOptional = true;
		}
		if (e.getSource() == tarihCheck)
		{
			// calendar1.setEnabled((calendarEnabled = !calendarEnabled));
		}
	}

	JTextArea tarihText;
	boolean calendarEnabled = false;

	public boolean getTarihChecked()
	{
		return !this.tarihText.getText().equals("");
	}

	private static final boolean isNumeric(final String s)
	{
		for (int x = 0; x < s.length(); x++)
		{
			final char c = s.charAt(x);
			if (x == 0 && (c == '-'))
				continue; // negative
			if ((c >= '0') && (c <= '9'))
				continue; // 0 - 9
			return false; // invalid
		}
		return true; // valid
	}

	public String getTarih()
	{

		return this.tarihText.getText();
	}

	public boolean isValidTarih()
	{
		return this.isValidDate(this.tarihText.getText());
	}

	public String getPno()
	{

		if (isNumeric(siraTextField.getText()))
		{
			return this.siraTextField.getText();

		} else
			return "";

	}
	public String getSira()
	{

		if (isNumeric(pnoTextField.getText()))
		{
			return this.pnoTextField.getText();

		} else
			return "";

	}
}
