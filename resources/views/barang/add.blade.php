@extends('layouts.app')
@section('content')

<div class="container">
	<h1 class="page-title"><a href="{{route('semua_barang')}}"><i class="fas fa-chevron-left"></i></a> Tambah Data Barang</h1><br>

	<div class="card">
		<div class="card-header"><i class="fas fa-plus"></i> Tambah data barang</div>
		<div class="card-body">
			<form action="{{route('simpan_barang')}}" method="post" enctype="multipart/form-data">
				@csrf()
				<div class="form-group">
					<label for="">Nama Barang</label>
					<input type="text" name="nama" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Berat</label>
					<input type="number" name="berat" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Gudang</label>
					<select name="gudang" id="" class="form-control">
						<option value="">-- Pilih Gudang penyimpanan --</option>
						@foreach ($goedang as $key)
							<option value="{{$key->id}}">{{$key->alamat}}</option>
						@endforeach
					</select>
				</div>
				<button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Simpan</button>
			</form>
		</div>
	</div>
</div>

@endsection