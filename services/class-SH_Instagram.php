<?php
/**
 * SH_Instagram Class
 * @author 		Sarah Henderson
 * @date			2013-12-26
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
// widget class
class SH_Instagram extends SH_Social_Service {
	
	public function __construct($newWindow, $imageSet, $settings) {
		parent::__construct($newWindow, $imageSet, $settings);
		$this->service = "Instagram";
	}

	
	public function shareButton($url, $title = '', $showCount = false) {
		return '';
	}
	
	public function linkButton($username) {
		
		$url = "http://instagram.com/$username";
		$html = '<a class="' . $this->cssClass() 
				. '" href="'. $url. '" ' 
				. ($this->newWindow ? 'target="_blank"' : '') 
				. '>';
	
		$html .= $this->buttonImage();	
		
		$html .= '</a>';
	
		return $html;
	}
	
	public static function canShare() {
		return false;	
	}

	public static function description() {
		return "Hint: instagram.com/<strong>user-id</strong>";	
	}

}

?>