<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $ticket['belum'] = Ticket::where('status',0)->get();
        $ticket['sudah'] = Ticket::where('status',1)->get();
        $ticket['batal'] = Ticket::where('status',3)->get();
        $ticket['semua'] = Ticket::all();
        // Harian
        $ticket['harian_belum'] = Ticket::where('status',0)->where('created_at', '>', now()->subDays(30)->endOfDay())->get();
        $ticket['harian_sudah'] = Ticket::where('status',1)->where('created_at', '>', now()->subDays(30)->endOfDay())->get();
        $ticket['harian_batal'] = Ticket::where('status',3)->where('created_at', '>', now()->subDays(30)->endOfDay())->get();
        $ticket['harian_semua'] = Ticket::whereDate('created_at',Carbon::today())->get();
        $ticket['bulanan'] = Ticket::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"),DB::raw('max(created_at) as createdAt'))
        ->whereYear('created_at', date('Y'))
        ->groupBy('month_name')
        ->orderBy('createdAt')
        ->get();
        $ticket['bulanan_belum'] = Ticket::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"),DB::raw('max(created_at) as createdAt'))
        ->whereYear('created_at', date('Y'))
        ->groupBy('month_name')
        ->orderBy('createdAt')
        ->where('status',0)
        ->get();
        $ticket['bulanan_batal'] = Ticket::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"),DB::raw('max(created_at) as createdAt'))
        ->whereYear('created_at', date('Y'))
        ->groupBy('month_name')
        ->orderBy('createdAt')
        ->where('status',3)
        ->get();
        return view('admin.index',compact('ticket'));
    }

    public function monthlyRegisteredUsers()
    {
        return array_map(function($month){
            return Ticket::whereMonth('created_at', $month)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        }, range(1,12));
    }

    public function monthly()
    {
        $counts = Ticket::select(DB::raw('MONTH(created_at) month, count(*) as count'))
        ->whereYear('created_at',Carbon::now()->format('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        ->pluck('count','month')
        ->toArray();

        return array_map(function($month){
            return Ticket::whereMonth('created_at', $month)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        }, range(1,12));
    }

    public function dashboarduser()
    {
        $ticket['belum'] = Ticket::where('status',0)->get();
        $ticket['sudah'] = Ticket::where('status',1)->get();
        $ticket['batal'] = Ticket::where('status',3)->get();
        $ticket['semua'] = Ticket::all();
        // Harian
        $ticket['harian_belum'] = Ticket::where('created_at', '>', now()->subDays(30)->endOfDay())->where('status',0)->get();
        $ticket['harian_sudah'] = Ticket::where('created_at', '>', now()->subDays(30)->endOfDay())->where('status',1)->get();
        $ticket['harian_batal'] = Ticket::where('created_at', '>', now()->subDays(30)->endOfDay())->where('status',3)->get();
        $ticket['harian_semua'] = Ticket::where('created_at', '>', now()->subDays(30)->endOfDay())->get();
        $ticket['bulanan'] = Ticket::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"),DB::raw('max(created_at) as createdAt'))
        ->whereYear('created_at', date('Y'))
        ->groupBy('month_name')
        ->orderBy('createdAt')
        ->get();
        $ticket['bulanan_belum'] = Ticket::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"),DB::raw('max(created_at) as createdAt'))
        ->whereYear('created_at', date('Y'))
        ->groupBy('month_name')
        ->orderBy('createdAt')
        ->where('status',0)
        ->get();
        $ticket['bulanan_batal'] = Ticket::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"),DB::raw('max(created_at) as createdAt'))
        ->whereYear('created_at', date('Y'))
        ->groupBy('month_name')
        ->orderBy('createdAt')
        ->where('status',3)
        ->get();
        return view('dashboarduser',compact('ticket'));
    }
}
