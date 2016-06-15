<?php

class SiteConfigExtension extends DataExtension {
     
	private static $has_one = array(
    	'Logo' => 'Image'
	);

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab('Root.Main', UploadField::create('Logo', 'Logo Image')->setFolderName('Default Images'));
    }

}