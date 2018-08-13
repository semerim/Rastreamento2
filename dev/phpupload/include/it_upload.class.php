<?php
class upload
{
	// dichiarazione variabili interne
	
	var $file_permitted;	// array MIME type dei file da uploadare
	var $archive_dir;		// directory dove uploadare i file	
	var $max_filesize;		// dimensione massima dei file
	
	// costruttore 
	// accetta: $max_fil   = la dimensione massima del file da caricare		default -> 300 kbyte
	//			$file_perm = array con i mime/type dei i file da caricare	default -> jpg, png
	//			$arc_dir   = la directory di destinazione dei file			default -> ditectory corrente
	
	function upload ( $file_perm , $max_fil = 300000, $arc_dir = ".." )
	{
		if ( empty ($file_perm) ) $file_perm = array ("image/pjpeg","image/x-png","image/jpeg","image/png");
		
		$this->file_permitted = $file_perm; // file accettati per l'upload.
		
		$this->max_filesize = $max_fil; // setta dimensione massima del file
		
		$this->archive_dir = $arc_dir;  // setta directory dove verranno depositati i file 
	}
	
	// metodo per fare l'upload
	// accetta: $file	= nome del campo file nel form di upload
	
	function putFile ( $file )
	{
		$userfile_type = strtok ( $_FILES[$file]['type'], ";"); // pulisce da quello che non serve il MIME TYPE
		$userfile_name = $_FILES[$file]['name']; // setta il nome originale del file
		$userfile_size = $_FILES[$file]['size']; // setta la dimensione del file caricato
		$userfile = $_FILES[$file]['tmp_name'];  // file caricato nella directory temporanea
		
		$error = "Impossibile caricare questo tipo di file: $userfile_type<br>"; // setta il messaggio di errore all'inizio
		
		// se trova il file tra i tipi MIME permessi
        // setta l'errore a stringa vuota
		
		$file_permitted = $this->file_permitted;
		
		foreach ( $file_permitted as $permitted )
        {
			if ( $userfile_type == $permitted ) $error = "";
        }
		
		// se la dimensione è minore di 0 o maggiore di $max_filesize
        // assigna alla stringa di errore il messaggio di dimensione errata
        if ( ($userfile_size <= 0) || ($userfile_size > $this->max_filesize) ) $error = "Dimensione errata: $userfile_size Kb.<br>";
		
		// se non ci sono errori puoi proseguire
        if ( $error == "" )
        {

			$filename = basename ($userfile_name); // estrae il nome del file

			if (!empty ($this->archive_dir) ) 
				$destination = $this->archive_dir."/".$filename; // percorso completo di destinazione del file
			else 
				$destination = $filename; // percorso completo di destinazione del file
			
            // controlla se un file con quel nome esiste gia'
			// in caso positivo inserisce un numero casuale all'inizio del file
			if ( file_exists($destination) )
            {
            	srand((double)microtime()*1000000); // inizializza generatore numeri casuali
            	$filename = rand(0,20000).$filename; // aggiunge numero casuale al nome del file
				if (!empty ($this->archive_dir) ) 
					$destination = $this->archive_dir."/".$filename; // percorso completo di destinazione del file
				else 
					$destination = $filename; // percorso completo di destinazione del file
            }

			// esegue alcuni controlli
			if(!is_uploaded_file($userfile)) die ("Il file $userfile_name non &egrave; stato caricato correttamente.");
	  
			// copia il file dalla dir temporanea a quella definitiva
	  
			if ( !@move_uploaded_file ($userfile,$destination) ) die ("Impossibile copiare $userfile_name da $userfile alla directory di destinazione.");

			return $destination; // restutisce il percorso completo del file nel file sistem del server
		}
		else
        {
        	echo $error;
			return false;
        }

	}
	
	// funzuione che controlla la versione delle librerie GD
	function chkgd2()
	{
		$testGD = get_extension_funcs("gd"); // cattura la lista delle funzioni della GD
		if (!$testGD) 
		{ 
			echo "GD not even installed."; 
			return false; 
		}
		else
		{
			ob_start(); // Inizializza il reindirizzamento dell'output verso il buffer
			phpinfo(8); // lancia il php info
			$grab = ob_get_contents(); // cattura il contenuto dell buffer in una variabile
			ob_end_clean(); // pulisce il buffer e termina il reindirizzamento
			
			$version = strpos  ($grab,"2.0 or higher"); // cerca la scringa '2.0 or higher'
			if ( $version ) return "gd2"; // se la trova restituisce gd2
			else return "gd"; // altrimenti restituisce "gd"
		}
	}	
	// metodo interno per il resize
	
