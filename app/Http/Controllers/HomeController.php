<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LamaLama\Wishlist\Wishlist;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('index', compact('user'));
    }
}
