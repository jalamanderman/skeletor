<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TreeDropdownField_Readonly;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
use SilverStripe\Control\Email\Email;
use SilverStripe\Control\Director;
use SilverStripe\SiteConfig\SiteConfig;

class FormSubmission extends DataObject {
	
	private static $singular_name = 'Form submission';
	private static $plural_name = 'Form submissions';
	private static $description = 'The payload for all contact form submissions';	
	private static $default_sort = 'Created DESC';
	
	private static $db = array(
		'URL' => 'Varchar',
		'Payload' => 'Text',
		'IPAddress' => 'Varchar(18)'
	);
	
	private static $has_one = array(
		'Origin' => DataObject::class
	);
	
	private static $summary_fields = array(
		'Created' => 'Created',
		'URL' => 'URL',
		'Origin.ClassName' => 'Origin',
		'IPAddress' => 'IP Address'
	);

	/**
	 * CMS Fields
	 **/
	public function getCMSFields(){

		$fields = parent::getCMSFields();

		if ($this->Origin()){
			$fields->addFieldToTab('Root.Main', ReadonlyField::create('Origin','Origin',($this->Origin()->ClassName.': '.$this->Origin()->ID)));
		} else {
			$fields->addFieldToTab('Root.Main', ReadonlyField::create('Origin','Origin',"No origin record"));
		}
		$fields->addFieldToTab('Root.Main', ReadonlyField::create('URL','URL'));
		$fields->addFieldToTab('Root.Main', ReadonlyField::create('IPAddress','IPAddress'));

		$fields->addFieldToTab('Root.Main', HeaderField::create('Payload', 'Payload', 3));
		$data = json_decode($this->Payload, true);
		if ($data){
			foreach ($data as $key => $value){
				$fields->addFieldToTab('Root.Main', ReadonlyField::create('Playload_'.$key, $key, (string)$value));
			}
		} else {
			$fields->addFieldToTab('Root.Main', LiteralField::create('html', '<p class="message notice">No submission data</p>'));
		}

		return $fields;
	}

	public function OriginType(){
		if ($this->Origin()){
			return $this->Origin()->ClassName;
		}
		return 'Unknown';
	}


	/**
	 * Send emails responding to this submission
	 **/
	public function SendEmails(){

		// convert payload to array for template
		$data = json_decode($this->Payload);

		// set up email "from" vars
		$config = SiteConfig::current_site_config(); 
		if ($config->EmailSender && $config->EmailSender_Name){
			$from = $config->EmailSender;
		} else {
			$from = 'noreply@plasticstudio.co.nz';
		}

		// define time var to use in template
		$body = '';
		$data->TimeSent = date('Y-m-d H:i:s');
		$data->ID = $this->ID;
		$data->Logo = $config->Logo();
		$data->Logo = $config->Logo();

		// different sources require different handling
		switch ($this->OriginType()){

			case 'ContactPage':
				if (isset($this->Origin()->Recipients)){
					$to = $this->Origin()->Recipients;
				}else{
					$to = $config->EmailRecipients;
				}
				$subject = $config->Title . ' contact form';
				$data->Title = $data->Name . ' has made an enquiry.';
				$data->URL = Director::absoluteBaseURL();
				$data->Data = ArrayList::create(array(
					ArrayData::create(array(
						'IsHeading' => true,
						'Value' => 'Details'
					)),
					ArrayData::create(array(
						'Title' => 'Name',
						'Value' => $data->Name
					)),
					ArrayData::create(array(
						'Title' => 'Email',
						'Value' => $data->Email
					)),
					ArrayData::create(array(
						'Title' => 'Phone',
						'Value' => $data->Phone
					)),
					ArrayData::create(array(
						'Title' => 'Message',
						'Value' => $data->Message
					))
				));
				$email = Email::create($from, $to, $subject, $body);
				$email->setReplyTo($data->Email);
				$email->setHTMLTemplate('Email/FormSubmission');
				$email->customise(ArrayData::create($data));
				$email->send();

				if($this->Origin()->SendCustomerEmail){
					// --- CUSTOMER EMAIL ---
					$to = $data->Email;
					$data->Title = 'Thanks for your message, we\'ll be in touch soon. The details you submitted are included below for your own records.';
					$email = Email::create($from, $to, $subject, $body);
					$email->setHTMLTemplate('Email/FormSubmission');
					$email->customise(ArrayData::create($data));
					$email->send();
				}

				break;

			default:
				
				$to = $config->EmailRecipients;
				$subject = $config->Title . ' contact submission';
				$data->Title = $data->Name . ' sent you a message through the website.';
				$email = Email::create($from, $to, $subject, $body);
				$email->replyTo($data->Email);
				$email->setTemplate('Email/FormSubmission');
				$email->populateTemplate( ArrayData::create($data) );
				$email->send();

				if ($this->Origin()->SendCustomerEmail){
					$to = '"'.$data->Name.'" <'.$data->Email.'>';
					$data->Title = 'Thanks for your message, we\'ll be in touch soon. The details you submitted are included below for your own records.';
					$email = Email::create($from, $to, $subject, $body);
					$email->setHTMLTemplate('Emails/FormSubmission');
					$email->customise( ArrayData::create($data) );
					$email->send();
				}
		}

		return;
	}

	function EditLink(){
		return Director::absoluteBaseURL() . 'admin/form-submissions/FormSubmission/EditForm/field/FormSubmission/item/'.$this->ID.'/edit';
	}

	function DataToHTMLList($data){
		$str = '<ul>';
		foreach($data as $key => $val){
			switch($key){
				case 'SecurityID':
					// don't include
					break;
				default:
					$str .= '<li><strong>'.$key.':</strong> '.$val.'</li>';
			}
		}
		$str .= '</ul>';
		return $str;
	}

	/**
	 * Retrieve and return particular attribute from Payload
	 * @param str $attr Attribute to find and return
	 */
	function PayloadAttr($attr=null){
		$data = json_decode($this->Payload);
		if( $attr && isset($data->$attr) ){
			return $data->$attr;
		}
	}
}