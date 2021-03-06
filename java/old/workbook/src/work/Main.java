package work;
import java.awt.BorderLayout;
import java.awt.Component;
import java.awt.Dialog.ModalityType;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.OutputStream;
import java.io.PrintStream;
import java.io.Writer;
import java.util.ArrayList;
import java.util.Map;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JMenu;
import javax.swing.JMenuBar;
import javax.swing.JMenuItem;
import javax.swing.JOptionPane;
import javax.swing.JScrollPane;
import javax.swing.JSeparator;
import javax.swing.JTabbedPane;
import javax.swing.JTextPane;
import javax.swing.SwingUtilities;
import javax.swing.UIManager;
import javax.swing.UnsupportedLookAndFeelException;
import javax.swing.text.BadLocationException;
import javax.swing.text.Document;

public class Main extends JFrame implements ActionListener {

	private static final long serialVersionUID = 1L;
	ArrayList<WorkbookListener> tabs;
	JTabbedPane tab;
	JMenuBar bar;
	JMenu menu;
	JMenu item;

	public Main(String string) {
		super(string);
		tabs = new ArrayList<WorkbookListener>();
		tab = new JTabbedPane();
		add(tab, BorderLayout.CENTER);

		addWindowListener(new WindowAdapter() {

			public void windowClosing(WindowEvent e) {

				for (WorkbookListener w : tabs) {
					w.exiting(e);
				}
				System.exit(0);
			}

		});

		bar = new JMenuBar();
		// bar.add

		menu = new JMenu("Edit Datas");
		menu.setIcon(new ImageIcon("images/edit.png"));
		menu.add(new JSeparator(JSeparator.VERTICAL), BorderLayout.LINE_START);

		item = new JMenu();

		addFileMenu();

		item.setIcon(new ImageIcon("images/file.png"));
		item.add(new JSeparator(JSeparator.VERTICAL), BorderLayout.LINE_START);
		item.setText("Edit File Datas");
		item.addActionListener(this);
		menu.add(item);

		JMenu extMenu = new JMenu("Run External");

		bar.add(extMenu);

		JMenu savedMenu = new JMenu("Saved  Programs");

		try {
			BufferedReader in = new BufferedReader(new FileReader(
					"extprogs.json"));
			String str;
			while ((str = in.readLine()) != null) {
				final String strx = str;

				JMenuItem menuItem = new JMenuItem(strx.split(":=")[0]);
				extMenu.add(menuItem);
				menuItem.addActionListener(new ActionListener() {

					@Override
					public void actionPerformed(ActionEvent e) {
						SwingUtilities.invokeLater(new Runnable() {
							public void run() {

								try {

									ProcessBuilder pb = new ProcessBuilder(strx
											.split(":=")[1], "myArg");
									Map<String, String> env = pb.environment();
									env.put("VAR1", strx.split(":=")[1]);
									env.remove("OTHERVAR");
									env.put("VAR2", env.get("VAR1") + "suffix");
									pb.directory(new File(strx.split(":=")[1])
											.getParentFile());

									pb.start().waitFor();

								} catch (Exception err) {
									err.printStackTrace();
								}
							}
						});

					}
				});
			}
			in.close();
		} catch (IOException e1) {
			System.err.println(e1.getMessage());
		}

		extMenu.add(savedMenu);

		bar.add(menu);
		bar.add(extMenu);
		setJMenuBar(bar);

	}

	private void addFileMenu() {
		File dir = new File(".");

		String[] children = dir.list();
		if (children == null) {
			System.out.println("null.");
			;
		} else {
			for (int i = 0; i < children.length; i++) {

				String filename = children[i];
				File file = new File(filename);
				if (!filename.startsWith(".") && !file.isDirectory()) {
					JMenuItem menuItem = new JMenuItem(filename);
					menuItem.addActionListener(this);
					menuItem.setActionCommand(filename);

					item.add(menuItem);
				}
			}
		}

	}

	public void addTab(String tabName, Component c) {
	//	if (c.getClass() != TimePass.class)			return;
		tabs.add((WorkbookListener) c);
		tab.add(tabName, c);
	}

