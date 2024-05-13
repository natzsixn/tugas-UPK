<?php

namespace App\Http\Controllers;

use App\Models\Disposition;
use App\Models\MailType;
use App\Models\Mails;
use App\Models\User;

use App\Http\Requests\StoredisposisiRequest;
use App\Http\Requests\UpdatedisposisiRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Cek apakah user memiliki akses sebagai admin atau tidak
        if ($user->level === 'admin') {
            // Jika admin, tampilkan semua surat

            $dis = Disposition::all();
        } else {
            // Jika bukan admin, tampilkan surat yang ditujukan ke user tersebut
            $dis = Disposition::where('user_id', $user->username)->get();
        }
        return view('disposition.index', compact('dis'  ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(disposisi $disposisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $disposition = Disposition::findOrFail($id);
        return view('disposition.edit', compact('disposition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedisposisiRequest $request, $id)
    {
        $disposition = Disposition::findOrFail($id);
        $disposition->update([
            'disposition_at' => now()->format('Y-m-d'), // Update ke format tahun-bulan-tanggal
            'reply_at' => now()->format('Y-m-d'), // Update ke format tahun-bulan-tanggal
            'status' => 'confirm'
        ]);

        return redirect()->route('disposisi.index')->with('success', 'Disposition updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(disposisi $disposisi)
    {
        //
    }
}
