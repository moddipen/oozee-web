<?php

namespace App\Http\Controllers\Api;

use App\Models\TempMedia;
use App\Models\VoiceMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Models\Media;

class VoiceMessageController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'media_id' => 'required',
            'sender_user_id' => 'required',
            'receiver_user_id' => 'required'
        ]);
        $voiceMessage = new VoiceMessage();
        $voiceMessage->sender_user_id = $request->sender_user_id;
        $voiceMessage->receiver_user_id = $request->receiver_user_id;
        if ($voiceMessage->save()) {
            $mediaItem = Media::find($request->media_id);
            if (!$mediaItem) {
                return $this->makeError('Media not found.', [], 410);
            }
            $movedMediaItem = $mediaItem->move($voiceMessage);
            if ($movedMediaItem) {
                $mediaItem->delete();
                return $this->makeResponse('Voice message sent successfully.', [], 200);
            } else {
                $voiceMessage->delete();
                return $this->makeError('Please try again !', [], 410);
            }
        } else {
            return $this->makeError('Please try again !', [], 410);
        }
    }
}
