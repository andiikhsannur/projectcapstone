<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">

    <!-- Bootstrap offline -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">   
    
    <title>Poliklinik</title>   <!--Judul Halaman-->
</head>
<body>
  <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        Sistem Informasi Poliklinik
      </a>
      <button class="navbar-toggler"
        type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">
                Home
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Data Master
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Dokter</a></li>
                <li><a class="dropdown-item" href="#">Pasien</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" 
              href="index.php?page=periksa">
                Periksa
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <main role="main" class="container">
        <?php
        if (isset($_GET['page'])) {
        ?>
            <h2><?php echo ucwords($_GET['page']) ?></h2>
        <?php
            include($_GET['page'] . ".php");
        } else {
            echo "Selamat Datang di Sistem Informasi Poliklinik";
        }
        ?>
    </main>  
</body>
</html>