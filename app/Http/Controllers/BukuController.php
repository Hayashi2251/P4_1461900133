<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\BukuExport;
use App\Models\Buku;
use App\Models\JenisBuku;
use App\Models\RakBuku;

class BukuController extends Controller
{
    public function index(){
        $rak = RakBuku::join('buku','rak_buku.id_buku', '=', 'buku.id')->join('jenis_buku', 'rak_buku.id_jenis_buku', '=', 'jenis_buku.id')->get();
        // dd($rak);
        return view('buku0133', [
            'rak' => $rak,
        ]);
    }

    public function export_excel(){
		return Excel::download(new BukuExport, 'Data_1461900133.xlsx');
	}
}
