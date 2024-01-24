<?php
include 'conpoli.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
?>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    h2 {
        color: #333;
        border-bottom: 2px solid #333;
        padding-bottom: 10px;
    }

    p {
        margin: 10px 0;
    }

    button {
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
</style>

<?php
if (isset($_GET['page']) && $_GET['page'] == 'invoice' && isset($_GET['id'])) {
    $id_periksa = $_GET['id'];

    // Ambil data periksa dan detail_periksa berdasarkan ID
    $query_periksa = "SELECT 
                            pr.*,
                            d.nama AS 'nama_dokter', 
                            p.nama AS 'nama_pasien', 
                            GROUP_CONCAT(dp.id_obat SEPARATOR ', ') AS 'id_obat'
                        FROM periksa pr 
                        LEFT JOIN dokter d ON (pr.id_dokter = d.id) 
                        LEFT JOIN pasien p ON (pr.id_pasien = p.id)
                        LEFT JOIN detail_periksa dp ON (pr.id = dp.id_periksa)
                        LEFT JOIN obat o ON (dp.id_obat = o.id) 
                        WHERE pr.id = $id_periksa
                        GROUP BY pr.id";
    $result_periksa = mysqli_query($mysqli, $query_periksa);

    // Tampilkan data periksa
    if ($data_periksa = mysqli_fetch_array($result_periksa)) {
        ?>
        <p>Nomor Periksa: <?php echo $data_periksa['id']; ?></p>
        <p>Nama Pasien: <?php echo $data_periksa['nama_pasien']; ?></p>
        <p>Nama Dokter: <?php echo $data_periksa['nama_dokter']; ?></p>
        <p>Tanggal Periksa: <?php echo $data_periksa['tgl_periksa']; ?></p>
        <p>Obat:
            <?php
            $id_obat_array = explode(', ', $data_periksa['id_obat']);
            $nama_obat_array = [];

            foreach ($id_obat_array as $id_obat) {
                $query_obat = "SELECT nama_obat FROM obat WHERE id = $id_obat";
                $result_obat = mysqli_query($mysqli, $query_obat);
                $data_obat = mysqli_fetch_array($result_obat);

                if ($data_obat) {
                    $nama_obat_array[] = $data_obat['nama_obat'];
                }
            }

            echo implode(', ', $nama_obat_array);
            ?>
        </p>
        <p>Catatan: <?php echo $data_periksa['catatan']; ?></p>

        <?php
        // Harga dokter per periksa
        $harga_dokter = 150000;

        // Ambil harga obat berdasarkan ID
        $total_harga_obat = 0;

        foreach ($id_obat_array as $id_obat) {
            $query_harga_obat = "SELECT harga FROM obat WHERE id = $id_obat";
            $result_harga_obat = mysqli_query($mysqli, $query_harga_obat);
            $data_harga_obat = mysqli_fetch_array($result_harga_obat);

            // Jika harga obat ditemukan, tambahkan ke total harga obat
            if ($data_harga_obat) {
                $total_harga_obat += (int)$data_harga_obat['harga'];
            }
        }

        // Hitung total pembayaran
        $total_pembayaran = $harga_dokter + $total_harga_obat;

        ?>
        <!-- Tampilkan informasi pembayaran -->
        <p>Total Pembayaran (Dokter): Rp. <?php echo number_format($harga_dokter, 0, ',', '.'); ?></p>
        <p>Total Pembayaran (Obat): Rp. <?php echo number_format($total_harga_obat, 0, ',', '.'); ?></p>
        <p>Total Pembayaran: Rp. <?php echo number_format($total_pembayaran, 0, ',', '.'); ?></p>

        <!-- Tambahkan tombol untuk mencetak invoice jika diperlukan -->
        <button onclick="window.print()">Cetak Invoice</button>

        <?php
    } else {
        echo "<p>Data periksa tidak ditemukan</p>";
    }
} else {
    // Tambahkan logika untuk menangani halaman periksa atau halaman lainnya
}
?>
