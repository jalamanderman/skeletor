<?php
/*class FormSubmission extends DataObject {	
		
	static private $db = array(
		'FormData' => 'Text',
		'Name' => 'Varchar(255)',
		'Email' => 'Varchar(255)'
	);
		
	static private $has_one = array(
		'Page' => 'Page'
	);
	
	static $summary_fields = array(
		'Created' => 'Date',
		'Name' => 'Name',
		'Email' => 'Email'
	);
	
	static $default_sort = 'Created DESC';
	
	public static $searchable_fields = array(
		'Created',
		'Name',
		'Email'
	);
}*/



class FormSubmission extends DataObject {
	
	private static $singular_name = 'Form submission';
	private static $plural_name = 'Form submissions';
	private static $description = 'The payload for all contact form submissions';	
	private static $default_sort = 'Created DESC';
	
	private static $db = array(
		'URL' => 'Varchar',
		'Payload' => 'Text',
		'IPAddress' => 'Varchar(18)',
		'UniqueID' => 'Text'
	);
	
	private static $has_one = array(
		'Origin' => 'DataObject'
	);
	
	private static $summary_fields = array(
		'Created' => 'Created',
		'URL' => 'URL',
		'OriginType' => 'Origin',
		'IPAddress' => 'IP Address',
		'UniqueID' => 'UniqueID'
	);

	/**
	 * CMS Fields
	 **/
	public function getCMSFields(){
		$fields = FieldList::create();

		$fields->push(TextField::create('URL','URL'));
		$fields->push(TextField::create('IPAddress','IPAddress'));
		$fields->push(TextField::create('UniqueID','UniqueID'));

		$fields->push(LiteralField::create('html','<br /><h3>Submission data</h3>'));
		$data = json_decode($this->Payload, true);
		foreach ($data as $key => $value){
			if ($key == 'AttendeesData'){
				$fields->push(ReadonlyField::create('Playload_'.$key,$key,json_encode($value)));
			} else {
				$fields->push(ReadonlyField::create('Playload_'.$key,$key,(string)$value));
			}
		}

		return $fields;
	}

	function onBeforeWrite(){
		$this->UniqueID = $this->CreateUniqueID($this->Created);
		parent::onBeforeWrite();
	}

	public function OriginType(){
		if( $this->OriginClass ) return $this->OriginClass;
		if( $this->OriginID <= 0 ) return '-';
		return $this->Origin()->ClassName;
	}


	/**
	 * Send emails responding to this submission
	 **/
	public function SendEmails(){

		// convert payload to array for template
		$data = json_decode($this->Payload);

		// set up email "from" vars
		$config = SiteConfig::current_site_config(); 
		if( $config->SendEmailsFrom_Name && $config->SendEmailsFrom_Email ){
			$from = '"'.$config->SendEmailsFrom_Name.'" <'.$config->SendEmailsFrom_Email.'>';
		}else{
			$from = 'DEFAULT <noreply@default.co.nz>';
		}

		// define time var to use in template
		$body = '';
		$data->TimeSent = date('Y-m-d H:i:s');
		$data->UniqueID = $this->UniqueID;

		// different sources require different handling
		switch ($this->OriginType()){

			case 'ContactPage':
				// --- ADMIN EMAIL ---
				if( isset($this->Origin()->AdminEmail) ){
					$to = $this->Origin()->AdminEmail;
				}else{
					$to = $config->SendEmailsTo_Email;
				}
				$subject = $config->Title . ' Website contact form submission';
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
				$email->replyTo($data->Email);
				$email->setTemplate('Emails/FormSubmission');
				$email->populateTemplate( ArrayData::create($data) );
				$email->send();

				// --- CUSTOMER EMAIL ---
				$to = '"'.$data->Name.'" <'.$data->Email.'>';
				$data->Title = 'Thanks for your message, we\'ll be in touch soon. The details you submitted are included below for your own records.';
				$email = Email::create($from, $to, $subject, $body);
				$email->setTemplate('Emails/FormSubmission');
				$email->populateTemplate( ArrayData::create($data) );
				$email->send();

				break;

			default:
				
				// --- ADMIN EMAIL ---
				$to = $config->SendEmailsTo_Email;
				$subject = $config->Title . ' Website form submission';
				$data->Title = $data->Name . ' sent you a message through the website.';
				$email = Email::create($from, $to, $subject, $body);
				$email->replyTo($data->Email);
				$email->setTemplate('Emails/FormSubmission');
				$email->populateTemplate( ArrayData::create($data) );
				$email->send();

				// --- CUSTOMER EMAIL ---
				$to = '"'.$data->Name.'" <'.$data->Email.'>';
				$data->Title = 'Thanks for your message, we\'ll be in touch soon. The details you submitted are included below for your own records.';
				$email = Email::create($from, $to, $subject, $body);
				$email->setTemplate('Emails/FormSubmission');
				$email->populateTemplate( ArrayData::create($data) );
				$email->send();
		}

		return;
	}

	/**
	 * Create unique ID for submission
	 * 
	 * @param $str string | string to hash
	 * 
	 * @return string | hashed string
	 **/
	function CreateUniqueID($str){
		return md5($str . microtime());
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

}