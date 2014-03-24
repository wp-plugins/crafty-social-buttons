<?php
/**
 * SH_Flickr Class
 * @author 		Sarah Henderson
 * @date			2013-07-07
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
// widget class
class SH_Flickr extends SH_Social_Service {
	
	public function __construct($newWindow, $imageSet, $settings) {
		parent::__construct($newWindow, $imageSet, $settings);
		$this->service = "Flickr";
	}

	
	public function shareButton($url, $title = '', $showCount = false) {
		return '';
	}
	
	public function linkButton($username) {
		
		if (strpos($username, 'http://') === 0) {
			$url = $username;
		} else {
			$url = "http://flickr.com/photos/$username";
		}
		$html = '<a class="' . $this->cssClass() . '" href="'. $url. '" ' . 
						($this->newWindow ? 'target="_blank"' : '') . '>';
	
		$html .= $this->buttonImage();	
		
		$html .= '</a>';
	
		return $html;
	}
	
	public static function canShare() {
		return false;	
	}

	public static function description() {
		return "Hint: flickr.com/photos/<strong>user-id</strong> (numbers and letters)";	
	}
}

?>