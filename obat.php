<?php
include_once("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">



    <!-- Bootstrap Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">   
    
    <title>Sistem Informasi Poliklinik</title>   <!--Judul Halaman-->
</head>
<body>
    <div class="container" >
        <hr>
            <!--Form Input Data-->
            <form  method="POST" action="" name="myForm" onsubmit="return(validate());">
            <!-- Kode php untuk menghubungkan form dengan database -->
                <?php
                    $nama_obat = '';
                    $kemasan = '';
                    $harga = '';
                    if (isset($_GET['id'])) {$ambil = mysqli_query($mysqli, 
                        "SELECT * FROM obat 
                        WHERE id='" . $_GET['id'] . "'");
                        while ($row = mysqli_fetch_array($ambil)) {
                            $nama_obat = $row['nama_obat'];
                            $kemasan = $row['kemasan'];
                            $harga = $row['harga'];
                        }
                    ?>
                        <input type="hidden" name="id" value="<?php echo
                        $_GET['id'] ?>">
                    <?php
                    }
                    ?>
                    <div class="col">
                        <label for="inputNamaObat" class="form-label fw-bold">
                            Nama Obat
                        </label>
                        <input type="text" class="form-control" name="nama_obat" id="inputNamaObat" placeholder="Nama Obat" value="<?php echo $nama_obat ?>">
                    </div>
                    <div class="col">
                        <label for="inputKemasan" class="form-label fw-bold">
                            Kemasan
                        </label>
                        <input type="text" class="form-control" name="kemasan" id="inputKemasan" placeholder="Kemasan" value="<?php echo $kemasan ?>">
                    </div>
                    <div class="col mb-2">
                        <label for="inputHarga" class="form-label fw-bold">
                            Harga
                        </label>
                        <input type="text" class="form-control" name="harga" id="inputHarga" placeholder="Harga" value="<?php echo $harga ?>">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
                    </div>
            </form>

            <!-- Table-->
            <table class="table table-hover">
                <!--thead atau baris judul-->
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Kemasan</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <!--tbody berisi isi tabel sesuai dengan judul atau head-->
                <tbody>
                    <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
                    berdasarkan status dan tanggal awal-->
                    <?php
                    $result = mysqli_query($mysqli,"SELECT * FROM obat");
                    $no = 1;
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $no++ ?></th>
                            <td><?php echo $data['nama_obat'] ?></td>
                            <td><?php echo $data['kemasan'] ?></td>
                            <td><?php echo $data['harga'] ?></td>
                            <td>
                                <a class="btn btn-success rounded- px-3" href="index.php?page=obat&id=<?php echo $data['id'] ?>">Ubah</a>
                                <a class="btn btn-danger rounded-pill px-3" href="index.php?page=obat&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <?php
            if (isset($_POST['simpan'])) {
                if (isset($_POST['id'])) {
                    $ubah = mysqli_query($mysqli, "UPDATE obat SET 
                                                    nama_obat = '" . $_POST['nama_obat'] . "',
                                                    kemasan = '" . $_POST['kemasan'] . "',
                                                    harga = '" . $_POST['harga'] . "'
                                                    WHERE
                                                    id = '" . $_POST['id'] . "'");
                } else {
                    $tambah = mysqli_query($mysqli, "INSERT INTO obat (nama_obat,kemasan,harga) 
                                                    VALUES ( 
                                                        '" . $_POST['nama_obat'] . "',
                                                        '" . $_POST['kemasan'] . "',
                                                        '" . $_POST['harga'] . "'
                                                        )");
                }

                echo "<script> 
                        document.location='index.php?page=obat';
                        </script>";
                
            }
            if (isset($_GET['aksi'])) {
                if ($_GET['aksi'] == 'hapus') {
                    $hapus = mysqli_query($mysqli, "DELETE FROM obat WHERE id = '" . $_GET['id'] . "'");    
                }
                echo "<script> 
                        document.location='index.php?page=obat';
                        </script>";         
            }
            ?>
    </div>   
</body>
</html>
