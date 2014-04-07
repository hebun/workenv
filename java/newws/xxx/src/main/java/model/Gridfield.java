// default package
// Generated Mar 11, 2014 1:20:13 AM by Hibernate Tools 3.4.0.CR1
package model;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;

import static javax.persistence.GenerationType.IDENTITY;

import javax.persistence.Id;
import javax.persistence.Table;

/**
 * Gridfield generated by hbm2java
 */
@SuppressWarnings("serial")
@Entity
@Table(name = "gridfield", catalog = "clickcart")
public class Gridfield implements java.io.Serializable {

	private Integer id;
	private int gridId;
	private String column;
	private String header;

	public Gridfield() {
	}

	public Gridfield(int gridId) {
		this.gridId = gridId;
	}

	public Gridfield(int gridId, String column, String header) {
		this.gridId = gridId;
		this.column = column;
		this.header = header;
	}

	@Id
	@GeneratedValue(strategy = IDENTITY)
	@Column(name = "id", unique = true, nullable = false)
	public Integer getId() {
		return this.id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	@Column(name = "gridId", nullable = false)
	public int getGridId() {
		return this.gridId;
	}

	public void setGridId(int gridId) {
		this.gridId = gridId;
	}

	@Column(name = "column", length = 30)
	public String getColumn() {
		return this.column;
	}

	public void setColumn(String column) {
		this.column = column;
	}

	@Column(name = "header")
	public String getHeader() {
		return this.header;
	}

	public void setHeader(String header) {
		this.header = header;
	}

}