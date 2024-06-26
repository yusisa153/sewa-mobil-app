@extends('layout.master')

@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Mobil</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('isi')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Mobil</h3>

                            <div class="text-center mx-auto">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah-data">+
                                    Data Baru</button>
                            </div>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Merk</th>
                                        <th>Model</th>
                                        <th>Plat No</th>
                                        <th>Tarif</th>
                                        <th>Keterangan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataMobil as $row)
                                        <tr>
                                            <td> {{ $row->merek }} </td>
                                            <td> {{ $row->model }} </td>
                                            <td> {{ $row->plat_nomor }} </td>
                                            <td> {{ $row->tarif }} </td>
                                            <td>
                                                @if ($row->status_sewa == true)
                                                    Sedang Di Pinjam
                                                @else
                                                    Ready
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="hapusData({{ $row->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="2">Tidak ada data</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="modal fade" id="modal-tambah-data">
        <form action="{{ url('/tambahData') }}" method="POST">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Mobil</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Data Mobil</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden">
                                    <label for="merek">Merek Mobil</label>
                                    <input type="text" class="form-control" id="merek" name="merek"
                                        placeholder="Masukkan merek mobil" required>
                                </div>
                                <div class="form-group">
                                    <label for="model">Model Mobil</label>
                                    <input type="text" class="form-control" id="model" name="model"
                                        placeholder="Masukkan model mobil" required>
                                </div>
                                <div class="form-group">
                                    <label for="model">Plat Nomor</label>
                                    <input type="text" class="form-control" id="plat_nomor" name="plat_nomor"
                                        placeholder="Masukkan plat nomor" required>
                                </div>
                                <div class="form-group">
                                    <label for="model">Tarif</label>
                                    <input type="text" class="form-control" id="tarif" name="tarif"
                                        placeholder="Masukkan tarif" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-id="1" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-id="2">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        function hapusData(id) {
            if (confirm('Apakah Yakin data ini akan dihapus ?')) {
                location.href = "{{ url('/hapusData') }}/" + id;
            }
        }
    </script>

    @if (!empty(session('sukses')))
        <script>
            var msg = "{{ session('sukses') }}"
            toastr.success(msg)
        </script>
    @endif
@endsection
