package org.nule.lighthl7lib.hl7;

import javax.xml.parsers.SAXParser;
import javax.xml.parsers.SAXParserFactory;

import org.xml.sax.Attributes;
import org.xml.sax.helpers.DefaultHandler;

public class Options {
	private String theFile;
	private int inPort;
	private int outPort;
	private int refresh;
	String server;
	private boolean isAuto;
	private boolean isOnay;

	public Options(String file) {
		theFile = file;
		load();
	}

	public Options() {
		theFile = "options.xml";
		load();
	}

	public void load() {
		DefaultHandler handler = new DefaultHandler() {
			String currentElement = "";

			public void startElement(String uri, String lname, String qname,
					Attributes attributes) {

				currentElement = qname;
			}

			public void endElement(String uri, String name, String qName) {
				currentElement = "";
			}

			public void characters(char[] ch, int start, int finish) {

				String value = new String(ch, start, finish);
				if (value == "\n\t")
					return;

				if (currentElement == "server") {
					server = value;
				} else if (currentElement == "isAutoSend") {
					int _value=Integer.parseInt(value);
					isAuto = (_value == 0) ? false : true;
					
				} else if (currentElement == "inPort") {
					inPort = Integer.parseInt(value);
				} else if (currentElement == "outPort") {
					outPort = Integer.parseInt(value);
				} else if (currentElement == "refresh") {
					refresh = Integer.parseInt(value);
				}
				 else if (currentElement == "onay") {
						int _value=Integer.parseInt(value);
						isOnay = (_value == 0) ? false : true;
						
					}
			}
		};
		try {
			SAXParser parser = getParser();
			parser.parse(theFile, handler);
		} catch (Exception e) {

			System.out.println(e.getMessage());

			return;
		}
	}

	public SAXParser getParser() throws Exception {
		SAXParserFactory factory = SAXParserFactory.newInstance();
		return factory.newSAXParser();
	}

	public int getInPort() {

		return this.inPort;

	}

	public int getOutPort() {

		return this.outPort;
	}

	public String getServer() {
		return server;
	}

	public int getRefreshTime() {
		return refresh;
	}

	public boolean isAuto() {
		return isAuto;
	}

	public void setAuto(boolean isAuto) {
		this.isAuto = isAuto;
	}

	public boolean isOnay() {
		return isOnay;
	}

	public void setOnay(boolean isOnay) {
		this.isOnay = isOnay;
	}
}
