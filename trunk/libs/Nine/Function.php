<?php
/**
 * LICENSE
 * 
 * [license information]
 * 
 * @category   Nine
 * @copyright  Copyright (c) 2011 9fw.org
 * @license    http://license.9fw.org
 * @version    v 1.0 2009-04-15
 * 
 */
class Nine_Function
{
	
	public static function copyFolder($source, $target)
	{
		if ( is_dir( $source ) ) {
			Nine_Folder::mkDirIfNotExist( $target );
			$d = dir( $source );
			while ( FALSE !== ( $entry = $d->read() ) ) {
				if ( $entry == '.' || $entry == '..' ) {
					continue;
				}
				$dest = $source . '/' . $entry; 
				if ( is_dir( $dest ) ) {
					self::copyFolder( $dest, $target . '/' . $entry );
					continue;
				}
				copy( $dest, $target . '/' . $entry );
			}
	 
			$d->close();
		}else {
			copy( $source, $target );
		}
	}
	
	
    public static function arrayChunkFixed($input, $num, $preserveKeys = FALSE) 
    {
    	$count = count ( $input );
    	if ($count) {
    		$input = array_chunk ( $input, ceil ( $count / $num ), $preserveKeys );
    	}
    	$input = array_pad ( $input, $num, array () );
    	return $input;
    }
    
    public static function arrayChunkVertical($array, $num)
    {
        $total   = count($array);
        $minSzie = floor($total * 1 / $num);
        $maxSize = ceil ($total * 1 / $num);
        /**
         * How many columns with max size?
         */
        $countMaxSize = $total - $num * $minSzie;
        
        $result  = array();
        $tmp     = array();
        $pointer = 1;
        for ($i = 1; $i <= $total; $i++) {
            $item = array_shift($array);
            if (null == $item) {
                $item = array();
            }
            $tmp[] = $item;
            if ($countMaxSize > 0 && $pointer % $maxSize == 0 
            || $countMaxSize <= 0 && $pointer % $minSzie == 0
            || $pointer == $total) {
                $result[] = $tmp;
                $tmp      = array();
                $countMaxSize --;
            }
            $pointer++;
        }
        return $result;
    }
    /**
     * Split text with readmore div
     * 
     * @param string $text
     * @return array Array result with 2 elements:
     *   0 => intro text
     *   1 => the rest of text
     */
    public static function splitTextWithReadmore($text)
    {
        
        $regexp = '<div\s[^>]*style="page-break-after: always;?">.*</div>'; 
        $result = preg_split("#{$regexp}#siU", $text, 2);
        
        if(isset($result[1])) {
            /**
             * Remove many readmore div
             */
            $result[1] = @preg_replace("#{$regexp}#siU", ' ', $result[1]);
            return $result;
        } else {
            return array(
                0 => null,
                1 => @$result[0]
            );
        }
    }
    /**
     * Combine intro text and full text with readmove div
     * 
     * @param string $introText
     * @param string $fullText
     * 
     * @return string
     */
    public static function combineTextWithReadmore($introText, $fullText)
    {
		if (null == trim($introText)) {
			return $fullText;
		}
        return  $introText 
                . ' <div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>'
                . $fullText;
    }
    
    public static function subStringAtBlank ($string, $max = 50, $endString = '...') 
    { 
        /**
         * Detect string encoding
         */
        $encoding = mb_detect_encoding ($string);
        /**
         * Short string
         */
        if (mb_strlen($string, $encoding) <= $max) {
            return $string; 
        }
        /**
         * Long string
         */
        /**
         * Sub string
         */
        $newString = mb_substr($string, 0, $max, $encoding);
        if (' ' == $string{strlen($newString)}) {
            return $newString;
        }
        /**
         * Find last blank position
         */
        return trim(substr($newString, 0, strrpos($newString, ' '))) . $endString; 
    } 
    
//    public static function getImageFromHtml($text) 
////    {
//        $match = array();
//        $regexp = "<img\s[^>]*src=(\"??)([^\" >]*?)\\1[^>]*>"; 
//        preg_match("/$regexp/siU", $text, $match);
//        return @$match[2];
//    }
//    
        
