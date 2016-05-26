import java.lang.*;
import java.util.*;
import java.text.*;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;


public class ActualizaContainer
{
	 public static int peso=0;

	private static Object lock = new Object();

	public static void actualizar_datos(){
		synchronized(lock){
			if(peso==100)peso=0;
			else peso=peso+1;
			try{incrementa(peso);}catch(Exception e){};
				System.out.println("Esperando para actualizar de nuevo.");
			
			try{Thread.sleep(10000);}catch(Exception e){};
		}
	}


	public static void incrementa(int i) throws MalformedURLException, IOException 
	{
      String cad = "http://api.thingspeak.com/update?key=AY03WD9G95YQN9LF&field1="+i;
      System.out.println("Peso: "+peso);
      URL url = new URL(cad);
      URLConnection con = url.openConnection();
 	
      BufferedReader in = new BufferedReader(
         new InputStreamReader(con.getInputStream()));
 
   	}


	public static void main(String[] args)  throws Exception{
		for(;;){
			actualizar_datos();
		}
			
	}

}
