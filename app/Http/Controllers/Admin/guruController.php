<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\guru;
use Illuminate\Http\Request;

class guruController extends Controller
{
     // method untuk data guru
     public function index(){
        $gurus = guru::latest()->when(request()->q, function($gurus){
            $gurus = $gurus->where("nama_guru", "like", "%". request()->q . "%");
        })->paginate(10);
        return view("admin.guru.index", compact("gurus")); ;
    }

     //method untuk panggil form input data
     public function create(){
        return view('admin.guru.create');
    }

     //method untuk kirem data dari inputan form ke tabel guru di database
     public function store(Request $request){
        $this->validate($request, [
            'nama_guru' => 'required|unique:gurus',
            'no_hp' => 'required|min:12',
            'alamat'=> 'required',
        ]);

        //data input simpan ke dalam tabel
        $gurus = guru::create([
            'nama_guru' => $request->nama_guru,
            'no_hp' => $request->no_hp,
            'alamat'=> $request->alamat,
        ]);

        //kondisi apakah data berhasil disimpan atau tidak
        if($gurus){
            //redirect dengan tampilkan pesan
            return redirect()->route('admin.guru.index')->with(['succes' =>'Data Berhasil Disimpan kedalam tabel guru']);
        }else{
            return redirect()->route('admin.guru.index')->with(['error' =>'Data Gagal Disimpan kedalam tabel guru']);
        }
    }

        // method untuk tampilkan data yang mau diubah
        public function edit(guru $guru){
            return view('admin.guru.edit', compact('guru'));
        }

         //buat method untuk kirimkan data yang di ubah di form inputan
         public function update(Request $request, guru $guru){
    
        // Code untuk memvalidasi inputan
        $this ->validate($request, [
            'nama_guru'=> 'required|:gurus,nama_client,' .$guru->id,
            'no_hp'=> 'required|:gurus,no_kontak,' .$guru->id,
            'alamat'=> 'required|:gurus,alamat,' .$guru->id,
        ]);

         //update data di tabel guru dengan data baru
         $guru = guru::findOrFail($guru->id);
         $guru->update([
             'nama_guru'=> $request->nama_guru,
             'no_hp'=> $request->no_hp,
             'alamat'=> $request->alamat,
         ]);

         //Kondisi Jika Berhasil atau Gagal ubah datanya
        if($guru){
            // redirect dengan tampilkan pesan
                return redirect()->route('admin.guru.index')->with('success','Data Berhasil Diubah Kedalam Tabel guru');
            }else{
                return redirect()->route('admin.guru.index')->with('error','Data Gagal Diubah Kedalam Tabel guru');
            }
        }
        
              //membuat method hapus
    public function destroy($id){
        $guru = guru::findOrFail($id);
        // hapus dulu image sebelumnya
        
        $guru->delete();

        //kondisi berhasil hapus atau tidak
        if($guru){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }
    }
    }