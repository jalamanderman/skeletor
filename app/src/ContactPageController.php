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
		'Form',
		'submitted'
	);

    public function init(){
        parent::init();
    }

	function Form(){

		$params = $this->request->params();

		if ($params['Action'] == 'submitted'){

			return $this->OnCompletionMessage;

		} else {

			$fields = FieldList::create(
				TextField::create('Name', 'Name'),
				EmailField::create('Email', 'Email'),
				TextField::create('Phone', 'Phone'),
				TextareaField::create('Message', 'Message')
			);

			$actions = FieldList::create(
				FormAction::create('doForm', 'Submit')
			);

			$validator = RequiredFields::create('Name', 'Email','Phone', 'Message');

			$form = Form::create($this, 'Form', $fields, $actions, $validator)->addExtraClass('contact-form');

			return $form;
		}
	}

    function doForm($data, $form) {
		$submission = FormSubmission::create();
		$submission->Payload = json_encode($data);
		$submission->OriginID = $this->ID;
		$submission->OriginClass = $this->ClassName;
		$submission->write();
        $submission->SendEmail();
		$submission->SendConfirmationEmail();

        $this->redirect($this->Link().'submitted');
    }
}
