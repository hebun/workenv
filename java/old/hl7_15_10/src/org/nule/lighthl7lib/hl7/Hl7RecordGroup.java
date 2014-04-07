/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package org.nule.lighthl7lib.hl7;

import java.util.*;

/**
 *
 * @author mike
 */
public class Hl7RecordGroup {
    
    private String record;
    private String[] seps;
    private GroupDefinition[] def;
    private List groups = null;
    
    public Hl7RecordGroup(GroupDefinition[] groups, String record) {
        def = groups;
        this.record = record;
        seps = Hl7RecordUtil.setSeparators(record);
    }
    
    public Hl7RecordGroup(GroupDefinition[] groups) {
        def = groups;
        seps = Hl7RecordUtil.setDefaultSeparators();
    }
    
    public Hl7RecordGroup(GroupDefinition[] groups, String[] delims) {
        def = groups;
        seps = delims;
    }
    
    /**
     * Check the provided groups to make sure they make some kind of sense.
     * 
     * @param groups an array of GroupDefinition objects.
     */
    private void checkGroups(GroupDefinition[] groups) {
        
    }
    
}
