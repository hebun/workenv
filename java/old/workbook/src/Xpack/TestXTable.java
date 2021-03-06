package Xpack;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.Hashtable;
import java.util.List;

import javax.swing.JButton;
import javax.swing.JFrame;

import org.junit.After;
import org.junit.AfterClass;
import org.junit.Before;
import org.junit.BeforeClass;
import org.junit.Test;

public class TestXTable {

	@BeforeClass
	public static void setUpBeforeClass() throws Exception {
	}

	@AfterClass
	public static void tearDownAfterClass() throws Exception {
	}

	@Before
	public void setUp() throws Exception {
	}

	@After
	public void tearDown() throws Exception {
	}

	@Test
	public void testXTable() throws InterruptedException {
		JFrame frame = new JFrame();
		final XTable table = new XTable();

		List<Hashtable<String, String>> data = Jdbc
				.select("select homeTeam,awayTeam,ht,at,draw,tarih from betfairView");
		table.setData(data);

		;

		frame.setLayout(null);
		JButton but = new JButton("blblbla");
		but.setLocation(300, 500);
		but.setSize(100, 20);

		but.addActionListener(new ActionListener() {

			@Override
			public void actionPerformed(ActionEvent e) {

				table.setData(Jdbc
						.select("select homeTeam,awayTeam,ht,at,draw,tarih from betfairView limit 5"));
			}
		});

		frame.getContentPane().add(table);
		frame.getContentPane().add(but);
		// frame.pack();
		frame.setLocationRelativeTo(null);
		frame.setVisible(true);
		frame.setSize(600, 600);


		// frame.repaint();
		Thread.sleep(6000);
	}


}
