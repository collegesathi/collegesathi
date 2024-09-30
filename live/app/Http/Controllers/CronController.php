<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\TempEmail;
use App\Services\SendMailService;
use App\Modules\Broadcast\Models\Broadcast;
use App\Modules\User\Models\User;
use CustomHelper, DB, Config;


/**
 * Cron Controller
 */
class CronController extends BaseController
{
	/**
	 * Function to send session scheduled email from tempEmais
	 * @param null
	 * @return null
	 * Cron should run in every 5 minutes
	 */
	public function sendTempEmails(){
		$tempMails = TempEmail::limit(TEMP_MAIL_SEND_LIMIT)->orderBy('created_at', 'ASC')->get()->toArray();
		if (!empty($tempMails)) {
			foreach ($tempMails as $result) {
				$email 			=	isset($result['email']) ? $result['email'] : '';
				$toName 		= 	isset($result['to_name']) ? $result['to_name'] : '';
				$subject 		= 	isset($result['subject']) ? $result['subject'] : '';
				$messageBody 	= 	isset($result['message']) ? $result['message'] : '';
				$from_email 	= 	isset($result['from_email']) ? $result['from_email'] : '';
				$fromName 		= 	isset($result['from_name']) ? $result['from_name'] : '';

				$files 				= 	false;
				$path 				= 	'';
				$attachmentName 	=	NULL;
				$attachment_info 	= 	!empty($result['attachment_info']) ? $result['attachment_info'] : '';
				$file_exists		=	false;
				$fullFilePath		=	NULL;

				if ($attachment_info) {
					$attachment_info_arr = json_decode($attachment_info, true);
					if (!empty($attachment_info_arr)) {
						$files 			= 	!empty($attachment_info_arr['files']) ? $attachment_info_arr['files'] : false;
						$folderPath 	= 	!empty($attachment_info_arr['path']) ? $attachment_info_arr['path'] : '';
						$fileName 		=	!empty($attachment_info_arr['attachmentName']) ? $attachment_info_arr['attachmentName'] : '';

						if (file_exists($folderPath . $fileName)) {
							$fullFilePath	=	$folderPath . $fileName;
							$file_exists	=	true;
							$attachmentName	=	'file_name_goes_here.txt';
						}
					}
				}

				if ($email) {
					$sendMail = new SendMailService;
					$mailSent = $sendMail->sendMail($email, $toName, $subject, $messageBody, $from_email, $fromName, $file_exists, $fullFilePath, $attachmentName);
					TempEmail::where('id', $result['id'])->delete();
				}
			}
		}
		echo 'Success';
		die;
	}


	/**
	 * This function use to send broadcast notification message
	 * CronController::sendBroadcastMessage()
	 * @return array
	 * Cron should run in every 5 minutes
	 */
	public function sendBroadcastMessage($broadcastType = null){
		$currentTime    =   CustomHelper::getCurrentTime();
		$DB				=	Broadcast::query();
		$DB->where("is_active", ACTIVE)->where('send_date', '<=', $currentTime)->where("is_sent", INACTIVE);

		if ($broadcastType == EMAIL_NOTIFICATION) {

			$notificaionType = EMAIL_BROADCAST_NOTIFICATION_TYPE;
			$DB->where('type', $notificaionType);
		} elseif ($broadcastType == PUSH_NOTIFICATION) {

			$notificaionType = PUSH_BROADCAST_NOTIFICATION_TYPE;
			$DB->where('type', $notificaionType);
		} elseif ($broadcastType == WEB_NOTIFICATION) {

			$notificaionType = WEB_BROADCAST_NOTIFICATION_TYPE;
			$DB->where('type', $notificaionType);
		}

		$broadcastMsg = $DB->get()->toArray();
 
		if (!empty($broadcastMsg)) {
			foreach ($broadcastMsg as $key => $record) {
				$userIdArray 	=	isset($record['user_ids']) ? $record['user_ids'] : "";
				$message	 	=	isset($record['message']) ? $record['message'] : "test demo";
				$broadcastId	=	isset($record['id']) ? $record['id'] : "";
				$subject        =   isset($record['subject']) ? $record['subject'] : "Broadcast";

				if (!empty($userIdArray)) {

					$emailArray =  explode(',', $userIdArray);
					foreach ($emailArray as $key => $email) {

						$userDetails = User::where('email', $email)->select('id')->first();
						$userId     = isset($userDetails->id) ? $userDetails->id : "";

						if ($record['type']  == WEB_BROADCAST_NOTIFICATION_TYPE) {
							$extraParam                 =   array("user_id" => $userId);
							$notification_rep_array 	=	array($message);
							$action						=	"broadcast_message";
							$type 						=	"broadcast_message";
							$notificationAttribute		=	array();
							CustomHelper::saveNotificationActivity($notification_rep_array, $action, $type, $userId, $notificationAttribute, $extraParam);
						}

						if ($record['type'] == EMAIL_BROADCAST_NOTIFICATION_TYPE) {
							$objTempEmail	            =  	new TempEmail;
							$objTempEmail->email		=	$email;
							$objTempEmail->to_name		=	$email;
							$objTempEmail->subject		=	$subject;
							$objTempEmail->message		=	$message;
							$objTempEmail->from_email	=	Config::get('Site.email');
							$objTempEmail->from_name	=	Config::get('Site.title');
							$objTempEmail->save();
						}

						if ($record['type'] == PUSH_BROADCAST_NOTIFICATION_TYPE) {
							$pushNotificationRepArray 	    =  array($message);
							$pushAction						=  "broadcast_message";
							$pushNotificationAttribute		=  array();
							CustomHelper::savePushNotificationActivity($pushNotificationRepArray, $pushAction, $userId, $pushNotificationAttribute);
						}
					}
				}
				Broadcast::where('id', $broadcastId)->update(['is_sent' => (int)ACTIVE]);
			}
			echo 'Success';
			die;
		} 
		else {
			echo "No record";
			die;
		}
	}
	
} // end CronController class
