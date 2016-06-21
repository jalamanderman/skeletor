<?php
class Page extends SiteTree {

	private static $db = array();

	private static $has_one = array();
	
	public function getCMSFields(){	
		$fields = parent::getCMSFields();
		
		return $fields;
	}
	
	/**
	 * Get this object's controller
	 * @return obj
	 */
	public function MyController(){
		$class = $this->ClassName . "_Controller";
		$controller = new $class($this);
		return $controller;
	}
	
	function OgImage(){
		return $this->MyController()->OgImage();
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
		
		// global javascript requirements
		Requirements::javascript('site/js/jquery.js');
		Requirements::javascript('site/js/base.js');
		
		// global CSS requirements
		Requirements::css('site/css/main.css');
	}
	
	/**
	 * Set image to use in og:image tag in document head
	 * Returns Logo() set in SiteConfig if it has been set
	 * Return false otherwise
	 */
	function OgImage(){
		if($Image = SiteConfig::current_site_config()->Logo()) return $Image;
		return false;
	}
}