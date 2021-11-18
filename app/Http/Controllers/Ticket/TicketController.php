<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Notification;
use App\Notifications\NewTicket;

class TicketController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        if($auth->role_id==1 || $auth->role_id==2){
            $ticket = Ticket::where('status',0)
            ->select('ticket_tickets.id as id','users.name as nama','ticket_tickets.pesan','ticket_tickets.created_at','ticket_tickets.updated_at','ticket_tickets.status','ticket_tickets.image')
            ->join('users','ticket_tickets.user_id','=','users.id')
            ->orderBy('created_at','ASC')
            ->get();
        }else{
            $ticket = Ticket::where('status',0)
            ->select('ticket_tickets.id as id','users.name as nama','ticket_tickets.pesan','ticket_tickets.created_at','ticket_tickets.updated_at','ticket_tickets.status','ticket_tickets.image')
            ->join('users','ticket_tickets.user_id','=','users.id')
            ->where('user_id',$auth->id)
            ->orderBy('created_at','DESC')
            ->get();
        }
        $title = 'Data Ticket Belum Diatasi';
        return view('ticket.index',compact('ticket','title'));
    }

    public function nonaktif()
    {
        $auth = Auth::user();
        if($auth->role_id==1 || $auth->role_id==2){
            $ticket = Ticket::where('status',1)
            ->select('ticket_tickets.id as id','users.name as nama','ticket_tickets.pesan','ticket_tickets.created_at','ticket_tickets.updated_at','ticket_tickets.status','ticket_tickets.image')
            ->join('users','ticket_tickets.user_id','=','users.id')
            ->orderBy('updated_at','DESC')
            ->get();
        }else{
            $ticket = Ticket::where('status',1)
            ->select('ticket_tickets.id as id','users.name as nama','ticket_tickets.pesan','ticket_tickets.created_at','ticket_tickets.updated_at','ticket_tickets.status','ticket_tickets.image')
            ->join('users','ticket_tickets.user_id','=','users.id')
            ->where('user_id',$auth->id)
            ->orderBy('updated_at','DESC')
            ->get();
        }
        $title = 'Data Ticket Belum Diatasi';
        return view('ticket.index',compact('ticket','title'));
    }

    public function allticket()
    {
        $auth = Auth::user();
        if($auth->role_id==1 || $auth->role_id==2){
            $ticket = Ticket::orderBy('ticket_tickets.created_at','DESC')
            ->select('ticket_tickets.id as id','users.name as nama','ticket_tickets.pesan','ticket_tickets.created_at','ticket_tickets.updated_at','ticket_tickets.status','ticket_tickets.image')
            ->join('users','ticket_tickets.user_id','=','users.id')
            ->get();
        }else{
            $ticket = Ticket::where('ticket_tickets.user_id',$auth->id)
            ->select('ticket_tickets.id as id','users.name as nama','ticket_tickets.pesan','ticket_tickets.created_at','ticket_tickets.updated_at','ticket_tickets.status','ticket_tickets.image')
            ->join('users','ticket_tickets.user_id','=','users.id')
            ->orderBy('created_at','DESC')
            ->get();
        }
        $title = 'Data Semua Ticket';
        return view('ticket.index',compact('ticket','title'));
    }

    public function add()
    {
        return view('ticket.add');
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nama' => 'required',
            'user_id' => 'required',
            'pesan' =>  'required',
            'image' => 'max:2024',
            'image.*' => 'mimes:jpeg,jpg,png,gif,pdf,doc,docx'
        ]);

        $useradmin = User::where('role_id',1)->get();

        if($request->hasFile('image')) {
            foreach($request->file('image') as $file)
            {
                $name = uniqid() . '_' . time(). '.' .$file->getClientOriginalName();
                $file->move(public_path().'/img/photo/', $name);
                $data[] = $name;
            }

            $file= new Ticket();
            $file->user_id = $request->user_id;
            $file->nama = $request->nama;
            $file->pesan=$request->pesan;
            $file->image = json_encode($data);

            $file->save();

            // SEND Notification
            $notifdata = [
                'id_ticket' => $file->id,
                'name' => $request->nama,
                'message' => 'Ticket Baru telah dibuat'
            ];

            Notification::send($useradmin, new NewTicket($notifdata));
        }else{

            $ticket = Ticket::create([
                'nama' => $request->nama,
                'user_id' => $request->user_id,
                'pesan' => $request->pesan
            ]);

            // SEND Notification
            $notifdata = [
                'id_ticket' => $ticket->id,
                'name' => $request->nama,
                'message' => 'Ticket Baru telah dibuat'
            ];

            Notification::send($useradmin, new NewTicket($notifdata));
        }

        
        return redirect()->route('usr.ticket')
                        ->with('success','Ticket Berhasil Terkirim');
    }

    public function solved($id)
    {
        $auth = Auth::user();
        $validate = Ticket::where('user_id',$auth->id)
        ->where('id',$id)
        ->first();

        if($auth->role_id==1){
            $ticket = Ticket::find($id);
            $ticket->status = 1;
            $ticket->update();

            return redirect()->route('usr.ticket')->with('success','Berhasil Ubah Status');
        }elseif($auth->role_id==0 && !empty($validate)){
            $ticket = Ticket::find($id);
            $ticket->status = 1;
            $ticket->update();
            return redirect()->route('usr.ticket')->with('success','Berhasil Ubah Status');
        }else{
            return redirect()->route('usr.ticket')->with('error','Tidak ada hak akses');
        }
    }

    public function show($id)
    {
        $ticket = Ticket::where('ticket_tickets.id',$id)
        ->select('ticket_tickets.id as id','users.name as nama','ticket_tickets.pesan','ticket_tickets.created_at','ticket_tickets.updated_at','ticket_tickets.status','ticket_tickets.image')
            ->join('users','ticket_tickets.user_id','=','users.id')
        ->first();
        $pesan = Pesan::where('ticket_id',$id)
        ->orderBy('created_at','DESC')
        ->get();
        return view('ticket.show',compact('ticket','pesan'));
    }

    public function cari(Request $request)
    {
		$cari = $request->cari;
        $auth = Auth::user();

        if($auth->role_id==1){
            $ticket = Ticket::where('nama','like',"%".$cari."%")
            ->orwhere('pesan','like',"%".$cari."%")
            ->paginate();
        }else{
            $ticket = Ticket::where('user_id',$auth->id)
            // ->where(fn($query) =>
            //     $query->where('nama','like',"%".$cari."%")
            //     ->orwhere('pesan', 'like',"%".$cari."%")
            //     )
            ->where(function($q) use ($cari) {
                 $q->where('nama','like',"%".$cari."%")
                   ->orwhere('pesan', 'like',"%".$cari."%");
             })
            ->get();
        }
        $title = 'Hasil Pencarian '.$cari;
        return view('ticket.index',['ticket' => $ticket,'title' => $title]);
    }

    public function kirimpesan(Request $request)
    {
        // Validasi
        $request->validate([
            'ticket_id' => 'required',
            'nama' => 'required',
            'pesan' => 'required'
        ]);

        try{
            $pesan = Pesan::create([
                'ticket_id' => $request->ticket_id,
                'nama' => $request->nama,
                'pesan' => $request->pesan,
            ]);
            return redirect()->back();
        } catch (QueryException $e) {
            return redirect()->back()->with(['error' => $e->errorInfo]);
        }

    }

    public function update(Request $request)
    {
        // Validasi
        $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'pesan' => 'required',
            'image' => 'max:2024',
            'image.*' => 'mimes:jpeg,jpg,png,gif,pdf,doc,docx'
        ]);

        try{
            if($request->hasFile('image')) {
                foreach($request->file('image') as $file)
                {
                    $name = uniqid() . '_' . time(). '.' .$file->getClientOriginalName();
                    $file->move(public_path().'/img/photo/', $name);
                    $data[] = $name;
                }

                $file= Ticket::where('id',$request->id)->first();
                $multidata = json_encode($data);
                if(!empty($file->image)){
                    $merge = json_encode(array_merge(json_decode($multidata, true),json_decode($request->gambar, true)));
                }else{
                    $merge = $multidata;
                }
                $file->image = $merge;

                $file->save();
                return redirect()->back()
                            ->with('success','Ticket Berhasil Terkirim');
            }
            $ticket = Ticket::where('id',$request->id)->first();
            $ticket->nama = $request->nama;
            $ticket->pesan = $request->pesan;
            $ticket->status = $request->statusticket;
            if($request->statusticket==1){
                $user = User::where('id',$ticket->user_id)->get();
                $notifdata = [
                    'id_ticket' => $request->id,
                    'name' => $request->nama,
                    'message' => 'Ticket ['.$request->id.'] Telah Teratasi'
                ];

                Notification::send($user, new NewTicket($notifdata));
            }
            $ticket->update();
            return redirect()->route('usr.ticket')->with('success','Berhasil Edit');
        }catch (QueryException $e) {
            return redirect()->back()->with(['error' => $e->errorInfo]);
        }
    }

    public function batal($id)
    {
        $ticket = Ticket::find($id);
        if($ticket){
            $ticket->status = 3;
            $ticket->update();
            return redirect()->route('usr.ticket')->with('success','Berhasil');
        }else{
            return redirect()->back()->with(['error' => 'Error']);
        }
    }

    public function dibatalkan()
    {
        $auth = Auth::user();
        if($auth->role_id==1){
            $ticket = Ticket::where('status',3)
            ->orderBy('created_at','DESC')
            ->get();
        }else{
            $ticket = Ticket::where('status',3)
            ->where('user_id',$auth->id)
            ->orderBy('created_at','DESC')
            ->get();
        }
        $title = 'Data Ticket Sudah Dibatalkan';
        return view('ticket.index',compact('ticket','title'));
    }

    public function markread($id)
    {
        Auth::user()
            ->unreadNotifications
            ->where('id',$id)
            ->markAsRead();

        $notif = Auth::user()
                ->notifications
                ->where('id',$id)
                ->first();

        $ticket_id = $notif->data['id_ticket'];

        return redirect()->route('usr.showticket', $ticket_id);
    }
}
