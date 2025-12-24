<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FinanceProfileController extends Controller
{
    public function myProfile()
    {
        return Inertia::render('NewProfile/Index');
    }
}
