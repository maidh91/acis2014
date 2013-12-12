<?php
/*
	This is PHP file that generates CAPTCHA image for the How to Create CAPTCHA Protection using PHP and AJAX Tutorial

	You may use this code in your own projects as long as this 
	copyright is left in place.  All code is provided AS-IS.
	This code is distributed in the hope that it will be useful,
 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	
	For the rest of the code visit http://www.WebCheatSheet.com
	
	Copyright 2006 WebCheatSheet.com	

*/

//Start the session so we can store what the security code actually is
session_start();

//Send a generated image to the browser 
create_image(); 
exit(); 

function create_image() 
{ 
    
/*	//Let's generate a totally random string using md5 
    $md5_hash = md5(rand(0,999)); 
    //We don't need a 32 character long string so we trim it down to 5 
    $security_code = strtoupper(substr($md5_hash, 15, 5)); 

    //Set the session to store the security code
    $_SESSION["security_code"] = $security_code;

    //Set the image width and height 
    $width = 100; 
    $height = 20;  
	$font_size = $height * 0.75;

    //Create the image resource 
    $image = ImageCreate($width, $height);  

    //We are making three colors, white, black and gray 
    $white = ImageColorAllocate($image, 255, 255, 255); 
    $black = ImageColorAllocate($image, 0, 0, 0); 
    $grey = ImageColorAllocate($image, 140, 140, 140);
	$red= ImageColorAllocate($image, 255, 0, 0);
	//$noise_color = imagecolorallocate($image, 100, 120, 180);
    //Make the background black 
    ImageFill($image, 0, 0, $black); 
    //Add randomly generated string in white to the image
    //ImageString($image, 5, 30, 3, $security_code, $red); 
	//imagestring  ( resource $image  , int $font  , int $x  , int $y  , string $string  , int $color  )

    //Throw in some lines to make it a little bit harder for any bots to break 
/*    ImageRectangle($image,0,0,$width-1,$height-1,$grey); 
    imageline($image, 0, 0, $width, $height, $grey); 
    imageline($image, 0, 0, $width/2, $height, $grey); 
	imageline($image, 0, 0, $width/3, $height, $grey);
	imageline($image, $width, 0, $width/3, $height, $grey);
	imageline($image, $width, 0, $width/2, $height, $grey);
	imageline($image, $width, 0, 0, $height, $grey);
 	imagettftext($image, $font_size, 0, 10, 50, $red, $font , $security_code);
    //Tell the browser what kind of file is come in 
    header("Content-Type: image/jpeg"); 

    //Output the newly created image in jpeg format 
    ImageJpeg($image); 
    
    //Free up resources
    ImageDestroy($image); 
*/
	
	// Set the content-type
	header("Content-type: image/png");
	$font = './monofont.ttf';
	// Create the image
	// $im = imagecreatetruecolor(400, 30);
	$width = 100; 
	$height = 20;  
	$font_size = $height * 0.75;
	$im = imagecreate($width, $height);
	// Create some colors
	$white = imagecolorallocate($im, 255, 255, 255);
	$grey = imagecolorallocate($im, 180, 180, 180);
    $grown = imagecolorallocate($im, 128, 0, 0);
	$black = imagecolorallocate($im, 0, 62, 62);
	$bg = imagecolorallocate($im, 215, 215, 215);
	
	imagefilledrectangle($im, 0, 0, 399, 29, $white);
	
	// The text to draw
	$md5_hash = md5(rand(0,999)); 
	//We don't need a 32 character long string so we trim it down to 6 
	$security_code1 = strtoupper(substr($md5_hash, 15, 3)); 
	$security_code2 = strtoupper(substr($md5_hash, 18, 3));
	
	//Set the session to store the security code
	$_SESSION["captcha"] = $security_code1.$security_code2;
	
	// Add background
	imagettftext($im, 20, 0, 1, 16, $bg, $font, "#######");
	// Add the first 3 letter
	imagettftext($im, 16, -10, 12, 13, $grown, $font, $security_code1);
	// Add the last 3 letter
	imagettftext($im, 16, 20, 45, 20, $black, $font, $security_code2); // rotate 20 degree
	//imagettftext  ( resource $image  , float $size  , float $angle  , int $x  , int $y  , int $color  , string $fontfile  , string $text  )
	
	// Using imagepng() results in clearer text compared with imagejpeg()
	imagepng($im);
	imagedestroy($im);

} 
?>