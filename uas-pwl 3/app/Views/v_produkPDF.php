<h1>Data Produk</h1>

<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Foto</th>
    </tr>

    <?php
    $no = 1;
    foreach ($product as $index => $produk) :
        $path = "../public/img/" . $produk['foto'];
        $type = pathinfo($path, PATHINFO_EXTENSION);

        if (file_exists($path)) {
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        } else {
            // Fallback to transparent 1x1 gif
            $base64 = 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=';
        }
?>
        <tr>
            <td align="center"><?= $index + 1 ?></td>
            <td><?= $produk['nama'] ?></td>
            <td align="right"><?= "Rp " . number_format($produk['harga'], 2, ",", ".") ?></td>
            <td align="center"><?= $produk['jumlah'] ?></td>
            <td align="center">
                <img src="<?= $base64 ?>" width="50px">
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
use CodeIgniter\I18n\Time;
$now = Time::now('Asia/Jakarta', 'en_US');
?>
Downloaded on <?= $now->toDateTimeString() ?>
