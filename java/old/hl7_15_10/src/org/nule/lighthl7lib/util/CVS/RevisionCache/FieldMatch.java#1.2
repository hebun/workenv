/*
 * FieldMatch.java
 *
 * Created on March 24, 2006, 2:56 PM
 *
 * Copyright (C) 2004-2006 M Litherland
 */

package org.nule.lighthl7lib.util;

import java.util.regex.*;
import org.nule.lighthl7lib.hl7.*;

/**
 *
 * @author litherm
 *
 * Create an object that contains the definition of a field. This can help
 * create the actual search.
 */
public class FieldMatch {
    
    private String segment;
    private int segRep;
    private int field;
    private int rep;
    private int comp;
    private int subcomp;
    
    /**
     * Create a field match object with just the segment header, it's assumed
     * that you'll use the addField, etc. methods after creating to set the
     * match class up as you see fit.
     */
    public FieldMatch(String newSegment) {
        segment = newSegment;
        segRep = 0;
        field = 0;
        rep = 0;
        comp = 0;
        subcomp = 0;
    }
    
    /**
     * Create a field match object while specifying the desired arguments for
     * field, repetition, etc. at creation.
     */
    public FieldMatch(String newSegment, int newSegRep, int newField, int newRep,
            int newComp, int newSubComp) {
        segment = newSegment;
        segRep = newSegRep;
        field = newField;
        rep = newRep;
        comp = newComp;
        subcomp = newSubComp;
    }
    
    /**
     * Retrieve the defined field object as a string from the provided Hl7Record
     * object.
     */
    public String getField(Hl7Record hr) {
        return getFieldObj(hr).toString();
    }
    
    /**
     * I should have really had the getField method return the Hl7Field object,
     * but I was young and stupid then.  It's too late to change the API on that
     * method, so here's a new method that does what I meant.
     */
    public Hl7Field getFieldObj(Hl7Record hr) {
        Hl7Segment seg;
        try {
            if (segRep == 0) {
                seg = hr.get(segment);
            } else {
                seg = hr.get(segment, segRep);
            }
            Hl7Field payload = seg.field(field);
            if (rep != 0) {
                payload = payload.getRep(rep);
            }
            if (comp != 0) {
                payload = payload.getComp(comp);
            }
            if (subcomp != 0) {
                payload = payload.getSubcomp(subcomp);
            }
            return payload;
        } catch (NullPointerException e) {
            return null;
        }
    }
    
    public void addSegRep(int newSegRep) {
        segRep = newSegRep;
    }
    
    public void addField(int newField) {
        field = newField;
    }
    
    public void addRep(int newRep) {
        rep = newRep;
    }
    
    public void addComp(int newComp) {
        comp = newComp;
    }
    
    public void addSubComp(int newSubComp) {
        subcomp = newSubComp;
    }
    
    /**
     * To simplify the creation of FieldMatch objects, verifyFields
     * takes a formatted string describing a field and returns the
     * appropriate field match object or null if the format was
     * invalid.
     *
     * @param fieldArgs
     * @return FieldMatch
     */
    public static FieldMatch verifyFields(String fieldArgs) {
        FieldMatch fm = null;
        Pattern segId = Pattern.compile("^([A-Z]{2}[A-Z0-9])(\\d*)");
        String[] parse1 = fieldArgs.split(":");
        if (parse1.length != 2) {
            System.err.println("Field received not valid: " + fieldArgs);
            System.err.println("Must include Segment and Field number.");
            return null;
        }
        Matcher m = segId.matcher(parse1[0].toString());
        if (m.find()) {
            fm = new FieldMatch(m.group(1));
            if (m.groupCount() > 2) {
                fm.addSegRep((new Integer(m.group(2))).intValue());
            }
            String[] fieldDef = parse1[1].split("-");
            switch (fieldDef.length) {
                case 4:
                    fm.addSubComp((new Integer(fieldDef[3])).intValue());
                case 3:
                    fm.addComp((new Integer(fieldDef[2])).intValue());
                case 2:
                    fm.addRep((new Integer(fieldDef[1])).intValue());
                case 1:
                    fm.addField((new Integer(fieldDef[0])).intValue());
                    break;
                default:
                    System.err.println("Error in field definition: "
                            + fieldArgs);
                    return null;
            }
        } else {
            System.err.println("Could not match segment id: "
                    + fieldArgs);
            System.err.println("Fields much start with segment id.");
            return null;
        }
        return fm;
    }
}
