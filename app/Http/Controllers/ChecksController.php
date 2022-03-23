<?php

namespace App\Http\Controllers;

use App\Models\CheckList;
use Illuminate\Http\Request;

class ChecksController extends Controller
{
    public function index() {

        $checks = CheckList::all();

        return view('checks.index', compact('checks'));
    }

    public function questions()  {
        return view('checks.questions');
    }
}
