@extends('layouts.app')
@section('content')

<div class="container">
	<h1 class="page-title">Master Data Barang</h1><br>


	<div class="card">
		<div class="card-header">
			<i class="fas fa-database"></i> Data barang
		</div>
		<div class="card-body">
		<a href="{{route('tambah_barang')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Barang</a>
			<table id="table" class="table table-striped table-hovered table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Berat</th>
						<th>Alamat Gudang</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($barang as $key)
					<tr>
						<td>{{$loop->iteration}}</td>
						<td>{{$key->nama}}</td>
						<td>{{$key->berat}}</td>
						<td>{{$key->gudang->alamat}}</td>
						<td>
							<a href="{{route('edit_barang', $key->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
							<a href="{{route('hapus_barang', $key->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection