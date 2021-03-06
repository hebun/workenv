package setest;

import java.util.Arrays;
import java.util.Collection;
import java.util.Iterator;
import java.util.Map;
import java.util.Set;

public class StringMap implements Map<String, String>, Iterable<String>,
		Iterator<String> {
	private static final int GROW_COUNT = 4;
	private String[] keys = new String[GROW_COUNT];
	private String[] values = new String[GROW_COUNT];
	int index = 0;
	int size = GROW_COUNT;
	int cursor = 0;

	public StringMap() {

	}

	@Override
	public int size() {

		return size;
	}

	@Override
	public boolean isEmpty() {

		return size == 0;
	}

	@Override
	public boolean containsKey(Object key) {
		for (String key1 : keys) {
			if (key1.equals(key)) {
				return true;
			}
		}
		return false;
	}

	@Override
	public boolean containsValue(Object value) {
		for (String key1 : values) {
			if (key1.equals(value)) {
				return true;
			}
		}
		return false;
	}

	@Override
	public String get(Object key) {

		for (int i = 0; i < index; i++) {
			if (keys[i].equals(key))
				return values[i];
		}
		return "";
	}

	@Override
	public String put(String key, String value) {

		if (index == size) {
			size += GROW_COUNT;
			keys = Arrays.copyOf(keys, size);
			values = Arrays.copyOf(values, size);
		}

		keys[index] = key;
		values[index] = value;

		return value;
	}

	@Override
	public String remove(Object key) {
		return "";
	}

	@Override
	public void putAll(Map<? extends String, ? extends String> m) {

	}

	@Override
	public void clear() {

	}

	@Override
	public Set<String> keySet() {

		return null;
	}

	@Override
	public Collection<String> values() {

		return null;
	}

	@Override
	public Set<java.util.Map.Entry<String, String>> entrySet() {

		return null;
	}

	@Override
	public Iterator<String> iterator() {

		return this;
	}

	@Override
	public boolean hasNext() {

		return cursor < index;
	}

	@Override
	public String next() {

		return values[cursor++];
	}

	@Override
	public void remove() {
		// TODO Auto-generated method stub

	}

}
