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
            $pesan = Pesan::join('tickets','pesans.ticket_id','=','tickets.id')
            ->select('tickets.user_id','tickets.id as idticket','pesans.nama','pesans.pesan as message')
            ->orderBy('pesans.created_at','DESC')
            ->where('tickets.user_id',$user->id)
            ->where('pesans.nama','!=',$user->name)
            ->get();

            $pesanadmin = Pesan::join('tickets','pesans.ticket_id','=','tickets.id')
            ->select('tickets.user_id','tickets.id as idticket','pesans.nama','pesans.pesan as message')
            ->orderBy('pesans.created_at','DESC')
            ->where('tickets.user_id','!=',$user->id)
            ->where('pesans.nama','!=',$user->name)
            ->get();
            $view->with(['user' => $pesan,'admin' => $pesanadmin]);;
          });
    }
}
