<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disposition;

class dashController extends Controller
{
    public function index()
    {
        $confirm = Disposition::where('status', 'diverifikasi')->count();

        // Menghitung jumlah disposisi yang belum dikonfirmasi (menunggu verifikasi)
        $unconfirm = Disposition::where('status', 'menunggu verifikasi')->count();

        return view('berandadash', compact('confirm' , 'unconfirm'));
    }
}
