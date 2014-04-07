/*
 * MshFieldOne.java
 *
 * Created on July 7, 2007, 7:38 PM
 *
 * To change this template, choose Tools | Template Manager
 * and open the template in the editor.
 */

package org.nule.lighthl7lib.hl7;

/**
 *
 * @author mike
 */
public class MshFieldOne extends Hl7Field {
    
    /** Creates a new instance of MshFieldOne */
    public MshFieldOne(String[] separators) {
        super(separators[4], separators);
    }

    protected Hl7Field getReal(int id, int sep) {
        return this;
    }

    protected int getRealCount(int sep) {
        return 1;
    }

    public String toString() {
        return seps[4];
    }
    
}
