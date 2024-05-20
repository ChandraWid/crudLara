@extends('layout.temp')
@section('konten')
    <!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
        <form class="d-flex" action="{{url('barang')}}" method="get">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
    </div>

    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
        <a href='{{url('barang/create')}}' class="btn btn-primary">+ Tambah Data</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-3">ID Barang</th>
                <th class="col-md-4">Nama Barang</th>
                <th class="col-md-2">Jenis</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $data->firstItem()?>
            @foreach ($data as $item)
            <tr>
                <td>{{$i}}</td>
                <td>{{$item->id}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->jenis}}</td>
                <td>
                    <a href='{{url('barang/'.$item->id.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Yakin ingin menghapus data?')" class="d-inline" action="{{url('barang/'.$item->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type ="submit" name ="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>    
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
    {{$data->withQueryString()->links()}}
</div>
<!-- AKHIR DATA -->
@endsection