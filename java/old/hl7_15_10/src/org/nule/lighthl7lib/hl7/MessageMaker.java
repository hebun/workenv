package org.nule.lighthl7lib.hl7;

import java.sql.Date;
import java.text.SimpleDateFormat;

public class MessageMaker {
	public static final char segmentSeparator = 0x0D;
	private String message;
	public static final char B = 0x0B;
	public static char D = 0x0D;
	public static final char _1C = 0x1C;

	public MessageMaker(String[] result) {

		// String timeStr = String.valueOf(System.currentTimeMillis());
		Date timeD = new Date(System.currentTimeMillis());
		SimpleDateFormat format = new SimpleDateFormat("yyyyMMddHHss");

		String time = format.format(timeD);
		String sex = "";
		Date timeDogum = null;
		String dogumTarihi=result[12];
//		if (result[12]!=null) {
//			String sub=result[12].substring(0,10);
//			try {
//				timeDogum = Date.valueOf(sub);
//				SimpleDateFormat formatDogum = new SimpleDateFormat("yyyyMMdd");
//				dogumTarihi = formatDogum.format(timeDogum);
//			} catch (RuntimeException e) {
//				System.out.println("tarihFormatıHatalı");
//			}
//			
//		}
		if (result[11] == null) {
			sex = "U";
		} else {
			if (result[11].equals("BAY")) {
				sex = "M";
			} else if (result[11].equals("BAYAN")) {
				sex = "F";
			} else {
				sex = "U";
			}
		}

		// result[7].substring(0, result[7].length() - 3);
		// result[1].substring(0, result[1].length() - 3);

		String message2 = B + "MSH|^~\\&|MELSOFT|HIS|IWM|SIEMENS|" + time
				+ "||ORM^O01|" + result[9] + "|P|2.3.1|||AL|NE|||" + D
				+ "PID|||" + result[0] + "|" + result[2] + "|" + result[8]
				+ "^" + result[7] + "^^^^|||" + sex + "||||||" + D + "PV1||"
				+ result[10] + "|" + result[4] + "||||||||||||||||" + result[1]
				+ "||||||||||||||||||||||||||" + D + "ORC|NW|" + result[3]
				+ "^|||||^^^" + time + "|||||||||||||" + D + "OBR||"
				+ result[3] + "||" + result[5] + "^" + result[6]
				+ "^GISBIR_Tree||||||||||||||TANISIZ||||||";

		message = B + "MSH|^~\\&|MELSOFT|HIS|IWM|SIEMENS|" + time
				+ "||ORM^O01|" + result[9] + "|P|2.3.1|||AL|NE|||" + D
				+ "PID|||" + result[0] + "|" + result[2] + "|" + result[8]
				+ "^" + result[7] + "^^^^||"+dogumTarihi+"|" + sex + "||||||" + D
				+ "PV1||" + result[10] + "|" + result[4] + "||||||||||||||||"
				+ result[3] + "|||||||||||||||||||||||||||" + D + "ORC|NW|"
				+ result[3] + "^1|||||^^^||" + time + "|||||||||||" + D
				+ "OBR||" + result[3] + "||" + result[5] + "^" + result[6]
				+ "^GISBIR_Tree||||||||||||||TANISIZ||||||" + "|||^^^" + time
				+ "^^ROUTINE||||||||||||" + D + _1C + D;

		String message1 = "MSH|^~\\&|MELSOFT|HIS|IWM|SIEMENS|" + time
				+ "||ORM^O01|540059|P|2.3.1|||AL|NE|||" + D + "PID||100|"
				+ result[0] + "|" + result[4] + "|" + result[2] + "^"
				+ result[3] + "^^^^||19621010||||||05358452928|" + D
				+ "PV1|1|I|110|||||3791|||||||||||" + result[6]
				+ "|||||||||||||||||||||||||" + time + "|" + D + "ORC|NW|"
				+ result[7] + "^1|||||^^^" + time + "|||||DOK000|00|||||||" + D
				+ "OBR|1|" + result[7] + "^1||" + result[4] + "^" + result[5]
				+ "^GISBIR_Tree|||||||||" + "|||||TANISIZ||||||1348|||^^^"
				+ time + "^^ROUTINE||||||||||||" + D;

		// Hl7Record record = new Hl7Record(message1);
		//
		// Hl7Segment mshSeg = record.get("MSH");
		//
		// Hl7Field messageType = mshSeg.field(9);
		// System.out.println(messageType.getComp(1).toString());
	}

	public String toString() {
		return message;
	}
}
