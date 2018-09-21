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
}
