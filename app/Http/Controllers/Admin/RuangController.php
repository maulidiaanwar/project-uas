<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
     // method untuk data guru
     public function index(){
        $ruangs = ruang::latest()->when(request()->q, function($ruangs){
            $ruangs = $ruangs->where("nama_ruang", "like", "%". request()->q . "%");
        })->paginate(10);
        return view("admin.ruang.index", compact("ruangs")); ;
    }
     //method untuk panggil form input data
     public function create(){
        return view('admin.ruang.create');
    }

     //method untuk kirem data dari inputan form ke tabel siswa di database
     public function store(Request $request){
        $this->validate($request, [
            'nama_ruang' => 'required|unique:ruangs',
            'nomor_ruang' => 'required',
        ]);

        //data input simpan ke dalam tabel
        $ruangs = ruang::create([
            'nama_ruang' => $request->nama_ruang,
            'nomor_ruang' => $request->nomor_ruang,
        ]);

        //kondisi apakah data berhasil disimpan atau tidak
        if($ruangs){
            //redirect dengan tampilkan pesan
            return redirect()->route('admin.ruang.index')->with(['succes' =>'Data Berhasil Disimpan kedalam tabel ruang']);
        }else{
            return redirect()->route('admin.ruang.index')->with(['error' =>'Data Gagal Disimpan kedalam tabel ruang']);
        }
    }

        // method untuk tampilkan data yang mau diubah
        public function edit(ruang $ruang){
            return view('admin.ruang.edit', compact('ruang'));
        }

         //buat method untuk kirimkan data yang di ubah di form inputan
         public function update(Request $request, ruang $ruang){
    
        // Code untuk memvalidasi inputan
        $this ->validate($request, [
            'nama_ruang'=> 'required|:ruangs,nama_ruang,' .$ruang->id,
            'nomor_ruang'=> 'required|:ruangs,nomor_ruang,' .$ruang->id,
        ]);

         //update data di tabel guru dengan data baru
         $ruang = ruang::findOrFail($ruang->id);
         $ruang->update([
             'nama_ruang'=> $request->nama_ruang,
             'nomor_ruang'=> $request->nomor_ruang,
         ]);

         //Kondisi Jika Berhasil atau Gagal ubah datanya
        if($ruang){
            // redirect dengan tampilkan pesan
                return redirect()->route('admin.ruang.index')->with('success','Data Berhasil Diubah Kedalam Tabel ruang');
            }else{
                return redirect()->route('admin.ruang.index')->with('error','Data Gagal Diubah Kedalam Tabel ruang');
            }

        }

            //membuat method hapus
    public function destroy($id){
        $ruang = ruang::findOrFail($id);
        // hapus dulu image sebelumnya
        
        $ruang->delete();

        //kondisi berhasil hapus atau tidak
        if($ruang){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }
    }
}
