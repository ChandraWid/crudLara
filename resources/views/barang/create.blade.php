@extends('layout.temp')
@section('konten')

@if ($errors -> any())
<div class="pt-3">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors-> all() as $item)
                <li>{{$item}}</li>
            @endforeach
        </ul>
    </div>
</div>
    
@endif
    <!-- START FORM -->
<form action='{{url('barang')}}' method='post'>
@csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href="{{ url('barang') }}" class="btn btn-secondary">&lt;&lt; Kembali</a>
        <div class="mb-3 row">
            <label for="id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='id' value = "{{Session::get('id')}}" id="id">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' value="{{Session::get('nama')}}" id="nama">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='jenis' value="{{Session::get('jenis')}}" id="jenis">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jenis" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
</form>
</div>
<!-- AKHIR FORM -->
@endsection