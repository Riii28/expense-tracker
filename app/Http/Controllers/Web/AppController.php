<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class AppController extends Controller
{
    private string $appTitle = 'Expense Tracker';
    private string $appDescription = 'Expense tracker for artisan';

    public function index()
    {
        return view('index', [
            'appTitle' => $this->appTitle,
            'appDescription' => $this->appDescription
        ]);
    }

    public function create()
    {
        return view('create', [
            'appTitle' => $this->appTitle,
            'appDescription' => $this->appDescription
        ]);
    }
}
