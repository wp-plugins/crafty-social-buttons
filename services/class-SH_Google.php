<?php
/**
 * SH_Social_Service Class
 * @author 		Sarah Henderson
 * @date			2013-07-07
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
// widget class
class SH_Google extends SH_Social_Service {

	public function __construct($newWindow, $imageSet, $settings) {
		parent::__construct($newWindow, $imageSet, $settings);
		$this->service = "Google";
		$this->imageUrl = $this->imagePath . "google.png";
	}


	public function shareButton($url, $title = '', $showCount = false) {
		
		$html = '<a class="' . $this->cssClass() . '" 
			 href="https://plus.google.com/share?' 
			 . 'url=' . $url  . '" ' 
			 . ($this->newWindow ? 'target="_blank"' : '') . '>';
		
		$html .= $this->buttonImage();	
		
		if ($showCount) {
			$html .= '<span class="crafty-social-share-count">' . $this->shareCount($url) . '</span>';	
		}
	
		$html .= '</a>';
	
		return $html;
	
	}
	
	public function linkButton($username) {
		
		$url = "http://plus.google.com/$username";
		$html = '<a class="' . $this->cssClass() . '" 
		 href="'. $url. '" ' . 
		 ($this->newWindow ? 'target="_blank"' : '') . '>';
	
		$html .= $this->buttonImage();	
		
		$html .= '</a>';
	
		return $html;
	}
	
	public function shareCount($url) {
		  $args = array(
            'method' => 'POST',
            'headers' => array(
                // setup content type to JSON 
                'Content-Type' => 'application/json'
            ),
            // setup POST options to Google API
            'body' => json_encode(array(
                'method' => 'pos.plusones.get',
                'id' => 'p',
                'method' => 'pos.plusones.get',
                'jsonrpc' => '2.0',
                'key' => 'p',
                'apiVersion' => 'v1',
                'params' => array(
                    'nolog'=>true,
                    'id'=> $url,
                    'source'=>'widget',
                    'userId'=>'@viewer',
                    'groupId'=>'@self'
                ) 
             )),
             // disable checking SSL sertificates               
            'sslverify'=>false
        );
     
    // retrieves JSON with HTTP POST method for current URL  
    $response = wp_remote_post("https://clients6.google.com/rpc", $args);
     
    if (is_wp_error($response)){
        // return zero if response is error                             
        return "0";             
    } else {        
        $json = json_decode($response['body'], true);                    
        // return count of Google +1 for requsted URL
        return intval( $json['result']['metadata']['globalCounts']['count'] ); 
    }
	}
}
?>
