package work;
import java.awt.Color;
import java.awt.event.WindowEvent;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.Reader;
import java.io.Writer;
import java.util.List;

import javax.swing.BorderFactory;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextField;
import javax.swing.ScrollPaneConstants;
import javax.swing.ScrollPaneLayout;

import Xpack.XButton;
import Xpack.XFrame;
import argo.jdom.JdomParser;
import argo.jdom.JsonNode;
import argo.jdom.JsonRootNode;
import argo.saj.InvalidSyntaxException;

public class Workbook extends XFrame implements WorkbookListener {

	private static final long serialVersionUID = 1L;

	XButton but;
	JopPanel root;

	@SuppressWarnings("unused")
	private JScrollPane scrollPane;
	public JPanel dayPanel;
	public JTextField field;
	public JLabel lab;

	public Workbook(String title) {
		super(title);

		init();
	
	}

	private void saveAndExit() {
		if (JopPanel.isChanged) {
			String json = root.getJson();

			try {
				Writer writer = new FileWriter("data.json");

				writer.write(json);

				writer.close();

			} catch (IOException e) {

			}
		}

	}

	public void butclick() {

	}

	private void init() {

		field = new JTextField();
		field.setLocation(10, 10);
		field.setSize(80, 20);
		lab = new JLabel("");
		lab.setSize(100, 100);
		lab.setLocation(10, 10);
		dayPanel = new JPanel();
		dayPanel.setLocation(630, 20);
		dayPanel.setSize(200, 140);
		dayPanel.setBorder(BorderFactory.createLineBorder(Color.gray, 1));

		dayPanel.setLayout(null);

		// dayPanel.add(field);

		this.getCont().add(dayPanel);

		/*
		 * but = new XButton(dayPanel, this, "Get"); but.setLocation(100, 10);
		 * but.setSize(60, 20); but.onClick("butclick");
		 */
		dayPanel.add(lab);

		JdomParser parser = new JdomParser();
		try {
			Reader reader = new FileReader("data.json");
			JsonRootNode node = parser.parse(reader);

			root = new JopPanel(node.getStringValue("text"));
			root.setExpend(true);

			String wake = node.getStringValue("wake");
			root.wake = wake;
			setDayly(wake);

			List<JsonNode> list = node.getArrayNode("children");

			for (JsonNode jsonNode : list) {

				JopPanel panel = new JopPanel(jsonNode.getStringValue("text"));

				panel.setOk(jsonNode.getStringValue("isOk").equals("true"));

				root.addChild(panel);

				List<JsonNode> l = jsonNode.getArrayNode("children");
				for (JsonNode je : l) {

					JopPanel panelx = new JopPanel(je.getStringValue("text"));

					panelx.setOk(je.getStringValue("isOk").equals("true"));
					panel.addChild(panelx);

					List<JsonNode> l1 = je.getArrayNode("children");
					for (JsonNode je1 : l1) {

						JopPanel panely = new JopPanel(
								je1.getStringValue("text"));

						panely.setOk(je1.getStringValue("isOk").equals("true"));
						panelx.addChild(panely);

						for (JsonNode jsonNode2 : je1.getArrayNode("children")) {
							JopPanel panelz = new JopPanel(
									jsonNode2.getStringValue("text"));

							panelz.setOk(jsonNode2.getStringValue("isOk")
									.equals("true"));
							panely.addChild(panelz);
						}

					}

				}
			}

		} catch (InvalidSyntaxException e) {
			System.out.println(e);
		} catch (FileNotFoundException e) {

			e.printStackTrace();
		} catch (IOException e) {

			e.printStackTrace();
		}

		root.reMake(1);

		int v = ScrollPaneConstants.VERTICAL_SCROLLBAR_ALWAYS;
		int h = ScrollPaneConstants.HORIZONTAL_SCROLLBAR_AS_NEEDED;

		JScrollPane pane = new JScrollPane(root, v, h);
		pane.setLayout(new ScrollPaneLayout());
		pane.setSize(600, 560);

		pane.setLocation(20, 20);

		this.getCont().add(pane);
		pane.validate();

	}

	/**
	 * @param wake
	 */
	public void setDayly(String wake) {

		int hour = Integer.parseInt(wake.split(":")[0]);
		int min = Integer.parseInt(wake.split(":")[1]);
		hour += 6;
		String labtext = "<html>second:" + formatTime(hour) + ":"
				+ formatTime(min);

		hour += 6;

		labtext += "<br><br>Third:" + formatTime(hour) + ":" + formatTime(min);

		hour += 4;

		labtext += "<br><br>fourth:" + formatTime(hour) + ":" + formatTime(min);
		labtext += "</html>";
		lab.setText(labtext);
	}

	public String formatTime(int i) {
		int k = i;
		k = k % 24;
		if (k < 10)
			return "0" + k;
		return "" + k;
	}

	@Override
	public boolean exiting(WindowEvent e) {
		saveAndExit();
		return false;
	}

}
