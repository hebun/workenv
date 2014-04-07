import java.io.Serializable;
import java.util.ArrayList;
import java.util.List;
import java.util.MissingResourceException;
import java.util.ResourceBundle;
import java.util.logging.Level;

import javax.faces.application.FacesMessage;
import javax.faces.bean.ManagedBean;
import javax.faces.bean.SessionScoped;
import javax.faces.context.FacesContext;
import javax.faces.event.ActionEvent;
import javax.servlet.http.HttpSession;

import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.boot.registry.StandardServiceRegistryBuilder;
import org.hibernate.cfg.Configuration;
import org.hibernate.criterion.Restrictions;
import org.primefaces.context.RequestContext;

import model.*;

@SuppressWarnings("serial")
@ManagedBean
@SessionScoped
public class Login implements Serializable {

	private boolean isDebug;
	public String password;
	private String username;
	private String status;
	private boolean isAdmin;
	private Member member;

	public Member getMember() {
		return member;
	}

	public void setMember(Member member) {
		this.member = member;
	}

	public boolean isAdmin() {
		return isAdmin;
	}

	public void setAdmin(boolean isAdmin) {
		this.isAdmin = isAdmin;
	}

	public String getStatus() {
		return status;
	}

	public void setStatus(String status) {
		this.isAdmin = status.equals("ADMIN");
		this.status = status;
	}

	private List<String> list = null;

	public Login() {

		this.list = new ArrayList<String>();
	}

	public List<String> getList() {
		return list;
	}

	public void setList(List<String> list) {
		this.list = list;
	}

	private int no = 0;

	public int getNo() {
		return no;
	}

	public void setNo(int no) {
		System.out.println(no + " sent to us");
		this.no = no;
	}

	public boolean getIsDebug() {
		return isDebug;
	}

	public void setIsDebug(boolean isDebug) {
		this.isDebug = isDebug;
	}

	public String clicked() {

		return "true";

	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public String getUsername() {
		return username;
	}

	public void setUsername(String username) {
		this.username = username;
	}

	public String listen() {

		return "from listen method";
	}

	public String comAction() {

		System.out.println("com action called");
		return "okay";
	}

	public static String getResourceBundleString(String resourceBundleName,
			String resourceBundleKey) throws MissingResourceException {

		ResourceBundle bundle = ResourceBundle.getBundle("util.hello",
				FacesContext.getCurrentInstance().getViewRoot().getLocale());

		String message = bundle.getString(resourceBundleKey);

		return message;
	}

	public String login() {

		java.util.logging.Logger.getLogger("org.hibernate").setLevel(Level.OFF);
		Session ss = null;
		try {
			Configuration cfg = new Configuration().configure();
			StandardServiceRegistryBuilder builder = new StandardServiceRegistryBuilder()
					.applySettings(cfg.getProperties());
			SessionFactory factory = cfg.buildSessionFactory(builder.build());

			ss = factory.openSession();
			ss.beginTransaction();

			@SuppressWarnings("unchecked")
			List<Member> list = ss.createCriteria(Member.class)
					.add(Restrictions.eq("username", username))
					.add(Restrictions.eq("password", password)).list();

			RequestContext context = RequestContext.getCurrentInstance();
			FacesMessage msg = null;
			boolean loggedIn = false;

			if (list.size() > 0) {
				loggedIn = true;
				HttpSession session = (HttpSession) FacesContext
						.getCurrentInstance().getExternalContext()
						.getSession(false);
				;
				session.setAttribute("username", username);

				setStatus(list.get(0).getStatus());

				setMember(list.get(0));
				session.setAttribute("member", getMember());

				session.setAttribute("status", list.get(0).getStatus());
				System.out.println("setting status:" + list.get(0).getStatus());
				return "home";
			} else {
				loggedIn = false;

				msg = new FacesMessage(FacesMessage.SEVERITY_ERROR,
						getResourceBundleString("util.hello", "invalidCred"),
						"Invalid credentials");
				FacesContext.getCurrentInstance().addMessage("auth", msg);
				context.addCallbackParam("loggedIn", loggedIn);
			}

		} catch (Exception ex) {
			ex.printStackTrace();
		}
		return "";
	}

	public String logout() {
		HttpSession session = (HttpSession) FacesContext
				.getCurrentInstance().getExternalContext()
				.getSession(false);
		session.invalidate();
	//	session.
		return "login";
	}
}
