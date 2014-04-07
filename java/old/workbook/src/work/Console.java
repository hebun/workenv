package work;
import java.awt.Component;
import java.awt.event.WindowEvent;

import javax.swing.JScrollPane;


@SuppressWarnings("serial")
public class Console extends JScrollPane implements WorkbookListener {

	public Console(Component c){
		super(c);
	}
	@Override
	public boolean exiting(WindowEvent e) {
	
		return true;
	}

}
