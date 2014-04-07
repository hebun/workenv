package org.nule.lighthl7lib.hl7;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.Socket;
import java.net.UnknownHostException;

import com.sun.corba.se.impl.orbutil.threadpool.TimeoutException;

public class Hl7Connection
{

	int port;
	String server;
	Socket socket = null ,getSocket = null;
	BufferedReader input;
	InputStreamReader inputStream = null;
	PrintWriter output = null;
	private static final int second = 1000;
	private int timeOut;
	int localPort = 0;

	public Hl7Connection() throws UnknownHostException, IOException
	{
		timeOut = 4 * second;
		Options option = new Options("options.xml");
		server = option.getServer();
		port = option.getOutPort();
		socket = new Socket(server, port);
		//System.out.println("local port:" + socket.getLocalPort());
		localPort = socket.getLocalPort();
		// getSocket = new Socket(server, localPort);
		socket.setSoTimeout(timeOut);

		try
		// creating writer
		{
			output = new PrintWriter(socket.getOutputStream(), true);
		} catch (IOException e1)
		{
			//System.out.println("outPut yarat�lamad�:");
			e1.printStackTrace();
			return;
		}
		try
		{
			inputStream = new InputStreamReader(socket.getInputStream());

		} catch (IOException e)
		{
			//System.out.println("inputStream yaratılamadı:");
			e.printStackTrace();
			return;
		}
		input = new BufferedReader(inputStream);

	}

	public void send(String message) throws CustomException
	{
		if (!isOpen())
		{
			throw new CustomException("Socket Kapalı!");

		}
		output.print(message);
		output.flush();

	}

	AboutDialog dialog;

	public void close()
	{
		try
		{
			output.close();
			socket.close();
		} catch (IOException e)
		{
		//	System.out.println("socket kapatılamadı");
			e.printStackTrace();
		}
	}

	public boolean isOpen()
	{
		if (socket == null)
			return false;

		return !socket.isClosed();
	}

	public String readACK() throws IOException, TimeoutException
	{
		String message = "";

		// reading ack
		while (true)
		{
			int get = 0;
			get = input.read();

			char ch = (char) get;

			message += ch;
			if (ch == 0x1C)
			{
				break;
			}
		}

		return message;
	}

}
