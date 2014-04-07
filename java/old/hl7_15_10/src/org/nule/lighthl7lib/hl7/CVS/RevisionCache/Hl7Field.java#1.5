/*
 * Hl7Field.java
 *
 * Created on March 24, 2006, 10:58 AM
 *
 * Copyright (C) 2004-2006 M Litherland
 */

package org.nule.lighthl7lib.hl7;

import java.util.ArrayList;

/**
 *
 * @author litherm
 *
 * This class abstracts an HL7 field.
 */
public class Hl7Field {
    private String field;
    protected String[] seps;
    private ArrayList comps = null;
    private String compSep = null;
    protected boolean existing = false;
    
    /**
     * Create a new Hl7Field object from a string and our separators.
     * 
     * @param newField
     * @param separators
     */
    public Hl7Field(String newField, String[] separators) {
        field = newField;
        seps = separators;
        existing = true;
    }

    /**
     * Create a new Hl7Field object from a string and our separators.
     * Let the caller set the existing field, which allows the caller to
     * flag this field as not existing in the original record.  If it is
     * set to false, then the field will not be included in rebuilt record.
     * However, it will be set to true if the field is changed after being
     * created, or if any underlying children are updated.
     * 
     * @param newField
     * @param separators
     * @param isExisting
     */
    public Hl7Field(String newField, String[] separators, boolean existing) {
        field = newField;
        seps = separators;
        this.existing = existing;
    }
    /**
     * Return the field as a string.
     * 
     * @return This field as a string.
     */
    public String toString() {
    	return field;
    }

    /**
     * Return a given Component as an Hl7Field within this field.
     * 
     * @param id
     * @return
     */
    public Hl7Field getComp(int id) {
    	return getReal(id, 1);
    }
    
    /**
     * Get real takes care of returning the proper subelement based upon
     * the separator id that's passed to us.  It is smart enough to know
     * that you've changed the separator from the last call.
     * 
     * @param id
     * @param sep
     * @return The requested Hl7Field
     */
    protected Hl7Field getReal(int id, int sep) {
    	if (comps == null || !seps[sep + 4].equals(compSep)) {
            comps = new ArrayList();
            compSep = seps[sep + 4];
            String[] fields = field.split(seps[sep]);
            for (int i = 0; i < fields.length; i++) {
                comps.add(new Hl7Field(fields[i], seps, existing));
            }
    	}
        if (id >= comps.size()) {
            for (int i = comps.size(); i < id; i++) {
                comps.add(new Hl7Field("", seps, false));
            }
        }
    	return (Hl7Field) comps.get(id - 1);
    }
    
    /**
     * Return number of components
     * 
     * @return int
     */
    public int getCompCount() {
    	return getRealCount(1);
    }
    
    /**
     * 
     * @param sep
     * @return
     */
    protected int getRealCount(int sep) {
    	if (comps == null || seps[sep + 4] != compSep) {
            return field.split(seps[sep]).length;
    	}
        int lastExistingField = 0;
        for (int i = 0; i < comps.size(); i++) {
            if (((Hl7Field) comps.get(i)).isExisting()) {
                lastExistingField = i;
            }
        }
    	return lastExistingField + 1;
    }
    
    /**
     * Return a given repetition as an Hl7Field within this field.
     * 
     * @param id
     * @return Hl7Field
     */
    public Hl7Field getRep(int id) {
    	return getReal(id, 2);
    }
    
    /**
     * Return the number of repetitions
     * 
     * @return int
     */
    public int getRepCount() {
        return getRealCount(2);
    }
    
    /**
     * Return a given subcomponent as an Hl7Field within this field.
     * 
     * @param id
     * @return Hl7Field
     */
    public Hl7Field getSubcomp(int id) {
    	return getReal(id, 3);
    }
    
    /** 
     * Return the number of subcomps a field has.
     * 
     * @return int
     */
    public int getSubcompCount() {
    	return getRealCount(3);
    }
    
    /**
     * Hand us a new string and regenerate the field.
     * 
     * @param newRecord
     */
    public void changeField(String newField) {
    	field = newField;
    	comps = null;
    	compSep = null;
        existing = true;
    }
    
    /**
     * Rebuilds the field from the subfields in case they
     * have changed.
     *
     * @return Newly constructed string of record.
     */
    public String rebuild() {
    	if (comps == null) {
            return field;
    	}
    	StringBuffer newField = new StringBuffer();
        int lastExistingField = 0;
        for (int i = 0; i < comps.size(); i++) {
            if (((Hl7Field) comps.get(i)).isExisting()) {
                lastExistingField = i;
            }
        }
    	for (int i = 0; i <= lastExistingField; i++) {
            if (i > 0) {
                newField.append(compSep);
            }
            newField.append(((Hl7Field) comps.get(i)).rebuild());
    	}
    	changeField(newField.toString());
    	return newField.toString();
    }
    
    /**
     * Returns the property of the existing private variable.  This is pretty
     * much only used by the rebuild method to determine if the field created
     * either existed initially in the record or was changed after a query
     * instantiated it.  The point is that if the record was instantiated by
     * a query but not populated (nor any children populated) it shouldn't be
     * included in the rebuilt record.
     *
     * @return existing property
     */
    public boolean isExisting() {
        if (comps == null) {
            return existing;
        }
        if (existing) {
            return existing;
        }
        for (int i = 0; i < comps.size(); i++) {
            Hl7Field field = (Hl7Field) comps.get(i);
            if (field.isExisting()) {
                existing = true;
            }
        }
        return existing;
    }
    
}
