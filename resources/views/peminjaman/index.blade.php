@extends('layout.master')

@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Peminjaman</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('isi')
    {{-- {{dd($dropDownModel)}} --}}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Mobil yang Disewa</h3>

                            <div class="text-center mx-auto">
                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#modal-tambah-data">+
                                    Sewa Baru</button>
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
                                        <th>Model</th>
                                        <th>Plat No</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($peminjaman as $row)
                                        <tr>
                                            <td> {{ $row->model }} </td>
                                            <td> {{ $row->plat_nomor }} </td>
                                            <td> {{ $row->tanggal_mulai }} </td>
                                            <td> {{ $row->tanggal_selesai }} </td>
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
        <form action="{{ url('/storePeminjaman')}}" method="POST" id="peminjaman">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Sewa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Data Sewa</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tanggal_mulai">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_selesai">Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai">
                                </div>
                                <div class="form-group">
                                    <label>Pilih Model</label>
                                    <select name="mobil_id" id="mobil_id" class="form-control select2" style="width: 100%;">
                                        <option value="">-- Pilih Model --</option>
                                        @forelse ($dropDownModel as $row)
                                            <option value="{{ $row->id }}">{{ $row->model }}</option>
                                        @empty
                                            <option value="">Tidak ada data</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-id="1"
                                data-dismiss="modal">Close</button>
                            <button type="button" onclick="tombolSimpan()" class="btn btn-primary" data-id="2">Save changes</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let tanggal_mulai = "{{ date('Y-m-d')}}"
            $('#tanggal_mulai').val(tanggal_mulai)
            let tanggal_selesai = "{{ date('Y-m-d', strtotime('+1 day'))}}"
            $('#tanggal_selesai').val(tanggal_selesai)
        })

        const tombolSimpan = () => {
            let model = $('#mobil_id').val()
            if (model == '') {
                alert('Pilih Model Dahulu !')
                return false
            }
            $('#peminjaman').submit()
        }
    </script>
@endsection
