@extends('layout.master')

@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pengembalian</h1>
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
                            <h3 class="card-title">Daftar Mobil yang Dikembalikan</h3>

                            <div class="text-center mx-auto">
                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#modal-tambah-data">+
                                    Pengembalian Baru</button>
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
                                        <th>Plat No</th>
                                        <th>Tanggal Pengembalian</th>
                                    </tr>
                                </thead>
                                <tbody>

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
        <form action="{{ url('/storePengembalian')}}" method="POST" id="pengembalian">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Pengembalian</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="peminjaman_id" name="peminjaman_id">
                        <input type="hidden" id="mobil_id" name="mobil_id">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Data Pengembalian</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Pilih Plat Nomor</label>
                                    <select onchange="ambilData(this)" name="plat_nomor" id="plat_nomor"
                                        class="form-control select2" style="width: 100%;">
                                        <option value="">-- Pilih Plat Nomor --</option>
                                        @forelse ($dropDownPlat as $row)
                                            <option value="{{ $row->plat_nomor }}">{{ $row->plat_nomor }}</option>
                                        @empty
                                            <option value="">Tidak ada data</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_mulai">Tanggal Pengembalian</label>
                                    <input onchange="ambilData($('#plat_nomor'))" type="date" class="form-control" name="tanggal_pengembalian"
                                        id="tanggal_pengembalian">
                                </div>
                                <div class="form-group">
                                    <label for="total_hari">Total Hari</label>
                                    <input type="text" class="form-control" name="total_hari" id="total_hari" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" class="form-control" name="model" id="model" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="total_biaya">Total Biaya</label>
                                    <input type="text" class="form-control" name="total_biaya" id="total_biaya" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-id="1"
                                data-dismiss="modal">Close</button>
                            <button type="button" onclick="tombolSimpan()" class="btn btn-primary" data-id="2">Save
                                changes</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let tanggal = "{{ date('Y-m-d') }}"
            $('#tanggal_pengembalian').val(tanggal)
        })

        const ambilData = (obj) => {
            let data_mobil = $(obj).val()
            let tgl_kembali = $('#tanggal_pengembalian').val()
            if (data_mobil != '') {
                $.ajax({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                    method: "GET",
                    url: "{{ url('/ambilDataPeminjaman') }}",
                    dataType: "json",
                    data: {
                        id: data_mobil,
                        tgl_kembali: tgl_kembali
                    },
                    success: function(data) {
                        $('#total_hari').val(data.totalHari)
                        $('#total_biaya').val(data.totalBiaya)
                        $('#model').val(data.model)
                        $('#peminjaman_id').val(data.peminjaman_id)
                        $('#mobil_id').val(data.mobil_id)
                    },
                    error: function(data) {
                        // alert(data)
                    }
                });
            }
        }

        const tombolSimpan = () => {
            let plat_nomor = $('#plat_nomor').val()
            if (plat_nomor == '') {
                alert('Pilih Plat Nomor Dahulu !')
                return false
            }
            $('#pengembalian').submit()
        }
    </script>
@endsection
