package Xpack;

import java.awt.Graphics;
import java.awt.Point;

import javax.swing.JPanel;

public class VTable extends JPanel {
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;

	int x, y, width, height;

	int cellCount, rowCount;
	int cellWidth, rowHeight;
	boolean isDraw = false;

	public VTable(int x, int y, int width, int height) {
		this(x, y, width, height, 120, 40);

	}

	public VTable(int x, int y, int width, int height, int cellw, int rowh) {
		this.x = x;
		this.y = y;
		this.width = width;
		this.height = height;
		this.cellWidth = cellw;
		this.rowHeight = rowh;
		this.cellCount = width / cellw;
		this.rowCount = height / rowh;
		this.setLocation(x, y);
		this.setSize(width, height);
	}

	public Point getLoc(int row, int cell) {
		int x = this.x + (cell - 1) * cellWidth + 10;
		int y = this.y + (row - 1) * rowHeight + 10;

		return new Point(x, y);
	}

	public void draw() {
		this.isDraw=true;

	}

	@Override
	protected void paintComponent(Graphics g) {
		
		super.paintComponent(g);
		doLayout();
		if (!isDraw)
			return;
		
		for (int i = 0; i < cellCount + 1; i++) {

			g.drawLine(i * cellWidth, 0, i * cellWidth, height);
		}

		for (int i = 0; i < rowCount + 1; i++) {

			g.drawLine(0, i * rowHeight, width, i * rowHeight);
		}

		//
	}
}
