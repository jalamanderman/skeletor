<?php

use SilverStripe\Forms\TextField;
use SilverStripe\CMS\Model\SiteTree;

class Page extends SiteTree {

	private static $db = [
		'MetaTitle' => 'Text'
	];

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->addFieldToTab(
			'Root.Main.Metadata',
			TextField::create('MetaTitle','Meta Title')
				->setRightTitle('Customised title for use in search engines. Defaults to the page title.'),
			'MetaDescription'
		);

		return $fields;
	}


	/**
	 * Get an inherited 'thing'
	 * This multi-purpose method allows us to iterate up the site tree to get a property or method.
	 * Usage: $Inherited('BannerImage') or $Inherited('Colour'), etc
	 *
	 * @param String $property
	 * @return Array
	 **/
	public function Inherited($property = null){
		$page = $this;

		// Identify whether the requested property is a property or a method()
		$is_method = $page->hasMethod($property);

		// Recursively go up the tree looking for our property with a non-falsy value
		while ($page->ParentID > 0 && ! ($is_method ? $page->$property()->exists() : ($page->$property !== null))){
			$page = $page->Parent();
		}

		return ($is_method ? $page->$property() : $page->$property);
	}


	/**
	 * Get a page link by classname
	 * Returns the *first* page instance's link by class
	 *
	 * @param String $class_name
	 * @return String
	 **/
	public function PageLink($class_name){
		if ($page = $class_name::get()->first()){
			return $page->Link();
		}

		return null;
	}
}
