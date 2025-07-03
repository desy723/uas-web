<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-row {
            font-weight: bold;
            background-color: #e0e0e0;
        }

        .footer {
            text-align: right;
            margin-top: 30px;
            font-size: 0.9em;
        }
    </style>
</head>

<body>

    <div class="invoice-header">
        <h1>INVOICE PEMBELIAN</h1>
        <p>Toko Online Anda</p>
        <p>Jl. Contoh No. 123, Kota Anda</p>
    </div>

    <div class="invoice-details">
        <p><strong>Nomor Invoice:</strong> INV-<?= date("Ymd") ?>-<?= mt_rand(1000, 9999) ?></p>
        <p><strong>Tanggal:</strong> <?= date("d-m-Y H:i:s") ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama Produk</th>
                <th class="text-center">Jumlah</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Subtotal</th>
                <th class="text-center">Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $grandTotal = 0; // Inisialisasi grand total
            // Asumsi $items adalah variabel yang berisi data keranjang/detail transaksi
            foreach ($items as $item) :
                $subtotal = $item['jumlah'] * $item['harga'];
                $grandTotal += $subtotal;
                $imagePath = '../public/img/' . $item['foto']; // Contoh path di CI4

                $base64Image = '';
                if (file_exists($imagePath)) {
                    $type = pathinfo($imagePath, PATHINFO_EXTENSION);
                    $data = file_get_contents($imagePath);
                    $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($data);
                } else {
                    // Fallback jika gambar tidak ditemukan
                    $base64Image = 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='; // Gambar 1x1 transparan
                }
            ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $item['nama'] ?></td>
                    <td class="text-center"><?= $item['jumlah'] ?></td>
                    <td class="text-right"><?= "Rp " . number_format($item['harga'], 0, ",", ".") ?></td>
                    <td class="text-right"><?= "Rp " . number_format($subtotal, 0, ",", ".") ?></td>
                    <td class="text-center">
                        <img src="<?= $base64Image ?>" width="50px" alt="Foto Produk">
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="text-right">Total Pembelian:</td>
                <td class="text-right"><?= "Rp " . number_format($grandTotal, 0, ",", ".") ?></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Invoice ini diunduh pada: <?= date("Y-m-d H:i:s") ?></p>
        <p>Terima kasih telah berbelanja di toko kami!</p>
    </div>

</body>

</html>