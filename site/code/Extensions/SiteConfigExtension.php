<?php

use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextAreaField;
use SilverStripe\Forms\FieldList;
use SilverStripe\AssetAdmin\Forms\UploadField;

class SiteConfigExtension extends DataExtension {

	static $db = array(
		'EmailRecipients' => 'Text',
		'EmailSender' => 'Text',
		'EmailSender_Name' => 'Text'
	);

	static $has_one = array(
		'Logo' => Image::class
	);
	
	public function updateCMSFields(FieldList $fields){

		$fields->addFieldToTab('Root.Main', UploadField::create('Logo', 'Site logo')->setDescription('Default logo for email templates and shared links on social media'));		
        $fields->addFieldToTab('Root.Main', HeaderField::create('Email','Email settings', 2));
        $fields->addFieldToTab('Root.Main', TextField::create('EmailRecipients','Email recipients')->setDescription('Default addresses to send all website emails to (comma-separated list)'));
		$fields->addFieldToTab('Root.Main', TextField::create('EmailSender','Email sender')->setDescription('Default <strong>address</strong> for website emails to come from (eg Joe Bloggs &lt;<em>joe.bloggs@website.com</em>&gt;)'));
		$fields->addFieldToTab('Root.Main', TextField::create('EmailSender_Name','Email sender name')->setDescription('Default <strong>name</strong> for website emails to come from (eg <em>Joe Bloggs</em> &lt;joe.bloggs@website.com&gt;)'));
	}
}