<?php

class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);
	
	public function getCMSFields(){
	
		$fields = parent::getCMSFields();
		
		return $fields;
	}
	
	/**
	 * Get this object's controller
	 ** Returns Page_Controller object
	 */
	public function MyController(){
		$class = $this->ClassName . "_Controller";
		$controller = new $class($this);
		return $controller;
	}
	
	/**
	 * Example usage
	 *
	function FunctionInController(){
		return $this->MyController()->FunctionInController();
	}*/
	
	function OgImage(){
		return $this->MyController()->OgImage();
	}

}

class Page_Controller extends ContentController {

	private static $allowed_actions = array (
	);

	public function init() {
	
		parent::init();

		/**** JS ****/
		//Requirements::javascript(THIRDPARTY_DIR.'/jquery/jquery.js');
		//Requirements::javascript($this->ThemeDir().'/js/effects.js');
		
		/**** CSS ****/
		//Requirements::css('http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700');
		//Requirements::css('http://fonts.googleapis.com/css?family=Nunito:400,300');
		Requirements::css($this->ThemeDir().'/css/typography.css');
		Requirements::css($this->ThemeDir().'/css/layout.css');
		Requirements::css($this->ThemeDir().'/css/form.css');
		
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