    /**
     * Create thubnail image
     * 
     * If there is no exsiting thumbnail image, new thubnal image will be created
     * If no width or height is determined, default thumbnail image will be returned
     * 
     * 
     * @param string $source             Path of full image path from project directory. Example: "media/userfiles/images/..." 
     * @param int    $thumbWidth         The width of thumbnail image. If $width is null, the ratio will be keep 
     * @param int    $thumbHeight        The heigh of thumbnail image. If $height is null, the ratio will be keep
     * @param string $backgroundColor    Background of new image in the case image is changed ratio
     * @param bool   $cropToCenter       If true and $thumbWidth and $thumbHeight are determined,sytem will fill image to center and remove overflow parts
     */
    public static function getThumbImage($source, $thumbWidth = null, $thumbHeight = null, $backgroundColor = '#FFFFFF', $cropToCenter = false)  
    {
        $source = urldecode($source);
        /**
         * Is invalid image?
         */
        if (! is_file($source)) {
            return $source;
        }
        /**
         * Parse the path of new thumbnail image
         */
        if (null == $thumbWidth && null == $thumbHeight) {
            /**
             * Load default config
             */
            include_once 'Nine/Registry.php';
            $config = @Nine_Registry::getConfig('defaultThumbnailImageSize');
            $config = explode('x', $config);
            if (empty($config) || 2 != count($config)) {
                throw new Exception("'defaultThumbnailImageSize'  in config.php file is missing or incorrect.");
            }
            $thumbWidth  = intval($config[0]);
            $thumbHeight = intval($config[1]);
        }
        /**
         * Replace first "images" string by "_thumbs"
         */
        if (null == $backgroundColor) {
            $backgroundColor = '#FFFFFF';
        }
        $extName = '';
        if (true == $cropToCenter) {
            $extName = '/center';
        }
        if ('#FFFFFF' != $backgroundColor) {
            $extName .= '/'. trim($backgroundColor, '#');
        }
        
        /**
         * Ensure we have "/" at the end of $extName
         */
        $extName = rtrim($extName, '/') . '/';
        
        if (false !== strpos($source, 'images')) {
	        $thumbImgPath = "tmp/cache/images/_thumbs/{$thumbWidth}x{$thumbHeight}{$extName}" 
	                      . substr($source, strpos($source, 'images') + 6);
        } else {
        	/**
        	 * Wrong config
        	 */
	        $thumbImgPath = "tmp/cache/images/_thumbs/{$thumbWidth}x{$thumbHeight}{$extName}" 
	                      . substr($source, 16);
        }
        /**
         * Image is exisiting?
         */
        if (is_file($thumbImgPath)) {
            return $thumbImgPath;
        }
        /************************************************************************************
         * Create thumbnail image
         ************************************************************************************/
        /**
         * Create thumbnal dicrectory
         */
        $folderPath = substr($thumbImgPath, 0, strrpos($thumbImgPath, '/'));
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        /**    
         * Detect type of image
         */
        $info = @getimagesize($source);
        $extension = strtolower(@$info['mime']);
        switch ($extension) {
            case 'image/jpeg':
                $imgFromFunc = 'imagecreatefromjpeg';
                $imageFunc   = 'imagejpeg';
                break;
            case 'image/png':
                $imgFromFunc = 'imagecreatefrompng';
                $imageFunc   = 'imagepng';
                break;
            case 'image/gif':
                $imgFromFunc = 'imagecreatefromgif';
                $imageFunc   = 'imagegif';
                break;
            default:
                return $source;
        }
        $img = $imgFromFunc("{$source}");
        /**
         * Load image and get image size
         */
        $width = imagesx($img);
        $height = imagesy($img);
        /**
         * Caculate thumbnail image size
         */
        if (null == $thumbWidth) {
            /**
             * Missing width param
             */
            $thumbWidth = floor($width * ( $thumbHeight / $height ));
        }
        if (null == $thumbHeight) {
            /**
             * Missing height param
             */
            $thumbHeight = floor($height * ( $thumbWidth / $width ));
        }
        /**
         * Calculate scaled image size
         */
        if (true == $cropToCenter && ($width * $thumbHeight) != ($thumbWidth * $height)) {
            /**
             * Crop image to center
             */
            /**
             * Destination image
             */
            $dWidth  = $thumbWidth;
            $dHeight = $thumbHeight; 
            $dstX    = 0;
            $dstY    = 0;
            
            /**
             * Original image
             */
            $orgX    = 0;
            $orgY    = 0;
            $oWidth  = $width;
            $oHeight = floor($thumbHeight * ( $oWidth / $thumbWidth ));
            /**
             * Resized with height
             */
            if ($oHeight > $height) {
                $oWidth = floor($width * ( $height / $oHeight ));
                $oHeight = $height;
            }
            /**
             * Calculate postion
             */
            $orgX = floor(($width - $oWidth)/2); 
            $orgY = floor(($height - $oHeight)/2); 
            /**
             * Valid X,Y
             */
            if ($orgX < 0) {
                $orgX = 0;
            }
            if ($orgY < 0) {
                $orgY = 0;
            }
            
        } else {
            /**
             * Original image
             */
            $orgX    = 0;
            $orgY    = 0;
            $oWidth  = $width;
            $oHeight = $height;
            /**
             * Resized with width
             */
            $dWidth  = $thumbWidth;
            $dHeight = floor($height * ( $thumbWidth / $width ));
            $dstX    = 0;
            $dstY    = 0;
            /**
             * Resized with height
             */
            if ($dHeight > $thumbHeight) {
                $dWidth = floor($thumbWidth * ( $thumbHeight / $dHeight ));
                $dHeight = $thumbHeight;
            }
            /**
             * Calculate postion
             */
            $dstX = floor(($thumbWidth - $dWidth)/2); 
            $dstY = floor(($thumbHeight - $dHeight)/2); 
            /**
             * Valid X,Y
             */
            if ($dstX < 0) {
                $dstX = 0;
            }
            if ($dstY < 0) {
                $dstY = 0;
            }
        }
    
        /**
         * Create temporary image
         */
        $tmpImg = imagecreatetruecolor($thumbWidth, $thumbHeight);
        /**
         * Calculate backgroud color
         */
        $backgroundColor    = trim($backgroundColor, '#');
        $backgroundColor    = str_split($backgroundColor, 2);
        $backgroundColor[0] = @hexdec($backgroundColor[0]);
        $backgroundColor[1] = @hexdec($backgroundColor[1]);
        $backgroundColor[2] = @hexdec($backgroundColor[2]);
        /**
         * Make background color to valid color
         */
        if ($backgroundColor[0] < 0 || $backgroundColor[0] > 255) {
            $backgroundColor[0] = 255;
        }
        if ($backgroundColor[1] < 0 || $backgroundColor[1] > 255) {
            $backgroundColor[1] = 255;
        }
        if ($backgroundColor[2] < 0 || $backgroundColor[2] > 255) {
            $backgroundColor[2] = 255;
        }
    
        if ('image/png' == $extension) {
            $col=imagecolorallocatealpha($tmpImg, $backgroundColor[0], $backgroundColor[1], $backgroundColor[2], 127);
            imagefill($tmpImg,0,0,$col);
            /**
             * Make new thumbnail
             */
            imagecopyresampled($tmpImg, $img, $dstX, $dstY, $orgX, $orgY, $dWidth, $dHeight, $oWidth, $oHeight);
            
            imagealphablending($tmpImg,false);
            imagesavealpha($tmpImg,true);
        } else {
            $col=imagecolorallocatealpha($tmpImg, $backgroundColor[0], $backgroundColor[1], $backgroundColor[2], 0);
            imagefill($tmpImg,0,0,$col);
            /**
             * Make new thumbnail
             */
            imagecopyresampled($tmpImg, $img, $dstX, $dstY, $orgX, $orgY, $dWidth, $dHeight, $oWidth, $oHeight);
        }
        
        /**
         * Save image to file
         */
        if ('image/jpeg' == $extension) {
            $imageFunc($tmpImg, "{$thumbImgPath}", 100);
        } else {
            
            $imageFunc($tmpImg, "{$thumbImgPath}");
        }
        
        return $thumbImgPath;
    }
    
