<?php

include 'koneksi.php';

session_start();
error_reporting(0);




if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result = mysqli_query($mysqli, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		
		header("Location: index.php");
	} else {
		echo "<script>alert('Woops! Username Atau Password anda Salah.')</script>";
	}
}

?>

    <!-- Bootstrap Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">   <!-- Gunakan salah satu cara saja -->

    <!-- Load JS online -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>   
    <!-- cukup gunakan salah satu saja -->
	<section class="vh-100" style="background-color: #508bfc;">

  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
		  <form action="" method="POST" class="login-email">

            <h3 class="mb-5">Sign in</h3>

            <div class="form-outline mb-4">
              <input type="text" id="typeEmailX-2" class="form-control form-control-lg" name="username" value="<?php echo $username; ?>" required> 
              <label class="form-label" for="typeEmailX-2" name >Username</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" value="<?php echo $_POST['password']; ?>" required>
              <label class="form-label" for="typePasswordX-2">Password</label>
            </div>

            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Login</button> 

			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>

        

          </div>
        </div>
      </div>
    </div>
  </div>
</section>