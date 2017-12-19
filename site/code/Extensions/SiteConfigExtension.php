<?php
class SiteConfigExtension extends DataExtension {

	static $db = array(
		'SendEmailsTo_Email' => 'Text',
		'SendEmailsFrom_Name' => 'Text',
		'SendEmailsFrom_Email' => 'Text'
	);

	static $has_one = array(
		'Logo' => 'Image'
	);
	
	public function updateCMSFields(FieldList $fields){

		// Global assets
		$fields->addFieldToTab('Root.GlobalAssets', HeaderField::create('Site assets', 4));
		$fields->addFieldToTab('Root.GlobalAssets', UploadField::create('Logo', 'Logo image')->setFolderName('GlobalAssets'));
		
		// Email settings
        $fields->addFieldToTab(
        	'Root.Emails', 
        	TextAreaField::create('SendEmailsTo_Email','Admin "To" email address(es)')
				->setDescription('Email addresses for deliver of global admin emails eg, contact form submissions etc.<br/>Can be comma-separated list.')
		);

		$fields->addFieldToTab(
        	'Root.Emails', 
        	TextField::create('SendEmailsFrom_Email','Admin "From" email address')
				->setDescription('Email addresses for global admin emails to come "From"')
		);
		$fields->addFieldToTab(
        	'Root.Emails', 
        	TextField::create('SendEmailsFrom_Name','Admin "From" email name')
				->setDescription('Name for global admin emails to come "From"')
		);

	}

}