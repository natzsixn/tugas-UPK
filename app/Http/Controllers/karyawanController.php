<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('username','level', 'id')->get();
        return view('pegawai.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $level = User::select('level' ,)->get();
        return view('pegawai.create', compact('level'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try {
            $validate = $request->validate([
                'username' => 'required',
                'fullname' => 'required',
                'password' => 'required',
                'level' => 'required|in:admin,user,TU',
            ],
            [
                'username.required' => 'Kolom username harus diisi.',
                'fullname.required' => 'Kolom fullname harus diisi.',
                'password.required' => 'Kolom password harus diisi.',
                'level.required' => 'Pilih salah satu level (admin, user, TU).',
                'level.in' => 'Level yang dipilih tidak valid.',
            ]);
            
            $validate['password'] = hash::make($validate['password']);

            $users = new User($validate);
            $users->save();

            return redirect()->route('karyawan.index')->with('status', 'Form Data berhasil ditambahkan');
        // } catch (\Exception $e) {
        //     return redirect()->back()->withInput()->with('error_message', 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $level = User::select('level' ,)->get();
        return view('pegawai.edit', compact('user' , 'level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:users,username,',
            'fullname' => 'required',
            'password' => 'nullable|min:8',
            'level' => 'in:admin,user,TU',
        ],
        [
            'username.required' => 'Kolom username harus diisi.',
            'fullname.required' => 'Kolom fullname harus diisi.',
            'level.required' => 'Pilih salah satu level (admin, user, TU).',
            'level.in' => 'Level yang dipilih tidak valid.',
        ]);

        $user = User::findOrFail($id);

        if ($request->filled('password') && Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'password baru tidak boleh sama dengan password lama.']);
        }

        $user->update([
            'username' => $request->username,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'fullname' => $request->fullname,
            'level' => $request->level,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mendapatkan user yang sedang login
        $loggedInUser = Auth::user();

        // Mendapatkan user yang akan dihapus
        $user = User::findOrFail($id);

        // Memeriksa apakah user yang akan dihapus sama dengan user yang sedang login
        if ($user->id === $loggedInUser->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
        }

        // Melakukan penghapusan jika bukan user yang sedang login
        $user->delete();


        return redirect()->route('karyawan.index')->with('status', 'Mail data has been deleted successfully.');
    }
}
