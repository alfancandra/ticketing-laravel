<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $ticket['belum'] = Ticket::where('status',0)->get();
        $ticket['sudah'] = Ticket::where('status',1)->get();
        $ticket['batal'] = Ticket::where('status',3)->get();
        $ticket['semua'] = Ticket::all();
        // Harian
        $ticket['harian_belum'] = Ticket::whereDate('created_at',Carbon::today())->where('status',0)->get();
        $ticket['harian_sudah'] = Ticket::whereDate('updated_at',Carbon::today())->where('status',1)->get();
        $ticket['harian_batal'] = Ticket::whereDate('created_at',Carbon::today())->where('status',3)->get();
        $ticket['harian_semua'] = Ticket::whereDate('created_at',Carbon::today())->get();
        return view('admin.index',compact('ticket'));
    }

    public function dashboarduser()
    {
        return view('dashboarduser');
    }
}
