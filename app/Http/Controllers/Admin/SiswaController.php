<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\guru;
use App\Models\ruang;
use App\Models\siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // method untuk data guru
    public function index(){
        $siswas = siswa::latest()->when(request()->q, function($siswas){
            $siswas = $siswas->where("nama_siswa", "like", "%". request()->q . "%");
        })->paginate(10);
        return view("admin.siswa.index", compact("siswas")); ;
    }

    
     //method untuk panggil form input data
     public function create(){
        // kode untuk ambil data dari tabel relasi yaitu tabel guru
        $gurus = guru::latest()->get();
        // kode untuk ambil data dari tabel relasi yaitu tabel ruang
        $ruangs = ruang::latest()->get();
        return view('admin.siswa.create', compact('gurus', 'ruangs'));
    }

    

     //method untuk kirem data dari inputan form ke tabel siswa
     public function store(Request $request){
        //validasi inputan
        $this->validate($request, [
            'nama_siswa' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'guru_id'=> 'required',
            'ruang_id' => 'required',
        ]);

        //data input simpan ke dalam tabel
        $siswas = siswa::create([
            'nama_siswa' => $request->nama_siswa,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat'=> $request->alamat,
            'guru_id'=> $request->guru_id,
            'ruang_id'=> $request->ruang_id,
        ]);

        //kondisi apakah data berhasil disimpan atau tidak
        if($siswas){
            //redirect dengan tampilkan pesan
            return redirect()->route('admin.siswa.index')->with('succes','Data Berhasil Disimpan kedalam tabel siswa');
        }else{
            return redirect()->route('admin.siswa.index')->with('error','Data Gagal Disimpan kedalam tabel siswa');
        }
    }

        // method untuk tampilkan data yang mau diubah
        public function edit(siswa $siswa){
            // kode untuk ambil data dari table relasi yaitu tabel guru
            $gurus = guru::latest()->get();
        // kode untuk ambil data dari table relasi yaitu tabel ruang
            $ruangs = ruang::latest()->get();
            return view('admin.siswa.edit', compact('siswa','gurus','ruangs'));
        }

         //buat method untuk kirimkan data yang di ubah di form inputan
         public function update(Request $request, siswa $siswa){

            
    
        // Code untuk memvalidasi inputan
        $this ->validate($request, [
            'nama_siswa'=> 'required|:siswas,nama_siswa', 
            'tanggal_lahir'=> 'required|:siswas,tanggal_lahir', 
            'alamat'=> 'required|:siswas,alamat', 
            'guru_id'=> 'required|exists:gurus,id', 
            'ruang_id'=> 'required|exists:ruangs,id' 
        ]);

         //update data di tabel guru dengan data baru
         $siswa = siswa::findOrFail($siswa->id);
         $siswa->update([
             'nama_siswa'=> $request->nama_siswa,
             'tanggal_lahir'=> $request->tanggal_lahir,
             'alamat'=> $request->alamat,
             'guru_id'=> $request->guru_id,
             'ruang_id'=> $request->ruang_id,
         ]);

         //Kondisi Jika Berhasil atau Gagal ubah datanya
        if($siswa){
            // redirect dengan tampilkan pesan
                return redirect()->route('admin.siswa.index')->with('success','Data Berhasil Diubah Kedalam Tabel siswa');
            }else{
                return redirect()->route('admin.siswa.index')->with('error','Data Gagal Diubah Kedalam Tabel siswa');
            }
        }

            //membuat method hapus
    public function destroy($id){
        $siswa = siswa::findOrFail($id);
        // hapus dulu image sebelumnya
        
        $siswa->delete();

        //kondisi berhasil hapus atau tidak
        if($siswa){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }
    }
    }