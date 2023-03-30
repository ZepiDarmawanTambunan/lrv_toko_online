<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['customer'] = User::count();
        $data['revenue'] = Transaction::sum('total_price');
        $data['transaction'] = Transaction::count();
        return view('pages.admin.dashboard', $data);
    }
}
