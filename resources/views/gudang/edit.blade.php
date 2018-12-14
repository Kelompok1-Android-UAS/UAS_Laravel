@extends("layouts.app")
@section('content')

<div class="container">
	<h1 class="page-title"><a href="{{route('semua_gudang')}}"><i class="fas fa-chevron-left"></i></a> Sunting Data Goedang</h1><br>

	<div class="card">
		<div class="card-header">
			<i class="fas fa-pencil"></i> Sunting data gudang
		</div>
		<div class="card-body">
			<form action="{{route('update_gudang')}}" method="post" enctype="mutlipart/form-data">
				@csrf()
				<input type="hidden" name="id" value="{{$gudang->id}}">
				<div class="form-group">
					<label for="">Alamat Gudang</label>
					<textarea name="alamat" id="" cols="30" rows="10" class="form-control">{{$gudang->alamat}}</textarea>
				</div>
				<div class="form-group">
					<label for="">Kapasitas Gudang</label>
					<input type="number" name="kapasitas" class="form-control" value="{{$gudang->kapasitas}}">
				</div>
				<div class="form-group">
					<label for="">Foto</label><br>
					<img src="{{asset('uploads/img/'.$gudang->pic)}}" alt=""><br><br>
					<input type="file" name="foto">
				</div>
				<button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Simpan</button>
			</form>
		</div>
	</div>
</div>

@endsection