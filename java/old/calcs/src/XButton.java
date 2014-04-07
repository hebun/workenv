
import java.awt.event.ActionListener;
import java.lang.reflect.InvocationTargetException;

import javax.swing.Action;
import javax.swing.Icon;
import javax.swing.JButton;
import javax.swing.JFrame;

@SuppressWarnings("serial")
public class XButton extends JButton {

	public static int butCount = 0;
	public static XButton[] buts = new XButton[10];
	public JFrame parent;
	public String action;

	public XButton() {

	}

	public XButton(JFrame frame) {
		parent = frame;
		buts[butCount] = this;

		butCount++;
		frame.getContentPane().add(this);
		this.addActionListener((ActionListener) frame);
		setSize(100, 20);
		this.setText("buton" + butCount);
	}

	public void onClick(String methodName) {
		this.action = methodName;

	}

	public void click() {
		java.lang.reflect.Method method = null;
		try {
			method = parent.getClass().getMethod(this.action);

		} catch (SecurityException e) {
			System.out.println("XButton:"+e.getMessage());
			// ...
		} catch (NoSuchMethodException e) {
			System.out.println("XButton:"+e.getMessage());
			// ...
		}
		try {
			method.invoke(parent);
		} catch (IllegalArgumentException e) {
			System.out.println("XButton:"+e.getMessage());
		} catch (IllegalAccessException e) {
			System.out.println("XButton:"+e.getMessage());
		} catch (InvocationTargetException e) {
			System.out.println("XButton:"+e.getMessage());
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

}
