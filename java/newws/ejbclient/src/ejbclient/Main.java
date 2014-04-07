package ejbclient;

import hellop.HelloCRemote;

import javax.naming.InitialContext;

public class Main {

	public static void main(String[] args) {
		   try {

			   private static HelloCRemote bean=new 
	            InitialContext ic = new InitialContext();
	            Sless sless = (Sless) ic.lookup("ejb30.Sless");
	            System.out.println("Sless bean says : " + sless.hello());

	        } catch(Exception e) {
	            e.printStackTrace();
	        }


	}

}
