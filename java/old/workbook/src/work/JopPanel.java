package work;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.BorderFactory;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;

import Xpack.XButton;
import Xpack.XFrame;

@SuppressWarnings("serial")
public class JopPanel extends JPanel implements ActionListener {

	public JopPanel children[];
	public int childCount;
	public JopPanel parent;
	int rank;
	String text;
	public JLabel labText;
	public XButton butAdd, butExp, butDel, butOk;
	public XFrame frame;
	public int totalChildCount = 2;
	public static final int height = 60;
	public static final int width = 550;
	public int w, h;
	private boolean expend = true;
	public static boolean isChanged = false;

	private boolean isOk = false;
	public String wake;

	public JopPanel(String text) {
		this.rank = 0;
		this.text = text;
		this.expend = false;
		this.setLayout(null);
		labText = new JLabel(text);

		this.add(labText);
		labText.setLocation(40, 10);
		labText.setSize(300, 20);

		butAdd = new XButton(this, frame, "+");

		butAdd.setSize(30, 20);
		butAdd.setBorder(null);
		this.add(butAdd);
		butAdd.addActionListener(this);

		butDel = new XButton(this, frame, "X");

		butDel.setSize(30, 20);
		butDel.setBorder(null);
		this.add(butDel);
		butDel.addActionListener(this);

		butOk = new XButton(this, frame, "Ok");

		butOk.setSize(30, 20);
		butOk.setBorder(null);
		this.add(butOk);
		butOk.addActionListener(this);

		butExp = new XButton(this, frame, "+");

		butExp.setSize(20, 20);
		butExp.setBorder(null);
		this.add(butExp);
		butExp.addActionListener(this);
		butExp.setLocation(4, 10);
		childCount = 0;

		children = new JopPanel[10];

		this.setBorder(BorderFactory.createLineBorder(Color.gray, 1));
	}

	public void addChild(JopPanel child) {
		this.children[this.childCount++] = child;
		this.add(child);
		child.setParent(this);

	}

	private void setSize(int call) {

		this.w = width - this.rank * 20;
		this.h = height * (this.totalChildCount);
		this.setSize(w, h - 4);
		this.setPreferredSize(new Dimension(w, h - 4));
		butAdd.setLocation(w - 80, 10);
		butDel.setLocation(w - 40, 10);
		butOk.setLocation(w - 120, 11);
		butOk.setBackground(isOk ? Color.GRAY : butDel.getBackground());
		this.setLocation(20, height * (call + 1));
		this.butExp.setVisible(this.childCount != 0 && this.rank != 0);
		butExp.setText(this.expend ? "-" : "+");
	}

	private void setParent(JopPanel jopPanel) {
		this.parent = jopPanel;
		this.rank = parent.rank + 1;

	}

	public int reMake(int call) {

		this.totalChildCount = 1;
		if (this.isExpend()) {

			int k = 0;
			for (int i = 0; i < childCount + 1; i++) {
				int deg = 1;
				if (i == childCount) {
					if (childCount <= 1) {
						break;
					}
					deg = 1;
				} else {

					deg = children[i].reMake(k);
				}
				k += deg;
				totalChildCount += deg;
			}
		}
		this.setSize(call);

		return totalChildCount;
	}

	public void dump() {
		String wrap = "";

		for (int j = 0; j < this.rank; j++) {
			wrap += " ";
		}

		System.out.println(wrap + this.text);
		for (int i = 0; i < childCount; i++) {
			children[i].dump();
		}
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == this.butAdd) {

			String newtext = JOptionPane.showInputDialog(this, "text?");
			if (newtext != null && !newtext.equals("")) {
				JopPanel jopPanel = new JopPanel(newtext);

				this.addChild(jopPanel);
				this.setExpend(true);
				getRoot().reMake(1);

				isChanged = true;
			}
		} else if (e.getSource() == this.butDel) {

			this.parent.removeChild(this);
			this.setExpend(true);
			getRoot().reMake(1);

			isChanged = true;
		} else if (e.getSource() == this.butOk) {

			setOk(!this.isOk);
			getRoot().reMake(1);

			isChanged = true;
		}

		else if (e.getSource() == this.butExp) {

			this.expend = !this.expend;

			butExp.setText(this.expend ? "-" : "+");

			getRoot().reMake(1);
              
		}

	}

	public void removeChild(JopPanel child) {

		for (int i = 0; i < childCount; i++) {

			JopPanel c = children[i];

			if (c == child) {
				children[i] = children[childCount - 1];
				children[childCount - 1] = null;
				childCount--;
				return;

			}

		}
	}

	private JopPanel getRoot() {
		JopPanel p = this;
		while (true) {
			if (p.rank == 0)
				return p;
			p = p.parent;
		}

	}

	public boolean isExpend() {
		return expend;
	}

	public void setExpend(boolean expend) {
		this.expend = expend;
	}

	public String getJson() {

		String json = "{ \"text\":\"" + this.text + "\",\"isOk\":\"" + isOk+"\"";
		if (this.rank == 0) {
			json += ",\"wake\":\""+this.wake+"\"";
		}
		json += ", \"children\":[";

		for (int i = 0; i < this.childCount; i++) {
			json += children[i].getJson() + ",";
		}
		if (childCount > 0)
			json = json.substring(0, json.length() - 1);
		json += "]}";
		return json;
	}

	public boolean isOk() {
		return isOk;
	}

	public void setOk(boolean isOk) {
		this.isOk = isOk;
	}

}
