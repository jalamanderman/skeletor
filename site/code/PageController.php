<?php

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\View\Requirements;
use SilverStripe\Control\Director;

class PageController extends ContentController {

	private static $allowed_actions = array();

	/**
	 * When we initialize this controller
	 * This happens during the birth of the universe
	 **/
	public function init() {	
		parent::init();
		
		// global compiled javascript
		if (Director::isLive()){
			Requirements::javascript('site/production/index.min.js');
		} else {
			Requirements::javascript('site/production/index.js');
		}
		
		// global css (compiled scss)
		if (Director::isLive()){
			Requirements::css('site/production/index.min.css');
		} else {
			Requirements::css('site/production/index.css');
		}
	}
}