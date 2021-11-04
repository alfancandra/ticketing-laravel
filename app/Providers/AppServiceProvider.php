<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Pesan;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('template.index', function($view) {
            $user = Auth::user();
            $pesan = Pesan::join('ticket_tickets','ticket_pesans.ticket_id','=','ticket_tickets.id')
            ->select('ticket_tickets.user_id','ticket_tickets.id as idticket','ticket_pesans.nama','ticket_pesans.pesan as message')
            ->orderBy('ticket_pesans.created_at','DESC')
            ->where('ticket_tickets.user_id',$user->id)
            ->where('ticket_pesans.nama','!=',$user->name)
            ->get();

            $pesanadmin = Pesan::join('ticket_tickets','ticket_pesans.ticket_id','=','ticket_tickets.id')
            ->select('ticket_tickets.user_id','ticket_tickets.id as idticket','ticket_pesans.nama','ticket_pesans.pesan as message')
            ->orderBy('ticket_pesans.created_at','DESC')
            ->where('ticket_tickets.user_id','!=',$user->id)
            ->where('ticket_pesans.nama','!=',$user->name)
            ->get();
            $view->with(['user' => $pesan,'admin' => $pesanadmin]);;
          });
    }
}
