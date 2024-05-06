<?php

namespace App\Http\Controllers;

use App\Models\Disposition;
use App\Models\MailType;
use App\Http\Requests\StoredisposisiRequest;
use App\Http\Requests\UpdatedisposisiRequest;
use Illuminate\Http\Request;

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
        return view('disposition.index', compact('dis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ds = Disposition::select('status')->get();
        $mailtype = MailType::all();
        $query = Disposition::query();

        if (request()->filled('ref_type_id')) {
            $query->whereHas('mail', function ($query) {
                $query->where('ref_type_id', request('ref_type_id'));
            });
        } else {
            $query->with('mail'); // Memuat relasi mail jika ref_type_id tidak ada
        }

        $mails = $query->get();
        return view('disposition.add', compact('ds', 'mails', 'mailtype'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'disposition_at' => 'required|date',
            'reply_at' => 'required',
            'description' => 'required',
            'notification' => 'required',
            'ref_type_id' => 'required|exists:mail_types,id',
            'user_id' => 'required|exists:users,id',
            'mail_id' => 'required|exists:mails,id',
            'status' => 'required|in:diverifikasi,menunggu verifikasi',
        ],
        [

            'reply_at.required' => 'reply harus di isi',
            'description.description' => 'deskripsi harus di isi',
            'ref_type_id.required' => 'tipe surat harus di isi dengan data yang valid',
            'mail_id.required' => 'mail harus di isi',
        ]);

        // Cek apakah user yang ingin diberi disposisi memiliki akses ke surat yang dimaksud
        $mail = Mail::findOrFail($request->mail_id);
        $recipient = User::findOrFail($request->user_id);

        if ($mail->recipient_id !== $recipient->id) {
            return response()->json(['error' => 'User yang dimaksud tidak memiliki akses ke surat ini.'], 403);
        }

        // Buat disposisi baru
        $disposition = new Disposition();
        $disposition->disposition_at = now();
        $disposition->reply_at = $request->reply_at;
        $disposition->description = $request->description;
        $disposition->notification = $request->notification;
        $disposition->ref_type_id = $request->ref_type_id;
        $disposition->user_id = auth()->id();
        $disposition->mail_id = $request->mail_id;
        $disposition->status = 'menunggu verifikasi';
        $disposition->save();

        return redirect()->route('disposition.index')->with('massage', 'disposisi berhasil di tambahkan');
    }

    public function confirmDisposition(Request $request, $id)
    {
        // Cek apakah disposisi ada dan milik user yang ingin mengonfirmasi
        $disposition = Disposition::findOrFail($id);

        if ($disposition->user_id !== auth()->id()) {
            return response()->json(['error' => 'Anda tidak memiliki izin untuk mengonfirmasi disposisi ini.'], 403);
        }

        // Lakukan konfirmasi disposisi
        $disposition->status = 'diverifikasi'; // Ubah status menjadi diverifikasi
        $disposition->save();

        return response()->json(['message' => 'Disposisi berhasil diverifikasi.']);
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
    public function edit(disposisi $disposisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedisposisiRequest $request, disposisi $disposisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(disposisi $disposisi)
    {
        //
    }
}
