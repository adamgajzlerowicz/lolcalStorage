<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class APINoteController extends Controller
{
    public function store(Request $request)
    {
        $note = new Note();
        $note->content = $request->get('content');
        $note->save();
        return back();
    }

}
