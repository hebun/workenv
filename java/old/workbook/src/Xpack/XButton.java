package Xpack;

import java.awt.event.ActionListener;
import java.lang.reflect.InvocationTargetException;
import java.lang.reflect.Method;

import javax.swing.Action;
import javax.swing.Icon;
import javax.swing.JButton;
import javax.swing.JOptionPane;
import javax.swing.JPanel;

@SuppressWarnings("serial")
public class XButton extends JButton {

	public static int butCount = 0;
	public static XButton[] buts = new XButton[1000];
	public XFrame parent;
	public String action;

	public Method method;

	public XButton() {

	}

	public XButton(XFrame frame) {
		this(null, frame, "buton" + butCount);
	}

	public XButton(JPanel panel, XFrame frame) {

		this(panel, frame, "buton" + butCount+1);
	}

	public XButton(JPanel panel, XFrame frame, String text) {
		super(text);
		parent = frame;
		butCount++;
		buts[butCount] = this;

		
		if (panel == null) {
			//frame.getContentPane().add(this);
		} else {
			panel.add(this);
		}
		this.addActionListener((ActionListener) frame);
		setSize(100, 20);
		this.setText(text);
	}

	public void onClick(String methodName) {
		this.action = methodName;

	}

	public void click() {
		java.lang.reflect.Method method = null;
		try {
			method = parent.getClass().getMethod(this.action);

		} catch (SecurityException e) {
			System.out.println("XButton:" + e.getMessage());
			return;
			// ...
		} catch (NoSuchMethodException e) {
			System.out.println("XButton:" + e.getMessage());
			return;
			// ...
		} catch (NullPointerException e) {
			JOptionPane.showMessageDialog(this,
					"Action method is not implemented for " + this.getText());
			return;
		}
		try {
			method.invoke(parent);
		} catch (IllegalArgumentException e) {
			System.out.println("XButton:" + e.getMessage());
		} catch (IllegalAccessException e) {
			System.out.println("XButton:" + e.getMessage());
		} catch (InvocationTargetException e) {
			System.out.println("XButton:" + e.getMessage());
		}

	}

	public XButton(Icon icon) {
		super(icon);
	}

	public XButton(String text) {
		super(text);

	}

	public XButton(Action a) {
		super(a);

	}

	public XButton(String text, Icon icon) {
		super(text, icon);

	}

	public void setLoc(int i, int j) {
		this.setLocation(parent.table.getLoc(i, j));

	}

}
