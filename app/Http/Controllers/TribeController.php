<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Tribe;
use App\Models\Note;


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

    /* public function note(Tribe $tribe, Note $note) {
        dump($tribe, $note);
    } */
}
