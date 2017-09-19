<?php
class Page extends SiteTree {

	private static $db = array();

	private static $has_one = array();
	
	public function getCMSFields(){	
		$fields = parent::getCMSFields();		
		return $fields;
	}
	
	/**
	 * Get this model's controller
	 * @return obj
	 */
	public function MyController(){
		$class = $this->ClassName . "_Controller";
		$controller = new $class($this);
		return $controller;
	}
}

class Page_Controller extends ContentController {

	private static $allowed_actions = array();

	/**
	 * When we initialize this controller
	 * This happens during the birth of the universe
	 **/
	public function init() {	
		parent::init();
		
		// global compiled javascript
		if( Director::isLive() ){
			Requirements::javascript('site/production/index.min.js');
		}else{
			Requirements::javascript('site/production/index.js');
		}
		
		// global css (compiled scss)
		if( Director::isLive() ){
			Requirements::css('site/production/index.min.css');
		}else{
			Requirements::css('site/production/index.css');
		}
	}

	/**
	 * Get logo set in site config if it exists
	 **/
	function Logo(){
		if ($Logo = SiteConfig::current_site_config()->Logo()){
			return $Logo;
		}
		return false;
	}

	/**
	 * Return image to use in og:image meta tag
	 * Default to site logo if it exists, otherwise return false.
	 *
	 * Override this as needed in page classes to dish up a relevant image.
	 * For instance, a news item may have a featured image, so on
	 * that page class this function could return the featured image.
	 **/
	function OgImage(){
		if ($Image = $this->Logo()){
			return $Image;
		}
		return false;
	}


	/**
	 * Send email to admin email address defined in SiteConfig
	 * @param array $TemplateData array of data to pass to template. Should be in this format:
	 *                            array(
	 *                            	'Subject' => 'The subject line of the email',
	 *                            	'Title' => 'The email title. Can contain html.',
	 *                            	'Description' => 'The email description. Can contain html.',
	 *                            	'ReplyToEmail' => $data['Email'], // Optional, email address that was captured in the form
	 *                            	'Fields' => ArrayList::create(// ArrayList of the data you want to output in the email, in key=>val pairs, eg:
	 *								    array(
	 *										ArrayData::create(array('Key' => 'Name', 'Value' => $data['Name'])),
	 *										ArrayData::create(array('Key' => 'Email', 'Value' => $data['Email'])),
	 *										ArrayData::create(array('Key' => 'Phone', 'Value' => $data['Phone'])),
	 *										ArrayData::create(array('Key' => 'Message', 'Value' => $data['Message']))
	 *									)
	 *								),
	 *                            	'SourceLink' => 'Link to page email was sent from (defaults to $this->Link)'
	 *                            )
	 *                            
	 
	function EmailAdmin($TemplateData=array()){

		// can only send if AdminEmails have been set
		if($this->SiteConfig()->AdminToEmails){

			// set email variables
			if($this->SiteConfig()->AdminFromEmail){
				$from = $this->SiteConfig()->AdminFromEmail;
			}else{
				$from = 'noreply@plasticstudio.co';
			}
			$to = $this->SiteConfig()->AdminToEmails;
			if(isset($TemplateData['Subject'])){
				$subject = $TemplateData['Subject'];
			}else{
				$subject = 'Email has been submitted through '.$this->SiteConfig()->Title;
			}
			$body = '';
			$email = new Email($from, $to, $subject, $body);
			$email->setBcc('client@plasticstudio.co.nz');
			if(isset($TemplateData['ReplyToEmail'])) $email->replyTo($TemplateData['ReplyToEmail']);
			
			// set template
			// NOTE: Email template references a logo at /site/images/email-template-logo.png
			// so make sure that file has been added
	    	$email->setTemplate('Email');
			
	    	// populate template
	    	$email->populateTemplate(array('TemplateData' => $TemplateData));
			
	    	// send mail
	    	return $email->send();

		}
		
	}*/

	/**
	 * Send email to form submitter
	 * @param array $TemplateData array of data to pass to template. Should be in this format:
	 *                            array(
	 *                            	'Subject' => 'The subject line of the email',
	 *                            	'Title' => 'The email title. Can contain html.',
	 *                            	'Description' => 'The email description. Can contain html.',
	 *                            	'ToEmail' => $data['Email'], // email address that was captured in the form
	 *                            	'Fields' => ArrayList::create(// ArrayList of the data you want to output in the email, in key=>val pairs, eg:
	 *								    array(
	 *										ArrayData::create(array('Key' => 'Name', 'Value' => $data['Name'])),
	 *										ArrayData::create(array('Key' => 'Email', 'Value' => $data['Email'])),
	 *										ArrayData::create(array('Key' => 'Phone', 'Value' => $data['Phone'])),
	 *										ArrayData::create(array('Key' => 'Message', 'Value' => $data['Message']))
	 *									)
	 *								),
	 *                            	'SourceLink' => 'Link to page email was sent from (defaults to $this->Link)'
	 *                            )
	 *                            
	 
	function SubmitterAdmin($TemplateData=array()){

		// can only send if AdminEmails have been set
		if(isset($TemplateData['ToEmail'])){

			// set email variables
			if($this->SiteConfig()->AdminFromEmail){
				$from = $this->SiteConfig()->AdminFromEmail;
			}else{
				$from = 'noreply@plasticstudio.co';
			}
			$to = $TemplateData['ToEmail'];
			if(isset($TemplateData['Subject'])){
				$subject = $TemplateData['Subject'];
			}else{
				$subject = 'Your submission has been received through '.$this->SiteConfig()->Title;
			}
			$body = '';
			$email = new Email($from, $to, $subject, $body);
			$email->setBcc('client@plasticstudio.co.nz');
			
			// set template
			// NOTE: Email template references a logo at /site/images/email-template-logo.png
			// so make sure that file has been added
	    	$email->setTemplate('Email');
			
	    	// populate template
	    	$email->populateTemplate(array('TemplateData' => $TemplateData));
			
	    	// send mail
	    	return $email->send();

		}
		
	}*/


}