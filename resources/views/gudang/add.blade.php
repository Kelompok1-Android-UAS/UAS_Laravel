@extends("layouts.app")
@section('content')

<div class="container">	
	<h1 class="page-title"><a href="{{route('semua_gudang')}}"><i class="fas fa-chevron-left"></i></a> Tambah Goedang</h1><br>

	<div class="card">
		<div class="card-header">
			<i class="fas fa-plus"></i> Tambah Gudang
		</div>
		<div class="card-body">
			<form action="{{route('simpan_gudang')}}" method="post" enctype="multipart/form-data">
				@csrf()
				<div class="form-group">
					<label for="">Alamat Gudang</label>
					<textarea name="alamat" id="" cols="30" rows="10" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label for="">Kapasitas Gudang</label>
					<input type="number" name="kapasitas" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Foto</label>
					<input type="file" name="foto">
				</div>
				<button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Simpan</button>
			</form>
		</div>
	</div>
</div>

@endsection