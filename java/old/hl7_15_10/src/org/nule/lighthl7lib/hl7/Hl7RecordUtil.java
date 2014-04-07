/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package org.nule.lighthl7lib.hl7;

import java.util.regex.*;

/**
 * 
 * @author mike
 */
public class Hl7RecordUtil
{

	public static final String sep0 = "\r";
	public static final Pattern hl7match = Pattern
			.compile("(MSH[^\\r]+\\r(?:[A-Z0-9]{3}[^\\r]*\\r)+)");
	public static final String defaultDelims = "^~\\&|";

	/**
	 * Accepts an HL7 record, sets the object separators based upon those
	 * contained in the HL7 record. If you data contains mixed separators this
	 * needs to be called before every record.
	 * 
	 * @param record
	 * @throws IllegalArgumentException
	 */
	public static String[] setSeparators(String record)
			throws IllegalArgumentException
	{

		if (!record.startsWith("MSH"))
		{
		//	System.out.println("record:"+record);
			throw new IllegalArgumentException("Record not HL7");
		}
		String[] seps = new String[8];
		// These are wrapped in character classes, because some characters like
		// | need it.
		seps[0] = "[" + record.substring(3, 4) + "]"; // Field separator
		seps[1] = "[" + record.substring(4, 5) + "]"; // Component separator
		seps[2] = "[" + record.substring(5, 6) + "]"; // Repetition separator
		seps[3] = "[" + record.substring(7, 8) + "]"; // Subcomponent
														// separator
		seps[4] = record.substring(3, 4); // Field separator
		seps[5] = record.substring(4, 5); // Component separator
		seps[6] = record.substring(5, 6); // Repetition separator
		seps[7] = record.substring(7, 8); // Subcomponent separator
		for (int i = 0; i < 4; i++)
		{
			// caret is special in Java regexes and a pain to escape.
			seps[i] = seps[i].replaceAll("[\\^]", "\\\\^");
		}
		return seps;
	}

	public static String[] setDefaultSeparators()
	{
		String record = "MSH|" + defaultDelims + "\r";
		return setSeparators(record);
	}

}
