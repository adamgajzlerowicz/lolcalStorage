<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::orderBy('id', 'desc')->get();
        return view('index',['notes'=>$notes]);
    }
    public function delete(Request $request){
        $notes = Note::all();
        foreach($notes as $note){
            $note->delete();
        }
        return back();
    }
}