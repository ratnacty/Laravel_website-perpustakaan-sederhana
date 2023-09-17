<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::all();
        $user = User::count();
        $book = Book::count();
        $pinjam = Peminjaman::count();
        return view('Home.backend.dashboard-admin',compact('user','book','pinjam'));
    }
}
