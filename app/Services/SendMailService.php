<?php


namespace App\Services;



use App\Http\Requests\RequestPopupRequest;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailSettingModel;
use function Symfony\Component\String\b;

class SendMailService
{

    private static function config()
    {
        $emailSetting = EmailSettingModel::firstOrFail();
        config([
            "mail.mailers.smtp.username" => $emailSetting->email_for_send,
            "mail.mailers.smtp.password" => $emailSetting->password,
        ]);
        return $emailSetting;

    }

//    public static function sendEmailToMySpecialUserRequest($model)
//    {
//        $emailSetting = SendMailService::config();
//        $data = array('name' => $model->name, 'code' => $model->code);
//        Mail::send('email.AccessGranted', $data, function($message) use ($emailSetting,$model) {
//            $message->to($model->email, $model->name)->subject($emailSetting->name.': Access granted!');
//            $message->from($emailSetting->email_for_send,$emailSetting->name);
//        });
//    }

    public static function sendEmailToAdmin($popup,$postData, RequestPopupRequest $request = null)
    {

        $emailSetting = SendMailService::config();

        switch ($popup){
            case 'request':
                $email = $emailSetting->email_for_request;
                $postData['clientMessage'] = $postData['message'];
                $view = 'toAdminFromRequest';
                break;
        }

        Mail::send('email.'.$view, $postData, function($message) use ($emailSetting,$popup, $email, $request, $postData) {
            $message->to($email,$emailSetting->name)->subject($emailSetting->name.': New mail from the '.$popup.' popup!');
            $message->from($emailSetting->email_for_send,$emailSetting->name);

//            if(isset($postData['file'])) {
//                $message->attach($request->file('file')->getRealPath(), [
//                    'as' => $request->file('file')->getClientOriginalName(),
//                    'mime' => $request->file('file')->getMimeType()
//                ]);
//            }
        });
    }
}

