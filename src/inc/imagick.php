
<?php
try
{


	$url = "http://mytestsite.tk/imagick/output/watermark.png";
	$tmp = download_url( $url );
	//$post_id = ;
	$desc = "Test test test test";

	// Set variables for storage
	// fix file filename for query strings
	preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $file, $matches);
	$file_array['name'] = basename($matches[0]);
	$file_array['tmp_name'] = $tmp;

	// If error storing temporarily, unlink
	if ( is_wp_error( $tmp ) ) {
		@unlink($file_array['tmp_name']);
		$file_array['tmp_name'] = '';
	}

	// do the validation and storage stuff
	$id = media_handle_sideload( $file_array, $post_id, $desc );

	// If error storing permanently, unlink
	if ( is_wp_error($id) ) {
		@unlink($file_array['tmp_name']);
		return $id;
	}

	$src = wp_get_attachment_url( $id );
	
	/*
    $image = 'http://gundambuilder.com/wp-content/uploads/2014/04/temp-gundam-age-1-normal.jpg';
	$overlay = new Imagick('images/overlay-effect.png');
	$over = new Imagick('images/temp2.png');
	$over2 = new Imagick('images/temp3.png');
	$over3 = new Imagick('images/temp4.png');
	$logo = new Imagick('images/gb-logo.png');
	
	$logo->resizeImage(200,0,Imagick::FILTER_LANCZOS,1);
	
	
    $im = new Imagick();
	

    $im->readImage( $image );
	$im->setSize(960,540);
	$im->resizeImage(960,0,Imagick::FILTER_LANCZOS,1);
	$im->cropImage(960, 540, 0, 0);
	$im->setImagePage(960, 540, 0, 0);
	
    $draw = new ImagickDraw();

	$im->compositeImage($overlay, Imagick::COMPOSITE_DEFAULT, 0, 0);
	$im->compositeImage($over, Imagick::COMPOSITE_DEFAULT, 0, 0);
	$im->compositeImage($over2, Imagick::COMPOSITE_DEFAULT, 120, 0);
	$im->compositeImage($over3, Imagick::COMPOSITE_DEFAULT, 180, 0);
	$im->compositeImage($logo, Imagick::COMPOSITE_DEFAULT, 750, 0);
	
    $draw->setFont( "BebasNeue-Bold.ttf" );
    $draw->setFontSize( 90 );
    $draw->setFillAlpha( 0.8 );
    $draw->setGravity( imagick::GRAVITY_SOUTHWEST );
	
	

	  $x = 0;
	  $y = 90;
	  $angle = 0;
	  $lineheight = 75;
	  $str = "GUNDAM HEAVY ARMS CUSTOM";
	  $str = wordwrap($str, 18,"\n");
	  $str_array = explode("\n",$str);
	  $count=0;
	  foreach(array_reverse($str_array) as $line){
		
		$im->annotateImage( $draw, $x, $y+($lineheight*$count), $angle, $line);
		$count+=1;
	  }
	  
	  
	$draw->setFontSize( 60 );
    $draw->setFillAlpha( 0.5 );
    $draw->setGravity( imagick::GRAVITY_SOUTHWEST );
	$im->annotateImage( $draw, 0, 0, 0, "THE ZERO THREE GUNDAM" );
	
    $im->setImageFormat( "png" );

	
    $im->writeImage( './imagick/imagick.png' );

    echo 'Image Created';
	
	*/
	
	
}
catch(Exception $e)
{
    echo $e->getMessage();
}
?>