	/**
	 * 
	 */
	public static void redirectIo() {

		OutputStream out = new OutputStream() {
			@Override
			public void write(int b) throws IOException {
				updateTextArea(String.valueOf((char) b));
			}

			@Override
			public void write(byte[] b, int off, int len) throws IOException {
				updateTextArea(new String(b, off, len));
			}

			@Override
			public void write(byte[] b) throws IOException {
				write(b, 0, b.length);
			}
		};

		System.setOut(new PrintStream(out, true));
		System.setErr(new PrintStream(out, true));
	}

	private static void updateTextArea(final String textx) {
		SwingUtilities.invokeLater(new Runnable() {
			public void run() {
				Document doc = text.getDocument();
				try {
					doc.insertString(doc.getLength(), textx, null);
				} catch (BadLocationException e) {
					throw new RuntimeException(e);
				}
				text.setCaretPosition(doc.getLength() - 1);
			}
		});
	}

	public static JTextPane text;

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		try {
			UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (InstantiationException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IllegalAccessException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (UnsupportedLookAndFeelException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		Main frame = new Main("Workbook");
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

		frame.setSize(1000, 700);
		frame.setVisible(true);

		frame.setLocationRelativeTo(null);

		Workbook workbook = new Workbook("title");
		frame.addTab("Workbook", workbook);

		Graph graph = new Graph("Graph");
		frame.addTab("Graph", graph);

		Calcs calcs = new Calcs("Calculations");
		frame.addTab("Calcs", calcs);

		Dnfinder dnfinder = new Dnfinder("Name Finder");
		frame.addTab("dnfinder", dnfinder);

		text = new JTextPane();
		text.setLocation(20, 40);
		text.setSize(400, 400);

		Schedule schedule = new Schedule();

		frame.addTab("Schedule", schedule);

		TimePass pass = new TimePass();

		frame.addTab("timepass", pass);

		Console panel = new Console(text);
		panel.setPreferredSize(new Dimension(400, 400));
		panel.setVerticalScrollBarPolicy(JScrollPane.VERTICAL_SCROLLBAR_ALWAYS);
		panel.setSize(600, 500);
		panel.setLocation(20, 20);
		frame.addTab("console", panel);

		// frame.tab.setSelectedIndex(3);
		redirectIo();
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		System.out.println(e.getSource().getClass());

		if (e.getSource().getClass() == JMenuItem.class) {
			openFile(e.getActionCommand());
		}

		if (e.getSource() == item) {
			JOptionPane.showMessageDialog(this, "edit files clicked");

		}

	}

	private void openFile(final String actionCommand) {
		final JTextPane text = new JTextPane();
		text.setLocation(20, 40);
		text.setSize(400, 400);

		Console panel = new Console(text);
		panel.setPreferredSize(new Dimension(400, 400));
		panel.setVerticalScrollBarPolicy(JScrollPane.VERTICAL_SCROLLBAR_ALWAYS);
		panel.setSize(600, 500);
		panel.setLocation(20, 20);

		JDialog dialog = new JDialog(this);
		dialog.setLayout(new FlowLayout());
		dialog.add(panel);

		dialog.setModalityType(ModalityType.APPLICATION_MODAL);

		JButton button = new JButton("Save");
		button.addActionListener(new ActionListener() {

			public void actionPerformed(ActionEvent e) {

				try {
					Writer writer = new FileWriter(actionCommand);

					writer.write(text.getText());

					writer.close();

				} catch (IOException e1) {

				}

			}
		});
		dialog.add(button);
		dialog.pack();
		String templ = "";
		try {
			BufferedReader in = new BufferedReader(
					new FileReader(actionCommand));
			String str;
			while ((str = in.readLine()) != null) {
				templ += str + "\n";
			}
			in.close();
		} catch (IOException e1) {
			System.err.println(e1.getMessage());
		}

		text.setText(templ);
		dialog.setLocationRelativeTo(this);
		dialog.setVisible(true);
	}
}
