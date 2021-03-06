package com.betfair.aping;

import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.HashSet;
import java.util.Hashtable;
import java.util.List;
import java.util.Properties;
import java.util.Set;
import java.util.logging.ConsoleHandler;
import java.util.logging.Logger;

import tempobet.Tempobet;

import com.betfair.aping.api.ApiNgJsonRpcOperations;
import com.betfair.aping.entities.EventResult;
import com.betfair.aping.entities.MarketBook;
import com.betfair.aping.entities.MarketCatalogue;
import com.betfair.aping.entities.MarketFilter;
import com.betfair.aping.entities.PriceProjection;
import com.betfair.aping.entities.PriceSize;
import com.betfair.aping.entities.Runner;
import com.betfair.aping.enums.MarketBettingType;
import com.betfair.aping.enums.MarketProjection;
import com.betfair.aping.enums.MarketSort;
import com.betfair.aping.enums.PriceData;
import com.betfair.aping.exceptions.APINGException;
import com.betfair.aping.util.DataTable;
import com.betfair.aping.util.Jdbc;
import com.betfair.aping.util.JdbcLong;
import com.betfair.aping.util.LogFormatter;

public class ApiNGDemo {
	// market book. get prices
	private static Properties prop = new Properties();
	private static String applicationKey;
	private static String sessionToken;
	private static boolean debug;
	public static Logger LOGGER = Logger.getLogger(ApiNGDemo.class.getName());
	private static boolean started = false;
	static boolean fetchBookProcess = false;
	public static ApiNgJsonRpcOperations jsonOperations;

	public static void Main() {
		LOGGER = Logger.getLogger(ApiNGDemo.class.getName());
		jsonOperations = ApiNgJsonRpcOperations.getInstance();

		applicationKey = "5DWDmqno4izTvPPf";
		sessionToken = "pGOPkmXqer0TmWdILg1YsgfdPRSUI1sc2HHpHyDujfc=";
		started = true;

		try {
			InputStream in = ApiNGDemo.class
					.getResourceAsStream("/apingdemo.properties");
			prop.load(in);
			in.close();
			LOGGER.setUseParentHandlers(false);
			debug = new Boolean(prop.getProperty("DEBUG"));
			ConsoleHandler consoleHandler = new ConsoleHandler();
			consoleHandler.setFormatter(new LogFormatter());
			LOGGER.addHandler(consoleHandler);
			;

		} catch (IOException e) {
			System.out.println("Error loading the properties file: "
					+ e.toString());
		}

	}

	/**
	 * 
	 */
	public static void fetchMarketBook() {
		if (false == started)
			Main();

		if (fetchBookProcess) {
			LOGGER.info("fetchbook in progress");
			return;
		}
		fetchBookProcess = true;
		LOGGER.info("fetchbook started");
		Tempobet.getWeekend();
		fetchEvents();
		fetchMarkets();

		// System.exit(0);
		JdbcLong.say = 0;

		try {
			MarketFilter filter = new MarketFilter();
			Set<String> eventTypeIds = new HashSet<String>();
			eventTypeIds.add("1");
			filter.setEventTypeIds(eventTypeIds);

			Set<MarketProjection> marketProjection = new HashSet<MarketProjection>();
			marketProjection.add(MarketProjection.EVENT);

			JdbcLong.start("fetchMarketbokk");

			// marketIds.add("1.113291175");
			PriceProjection priceProjection = new PriceProjection();
			HashSet<PriceData> hashSet = new HashSet<PriceData>();
			hashSet.add(PriceData.EX_BEST_OFFERS);
			priceProjection.setPriceData(hashSet);

			List<Hashtable<String, String>> list = JdbcLong
					.select("select m.externId as externId,m.eventId as eventId from `market` as m inner join `match` as ma on ma.externId=m.eventId"
							+ " where ma.tarih>now() and m.name like  '%Match Odds%'");

			List<String> marketIds = new ArrayList<String>();
			Hashtable<String, String> marketEvent = new Hashtable<String, String>();
			// marketIds.add("1.113308255");
			LOGGER.info("started to fetch marketbooks for " + list.size()
					+ " marketcatalogues");
			int k = 0;
			for (Hashtable<String, String> h : list) {

				marketIds.add(h.get("externId"));
				marketEvent.put(h.get("externId"), h.get("eventId"));
				if (k++ % 20 == 0) {
					List<MarketBook> result = jsonOperations.listMarketBook(
							marketIds, priceProjection, null, null, null,
							applicationKey, sessionToken);

					for (MarketBook book : result) {
						int j = 0;
						String update = "update `match` set ";
						int topOran = 0;
						for (Runner r : book.getRunners()) {
							if (r.getEx().getAvailableToBack().size() <= 0)
								continue;
							PriceSize ps = r.getEx().getAvailableToBack()
									.get(0);
							if (k == 4)
								System.out.println("r.tosting:" + r.toString());
							topOran += (ps.getPrice() * 100);
							if (j == 0) {

								update += " ht='" + (ps.getPrice() * 100)
										+ "',";
							}
							if (j == 1) {
								update += " draw='" + (ps.getPrice() * 100)
										+ "',";
							}
							if (j == 2) {
								update += " at='" + (ps.getPrice() * 100)
										+ "' where externId='"
										+ marketEvent.get(book.getMarketId())
										+ "'";
								if (topOran > 400) {
									JdbcLong.query(update);
									// System.out.print("updated");
								}
							}
							// System.out.print(ps.getPrice().toString() + "-");
							j++;
						}

					}
					System.out.print("*");
					marketIds.clear();
				}
			}

		} catch (APINGException e) {
			System.out.println("error blabla :");
			e.printStackTrace();
		} catch (Exception ex) {
			ex.printStackTrace();
		} finally {

			JdbcLong.close("fetchmarketbook");
		}
		fetchBookProcess = false;
	}

