<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:posts',
            'body' => 'required',
        ]);
    }
}