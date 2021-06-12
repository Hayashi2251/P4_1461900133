<?php

namespace App\Exports;

use App\Models\RakBuku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BukuExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $rak = RakBuku::join('buku','rak_buku.id_buku', '=', 'buku.id')->join('jenis_buku', 'rak_buku.id_jenis_buku', '=', 'jenis_buku.id')->get();

        $data = [];
        foreach ($rak as $u) {

            $data[] = [
                'id' => $u->id ?? '-',
                'judul' => $u->judul ?? '-',
                'jenis' => $u->jenis ?? '-',
                'tahun_terbit' => $u->tahun_terbit ?? '-',
            ];
        }

        $collection = new Collection($data);

        // dd($collection);
        return $collection;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul Buku',
            'Jenis Buku',
            'Tahun Terbit'
        ];
    }
}