	public static void fetchEvents() {
		if (false == started)
			Main();

		if (!checkCall("EVENTS")) {
			LOGGER.info("not fetching EVENTS");
			return;
		}

		MarketFilter filter = new MarketFilter();
		Set<String> eventTypeIds = new HashSet<String>();
		eventTypeIds.add("1");
		filter.setEventTypeIds(eventTypeIds);
		try {
			List<EventResult> eventResults = jsonOperations.listEvents(filter,
					applicationKey, sessionToken);

			String minsert = EventResult.startInsert();
			int fails = 0;
			for (EventResult eventResult : eventResults) {
				try {
					minsert += eventResult.getInsert() + ",";

				} catch (Exception e) {
					fails++;
					// LOGGER.warning(e.getMessage());

				}
			}
			minsert = minsert.substring(0, minsert.length() - 1);

			JdbcLong.start("fetcEvents");
			LOGGER.info("inserting " + eventResults.size()
					+ " matchs total and " + fails + " fails for betfair");
			JdbcLong.query(minsert);
			JdbcLong.query("insert into betfairupdate(type,tarih) values('EVENTS',NOW())");
			JdbcLong.close("fetchevents");
		} catch (APINGException e) {
			LOGGER.severe(e.getMessage());
			e.printStackTrace();
		}
	}

	public static boolean checkCall(String string) {
		DataTable dataTable = JdbcLong
				.select("select * from betfairupdate where type='" + string
						+ "' and tarih >= DATE_SUB(NOW(),INTERVAL 1 HOUR)");

		return dataTable.size() == 0;

	}

	/**
	 * 
	 */
	public static void fetchMarkets() {
		if (false == started)
			Main();

		if (!checkCall("MARKETS")) {
			LOGGER.info("not fetching MARKETS");
			return;
		}
		try {
			MarketFilter filter = new MarketFilter();
			Set<String> eventTypeIds = new HashSet<String>();

			DataTable events = Jdbc.select("select * from `match` where "
					+ "((`match`.`awayTeam` <> 'xxx') "
					+ "and (`match`.`tarih` > now()) and "
					+ " (`match`.`siteId` = 2))");
			// LOGGER.info(String.valueOf(events.size()));
			// Set<String> eventIds = new HashSet<String>();
			// eventIds.add("27170459");
			eventTypeIds.add("1");
			filter.setEventTypeIds(eventTypeIds);
			Set<MarketBettingType> bettingTypes = new HashSet<MarketBettingType>();
			bettingTypes.add(MarketBettingType.ODDS);

			filter.setMarketBettingTypes(bettingTypes);
			// filter.setEventIds(eventIds);

			JdbcLong.start("fetchMarket");
			Set<String> eventIds = new HashSet<String>();
			Set<MarketProjection> marketProjection = new HashSet<MarketProjection>();
			marketProjection.add(MarketProjection.EVENT);
			int k = 0;
			LOGGER.info("started to fetch markets for " + events.size()
					+ " matches");
			for (Hashtable<String, String> row : events) {

				eventIds.add(row.get("externId"));
				if (k++ % 100 == 0) {

					filter.setEventIds(eventIds);
					List<MarketCatalogue> result = jsonOperations
							.listMarketCatalogue(filter, marketProjection,
									MarketSort.FIRST_TO_START, "1000",
									applicationKey, sessionToken);
					String minsert = MarketCatalogue.startInsert();
					for (MarketCatalogue catalogue : result) {
						minsert += catalogue.getInsert() + ",";
					}
					minsert = minsert.substring(0, minsert.length() - 1);
					JdbcLong.query(minsert);
					System.out.print("#");
					eventIds.clear();
				}
			}
		} catch (Exception e) {
			LOGGER.info("eror");
			e.printStackTrace();
		} catch (APINGException e) {
			e.printStackTrace();
		} finally {
			JdbcLong.query("insert into betfairupdate(type,tarih) values('MARKETS',NOW())");
			JdbcLong.close("fetchmarkets");

		}
	}

	public static Properties getProp() {
		return prop;
	}

	public static boolean isDebug() {
		return debug;
	}
}
