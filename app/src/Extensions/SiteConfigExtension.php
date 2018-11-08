<?php

use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextAreaField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Core\Environment;

class SiteConfigExtension extends DataExtension {

	private static $db = [
		'EmailRecipients' => 'Text',
		'EmailSender' => 'Text'
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
        $fields->addFieldToTab('Root.Main', TextField::create('EmailRecipients','Default recipients')->setDescription('Email addresses to send all website emails <strong>to</strong> (comma-separated list)'));
		$fields->addFieldToTab('Root.Main', TextField::create('EmailSender','Default sender')->setDescription('Name for emails to come <strong>from</strong> (eg Joe Bloggs)'));
		$fields->addFieldToTab('Root.Main', ReadonlyField::create('EmailFrom_Display','Send all emails from', $this->EmailFrom())->setDescription('This cannot be edited as it needs to be a validated, environment-specific email address.'));
	}


	/**
	 * Calculate what the sending email is
	 * This must be set in .env to a validated email address
	 * Note: SSP provide pre-validated *.sites.silverstripe.com email addresses
	 *
	 * @return String
	 **/
	public static function EmailFrom(){
		if ($email = Environment::getEnv('SS_SEND_ALL_EMAILS_FROM')){
			return $email;
		}
		return "noreply@plasticstudio.co";
	}
}