@extends('layouts.app')
@section('content')

<div class="container">
	<h1 class="page-title"><a href="{{route('semua_barang')}}"><i class="fas fa-chevron-left"></i></a> Sunting Data Barang</h1><br>

	<div class="card">
		<div class="card-header">
			<i class="fas fa-pencil"></i> Sunting data barang
		</div>
		<div class="card-body">
			<form action="{{route('update_barang')}}" method="post">
				@csrf()
				<input type="hidden" value="{{$barang->id}}" name="id">
				<div class="form-group">
					<label for="">Nama barang</label>
					<input type="text" name="nama" class="form-control" value="{{$barang->nama}}">
				</div>
				<div class="form-group">
					<label for="">Berat</label>
					<input type="number" name="berat" class="form-control" value="{{$barang->berat}}">
				</div>
				<div class="form-group">
					<label for="">Pilih gudang</label>
					<select name="gudang" id="" class="form-control">
						<option value="{{$barang->gudang_id}}">{{$barang->gudang->alamat}}</option>
						@foreach ($daftar_gudang as $key)
							<option value="{{$key->id}}">{{$key->alamat}}</option>
						@endforeach
					</select>
				</div>
				<button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Update</button>
			</form>
		</div>
	</div>
</div>

@endsection