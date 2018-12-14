@extends("layouts.app")
@section('content')

<div class="container">
	<h1 class="page-title">Master Goedang</h1><br>

	<div class="card">
		<div class="card-header">
			Daftar Goedang
		</div>
		<div class="card-body">
			<a href="{{route('tambah_gudang')}}" class="btn btn-primary"><i class="fas fa-plus"></i> <span>Tambah</span></a>

			<table id="table" class="table table-hovered table-striped table-bordered" style="width: 100%;">
				<thead>
					<tr>
						<th>No</th>
						<th>Alamat</th>
						<th>Kapasitas</th>
						<th>Gambar</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($gudang as $key)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$key->alamat}}</td>
							<td>{{$key->kapasitas}}</td>
							<td><img src="{{asset('uploads/img/'.$key->pic)}}" alt=""></td>
							<td>
								<a href="{{route('edit_gudang', $key->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
								<a href="{{route('hapus_gudang', $key->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection