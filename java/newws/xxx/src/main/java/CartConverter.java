import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
import javax.faces.convert.Converter;
import javax.faces.convert.ConverterException;
import javax.faces.convert.FacesConverter;

import model.Cart;

@FacesConverter(forClass = model.Cart.class, value = "cart")
public class CartConverter implements Converter {

	public CartConverter() {
		// TODO Auto-generated constructor stub
	}

	@Override
	public Object getAsObject(FacesContext arg0, UIComponent arg1, String arg2)
			throws ConverterException {
		if (arg2==null|| arg2.trim().equals(""))
			return null;
		//System.out.println("getasobject:" + arg2);
		Process bean = (Process) arg0.getApplication().evaluateExpressionGet(arg0,
				"#{process}", Process.class);
		for (Cart c: bean.getCarts()) {

			if (c.getId().toString().equals(arg2))
				return c;

		}
		return null;
	}

	@Override
	public String getAsString(FacesContext arg0, UIComponent arg1, Object arg2)
			throws ConverterException {
		if (arg2 == null || arg2.equals(""))
			return "";
	//	System.out.println("getasstring:" + ((Member) arg2).getId());
		return ((Cart) arg2).getId().toString();
	}

}
