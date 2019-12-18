<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotes(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'country_id' => 'required',
            'phone_number' => 'required'
        ]);
        $codeNumber = $this->setNumber($request->phone_number, $request->country_id);
        $notes = Note::where([
            'user_id' => $request->user_id,
            'country_id' => $codeNumber['cid'],
            'phone_number' => $codeNumber['phone']
        ])->get();
        return $this->makeResponse('', ['notes' => $notes], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:30',
            'user_id' => 'required',
            'country_id' => 'required',
            'phone_number' => 'required',
            'note' => 'required'
        ]);

        $codeNumber = $this->setNumber($request->phone_number, $request->country_id);

        $note = new Note();
        $note->title = $request->title;
        $note->user_id = $request->user_id;
        $note->country_id = $codeNumber['cid'];
        $note->phone_number = $codeNumber['phone'];
        $note->note = $request->note;
        if ($note->save()) {
            return $this->makeResponse('Note added successfully.', [], 200);
        } else {
            return $this->makeError('Something went wrong.', [], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::find($id);
        if ($note) {
            return $this->makeResponse('', ['note' => $note], 200);
        } else {
            return $this->makeResponse('Note not found !', [], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:30',
            'note' => 'required'
        ]);

        $note = Note::find($id);
        $note->title = $request->title;
        $note->note = $request->note;
        if ($note->save()) {
            return $this->makeResponse('Note updated successfully.', [], 200);
        } else {
            return $this->makeError('Something went wrong.', [], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        if ($note && $note->delete()) {
            return $this->makeResponse('Note deleted successfully.', [], 200);
        } else {
            return $this->makeError('Something went wrong.', [], 401);
        }
    }
}
