<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Models\ProductModel;

class ProdukController extends BaseController
{
    protected $product;

    function __construct()
    {
        helper('form');
        helper('number');
        $this->product = new ProductModel();
    }

    public function index()
    {
        $product = $this->product->findAll();
        $data['product'] = $product;

        return view('v_produk', $data);
    }

    public function create()
    {
        $dataFoto = $this->request->getFile('foto');

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'jumlah' => $this->request->getPost('jumlah'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        if ($dataFoto->isValid()) {
            $fileName = $dataFoto->getRandomName();
            $dataForm['foto'] = $fileName;
            $dataFoto->move('img/', $fileName);
        }

        $this->product->insert($dataForm);

        return redirect('produk')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $dataProduk = $this->product->find($id);

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'jumlah' => $this->request->getPost('jumlah'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        if ($this->request->getPost('check') == 1) {
            if ($dataProduk['foto'] != '' and file_exists("img/" . $dataProduk['foto'] . "")) {
                unlink("img/" . $dataProduk['foto']);
            }

            $dataFoto = $this->request->getFile('foto');

            if ($dataFoto->isValid()) {
                $fileName = $dataFoto->getRandomName();
                $dataFoto->move('img/', $fileName);
                $dataForm['foto'] = $fileName;
            }
        }

        $this->product->update($id, $dataForm);

        return redirect('produk')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $dataProduk = $this->product->find($id);

        if ($dataProduk['foto'] != '' and file_exists("img/" . $dataProduk['foto'] . "")) {
            unlink("img/" . $dataProduk['foto']);
        }

        $this->product->delete($id);

        return redirect('produk')->with('success', 'Data Berhasil Dihapus');
    }

    public function download()
    {
        log_message('debug', 'Download method called');
        ini_set('memory_limit', '1024M'); // Increase memory limit for PDF generation
        set_time_limit(300); // Increase max execution time to 5 minutes

        try {
            //get data from database
            $product = $this->product->findAll();

            //pass data to file view
            $html = view('v_produkPDF', ['product' => $product]);

            //set the pdf filename
            $filename = date('y-m-d-H-i-s') . '-produk.pdf';

            // instantiate and use the dompdf class
            $dompdf = new Dompdf();

            // load HTML content (file view)
            $dompdf->loadHtml($html);

            // setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // render html as PDF
            $dompdf->render();

            // Clear previous output buffer to avoid header issues
            if (ob_get_length()) {
                ob_end_clean();
            }

            // Set headers explicitly for PDF download
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Cache-Control: private, max-age=0, must-revalidate');
            header('Pragma: public');

            // Output the PDF to browser
            echo $dompdf->output();

            exit; // Stop further output
        } catch (\Exception $e) {
            log_message('error', 'PDF download error: ' . $e->getMessage());
            return redirect('produk')->with('error', 'Failed to generate PDF. Please try again later.');
        }
    }
}
