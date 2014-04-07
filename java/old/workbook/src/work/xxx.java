package work;

import java.util.Collection;
import java.util.Iterator;
import java.util.Map;
import java.util.Set;

public class xxx implements Iterator<String>, Iterable<String>, Map {
	String[] dizi = { "blbla", "xxxx", "yyy" };
	public int k = 0;

	public xxx() {

	}

	@Override
	public boolean hasNext() {

		return k < 3;
	}

	@Override
	public String next() {

		return dizi[k++];
	}

	@Override
	public void remove() {

	}

	@Override
	public Iterator<String> iterator() {
		// TODO Auto-generated method stub
		return this;
	}

	@Override
	public int size() {
		// TODO Auto-generated method stub
		return 0;
	}

	@Override
	public boolean isEmpty() {
		// TODO Auto-generated method stub
		return false;
	}

	@Override
	public boolean containsKey(Object key) {
		// TODO Auto-generated method stub
		return false;
	}

	@Override
	public boolean containsValue(Object value) {
		// TODO Auto-generated method stub
		return false;
	}

	@Override
	public Object get(Object key) {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public Object put(Object key, Object value) {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public Object remove(Object key) {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public void putAll(Map m) {
		// TODO Auto-generated method stub

	}

	@Override
	public void clear() {
		// TODO Auto-generated method stub

	}

	@Override
	public Set keySet() {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public Collection values() {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public Set entrySet() {
		// TODO Auto-generated method stub
		return null;
	}

}
