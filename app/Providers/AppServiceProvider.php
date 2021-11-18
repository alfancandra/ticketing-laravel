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




            if($user->role_id==0){
                $pesan = Pesan::join('ticket_tickets','ticket_pesans.ticket_id','=','ticket_tickets.id')
                ->select('ticket_tickets.user_id','ticket_tickets.id as idticket','ticket_pesans.created_at as tglpesan','ticket_pesans.nama','ticket_pesans.pesan as message')
                ->orderBy('ticket_pesans.created_at','DESC')
                ->where('ticket_tickets.user_id',$user->id)
                ->where('ticket_pesans.nama','!=',$user->name)
                ->get();

                $notifications = $user->Notifications()->limit(5)->get();
            }elseif($user->role_id==1){
                $pesan = Pesan::join('ticket_tickets','ticket_pesans.ticket_id','=','ticket_tickets.id')
                ->select('ticket_tickets.user_id','ticket_tickets.id as idticket','ticket_pesans.created_at as tglpesan','ticket_pesans.nama','ticket_pesans.pesan as message')
                ->orderBy('ticket_pesans.created_at','DESC')
                ->where('ticket_tickets.user_id','!=',$user->id)
                ->where('ticket_pesans.nama','!=',$user->name)
                ->get();

                $notifications = $user->Notifications()->limit(5)->get();
            }else{
                $pesan = null;
                $notifications = null;
            }
            $view->with(['user' => $pesan,'notifications' => $notifications]);;
          });
    }
}
