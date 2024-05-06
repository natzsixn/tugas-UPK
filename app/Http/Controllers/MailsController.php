<?php

namespace App\Http\Controllers;

use App\Models\Mails;
use App\Models\User;
use App\Models\MailType;
use App\Models\Disposition;
use App\Http\Requests\StoreMailsRequest;
use App\Http\Requests\UpdateMailsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Cek apakah user memiliki akses sebagai admin atau pembuat surat
        if ($user->level === 'admin') {
            // Jika admin, tampilkan semua surat
            $mails = Mails::all();
        } else {
            // Jika bukan admin, tampilkan surat yang ditujukan ke user tersebut
            $mails = Mails::where('mail_to', $user->username)->orWhere('mail_from', $user->username)->get();
        }

        return view('suratmasuk.index', compact('mails'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mailtypes = MailType::all();
        return view('suratmasuk.create', compact('mailtypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try {
            $request->validate([
                'mail_code' => 'required',
                'mail_to' => 'required',
                'mail_from' => 'required',
                'mail_date' => 'required',
                'mail_subject' => 'required',
                'description' => 'required',
                'mail_type_id' => 'required',
                'incoming_at' => 'nullable',
                'file_upload' => 'nullable|mimes:pdf,png,jpg|max:10000'
            ],
            [
                'mail_code.required' => 'mail code harus di isi',
                'mail_to.required' => 'mail to harus di isi',
                'mail_from.required' => 'mail from harus di isi',
                'mail_date.required' => 'mail date harus di isi',
                'mail_subject.required' => 'mail subjek harus di isi',
                'description.required' => 'deskripsi harus di isi',
                'mail_type_id.required' => 'tipe surat harus di isi',
                'file_upload.required' => 'file harus di isi',
                'file_upload.mimes' => 'file harus bertipe pdf atau gambar',
                'file_upload.max' => 'file tidak boleh lebih 10mb',
            ]
            );

            // // Cek apakah user penerima (mail_to) ada
            // $recipient = User::where('username', $request->mail_to)->first();
            // if (!$recipient) {
            //     return redirect()->back()->withInput()->with('error_message', 'User penerima tidak ditemukan');
            // }

            $mail = new Mails();
            $mail->mail_code = $request->mail_code;
            $mail->mail_date = $request->mail_date;
            $mail->mail_from = $request->mail_from;
            $mail->mail_to = $request->mail_to;
            $mail->mail_subject = $request->mail_subject;
            $mail->description = $request->description;
            $mail->mail_type_id = $request->mail_type_id;
            $mail->incoming_at = now();
            $mail->user_id = Auth::id();

            // Upload file jika ada
            if ($request->hasFile('file_upload')) {
                $file = $request->file('file_upload');
                $fileName =  time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $mail->file_upload = 'uploads/' . $fileName;
            }

            $mail->save();
            return redirect()->route('mail.index')->with('status', 'Form Data berhasil ditambahkan');
        // } catch (\Exception $e) {
        //     return redirect()->back()->withInput()->with('error_message', 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mail = Mails::findOrFail($id);
        return view('suratmasuk.show', compact('mail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mails $mails , $id)
    {
        $mailtype = MailType::all();
        $mail = Mails::findOrFail($id);
        return view('suratmasuk.update', compact(['mailtype', 'mail']));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMailsRequest $request, Mails $mails)
    {
        $request->validate([
            'mail_code' => 'required',
            'mail_date' => 'required|date',
            'mail_from' => 'required',
            'mail_to' => 'required',
            'mail_subject' => 'required',
            'description' => 'required',
            'mail_type_id' => 'required|exists:mail_types,id',
            'file_upload' => 'nullable|file',
        ],
        [
            'mail_code.required' => 'mail code harus di isi',
            'mail_to.required' => 'mail to harus di isi',
            'mail_from.required' => 'mail from harus di isi',
            'mail_date.required' => 'mail date harus di isi',
            'mail_subject.required' => 'mail subjek harus di isi',
            'description.required' => 'deskripsi harus di isi',
            'mail_type_id.required' => 'tipe surat harus di isi',
            'file_upload.required' => 'file harus di isi',
            'file_upload.mimes' => 'file harus bertipe pdf atau gambar',
            'file_upload.max' => 'file tidak boleh lebih 10mb',
        ]);

        // Update data surat
        $mail->update([
            'mail_code' => $request->mail_code,
            'mail_date' => $request->mail_date,
            'mail_from' => $request->mail_from,
            'mail_to' => $request->mail_to,
            'mail_subject' => $request->mail_subject,
            'description' => $request->description,
            'mail_type_id' => $request->mail_type_id,
        ]);

        // Upload file jika ada
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $mail->file_upload = 'uploads/' . $fileName;
            $mail->save();
        }

        return redirect()->route('mail.index')->with('status', 'Form Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mail = Mails::findOrFail($id);

        // Hapus file terkait jika ada
        if ($mail->file_path) {
            Storage::disk('public')->delete($mail->file_upload);
        }

        // Hapus data mail dari database
        $mail->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('mail.index')->with('status', 'Mail data has been deleted successfully.');
    }
}
