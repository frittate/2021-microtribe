<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Tribe;
use App\Models\Note;
use Illuminate\Support\Str;

class TribeController extends Controller
{
    public function index()
    {
        $tribes = Auth::user()->tribes->all();
        $notes = Auth::user()->notes->all();

        return Inertia::render('Tribes/Index', [
            'filters' => '',
            'tribes' =>  $tribes,
            'notes' => $notes
        ]);
    }
    //
    public function single($id)
    {
        $tribe = Auth::user()->tribes->where('uuid', $id)->first();
        $notes = [];
        $archived_length = 0;
        $inbox_length = 0;

        if (isset($tribe->notes)) {
            $notes = $tribe->notes->filter(function ($note) {
                return $note->pivot->status_id === Note::STATUS['approved'];
            })->all();

            foreach ($notes as $note) {
                $note['user_array'] = $note->user->get(['name']);
            }

            $archived_length = $tribe->notes->filter(function ($note) {
                return $note->pivot->status_id === Note::STATUS['archived'];
            })->count();

            $inbox_length = $tribe->notes->filter(function ($note) {
                return $note->pivot->status_id === Note::STATUS['unapproved'] || $note->pivot->status_id === Note::STATUS['flagged'];
            })->count();

        }

        if (isset($tribe->users)) {
            foreach ($tribe->users as $user) {
                $users[] = [
                    'name' => $user->name
                ];
            }
        }

        return Inertia::render('Tribes/Id', [
            'tribe' => $tribe,
            'notes' => $notes,
            'archived' => $archived_length,
            'inbox' => $inbox_length,
            'users' => $users
        ]);
    }

    public function note($tribe_uuid, $note_uuid)
    {
        $note = Note::where('uuid', $note_uuid)->first();
        $tribe = $note->tribes()->where('uuid', $tribe_uuid)->first();

        return Inertia::render('Notes/TribeView', [
            'note' => $note,
            'tribe' => $tribe
        ]);
    }

    public function createTemplate()
    {
        $user = Auth::user();

        $tribe = new Tribe;
        $tribe->name = 'new_tribe';
        $tribe->votes_for_approve = 1;
        $tribe->votes_for_archive = 2;
        $tribe->votes_for_delete = 2;
        $tribe->has_inbox = true;
        $tribe->has_archive = true;

        return Inertia::render('Tribes/Edit', [
            'tribe' => $tribe,
            'users' => $user
        ]);
    }

    public function store()
    {
        $uuid = (string) Str::uuid();

        $tribe = new Tribe;
        $tribe->uuid = substr($uuid, 0, 8);
        $tribe->name = Request::input('name');
        $tribe->description = Request::input('description');
        $tribe->photo_path = Request::input('photo_path');
        $tribe->votes_for_approve = Request::input('votes_for_approve');
        $tribe->votes_for_archive = Request::input('votes_for_archive');
        $tribe->votes_for_delete = Request::input('votes_for_delete');
        $tribe->has_inbox = Request::input('has_inbox');
        $tribe->has_archive = Request::input('has_archive');
        $tribe->save();

        $this->setUserToTribe($tribe);

        return Redirect::route('tribes.single', $tribe->uuid);
    }

    public function setUserToTribe($tribe)
    {
        $user = Auth::user();

        $tribe->users()->attach($tribe->id, ['user_id' => $user->id]);
        return $tribe->save();
    }

    /* public function note(Tribe $tribe, Note $note) {
        dump($tribe, $note);
    } */
}
