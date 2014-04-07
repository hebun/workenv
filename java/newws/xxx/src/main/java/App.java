import java.io.Serializable;
import java.util.MissingResourceException;
import java.util.ResourceBundle;
import java.util.logging.Level;

import javax.annotation.ManagedBean;
import javax.faces.bean.SessionScoped;
import javax.faces.context.FacesContext;
import javax.servlet.http.HttpSession;

import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.boot.registry.StandardServiceRegistryBuilder;
import org.hibernate.cfg.Configuration;

@SuppressWarnings("serial")
@SessionScoped
@ManagedBean
public class App implements Serializable {
	private String extention = ".faces";

	// insert into gridfield(gridId,`column`,header) ( select 2,COLUMN_NAME,''
	// from information_schema.COLUMNS where TABLE_NAME="cart")
	public String getExtention() {
		return extention;
	}

	public void setExtention(String extention) {
		this.extention = extention;
	}

	public App() {
		this.extention = ".faces";
		java.util.logging.Logger.getLogger("org.hibernate").setLevel(Level.OFF);
		System.out.println("app createed");
	}

	public static String getResourceBundleString(String resourceBundleKey)
			throws MissingResourceException {

		ResourceBundle bundle = ResourceBundle.getBundle("util.hello",
				FacesContext.getCurrentInstance().getViewRoot().getLocale());

		String message = bundle.getString(resourceBundleKey);

		return message;
	}

	public static Session hibSessionx() {
		Configuration configuration = new Configuration();
		Configuration cfg = configuration.configure();
		StandardServiceRegistryBuilder builder = new StandardServiceRegistryBuilder()
				.applySettings(cfg.getProperties());
		SessionFactory factory = cfg.buildSessionFactory(builder.build());

		return factory.openSession();
	}

	public static Object getSessionAttr(String attr) {
		HttpSession session = (HttpSession) FacesContext
				.getCurrentInstance().getExternalContext()
				.getSession(false);
		return session.getAttribute(attr);
	}
}
