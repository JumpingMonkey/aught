<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPopupRequest;
use App\Models\Pages\RequestPageModel;
use App\Models\Pages\RequestPopupMessagesModel;
use App\Services\SendMailService;
use Illuminate\Http\Request;

class PopupsController extends Controller
{
    public function request_popup_post(RequestPopupRequest $request){

        $postData = $request->input();

        if($request->file !== null) {
            $postData['file']=$request->file->store('/');
        }else{
            $postData['file']=null;
        }

        $newClientMessage = new RequestPopupMessagesModel($postData);
        $newClientMessage->save();

        SendMailService::sendEmailToAdmin('request',$postData, $request);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }

    public function getRequestPage()
    {
        $data = RequestPageModel::firstOrFail();

        $content = $data->getFullData();

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
