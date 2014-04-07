package org.nule.lighthl7lib.hl7;

public class MLLPMessage
{
	public static final char B = 0x0B;
	public static char D = 0x0D;
	public static final char _1C = 0x1C;
	String message;

	public MLLPMessage(String message)
	{
		this.message = message;
		implementMLLP();
	}

	public String toString()
	{
		return message;
	}

	public static String removeMLLP(String message)
	{
      return message.substring(1);
	}

	private void implementMLLP()
	{
		message = B + message + _1C + D;
	}
}
