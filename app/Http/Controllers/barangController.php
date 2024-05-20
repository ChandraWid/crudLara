<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class barangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumbaris = 4;

        if (strlen($katakunci)) {
            $data = Barang::where('id', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('jenis', 'like', "%$katakunci%")
                ->paginate($jumbaris);
        } else {
            $data = Barang::orderBy('id', 'asc')->paginate($jumbaris);
        }

        return view('barang.index')->with('data', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Session::flash('id', $request->id);
        Session::flash('nama', $request->nama);
        Session::flash('jenis', $request->jenis);

        //validasi kalo pas create kosong disimpan
        $request->validate(
            [
                'id' => 'required|numeric|unique:barang,id',
                'nama' => 'required',
                'jenis' => 'required'
            ],
            [
                'id.required' => 'Kolom ID harus diisi',
                'id.numeric' => 'ID harus dalam angka',
                'id.unique' => 'ID sudah ada',
                'nama.required' => 'Kolom Nama harus diisi',
                'jenis.required' => 'Kolom Jenis harus diisi'
            ]
        );

        //create data
        $data = [
            'id' => $request->id,
            'nama' => $request->nama,
            'jenis' => $request->jenis,

        ];
        barang::create($data);
        return redirect()->to('barang')->with('Success', 'Berhasil menambahkan data');
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
    public function edit(string $id)
    {
        $data = barang::where('id', $id)->first();
        return view('barang.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'nama' => 'required',
                'jenis' => 'required'
            ],
            [
                'nama.required' => 'Kolom Nama harus diisi',
                'jenis.required' => 'Kolom Jenis harus diisi'
            ]
        );

        //create data
        $data = [
            'nama' => $request->nama,
            'jenis' => $request->jenis,

        ];
        barang::where('id', $id)->update($data);
        return redirect()->to('barang')->with('Success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        barang::where('id', $id)->delete();
        return redirect()->to('barang')->with('Success', 'Berhasil melakukan delete data');
    }
}
