<?php

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\View\Requirements;
use SilverStripe\Control\Director;

class PageController extends ContentController {

	private static $allowed_actions = [];

	public function init() {
		parent::init();

		// global compiled javascript
		if (Director::isLive()){
			Requirements::javascript('app/production/index.min.js');
		} else {
			Requirements::javascript('app/production/index.js');
		}

		// global css (compiled scss)
		if (Director::isLive()){
			Requirements::css('app/production/index.min.css');
		} else {
			Requirements::css('app/production/index.css');
		}
	}
}
