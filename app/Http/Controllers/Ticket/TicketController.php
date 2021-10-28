<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $ticket = Ticket::where('status',0)->get();
        return view('ticket.index',compact('ticket'));
    }

    public function nonaktif()
    {
        $ticket = Ticket::where('status',1)->get();
        return view('ticket.index',compact('ticket'));
    }

    public function allticket()
    {
        $ticket = Ticket::all();
        return view('ticket.index',compact('ticket'));
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
            'image.*' => 'mimes:jpeg,jpg,png,gif'
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

    public function show($id)
    {
        $ticket = Ticket::where('id',$id)->first();
        return view('ticket.show',compact('ticket'));
    }
}
