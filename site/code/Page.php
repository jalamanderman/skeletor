<?php

use SilverStripe\Forms\TextField;
use SilverStripe\CMS\Model\SiteTree;

class Page extends SiteTree {

	private static $db = array(
		'MetaTitle' => 'Text'
	);

	private static $has_one = array();
	
	public function getCMSFields(){	
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main.Metadata', TextField::create('MetaTitle','Meta Title')->setRightTitle('Customised title for use in search engines. Defaults to the page title.'), 'MetaDescription');

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
