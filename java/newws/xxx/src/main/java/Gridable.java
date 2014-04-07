import java.util.List;

import javax.faces.event.ActionEvent;

import org.primefaces.event.SelectEvent;

import model.Gridfield;

public interface Gridable {
	public void add(ActionEvent event);
	public void edit(ActionEvent event);
	public void refresh(ActionEvent event);
	public void delete(ActionEvent event);
	public List<Gridfield> getColumns();
	public void onRowSelect(SelectEvent even);
}
