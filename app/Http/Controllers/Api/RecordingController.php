<?php

namespace App\Http\Controllers\Api;

use App\Models\Recording;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Models\Media;

class RecordingController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException3
     */
    public function getRecordings(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);
        $recordings = Recording::where('user_id', $request->user_id)->latest()->take(10)->get();
        return $this->makeResponse('', ['recordings' => $recordings], 200);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'media_id' => 'required',
            'user_id' => 'required',
            'phone_number' => 'required',
            'country_id' => 'required'
        ]);

        try {
            $record = new Recording();
            $record->user_id = $request->user_id;
            $record->phone_number = $request->phone_number;
            $record->country_id = $request->country_id;
            if ($record->save()) {
                $mediaItem = Media::find($request->media_id);
                if (!$mediaItem) {
                    return $this->makeError('Media not found.', [], 410);
                }
                $movedMediaItem = $mediaItem->move($record);
                if ($movedMediaItem) {
                    $mediaItem->delete();
                    return $this->makeResponse('Recording added successfully.', [], 200);
                } else {
                    $record->delete();
                    return $this->makeError('Please try again', [], 410);
                }
            } else {
                return $this->makeError('Please try again', [], 410);
            }
        } catch (\Exception $e) {
            return $this->makeError($e->getMessage(), [], 410);
        }
    }
}