    public static function cropImage($source, $thumbWidth = 2000) 
    {
        $source = urldecode($source);
        /**
         * Is invalid image?
         */
        if (! is_file($source)) {
            return $source;
        }
        $info = getimagesize($source);
        if ($thumbWidth >= $info[0]) {
            return $source;
        }
    
        $extension = strtolower($info['mime']);
        switch ($extension) {
            case 'image/jpeg':
                $imgFromFunc = 'imagecreatefromjpeg';
                $imageFunc   = 'imagejpeg';
                break;
            case 'image/png':
                $imgFromFunc = 'imagecreatefrompng';
                $imageFunc   = 'imagepng';
                break;
            case 'image/gif':
                $imgFromFunc = 'imagecreatefromgif';
                $imageFunc   = 'imagegif';
                break;
            default:
                return $source;
        }
        $img = $imgFromFunc("{$source}");
        // load image and get image size
        
        
        $thumbImgPath = "tmp/images/" . microtime() . rand(1, 1000000000) . ".jpg";
    
        $width = imagesx($img);
        $height = imagesy($img);
    
        // calculate thumbnail size
        $newWidth = $thumbWidth;
        $newHeight = floor($height * ( $thumbWidth / $width ));
    
        // create a new temporary image
        $tmpImg = imagecreatetruecolor($newWidth, $newHeight);
        
    
        if ('image/png' == $extension) {
            $col=imagecolorallocatealpha($tmpImg, 255, 255, 255, 127);
            imagefill($tmpImg,0,0,$col);
        }
    
        // copy and resize old image into new image
        imagecopyresampled($tmpImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        // save thumbnail into a file
    
        if ('image/png' == $extension) {
            imagealphablending($tmpImg,false);
            imagesavealpha($tmpImg,true);
        }
        
        /**
         * Save image to tmp file
         */
        if ('image/jpeg' == $extension) {
            $imageFunc($tmpImg, "{$thumbImgPath}", 100);
        } else {
            
            $imageFunc($tmpImg, "{$thumbImgPath}");
        }
        
        if (is_file("{$thumbImgPath}") && filesize("{$thumbImgPath}") >= 100) {
            copy("{$thumbImgPath}", "{$source}");
            unlink("{$thumbImgPath}");
        }
        return $source;
    }

    /**
     * Return image path from project folder
     * 
     * @param string $path
     * 
     * @example 
     * "/<your_project>/media/userfiles/images/example.jpg" >> "media/userfiles/images/example.jpg"
     * 
     * "http://<livesite>/media/userfiles/images/example.jpg" >> "media/userfiles/images/example.jpg"
     */
    public static function getImagePath($path)
    {
    	$relativePath = '';
    	if("http" == @substr($path,0,4)) {
    		$liveSite = rtrim(Nine_Registry::getConfig('liveSite'),'/ ').'/';
    		$relativePath = urldecode(substr($path, strlen($liveSite)));
    	}
    	else {
    		$relativePath = urldecode(substr($path, strlen(Nine_Registry::getBaseUrl())));
    	}
    	return $relativePath;
    }
    /**
     * Get Youtube link what used for embed video
     * 
     * @param string 
     * 
     * @example 
     * "http://www.youtube.com/watch?v=ABCDE&feature=channel" >> "http://www.youtube.com/v/ABCDE"
     */
    public static function getYoutubeLink($link)
    {
        //http://www.youtube.com/watch?v=EVBsypHzF3U&feature=channel
        $pos = strpos($link, 'v=');
        if (false === $pos) {
            return '';
        }
        $link = substr($link, $pos + 2);
        $link = explode('&', $link);
        $link = current($link);
        return "http://www.youtube.com/v/{$link}";
    }
	/**
	 * Get download link
	 * 
	 * @param string $link
	 * 
	 * @return string Link to download module
	 */
    public static function getDownloadLink($link)
    {
//        return Nine_Registry::getBaseUrl() . 'download/index/index/f/' . base64_encode($link);
		return Nine_Registry::getConfig('liveSite') . 'download/index/index/f/' . base64_encode($link);	
    }
    
	/**
	 * Get preview file link
	 * 
	 * @param string $link
	 * 
	 * @return string Link to download module
	 */
    public static function getPreviewFileLink($link)
    {
		return Nine_Registry::getConfig('liveSite') . 'download/index/preview/f/' . base64_encode($link);	
    }
    
}