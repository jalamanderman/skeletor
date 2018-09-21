<?php

use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextAreaField;
use SilverStripe\Forms\FieldList;
use SilverStripe\AssetAdmin\Forms\UploadField;

class SiteConfigExtension extends DataExtension {

	private static $db = [
		'EmailRecipients' => 'Text',
		'EmailSender' => 'Text',
		'EmailSender_Name' => 'Text'
	];

	private static $has_one = [
		'Logo' => Image::class
	];

	private static $owns = [
		'Logo'
	];

	public function updateCMSFields(FieldList $fields){
		$fields->addFieldToTab('Root.Main', UploadField::create('Logo', 'Site logo')->setDescription('Default logo for email templates and shared links on social media'));
        $fields->addFieldToTab('Root.Main', HeaderField::create('Email','Email settings', 2));
        $fields->addFieldToTab('Root.Main', TextField::create('EmailRecipients','Email recipients')->setDescription('Email addresses to send all website emails <strong>to</strong> (comma-separated list)'));
		$fields->addFieldToTab('Root.Main', TextField::create('EmailSender','Email sender')->setDescription('Email address for emails to come <strong>from</strong> (eg joe.bloggs@website.com)'));
		$fields->addFieldToTab('Root.Main', TextField::create('EmailSender_Name','Email sender name')->setDescription('Name for emails to come <strong>from</strong> (eg Joe Bloggs)'));
	}
}
