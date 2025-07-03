<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use Dompdf\Dompdf; // Tambahkan ini untuk mengimpor Dompdf

class InvoiceController extends BaseController
{
    protected $cart;
    protected $transaction;
    protected $transaction_detail;

    function __construct()
    {
        helper('number');
        helper('form');
        $this->cart = \Config\Services::cart();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }

    public function downloadInvoice($transactionId)
    {
        if (!is_numeric($transactionId) || $transactionId <= 0) {
            session()->setFlashdata('error', 'ID transaksi tidak valid.');
            return redirect()->to(base_url('transaksi')); // Redirect ke halaman daftar transaksi
        }

        $transaction = $this->transaction->find($transactionId);

        if (empty($transaction)) {
            session()->setFlashdata('error', 'Transaksi dengan ID tersebut tidak ditemukan.');
            return redirect()->to(base_url('transaksi'));
        }
        $items = $this->transaction_detail
            ->select('transaction_detail.*, product.nama, product.harga, product.foto')
            ->join('product', 'product.id = transaction_detail.product_id', 'left') // Asumsikan product_id di transaction_details
            ->where('transaction_id', $transactionId)
            ->findAll();

        if (empty($items)) {
            session()->setFlashdata('error', 'Detail invoice untuk transaksi ini tidak ditemukan.');
            return redirect()->to(base_url('transaksi'));
        }

        $data = [
            'transaction' => $transaction, // Data transaksi utama
            'items' => $items,             // Detail transaksi beserta data produk
        ];
        $html = view('v_invoice', $data); // Pastikan 'v_invoice' adalah nama file view Anda

        $filename = 'invoice-' . $transaction['id'] . '-' . date('Ymd-His');

        // 8. Inisialisasi Dompdf
        $dompdf = new Dompdf();

        // 9. Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // 10. (Opsional) Atur ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // 11. Render HTML menjadi PDF
        $dompdf->render();

        // 12. Output PDF sebagai respons HTTP yang akan memicu download
        return $this->response->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '.pdf"')
            ->setBody($dompdf->output());
    }

    public function buy()
    {
        if ($this->request->getPost()) {
            $dataForm = [
                'username' => $this->request->getPost('username'),
                'total_harga' => $this->request->getPost('total_harga'),
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            // Memastikan insert berhasil
            $this->transaction->insert($dataForm);
            $last_insert_id = $this->transaction->getInsertID();

            // Tambahkan pengecekan jika insert transaksi gagal
            if (!$last_insert_id) {
                // Handle error, mungkin redirect kembali dengan pesan error
                session()->setFlashdata('error', 'Gagal membuat transaksi. Silakan coba lagi.');
                return redirect()->back();
            }

            foreach ($this->cart->contents() as $value) {
                $dataFormDetail = [
                    'transaction_id' => $last_insert_id,
                    'product_id' => $value['id'],
                    'jumlah' => $value['qty'],
                    'diskon' => 0,
                    'subtotal_harga' => $value['qty'] * $value['price'],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];

                // Memastikan insert detail transaksi
                $this->transaction_detail->insert($dataFormDetail);
            }

            // Hancurkan keranjang belanja setelah semua data tersimpan
            $this->cart->destroy();

            return redirect()->to(base_url('invoice/download/' . $last_insert_id));
        }

        return redirect()->to(base_url('/')); // Contoh, redirect ke halaman utama
    }
}
