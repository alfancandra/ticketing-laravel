<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $ticket['belum'] = Ticket::where('status',0)->get();
        $ticket['sudah'] = Ticket::where('status',1)->get();
        $ticket['batal'] = Ticket::where('status',3)->get();
        $ticket['semua'] = Ticket::all();
        return view('admin.index',compact('ticket'));
    }

    public function dashboarduser()
    {
        return view('dashboarduser');
    }
}
