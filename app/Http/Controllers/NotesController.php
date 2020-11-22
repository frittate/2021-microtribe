<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class NotesController extends Controller
{
    public function index()
    {
        $tribes = Auth::user()->tribes->all();
        $notes = Auth::user()->notes->all();

        return Inertia::render('Notes/Index', [
            'filters' => '',
            'tribes' =>  $tribes,
            'notes' => $notes
        ]);
    }

    public function single($uuid)
    {
        $note = Auth::user()->notes->where('uuid', $uuid)->first();

        if (empty($note)) {
            return Redirect::route('notes.all');
        }

        $tribes = [];
        $user_tribes = [];

        if (isset($note->tribes)) {
            foreach ($note->tribes as $tribe) {
                $tribes[] = [
                    'name' => $tribe->name,
                    'uuid' => $tribe->uuid,
                    'photo_path' => $tribe->photo_path
                ];
            }
        }

        if (isset(Auth::user()->tribes)) {
            foreach (Auth::user()->tribes as $utribe) {
                $user_tribes[] = [
                    'name' => $utribe->name,
                    'uuid' => $utribe->uuid,
                ];
            }
        }

        return Inertia::render('Notes/Id', [
            'note' => $note,
            'tribes' => $tribes,
            'userTribes' => $user_tribes
        ]);
    }

    public function create()
    {
        $note = new Note;
        $note->title = 'untitled note';
        return Inertia::render('Notes/Id', [
            'note' => $note,
            'userTribes' => Auth::user()->tribes->all()
        ]);
    }

    public function store()
    {
        $id = Auth::user()->id;

        $uuid = (string) Str::uuid();

        $note = new Note;
        $note->title = Request::input('title');
        $note->user_id = $id;
        $note->uuid = substr($uuid, 0, 8);

        $note->save();

        return Redirect::route('notes.all');
    }

    public function update(Note $note)
    {
        $tribe_uuid = Request::input('utribe');
        if (isset($tribe_uuid)) {
            $tribe = Auth::user()->tribes->where('uuid', $tribe_uuid)->first()->id;
            $note->tribes()->attach($tribe, ['status_id' => 2]);
        }

        $note->content = Request::input('content');
        $note->title = Request::input('title');
        $note->save();

        return Redirect::back()->with('success', 'Note updated.');
    }
}
