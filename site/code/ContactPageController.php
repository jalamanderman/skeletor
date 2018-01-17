<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Control\Email\Email;

class ContactPage_Controller extends PageController { 

    private static $allowed_actions = array(
		'ContactForm',
		'submitted'
	);

    public function init(){
        parent::init();
    }
	
	function ContactForm(){

		$params = $this->request->params();
		
		if($params['Action'] == 'submitted'){
		
			return $this->OnCompletionMessage;
			
		}else{
	
			$fields = FieldList::create(
				TextField::create('Name', 'Name'),
				EmailField::create('Email', 'Email'),
				TextField::create('Phone', 'Phone'),
				TextareaField::create('Message', 'Message'),
				HiddenField::create('ContactPageID', null, $this->ID)
			);
			
			$actions = FieldList::create(
				FormAction::create('doContactForm', 'Submit')
			);
			
			// Validate required fields
			$validator = RequiredFields::create('Name', 'Email','Phone', 'Message');
			
			$form = Form::create($this, 'ContactForm', $fields, $actions, $validator)->addExtraClass('contact-form');
			
			return $form;

		}
	
	}
	
    function doContactForm($data, $form) {

    	// create form submission record
		$submission = FormSubmission::create();
		$submission->URL = $this->Link();
		$submission->Payload = json_encode($data);
		$submission->OriginID = $this->ID;
		$submission->OriginClass = $this->ClassName;
		$submission->write();
		$submission->SendEmails();
		
        $this->redirect($this->Link().'submitted');
    }
	
	/***
	* Send email
	***/
	function EmailAdmin($submission){
	
		if( !empty($this->FromName) ){
			$FromName = $this->FromName;
		}
		else{
			$FromName = $this->SiteConfig()->Title.' contact form';
		}

		$from = $FromName . ' <' . $this->FromEmail . '>';
		$to = $this->ToEmail;
		//$to = Email::setAdminEmail();
		$subject = 'A new submission has been received from '.$FromName;
		$body = '';
		
		$email = Email::create($from, $to, $subject, $body);
		
		//set template
    	$email->setTemplate('AdminEmail');
		
    	//populate template
    	$email->populateTemplate($submission);
		
    	//send mail
    	$email->send();		
	}
}