/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package org.nule.lighthl7lib.hl7;

/**
 *
 * @author mike
 */
public class GroupDefinition {
    
    private String root = null;
    private GroupDefinition[] children = null;
    
    public GroupDefinition(String root) {
        this.root = root;
    }
    
    public GroupDefinition(String root, GroupDefinition[] children) {
        this.root = root;
        this.children = children;
    }
    
    public String getRootSegment() {
        return root;
    }
    
    public boolean hasChildren() {
        return children != null;
    }
    
    public GroupDefinition[] getChildren() {
        return children;
    }
    
}
