<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;


class PdfController extends Controller
{
    public function generatePDF($id)
    {
        echo $id;
        die;
        $data = [
            'title' => 'Contoh PDF',
            'content' => 'Ini adalah konten PDF yang di-generate dari Dompdf.'
        ];

        // Render view ke HTML
        $html = view('pages.pdf.document', $data)->render();

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // (Opsional) Atur opsi seperti ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Simpan PDF atau tampilkan dalam browser
        return $dompdf->stream('invoice.pdf');
    }
}
