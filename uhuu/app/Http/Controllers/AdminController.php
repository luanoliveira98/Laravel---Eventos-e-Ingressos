<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Event;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        // Lista para formar o caminho de pão
        $listCrumbs = json_encode([
            ["title"=>"Dashboard", "url"=>""]
        ]);

        // Lista contendo a contagem de itens cadastrados no BD
        $countTables = [
            "events" => Event::where('user_id', auth()->user()->id)->count(), 
            "users"    => User::count(),
            "admins"  => User::where('admin', 'S')->count()
        ];
        return view('admin.dashboard.index', compact('listCrumbs', 'countTables'));
    }
}
