@extends('layouts.app', ['title' => 'Tambah Data Siswa - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">

        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold capitalize">TAMBAH DATA SISWA</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.siswa.store') }}" method="POST" >
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4">

                   
                    <div>
                        <label class="text-gray-700" for="nama_siswa">NAMA SISWA</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="nama_siswa" value="{{ old('nama_siswa') }}" placeholder="Nama Siswa">
                        @error('nama_siswa')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700" for="tanggal_lahir">TANGGAL LAHIR</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="Input Tanggal Lahir">
                        @error('tanggal_lahir')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
</div>
                    <div>
                        <label class="text-gray-700" for="alamat">ALAMAT SISWA</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat">
                        @error('alamat')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
</div>
                    <div>
                        <label class="text-gray-700" for="guru_id">NAMA GURU</label>
                        <select class="w-full border bg-gray-200 focus:bg-white rounded px-3 py-2 outline-none" name="guru_id">
                            @foreach($gurus as $guru)
                                <option class="py-1" value="{{ $guru->id}}">{{ $guru->nama_guru }}</option>
                            @endforeach
                        </select>
                        @error('guru_id')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="ruang_id">NAMA RUANG</label>
                        <select class="w-full border bg-gray-200 focus:bg-white rounded px-3 py-2 outline-none" name="ruang_id">
                            @foreach($ruangs as $ruang)
                                <option class="py-1" value="{{ $ruang->id}}">{{ $ruang->nama_ruang }}</option>
                            @endforeach
                        </select>
                        @error('ruang_id')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>
</div>

                <div class="flex justify-start mt-4">
                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection  