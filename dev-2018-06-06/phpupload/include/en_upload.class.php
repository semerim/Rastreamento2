<?php
class upload
{
	// class variable
	
	var $file_permitted;	// array MIME type of the permetted file
	var $archive_dir;		// upload directory	
	var $max_filesize;		// max size of file upload
	
	// constructor 
	// input:   $max_fil   = max size of file upload					default -> 300 kbyte
	//			$file_perm = array with mime/type of files to upload	default -> jpg, png, gif
	//			$arc_dir   = destination dir of the upload file			default -> ditectory corrente
	
	function upload ( $file_perm , $max_fil = 300000, $arc_dir = ".." )
	{
		if ( empty ($file_perm) ) $file_perm = array ("image/pjpeg","image/x-png","image/jpeg","image/png");
		
		$this->file_permitted = $file_perm; // set mime/type of files to upload
		
		$this->max_filesize = $max_fil; // set max size of file upload
		
		$this->archive_dir = $arc_dir;  // set destination dir of the upload file
	}
	
	// upload method
	// input: $file	= name of the FILE filed on the FORM
	
	function putFile ( $file )
	{
		$userfile_type = strtok ( $_FILES[$file]['type'], ";"); // clear file type:  MIME TYPE
		$userfile_name = $_FILES[$file]['name']; // set the original file name
		$userfile_size = $_FILES[$file]['size']; // set the file uploaded dimension
		$userfile = $_FILES[$file]['tmp_name'];  // file uploaded in the temp dir
		
		$error = "This file type is not permitted: $userfile_type<br>"; // set the error message
		
		// if the file is in the list of MIME TYPE permetted
        // set the error to empty string
		
		$file_permitted = $this->file_permitted;
		
		foreach ( $file_permitted as $permitted )
        {
			if ( $userfile_type == $permitted ) $error = "";
        }
		
		// if filesize is <= 0 or  > $max_filesize
        // set the error message
        if ( ($userfile_size <= 0) || ($userfile_size > $this->max_filesize) ) $error = "File size error: $userfile_size Kb.<br>";
		
		// if no error occured, start coping file
        if ( $error == "" )
        {

			$filename = basename ($userfile_name); // extract file name

            if (!empty ($this->archive_dir) ) 
				$destination = $this->archive_dir."/".$filename; // full destination path to images dir
			else 
				$destination = $filename; // full destination path to images dir

            // check id a fale eith the same name exist
			// if exist, add a random number to the file name
			if ( file_exists($destination) )
            {
            	srand((double)microtime()*1000000); // random number inizializzation
            	$filename = rand(0,20000).$filename; // add number to file name
            	if (!empty ($this->archive_dir) ) 
					$destination = $this->archive_dir."/".$filename; // full destination path to images dir
				else 
					$destination = $filename; // full destination path to images dir
            }

			// Do some additional checks
			if(!is_uploaded_file($userfile)) die ("File $userfile_name is not uploaded correctly.");
	  
			// copy file to temp dir to destination fir and removee the temp file
	  
			if ( !@move_uploaded_file ($userfile,$destination) ) die ("Impossible to copy $userfile_name from $userfile to destination directory.");

			return $destination; // return the full path of the file on file system of the server 
		}
		else
        {
        	echo $error;
			return false;
        }

	}
	

	// check to see what version (if any) of the gd libraries are installed
	function chkgd2()
	{
		$testGD = get_extension_funcs("gd"); // Grab function list
		if (!$testGD) 
		{ 
			echo "GD not even installed."; 
			return false; 
		}
		else
		{
			ob_start(); // Turn on output buffering
			phpinfo(8); // Output in the output buffer the content of phpinfo
			$grab = ob_get_contents(); // Grab the buffer
			ob_end_clean(); // Clean (erase) the output buffer and turn off output buffering 
			
			$version = strpos  ($grab,"2.0 or higher"); // search for string '2.0 or higher'
			if ( $version ) return "gd2"; // if find the string return gd2
			else return "gd"; // else return "gd"
		}
	}	
	
	// resize method
	
	function resize_jpeg( $image_file_path, $new_image_file_path, $max_width=480, $max_height=1600 )
	{

    	$return_val = 1;

    	// create new image

    	if(eregi("\.png$",$image_file_path)) // if is a png
    	{
			$return_val = ( ($img = ImageCreateFromPNG ( $image_file_path )) && $return_val == 1 ) ? "1" : "0";
    	}

    	if(eregi("\.(jpg|jpeg)$",$image_file_path)) // if is a jpg
    	{
    		$return_val = ( ($img = ImageCreateFromJPEG ( $image_file_path )) && $return_val == 1 ) ? "1" : "0";
    	}

    	$FullImage_width = imagesx ($img);    // original width
    	$FullImage_height = imagesy ($img);    // original width

    	// now we check for over-sized images and pare them down
    	// to the dimensions we need for display purposes
    	$ratio =  ( $FullImage_width > $max_width ) ? (real)($max_width / $FullImage_width) : 1 ;
    	$new_width = ((int)($FullImage_width * $ratio));    //full-size width
    	$new_height = ((int)($FullImage_height * $ratio));    //full-size height

    	//check for images that are still too high
    	$ratio =  ( $new_height > $max_height ) ? (real)($max_height / $new_height) : 1 ;
    	$new_width = ((int)($new_width * $ratio));    //mid-size width
    	$new_height = ((int)($new_height * $ratio));    //mid-size height

    	// --Start Full Creation, Copying--
    	// now, before we get silly and 'resize' an image that doesn't need it...
    	if ( $new_width == $FullImage_width && $new_height == $FullImage_height ) copy ( $image_file_path, $new_image_file_path );
	
		// check to see if gd2+ libraries are compiled with php
		
		$gd_version = ( $this->chkgd2() );
		
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

    	// --End Creation, Copying--

    	return ($return_val) ? TRUE : FALSE ;

	}
	
	// thumbnail creation
	// input:   $image_path = path to image to resize
	//			$path 		= destination dir of the thumbnails
	//			$larghezza  = thumbnails witdh 							default -> 80 pixel
	//			$altezza  	= thumbnails height 						default -> 80 pixel
	// 			$pre_name   = pre file string for thumbs				default -> "thumb_"
			
	function miniatura ( $image_path, $path, $larghezza=80, $altezza=80, $pre_name="thumb_" )
	{
		if ( (eregi("\.png$", $image_path) || eregi("\.(jpg|jpeg)$", $image_path)) && $image_path )
        {
			$image_name = basename ( $image_path );
            
			if (!empty ($path) ) 
				$thumb_path = $path."/".$pre_name.$image_name; // complete path to thumbnail dir
			else 
				$thumb_path = $pre_name.$image_name; // complete path to thumbnail dir
			
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
		} // end while
		
		$path = str_replace ( $file_name, "", $completePath );
		$filePath[path] = $path; 
		$filePath[filename] = $file_name; 
		
		return $filePath;
	}		
}
?>