<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alfan;

class AlfanController extends Controller
{
    public function add()
    {
        return view('admin.alfan.add');
    }

    public function store(Request $request)
    {
        // Validasi data
        $this->validate(request(), [
            'kegiatan' => 'required',
            'tanggal' => 'required',
        ]);

        // Store kegiatan to database
        try {
            $kegiatan = Alfan::create([
                'kegiatan' => $request->kegiatan,
                'tanggal' => $request->tanggal,
                'isread' => 0
            ]);

            return redirect()->route('adm.dataalfan')->with(['success' => 'Success membuat Kegiatan']);
        } catch (QueryException $e) {
            return redirect()->route('adm.dataalfan')->with(['error' => $e->errorInfo]);
        }
    }

    public function index()
    {
        $alfan = Alfan::orderBy('tanggal','ASC')->get();
        return view('admin.alfan.index',compact('alfan'));
    }
}
