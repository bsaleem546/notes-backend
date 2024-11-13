<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteStoreRequest;
use App\Http\Requests\NoteUpdateRequest;
use App\Http\Resources\NoteCollection;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        if ($request->pagination == 'no') {
            return NoteResource::collection(Note::getData($request, false));
        }

        return new NoteCollection(Note::getData($request));
    }

    public function show($id)
    {
        $note = Note::find($id);
        return NoteResource::make($note);
    }

    public function store(NoteStoreRequest $request)
    {
        $note = new Note();
        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();

        return NoteResource::make($note);
    }

    public function udpate($id, NoteUpdateRequest $request)
    {
        $note = Note::find($id);
        $note->title = $request->title ?? $note->title;
        $note->content = $request->content ?? $note->content;
        $note->save();

        return NoteResource::make($note);
    }

    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();

        return [];
    }
}
