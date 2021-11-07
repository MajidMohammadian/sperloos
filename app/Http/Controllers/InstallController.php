<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class InstallController extends Controller
{
    public function index()
    {
        User::factory()->count(10)->create();
        Post::factory()->count(20)->create();
    }
}
