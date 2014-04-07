package org.nule.lighthl7lib.hl7;

public class MessageAsistant
{
	public static String getMcid(String message, boolean isACK)
	{
		// mic
		if (isACK)
		{
			Hl7Record record = new Hl7Record(message);
			Hl7Segment pid = record.get("MSH");
			Hl7Field micdField = pid.field(10);
			return micdField.toString();
		}else{
			Hl7Record record = new Hl7Record(message);
			Hl7Segment pid = record.get("PID");
			Hl7Field micdField = pid.field(3);
			String mcid = micdField.getComp(1).toString();
			Hl7Segment obr = record.get("OBR");
			Hl7Field siraField = obr.field(2);
			mcid += siraField.toString();
			return mcid;
		}
	}
}