	function resize_jpeg( $image_file_path, $new_image_file_path, $max_width=480, $max_height=1600 )
	{

    	$return_val = 1;

    	// crea una nuova immagine

    	if(eregi("\.png$",$image_file_path)) // se e' un png
    	{
			$return_val = ( ($img = ImageCreateFromPNG ( $image_file_path )) && $return_val == 1 ) ? "1" : "0";
    	}

    	if(eregi("\.(jpg|jpeg)$",$image_file_path)) // se e' un jpg
    	{
    		$return_val = ( ($img = ImageCreateFromJPEG ( $image_file_path )) && $return_val == 1 ) ? "1" : "0";
    	}

    	$FullImage_width = imagesx ($img);    // larghezza originale immagine
    	$FullImage_height = imagesy ($img);    // altezza originale immagine

    	// Contolla la dimensione dell'immagine e crea le nuove dimensioni
    	$ratio =  ( $FullImage_width > $max_width ) ? (real)($max_width / $FullImage_width) : 1 ;
    	$new_width = ((int)($FullImage_width * $ratio));    //Larghezza massima
    	$new_height = ((int)($FullImage_height * $ratio));    //Altezza massima

    	// Controllo per immagini ancora troppo grandi
    	$ratio =  ( $new_height > $max_height ) ? (real)($max_height / $new_height) : 1 ;
    	$new_width = ((int)($new_width * $ratio));    //Larghezza media
    	$new_height = ((int)($new_height * $ratio));    //Altezza media

    	// --Inizio crezione, copia--
    	// prima di ridimensionare un'immagine se non e' necessario...
    	if ( $new_width == $FullImage_width && $new_height == $FullImage_height ) copy ( $image_file_path, $new_image_file_path );
		
		// Se sono installate le librerie GD2+ usa la funzione di resampled per migliori miniature
		
		$gd_version = $this->chkgd2();
		
		if ( $gd_version == "gd2" ) 
		{		
    		$full_id =  ImageCreateTrueColor ( $new_width , $new_height ); //Crea un'immagine
    		ImageCopyResampled ( $full_id, $img, 0,0,0,0, $new_width, $new_height, $FullImage_width, $FullImage_height );
		}
		elseif ( $gd_version == "gd" )
		{		
    		$full_id = ImageCreate ( $new_width , $new_height ); //Crea un'immagine
    		ImageCopyResized ( $full_id, $img, 0,0,0,0, $new_width, $new_height, $FullImage_width, $FullImage_height );
		}		
		
		else "GD Image Library is not installed.";
		
		
    	if(eregi("\.(jpg|jpeg)$",$image_file_path))
    	{
    		$return_val = ( $full = ImageJPEG( $full_id, $new_image_file_path, 80 ) && $return_val == 1 ) ? "1" : "0";
    	}

    	if(eregi("\.png$",$image_file_path))
    	{
			$return_val = ( $full = ImagePNG( $full_id, $new_image_file_path ) && $return_val == 1 ) ? "1" : "0";
    	}

    	ImageDestroy( $full_id );

    	// --Fine creazione, copia--

    	return ($return_val) ? TRUE : FALSE ;

	}
	
	// crea la miniatura
	// accetta: $image_path = percorso verso l'immagine dalla quale creare la miniatura
	//			$path 		= percorso della cartella di destinazione delle miniature
	//			$larghezza  = larghezza (in pixel) della miniatura							default -> 80 pixel
	//			$altezza  	= altezza (in pixel) della miniatura							default -> 80 pixel
	// 			$pre_name   = stringa da anteporre al nome del file							default -> "thumb_"
			
	function miniatura ( $image_path, $path, $larghezza=80, $altezza=80, $pre_name="thumb_" )
	{
		if ( (eregi("\.png$", $image_path) || eregi("\.(jpg|jpeg)$", $image_path)) && $image_path )
        {
			$image_name = basename ( $image_path );
            
			if (!empty ($path) ) 
				$thumb_path = $path."/".$pre_name.$image_name; // percorso completo di destinazione del file
			else 
				$thumb_path = $pre_name.$image_name; // percorso completo di destinazione del file
            
			if ( $this->resize_jpeg($image_path, $thumb_path, $larghezza, $altezza) ) return $thumb_path;
			else return "Errore nella creazione della miniatura<BR>";
		}
        elseif ($image_path) return "Impossibile creare la Miniatura da questo tipo di file<BR>";
		elseif ($send && $image_path) return "<font face=\"Verdana\" size=\"2\" color=\"red\"><b>Errore nel caricamento dell''immagine $cont</b></font><br>";	
	}
	
	function splitFilePath ( $completePath = "null/null" ) {
		
		$filePath = array ( path=>"", filename=>"" ) ;
		$tok = strtok($completePath,"/");
		
		while ($tok) {
			$file_name = $tok;
    		$tok = strtok("/");
		} // fine while
		
		$path = str_replace ( $file_name, "", $completePath );
		$filePath[path] = $path; 
		$filePath[filename] = $file_name; 
		
		return $filePath;
	}	
}
?>