import java.io.Serializable;
import java.util.ArrayList;
import java.util.HashSet;
import java.util.List;
import java.util.logging.Level;

import javax.annotation.ManagedBean;
import javax.faces.application.FacesMessage;
import javax.faces.bean.ManagedProperty;
import javax.faces.bean.ViewScoped;
import javax.faces.context.FacesContext;
import javax.faces.event.ActionEvent;

import model.Cart;
import model.Gridfield;
import model.Member;

import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.boot.registry.StandardServiceRegistryBuilder;
import org.hibernate.cfg.Configuration;
import org.hibernate.criterion.Restrictions;
import org.primefaces.context.RequestContext;
import org.primefaces.event.SelectEvent;
import org.primefaces.event.TabChangeEvent;
import org.primefaces.event.TabCloseEvent;

@SuppressWarnings("serial")
@ViewScoped
@ManagedBean
public class Members implements Serializable {

	private List<Member> members;
	private Member selected;
	private boolean detailRendered;
	private int activeIndex;
	private Member currentRow;
	Session ss = null;
	private List<Gridfield> columns = new ArrayList<Gridfield>();
	private int gridId = 1;
	
	@ManagedProperty(value = "#{login}")
	private Login login;

	
	
	public int getGridId() {
		return gridId;
	}

	public void setGridId(int gridId) {
		this.gridId = gridId;
	}

	public Login getLogin() {
		return login;
	}

	public void setLogin(Login login) {
		this.login = login;
	}

	@SuppressWarnings("unchecked")
	public Members() {
		java.util.logging.Logger.getLogger("org.hibernate").setLevel(Level.OFF);
		System.out.println("Thanks for creating me");
		activeIndex = 0;
		detailRendered = false;
		Configuration configuration = new Configuration();
		Configuration cfg = configuration.configure();
		StandardServiceRegistryBuilder builder = new StandardServiceRegistryBuilder()
				.applySettings(cfg.getProperties());
		SessionFactory factory = cfg.buildSessionFactory(builder.build());

		this.ss = factory.openSession();
		try {

			ss.beginTransaction();

			List<Member> list = ss.createCriteria(Member.class).list();

			columns = ss.createCriteria(Gridfield.class)
					.add(Restrictions.eq("gridId", this.gridId)).list();

			System.out.println("mem size:" + list.size());
			setMembers(list);
			ss.getTransaction().commit();
		} catch (Exception ex) {
			ex.printStackTrace();
			ss.getTransaction().rollback();
			;
		} finally {

		}
	}

	@SuppressWarnings("unchecked")
	public List<Cart> getSelCarts() {
		if (this.currentRow == null) {
			setSelCarts(new ArrayList<Cart>());
		}

		return (List<Cart>) this.currentRow.getCarts();

	}

	public void setSelCarts(List<Cart> selCarts) {
		this.currentRow.setCarts(new HashSet<Cart>(selCarts));

	}

	public boolean isDetailRendered() {

		return detailRendered;
	}

	public void save(ActionEvent event) {

		if (validateMember(currentRow)) {
			try {

				ss.beginTransaction();

				ss.save(currentRow);

				ss.getTransaction().commit();
				closeTab();
				refresh(event);
			} catch (Exception ex) {
				ex.printStackTrace();
				ss.getTransaction().rollback();
			} finally {

			}
		}
	}

	@SuppressWarnings("unused")
	public void saveColumns(ActionEvent event) {

		try {

			ss.beginTransaction();
			for (Gridfield f : columns) {

				if (f.getHeader().equals("") && false) {
					ss.delete(f);
				} else {

					ss.save(f);
				}
			}

			ss.getTransaction().commit();

			refresh(event);
		} catch (Exception ex) {
			ex.printStackTrace();
			ss.getTransaction().rollback();
		} finally {

		}

	}

	private boolean validateMember(Member currentRow2) {
		if (currentRow2.getPassword().length() < 4) {
			FacesMessage message = new FacesMessage(
					FacesMessage.SEVERITY_ERROR,
					"Sifre en az 4 basamakli olmali.", "");
			FacesContext.getCurrentInstance().addMessage(null, message);
			return false;
		}
		return true;
	}

	public void setDetailRendered(boolean detailDisabled) {
		this.detailRendered = detailDisabled;
	}

	public int getActiveIndex() {
		return activeIndex;
	}

	public void setActiveIndex(int activeIndex) {
		this.activeIndex = activeIndex;
	}

	public List<Gridfield> getColumns() {
		return columns;
	}

	public void setColumns(List<Gridfield> columns) {
		this.columns = columns;
	}

	public void add(ActionEvent event) {
		System.out.println("add called");
		selected = null;
		currentRow = new Member();
		setDetailRendered(true);
		setActiveIndex(1);
		System.out.println(getActiveIndex() + ".lll");
	}

	public void delete(ActionEvent event) {
		System.out.println("delete called");
		if (selected == null) {

			FacesMessage message = new FacesMessage(FacesMessage.SEVERITY_INFO,
					"Uyari", App.getResourceBundleString("sureToDelete"));

			RequestContext.getCurrentInstance().showMessageInDialog(message);
		} else {

			try {

				ss.beginTransaction();

				ss.delete(selected);

				ss.getTransaction().commit();
				this.refresh(event);

			} catch (Exception e) {
				System.out.println("ex in delete");
				e.printStackTrace();
				ss.getTransaction().rollback();
			}
		}
		selected = null;
		currentRow = new Member();
	}

	public void onRowSelect(SelectEvent even) {

	}

	@SuppressWarnings("unchecked")
	public void refresh(ActionEvent event) {
		System.out.println("refresh called");

		try {

			ss.beginTransaction();

			List<Member> list = ss.createCriteria(Member.class).list();

			setMembers(list);
			columns = ss.createCriteria(Gridfield.class)
					.add(Restrictions.eq("gridId", this.gridId)).list();

			System.out.println("mem size:" + columns.size());
			ss.getTransaction().commit();
		} catch (Exception e) {
			System.out.println("ex in refresh");
			e.printStackTrace();
			ss.getTransaction().rollback();
		}

		selected = null;
		currentRow = new Member();
	}

	public Member getCurrentRow() {
		return currentRow;
	}

	public void setCurrentRow(Member currentRow) {
		this.currentRow = currentRow;
	}

	public void edit(ActionEvent event) {
		currentRow = selected;
		if (selected == null) {

			FacesMessage message = new FacesMessage(FacesMessage.SEVERITY_INFO,
					"What we do in life", "Echoes in eternity.");

			RequestContext.getCurrentInstance().showMessageInDialog(message);
			System.out.println("edit called nulll");
		} else {

			setDetailRendered(true);
			setActiveIndex(1);
			System.out.println("edit called ");
		}

	}

	public void onTabChange(TabChangeEvent event) {

	}

	public void onTabClose(TabCloseEvent event) {

		closeTab();

	}

	private void closeTab() {
		setDetailRendered(false);
		setActiveIndex(0);
		System.out.println("close called");
	}

	public List<Member> getMembers() {
		return members;
	}

	public void setMembers(List<Member> members) {
		this.members = members;
	}

	public Member getSelected() {
		return selected;
	}

	public void setSelected(Member selected) {
		this.selected = selected;
	}

}
