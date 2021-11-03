<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Pesan;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        if($auth->role_id==1){
            $ticket = Ticket::where('status',0)
            ->orderBy('created_at','DESC')
            ->get();
        }else{
            $ticket = Ticket::where('status',0)
            ->where('user_id',$auth->id)
            ->orderBy('created_at','DESC')
            ->get();
        }
        $title = 'Data Ticket Sudah Diatasi';
        return view('ticket.index',compact('ticket','title'));
    }

    public function nonaktif()
    {
        $auth = Auth::user();
        if($auth->role_id==1){
            $ticket = Ticket::where('status',1)
            ->orderBy('updated_at','DESC')
            ->get();
        }else{
            $ticket = Ticket::where('status',1)
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
        if($auth->role_id==1){
            $ticket = Ticket::orderBy('updated_at','DESC')
            ->get();
        }else{
            $ticket = Ticket::where('user_id',$auth->id)
            ->orderBy('updated_at','DESC')
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
           return redirect()->route('usr.ticket')
                        ->with('success','Ticket Berhasil Terkirim');
        }

        /// insert setiap request dari form ke dalam database via model
        /// jika menggunakan metode ini, maka nama field dan nama form harus sama
        Ticket::create($request->all());
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
        $ticket = Ticket::where('id',$id)->first();
        $pesan = Pesan::where('ticket_id',$id)->orderBy('created_at','DESC')->get();
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
            ->where(fn($query) =>
                $query->where('nama','like',"%".$cari."%")
                ->orwhere('pesan', 'like',"%".$cari."%")
                )
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
}
