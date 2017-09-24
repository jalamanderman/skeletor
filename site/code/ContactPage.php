<?php

class ContactPage extends Page {

    private static $db = array(
        'ToEmail'=> 'Varchar(255)',
		'FromEmail'=> 'Varchar(255)',
		'FromName'=> 'Varchar(255)',
		'ContactDetails'=> 'HTMLText',
		'OnCompletionMessage'=> 'HTMLText',
		'SendCustomerEmail'=> 'Boolean'
    );

    private static $has_many = array(
        'Submissions' => 'FormSubmission'
    );
	
	static $description = 'Basic contact page';
	static $icon = 'site/cms/icons/email.png';

    function getCMSFields(){
	
        $fields = parent::getCMSFields();
		
		// ContactDetails tab
		//$fields->addFieldToTab('Root.ContactDetails', new TextField('LatLong', 'Lat/Long coordinates<br/><em>For Google map</em>'));
		$fields->addFieldToTab('Root.ContactDetails', HTMLEditorField::create('ContactDetails', 'Contact details'));
		
		// Emails tab
		$fields->addFieldToTab('Root.Emails', TextareaField::create('ToEmail', '"To" Email<br/><em>Email addresses to deliver form submissions to. Can be comma-separated list.</em>'));
		$fields->addFieldToTab('Root.Emails', TextField::create('FromEmail', '"From" & "Reply-to" Email<br/><em>Displayed in form submission email.</em>'));
		$fields->addFieldToTab('Root.Emails', TextField::create('FromName', 'From name<br/><em>Displayed in form submission email. Defaults to "'.SiteConfig::current_site_config()->Title.' contact form".</em>'));
		$fields->addFieldToTab('Root.Emails', CheckboxField::create('SendCustomerEmail', 'Send confirmation email to customer?'));
		
		// Submissions tab
        $GridFieldConfig = GridFieldConfig_RecordEditor::create();
        $SubmissionsField = GridField::create(
            'Submissions',
            'Submissions',
            $this->Submissions(),
            $GridFieldConfig
        );
        $fields->addFieldToTab('Root.Submissions', $SubmissionsField);
		
		// OnCompletion tab
		$fields->addFieldToTab('Root.OnCompletion', HTMLEditorField::create('OnCompletionMessage', 'Message to show after form submission'));
		
        return $fields;
		
    }



}


class ContactPage_Controller extends Page_Controller { 

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
		$Submission = FormSubmission::create();
		$Submission->URL = $this->Link();
		$Submission->Payload = json_encode($data);
		$Submission->OriginID = $this->ID;
		$Submission->OriginClass = $this->ClassName;
		$Submission->write();
		$Submission->SendEmails();
		
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
		
		$email = new Email($from, $to, $subject, $body);
		
		//set template
    	$email->setTemplate('AdminEmail');
		
    	//populate template
    	$email->populateTemplate($submission);
		
    	//send mail
    	$email->send();
		
	}
	
}