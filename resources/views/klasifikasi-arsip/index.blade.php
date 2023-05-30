@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Klasifikasi Arsip</h2>
            </div>
            <div class="pull-right">
                {{-- @can('klasifikasi-arsip-create') --}}
                <a class="btn btn-success mb-2" href="{{ route('klasifikasi-arsip.create') }}"> +Tambah Klasifikasi</a>
                {{-- @endcan --}}
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Kode Klasifikasi</th>
            <th>Uraian</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($klasifikasi_arsips as $klasifikasi)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $klasifikasi->name }}</td>
                <td>{{ $klasifikasi->detail }}</td>
                <td>
                    <form action="{{ route('klasifikasi-arsip.destroy', $klasifikasi->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('klasifikasi-arsip.show', $klasifikasi->id) }}">Show</a>
                        {{-- @can('klasifikasi-edit') --}}
                        <a class="btn btn-primary" href="{{ route('klasifikasi-arsip.edit', $klasifikasi->id) }}">Edit</a>
                        {{-- @endcan --}}
                        @csrf
                        @method('DELETE')
                        {{-- @can('klasifikasi-delete') --}}
                        <button type="submit" class="btn btn-danger">Delete</button>
                        {{-- @endcan --}}
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $klasifikasi_arsips->links() !!}
    <p class="text-center text-primary"><small>https://github.com/Dedi24/aplikasi-menajemen-surat</small></p>
@endsection
