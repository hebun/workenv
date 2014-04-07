import java.io.Serializable;
import java.util.Date;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;

import javax.annotation.ManagedBean;
import javax.faces.application.FacesMessage;
import javax.faces.bean.ViewScoped;
import javax.faces.context.FacesContext;
import javax.faces.webapp.FacesServlet;
import javax.servlet.http.HttpSession;
import javax.validation.constraints.NotNull;

import org.hibernate.Criteria;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.boot.registry.StandardServiceRegistryBuilder;
import org.hibernate.cfg.Configuration;
import org.hibernate.criterion.Restrictions;
import org.primefaces.context.RequestContext;

import model.*;

@ViewScoped
@ManagedBean
public class Process implements Serializable {
	/**
	 * 
	 */
	private static final long serialVersionUID = -3966377876438157280L;
	private static final Logger log = Logger.getLogger(Process.class.getName());
	Session ss = null;
	List<Cart> carts;
	List<Member> members;

	public List<Member> getMembers() {
		return members;
	}

	public void setMembers(List<Member> members) {
		this.members = members;
	}

	private String amount;

	@NotNull
	Cart selectedCart;

	Member sellerMember;

	String moveDesc;

	public String addToCart() {
		if (selectedCart == null) {
			FacesMessage msg = new FacesMessage(FacesMessage.SEVERITY_ERROR,
					App.getResourceBundleString("chooseCart"), "");
			FacesContext.getCurrentInstance().addMessage("auth", msg);
			return "";
		}
		int amot = Integer.parseInt(amount);
		if (selectedCart.getMember().getBakiye() < amot) {
			FacesMessage msg = new FacesMessage(FacesMessage.SEVERITY_ERROR,
					App.getResourceBundleString("notEnoughPoint"), "");
			FacesContext.getCurrentInstance().addMessage("auth", msg);
			
			return "";
		}
		
		return "";
	}

	public String payment() {

		if (selectedCart == null) {
			FacesMessage msg = new FacesMessage(FacesMessage.SEVERITY_ERROR,
					App.getResourceBundleString("chooseCart"), "");
			FacesContext.getCurrentInstance().addMessage("auth", msg);
			return "";
		}
		int amot = Integer.parseInt(amount);
		if (selectedCart.getBakiye() < amot) {
			FacesMessage msg = new FacesMessage(FacesMessage.SEVERITY_ERROR,
					App.getResourceBundleString("notEnoughPoint"), "");
			FacesContext.getCurrentInstance().addMessage("auth", msg);
			return "";
		}

		selectedCart.setBakiye(selectedCart.getBakiye() - amot);

		Move move = new Move();
		move.setCart(selectedCart);
		move.setType("PAYMENT");
		move.setTarih(new Date());
		move.setDesc(moveDesc);
		move.setUser((Member) App.getSessionAttr("member"));
		sellerMember.setBakiye(sellerMember.getBakiye() + amot);
		try {

			ss.beginTransaction();

			ss.save(move);
			ss.save(selectedCart);
			ss.save(sellerMember);

			ss.getTransaction().commit();

			amount = "";
			moveDesc = "";

			FacesMessage message = new FacesMessage(FacesMessage.SEVERITY_INFO,
					"Ok", App.getResourceBundleString("savedPayment"));

			RequestContext.getCurrentInstance().showMessageInDialog(message);
		} catch (Exception ex) {
			ss.getTransaction().rollback();
		}
		return "";

	}

	public Process() {

		java.util.logging.Logger.getLogger("org.hibernate").setLevel(Level.OFF);
		System.out.println("Thanks for creating process");

		Configuration configuration = new Configuration();
		Configuration cfg = configuration.configure();
		StandardServiceRegistryBuilder builder = new StandardServiceRegistryBuilder()
				.applySettings(cfg.getProperties());
		SessionFactory factory = cfg.buildSessionFactory(builder.build());

		this.ss = factory.openSession();
		this.refresh(null);
	}

	@SuppressWarnings("unchecked")
	private void refresh(Object object) {

		System.out.println("refresh called");

		try {

			ss.beginTransaction();

			Criteria criteria = ss.createCriteria(Cart.class);

			HttpSession session = (HttpSession) FacesContext
					.getCurrentInstance().getExternalContext()
					.getSession(false);
			Member mem = (Member) session.getAttribute("member");

			if (!mem.getStatus().equals("ADMIN")) {

				criteria.add(Restrictions.eq("member", mem));
			}

			List<Cart> list = criteria.list();

			System.out.println("mem size:" + list.size());
			setCarts(list);

			setMembers(ss.createCriteria(Member.class)
					.add(Restrictions.ne("status", "ADMIN")).list());

			ss.getTransaction().commit();
		} catch (Exception ex) {
			System.out.println("ex in pro cons");
			ex.printStackTrace();
			ss.getTransaction().rollback();
			;
		} finally {

		}

	}

	public List<Cart> getCarts() {
		return carts;
	}

	public void setCarts(List<Cart> carts) {
		this.carts = carts;
	}

	public String getAmount() {
		return amount;
	}

	public void setAmount(String amount) {
		this.amount = amount;
	}

	public Member getSellerMember() {
		return sellerMember;
	}

	public void setSellerMember(Member sellerMember) {
		this.sellerMember = sellerMember;
	}

	public String getMoveDesc() {
		return moveDesc;
	}

	public void setMoveDesc(String moveDesc) {
		this.moveDesc = moveDesc;
	}

	public Cart getSelectedCart() {
		return selectedCart;
	}

	public void setSelectedCart(Cart selectedCart) {
		this.selectedCart = selectedCart;
	}
}
