package org.nule.lighthl7lib.hl7;

@SuppressWarnings("serial")
public class CustomException extends Exception
{
	CustomException(String message)
	{
		super(message);
	}
}
