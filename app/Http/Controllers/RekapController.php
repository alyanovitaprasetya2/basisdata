<?php

namespace App\Http\Controllers;

use App\Entities\UserEntity;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $data = Penjualan::query();

        if(Auth::user()->role === UserEntity::ADMINISTRATOR || Auth::user()->role === UserEntity::PENGAWAS) {
            $data = $data->where('tempat_id', tempatID());
        } else {
            $data = $data->where('tempat_id', tempatID())
                        ->where('created_by', userID());
        }

        if($request->filled('daterange')) {
            $dates = explode(' - ', $request->daterange);
            $start_date = $dates[0];
            $end_date = $dates[1];

            $data = $data->whereBetween('TanggalPenjualan', [$start_date, $end_date]);
        }

        $data = $data->paginate(10);

        return view('pages.rekap_penjualan.list', compact('data'));
    }

    public function detail($id)
    {
        $detail = DetailPenjualan::with('penjualan')->where('penjualanID', $id)->get();
        $penjualan = Penjualan::with('user')->where('id', $id)->first();

        return view('pages.rekap_penjualan.detail', [
            'detail' => $detail,
            'penjualan' => $penjualan,
            'id' => $id
        ]);
    }

    public function nota($id)
    {
        $detail = DetailPenjualan::with('penjualan')->where('penjualanID', $id)->get();
        $penjualan = Penjualan::with('user')->where('id', $id)->first();

        return view('layouts.nota.nota', [
            'detail' => $detail,
            'penjualan' => $penjualan,
            'id' => $id
        ]);
    }

    public function exportExcel()
    {
        $data = Penjualan::select('penjualan.*', 'users.username as pegawai')
                        ->join('users', 'penjualan.created_by', '=', 'users.id')
                        ->where('penjualan.tempat_id', tempatID())
                        ->get();

        $spreadSheet = new Spreadsheet();
        $sheet = $spreadSheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Kode');
        $sheet->setCellValue('C1', 'Tanggal Penjualan');
        $sheet->setCellValue('D1', 'Metode Pembayaran');
        $sheet->setCellValue('E1', 'Total Harga');
        $sheet->setCellValue('F1', 'Dibayar');
        $sheet->setCellValue('G1', 'Dicatat Oleh');

        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id']);
            $sheet->setCellValue('B' . $row, $item['Kode']);
            $sheet->setCellValue('C' . $row, $item['TanggalPenjualan']);
            if($item['Metode'] == 1) {
                $sheet->setCellValue('D' . $row, 'TUNAI');
            } elseif($item['Metode'] == 2) {
                $sheet->setCellValue('D' . $row, 'QRIS');
            } else {
                $sheet->setCellValue('D' . $row, 'TRANSFER');
            }
            $sheet->setCellValue('E' . $row, $item['TotalHarga']);
            $sheet->setCellValue('F' . $row, $item['Dibayar']);
            $sheet->setCellValue('G' . $row, $item['pegawai']);
            $row++;
        }

        $time = Carbon::now();
        $writer = new Xlsx($spreadSheet);
        $filename = 'data_export-' . $time . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
