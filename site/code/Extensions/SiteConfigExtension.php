<?php
class SiteConfigExtension extends DataExtension {

	static $db = array(
		'AdminToEmails' => 'Text',
		'AdminFromEmail' => 'Text'
	);
	
	public function updateCMSFields(FieldList $fields){	
	
        $fields->addFieldToTab(
        	'Root.Emails', 
        	TextAreaField::create('AdminToEmails','Admin "To" email address(es)')
				->setDescription('Email addresses for deliver of global admin emails eg, contact form submissions etc.<br/>Can be comma-separated list.')
		);

		$fields->addFieldToTab(
        	'Root.Emails', 
        	TextField::create('AdminFromEmail','Admin "From" email address')
				->setDescription('Email addresses for global admin emails to come "From"')
		);

	}

}