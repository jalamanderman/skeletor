<?php
class Page extends SiteTree {

	private static $db = array();

	private static $has_one = array();
	
	public function getCMSFields(){	
		$fields = parent::getCMSFields();		
		return $fields;
	}
	
	/**
	 * Get this model's controller
	 * @return obj
	 */
	public function MyController(){
		$class = $this->ClassName . "_Controller";
		$controller = new $class($this);
		return $controller;
	}
	
}

class Page_Controller extends ContentController {

	private static $allowed_actions = array();

	/**
	 * When we initialize this controller
	 * This happens during the birth of the universe
	 **/
	public function init() {	
		parent::init();
		
		// global compiled javascript
		if( Director::isLive() ){
			Requirements::javascript('site/production/index.min.js');
		}else{
			Requirements::javascript('site/production/index.js');
		}
		
		// global css (compiled scss)
		if( Director::isLive() ){
			Requirements::css('site/production/index.min.css');
		}else{
			Requirements::css('site/production/index.css');
		}
	}

	/**
	 * Get logo set in site config if it exists
	 **/
	function Logo(){
		if ($Logo = SiteConfig::current_site_config()->Logo()){
			return $Logo;
		}
		return false;
	}

	/**
	 * Return image to use in og:image meta tag
	 * Default to site logo if it exists, otherwise return false.
	 *
	 * Override this as needed in page classes to dish up a relevant image.
	 * For instance, a news item may have a featured image, so on
	 * that page class this function could return the featured image.
	 **/
	function OgImage(){
		if ($Image = $this->Logo()){
			return $Image;
		}
		return false;
	}


}