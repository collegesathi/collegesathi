<?php
namespace App\Services;

use App\Modules\EmailTemplate\Models\EmailTemplate;
use App\Modules\EmailTemplate\Models\EmailAction;
use App\Modules\EmailLog\Models\EmailLog;
use App\Models\TempEmail;
use App\Services\BaseService;
use Config, Mail, Exception;

/**
 * Send Mail Service here
 *
 * Add your methods in the class below
 *
 * This is the base controller called everytime on every request
 */
 
class SendMailService extends BaseService{
	
	 
	/**  Function to send email form website
	*
	* @param string $to as reciver email address
	* @param string $toName as full name of receiver
	* @param array $rep_Array as array of constant values
	* @param string $action as action name
	* @param array $attributes as passed attributes if any like(subject,from,fromName,files,path,attachmentName), default blank
	* @return void 
	 */
	public function sendMail($to, $toName, $subject, $messageBody, $from = '', $fromName = '', $files = false, $path='', $attachmentName='') {
		$data = array();
		$data['to'] = $to;
		$data['fullName'] = $toName;
		$data['fromName'] = !empty($fromName) ? $fromName : Config::get('Site.title');
		$data['from'] = !empty($from) ? $from : Config::get('Site.email');
		$data['subject'] = $subject;

		$data['filepath'] = $path;
		$data['attachmentName'] = $attachmentName;
		try{
			if($files===false){
				Mail::send('emails.template', array('messageBody' => $messageBody), function($message) use ($data) {
					$message->to($data['to'], $data['fullName'])
					->from($data['from'], $data['fromName'])
					->subject($data['subject']);
				});
			}
			else {
				if($attachmentName!=''){
					Mail::send('emails.template', array('messageBody'=> $messageBody), function($message) use ($data){
						$message->to($data['to'], $data['fullName'])
							->from($data['from'], $data['fromName'])
							->subject($data['subject'])
							->attach($data['filepath'],array('as'=>$data['attachmentName']));
					});
				}
				else {
					// echo 'success';
					Mail::send('emails.template', array('messageBody'=> $messageBody), function($message) use ($data){
						$message->to($data['to'], $data['fullName'])
						->from($data['from'], $data['fromName'])
						->subject($data['subject'])
						->attach($data['filepath']);
					});
				}
				
			}
		}
		catch(\Exception $e){
		}
		$emailLogObj        		=   new EmailLog;
		$emailLogObj->email_to		=	$data['to'];
		$emailLogObj->email_from	=	$data['from'];
		$emailLogObj->subject		=	$data['subject'];
		$emailLogObj->message		=	$messageBody;	
		$emailLogObj->save();

	}//end sendMail() 
	
	/** Function to send email form website
	*
	* @param string $to as reciver email address
	* @param string $toName as full name of receiver
	* @param array $rep_Array as array of constant values
	* @param string $action as action name
	* @param array $attributes as passed attributes if any like(subject,from,fromName,files,path,attachmentName), default blank
	* @return void 
	 */
	public function callSendMail($to, $toName, $rep_Array, $action, $attributes = array()) {
			$emailActions = EmailAction::where('action','=',$action)->get()->toArray();
			$emailTemplates = EmailTemplate::where('action','=',$action)->get(array('name','subject','action','body'))->toArray();

			$cons = explode(',',$emailActions[0]['options']);
			$constants = array();

			foreach($cons as $key => $val){
				$constants[] = '{'.$val.'}';
			}

			//replace constant by values
			$messageBody = str_replace($constants, $rep_Array, $emailTemplates[0]['body']);
			$email_signature =   Config::get('Site.email_signature');
			$messageBody	=	$messageBody.'<br/><br/>'.$email_signature;
			
			//set attributes if any
			$subject = (isset($attributes['subject']) && !empty($attributes['subject'])) ? $attributes['subject'] : $emailTemplates[0]['subject'];
			
			$subject = str_replace($constants, $rep_Array, $subject);
			 
			$from = (isset($attributes['from']) && !empty($attributes['from'])) ? $attributes['from'] : Config::get('Site.email');
			$fromName = (isset($attributes['fromName']) && !empty($attributes['fromName'])) ? $attributes['fromName'] : Config::get('Site.title');

			$files = (isset($attributes['files']) && !empty($attributes['files'])) ? $attributes['files'] : false;
			$path = (isset($attributes['path']) && !empty($attributes['path'])) ? $attributes['path'] : '';
			$attachmentName = (isset($attributes['attachmentName']) && !empty($attributes['attachmentName'])) ? $attributes['attachmentName'] : '';

			$this->sendMail($to, $toName, $subject, $messageBody, $from, $fromName, $files, $path, $attachmentName);
	}//end callSendMail() 
	
	
	
	
	/** Function to send email form website
	*
	* @param string $to as reciver email address
	* @param string $toName as full name of receiver
	* @param array $rep_Array as array of constant values
	* @param string $action as action name
	* @param array $attributes as passed attributes if any like(subject,from,fromName,files,path,attachmentName), default blank
	* @return void 
	 */
	public function saveTempMail($to, $toName, $rep_Array, $action, $attributes = array()) {
			$emailActions = EmailAction::where('action','=',$action)->get()->toArray();
			$emailTemplates = EmailTemplate::where('action','=',$action)->get(array('name','subject','action','body'))->toArray();

			$cons = explode(',',$emailActions[0]['options']);
			$constants = array();

			foreach($cons as $key => $val){
				$constants[] = '{'.$val.'}';
			}
			 
			//replace constant by values
			$messageBody = str_replace($constants, $rep_Array, $emailTemplates[0]['body']);
			$email_signature =   Config::get('Site.email_signature');
			$messageBody	=	$messageBody.'<br/><br/>'.$email_signature;
			
			
			//set attributes if any
			$subject = (isset($attributes['subject']) && !empty($attributes['subject'])) ? $attributes['subject'] : $emailTemplates[0]['subject'];
			$from = (isset($attributes['from']) && !empty($attributes['from'])) ? $attributes['from'] : Config::get('Site.email');
			$fromName = (isset($attributes['fromName']) && !empty($attributes['fromName'])) ? $attributes['fromName'] : Config::get('Site.title');

			$files = (isset($attributes['files']) && !empty($attributes['files'])) ? $attributes['files'] : false;
			$path = (isset($attributes['path']) && !empty($attributes['path'])) ? $attributes['path'] : '';
			$attachmentName = (isset($attributes['attachmentName']) && !empty($attributes['attachmentName'])) ? $attributes['attachmentName'] : '';

			$attachment_info = '';

			if($files == true && !empty($path) && !empty($attachmentName) ) {
				$attachment_info = json_encode(array('files' => $files, 'path' => $path, 'attachmentName' => $attachmentName));	
			}

			$objTempEmail	=  	new TempEmail;
			$objTempEmail->email		=	$to;
			$objTempEmail->to_name		=	$toName;
			$objTempEmail->subject		=	$subject;
			$objTempEmail->message		=	$messageBody;
			$objTempEmail->from_email	=	$from;
			$objTempEmail->from_name	=	$fromName;
			$objTempEmail->attachment_info	=	$attachment_info;
			$objTempEmail->save();
	 
	}//end callSendMail() 
	
}
// end SendMailService class
