<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $dataMobil = Mobil::where('user_id', 1)->get();
        // dd($dataMobil);

        return view('data-mobil.index', ['dataMobil' => $dataMobil]);
    }

    public function tambahData(Request $request)
    {
        // dd($request->all);
        $mobil = Mobil::create([
            "merek" => $request["merek"],
            "model" => $request["model"],
            "plat_nomor" => $request["plat_nomor"],
            "tarif" => $request["tarif"],
            "status_sewa" => 0,
            "user_id" => 1
        ]);
        // dd($mobil->save());
        if ($mobil->save()) {
            Session::flash('sukses', 'Data Berhasil Disimpan !!!');
            return redirect('/');
        }
    }

    public function hapusData($id)
    {
        $model = Mobil::where('id', $id)->first();
        // $model->delete();

        if ($model->delete()) {
            Session::flash('sukses', 'Data Berhasil Dihapus !!!');
            return redirect('/');
        }
    }

    public function peminjaman()
    {

        $peminjaman = Peminjaman::where('peminjaman.user_id', 1)
            ->join('mobil', 'peminjaman.mobil_id', '=', 'mobil.id')
            ->get();
        // dd($peminjaman);

        $dropDownModel = Mobil::select('id', 'model', 'user_id')
            ->where('status_sewa', false)
            ->get();
        // dd($dropDownModel);

        return view(
            'peminjaman.index',
            [
                'dropDownModel' => $dropDownModel,
                'peminjaman' => $peminjaman
            ]
        );
    }

    public function storePeminjaman(Request $request)
    {
        // dd($request->all());
        $mobil = Mobil::where('id', $request->mobil_id)->first();

        $totalBiaya = $mobil->tarif * (strtotime($request->tanggal_selesai) - strtotime($request->tanggal_mulai)) / (60 * 60 * 24);

        $peminjaman = Peminjaman::create([
            'user_id' => 1,
            'mobil_id' => $request->mobil_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'total_biaya' => $totalBiaya,
            'status_pengembalian' => false
        ]);

        // Update status_sewa in mobil table
        $mobil->status_sewa = true;
        if ($mobil->save() && $peminjaman->save()) {
            Session::flash('sukses', 'Data Berhasil Disimpan !!!');
            return redirect('/peminjaman');
        }
    }

    public function pengembalian()
    {
        $dropDownPlat = Peminjaman::leftJoin('mobil', 'peminjaman.mobil_id', '=', 'mobil.id')
            ->select('mobil.plat_nomor', 'mobil.id')
            ->where('status_pengembalian', false)
            ->get();

        return view(
            'pengembalian.index',
            [
                'dropDownPlat' => $dropDownPlat
            ]
        );
    }

    public function ambilDataPeminjaman() {
        $mobil_id = $_GET['id'];
        $tgl_kembali = $_GET['tgl_kembali'];
        $mobil = Mobil::where('plat_nomor', $mobil_id)->first();
        $peminjaman = Peminjaman::where('mobil_id', $mobil->id)->where('status_pengembalian', false)->first();
        // dd($peminjaman->tanggal_mulai);
        
        $totalHari = (strtotime($tgl_kembali) - strtotime($peminjaman->tanggal_mulai)) / (60 * 60 * 24);
        $totalBiaya = $mobil->tarif * (strtotime($tgl_kembali) - strtotime($peminjaman->tanggal_mulai)) / (60 * 60 * 24);
        $model = $mobil['model'];
        $peminjaman_id = $peminjaman->id;
        $mobil_id = $mobil['id'];
        $data = [
            'totalHari'     => $totalHari,
            'totalBiaya'    => $totalBiaya,
            'model'         => $model,
            'peminjaman_id' => $peminjaman_id,
            'mobil_id'      => $mobil_id
        ];
        return json_encode($data);
    }

    public function storePengembalian(Request $request) {
        $peminjaman_id = $request->peminjaman_id;
        dd($request->all());
        $peminjaman = Peminjaman::with('mobil')->where('peminjaman_id', $peminjaman_id)->first();
        dd($peminjaman);
    }
}
