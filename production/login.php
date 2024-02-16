<?php 

session_start();

if (isset($_SESSION["login"])) {
  if ($_SESSION["level"] === "Kepala Cabang") {
    header("Location: admin.php");
  }elseif ($_SESSION["level"] === "Direktur Operasional") {
    header("Location: dirops.php");
  }elseif ($_SESSION["level"] === "Purchasing") {
    header("Location: purchasing.php");
  }elseif ($_SESSION["level"] === "Direktur HRD") {
    header("Location: hrd.php");
  }elseif ($_SESSION["level"] === "Direktur Keuangan") {
    header("Location: dirkeu.php");
  }elseif ($_SESSION["level"] === "Direktur Utama") {
    header("Location: dirut.php");
  }elseif ($_SESSION["level"] === "Kepala Operasional") {
    header("Location: sales.php");
  }else{
    header("Location: index.php");
  }
  
  exit;
}


require 'koneksi.php';

if (isset($_POST['login'])) {
  

  $username = mysqli_real_escape_string($koneksi, $_POST["username"]);
  $password = mysqli_real_escape_string($koneksi, $_POST["password"]);

  $result = mysqli_query($koneksi, "SELECT * FROM user JOIN karyawan ON karyawan.id_emp=user.id_emp WHERE username = '$username'");
  // $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

  // cek username
  if (mysqli_num_rows($result) === 1 ) {

    //cek password
    $row = mysqli_fetch_assoc($result); 
    if  (password_verify($password, $row["password"])){
      // set session
      $_SESSION["login"] = true;
      $_SESSION["username"] = $_POST["username"];
      $_SESSION["nama_emp"] = $row["nama_emp"];
      $_SESSION["id_user"] = $row["id_user"];
      // Menyimpan level pengguna dalam sesi
      $_SESSION["level"] = $row["level"];

      // Menyimpan jabatan pengguna dalam sesi
      $_SESSION['jabatan'] = $row['jabatan'];

      // Mengarahkan berdasarkan level pengguna
      if ($row["level"] === "Kepala Cabang") {
        echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
        echo '<script src="./sweetalert2.min.js"></script>';
        echo "<script>
        setTimeout(function () { 
            swal.fire({
                
                title               : 'Berhasil',
                text                :  'Login berhasil',
                //footer              :  '',
                icon                : 'success',
                timer               : 2000,
                showConfirmButton   : true
            });  
        },10);   setTimeout(function () {
            window.location.href = 'admin.php'; //will redirect to your blog page (an ex: blog.html)
        }, 2000); //will call the function after 2 secs
        </script>";
      }elseif ($row["level"] === "Direktur Operasional") {
        echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
        echo '<script src="./sweetalert2.min.js"></script>';
        echo "<script>
        setTimeout(function () { 
            swal.fire({
                
                title               : 'Berhasil',
                text                :  'Login berhasil',
                //footer              :  '',
                icon                : 'success',
                timer               : 2000,
                showConfirmButton   : true
            });  
        },10);   setTimeout(function () {
            window.location.href = 'dirops.php'; //will redirect to your blog page (an ex: blog.html)
        }, 2000); //will call the function after 2 secs
        </script>";
      }elseif ($row["level"] === "Kepala Finance") {
        echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
        echo '<script src="./sweetalert2.min.js"></script>';
        echo "<script>
        setTimeout(function () { 
            swal.fire({
                
                title               : 'Berhasil',
                text                :  'Login berhasil',
                //footer              :  '',
                icon                : 'success',
                timer               : 2000,
                showConfirmButton   : true
            });  
        },10);   setTimeout(function () {
            window.location.href = 'finance.php'; //will redirect to your blog page (an ex: blog.html)
        }, 2000); //will call the function after 2 secs
        </script>";
      }elseif ($row["level"] === "Purchasing") {
        echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
        echo '<script src="./sweetalert2.min.js"></script>';
        echo "<script>
        setTimeout(function () { 
            swal.fire({
                
                title               : 'Berhasil',
                text                :  'Login berhasil',
                //footer              :  '',
                icon                : 'success',
                timer               : 2000,
                showConfirmButton   : true
            });  
        },10);   setTimeout(function () {
            window.location.href = 'purchasing.php'; //will redirect to your blog page (an ex: blog.html)
        }, 2000); //will call the function after 2 secs
        </script>";
      }elseif ($row["level"] === "Direktur HRD") {
        echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
        echo '<script src="./sweetalert2.min.js"></script>';
        echo "<script>
        setTimeout(function () { 
            swal.fire({
                
                title               : 'Berhasil',
                text                :  'Login berhasil',
                //footer              :  '',
                icon                : 'success',
                timer               : 2000,
                showConfirmButton   : true
            });  
        },10);   setTimeout(function () {
            window.location.href = 'hrd.php'; //will redirect to your blog page (an ex: blog.html)
        }, 2000); //will call the function after 2 secs
        </script>";
      }elseif ($row["level"] === "Staff IT") {
        echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
        echo '<script src="./sweetalert2.min.js"></script>';
        echo "<script>
        setTimeout(function () { 
            swal.fire({
                
                title               : 'Berhasil',
                text                :  'Login berhasil',
                //footer              :  '',
                icon                : 'success',
                timer               : 2000,
                showConfirmButton   : true
            });  
        },10);   setTimeout(function () {
            window.location.href = 'it.php'; //will redirect to your blog page (an ex: blog.html)
        }, 2000); //will call the function after 2 secs
        </script>";
      }elseif ($row["level"] === "Direktur Utama") {
        echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
        echo '<script src="./sweetalert2.min.js"></script>';
        echo "<script>
        setTimeout(function () { 
            swal.fire({
                
                title               : 'Berhasil',
                text                :  'Login berhasil',
                //footer              :  '',
                icon                : 'success',
                timer               : 2000,
                showConfirmButton   : true
            });  
        },10);   setTimeout(function () {
            window.location.href = 'dirut.php'; //will redirect to your blog page (an ex: blog.html)
        }, 2000); //will call the function after 2 secs
        </script>";
      }elseif ($row["level"] === "Direktur Keuangan") {
        echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
        echo '<script src="./sweetalert2.min.js"></script>';
        echo "<script>
        setTimeout(function () { 
            swal.fire({
                
                title               : 'Berhasil',
                text                :  'Login berhasil',
                //footer              :  '',
                icon                : 'success',
                timer               : 2000,
                showConfirmButton   : true
            });  
        },10);   setTimeout(function () {
            window.location.href = 'dirkeu.php'; //will redirect to your blog page (an ex: blog.html)
        }, 2000); //will call the function after 2 secs
        </script>";
      }elseif ($row["level"] === "Kepala Operasional") {
        echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
        echo '<script src="./sweetalert2.min.js"></script>';
        echo "<script>
        setTimeout(function () { 
            swal.fire({
                
                title               : 'Berhasil',
                text                :  'Login berhasil',
                //footer              :  '',
                icon                : 'success',
                timer               : 2000,
                showConfirmButton   : true
            });  
        },10);   setTimeout(function () {
            window.location.href = 'sales.php'; //will redirect to your blog page (an ex: blog.html)
        }, 2000); //will call the function after 2 secs
        </script>";
      }elseif ($row["level"] === "Staff Operasional") {
        echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
        echo '<script src="./sweetalert2.min.js"></script>';
        echo "<script>
        setTimeout(function () { 
            swal.fire({
                
                title               : 'Berhasil',
                text                :  'Login berhasil',
                //footer              :  '',
                icon                : 'success',
                timer               : 2000,
                showConfirmButton   : true
            });  
        },10);   setTimeout(function () {
            window.location.href = 'operasion.php'; //will redirect to your blog page (an ex: blog.html)
        }, 2000); //will call the function after 2 secs
        </script>";
      }else{
        echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
        echo '<script src="./sweetalert2.min.js"></script>';
        echo "<script>
        setTimeout(function () { 
            swal.fire({
                
                title               : 'Berhasil',
                text                :  'Login berhasil',
                //footer              :  '',
                icon                : 'success',
                timer               : 2000,
                showConfirmButton   : true
            });  
        },10);   setTimeout(function () {
            window.location.href = 'index.php'; //will redirect to your blog page (an ex: blog.html)
        }, 2000); //will call the function after 2 secs
        </script>";
      }
      exit;
    }
        else{
            $error = true;
        }
  }

  $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login </title>
    <link rel="icon" href="images/logo-mmm.png" type="image/ico" />

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login" bgcolor="red">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php if(isset($error)) :?>
              <!-- <p style="color: red; font-style: italic;">Username / password salah</p> -->
              <?php
                    echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
                    echo '<script src="./sweetalert2.min.js"></script>';
                    echo "<script>
                    setTimeout(function () { 
                        swal.fire({
                            
                            title               : 'Login Gagal',
                            text                :  'Username / Password Salah',
                            //footer              :  '',
                            icon                : 'error',
                            timer               : 2000,
                            showConfirmButton   : true
                        });  
                    },10);   setTimeout(function () {
                        window.location.href = 'index.php'; //will redirect to your blog page (an ex: blog.html)
                    }, 2000); //will call the function after 2 secs
                    </script>";    
                ?>

              <?php endif; ?>
              <div>
                <h1> <img src="images/mmm.png"></h1>
              </div>
            <form action="" method="post">
              <h1>Login Form</h1>

              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" autofocus />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" name="login" class="btn btn-primary">Log in</button>
                <!-- <a class="btn btn-default submit" href="index.html">Log in</a>
                <a class="reset_pass" href="#">Lost your password?</a> -->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!-- <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p> -->

                <div class="clearfix"></div>
                <br />

                <div>
                  <!-- <h1> <img src="images/gpp-transparan.png"></h1> -->
                  <!-- <p>©2024 All Rights Reserved. PT Global Petro Pasific</p> -->
                </div>
              </div>
            </form>
          </section>
        </div>

        <?php 


          if (isset($_POST['register']) ) {
            
            if(registrasi($_POST) > 0 ){

                  echo '<link rel="stylesheet" href="./sweetalert2.min.css"></script>';
                  echo '<script src="./sweetalert2.min.js"></script>';
                  echo "<script>
                  setTimeout(function () { 
                      swal.fire({
                          
                          title               : 'Daftar Akun Berhasil',
                          text                :  'User baru berhasil ditambahkan',
                          //footer              :  '',
                          icon                : 'success',
                          timer               : 2000,
                          showConfirmButton   : true
                      });  
                  },10);   setTimeout(function () {
                      window.location.href = 'login.php'; //will redirect to your blog page (an ex: blog.html)
                  }, 2000); //will call the function after 2 secs
                  </script>";
                      
              // echo "
              //  <script>
              //    alert('User baru berhasil ditambahkan!');
                  //         document.location.href = 'login.php';
              //  </script>

              // ";  

            } else {
              echo mysqli_error($koneksi);
            }

          }

        ?>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <div>
                <h1> <img src="images/mmm.png"></h1>
              </div>
            <form action="" method="post">
              <h1>Create Account</h1>
              <div>
                <input name="username" type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input name="password" type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input name="password2" type="password" class="form-control" placeholder="Konfirmasi Password" required="" />
              </div>
              <div>
                <input name="email" type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
              <!-- <a class="btn btn-primary" href="index.html">Submit</a> -->
                <button type="submit" name="register" class="btn btn-primary">Create</button>

              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <!-- <h1> <img src="images/gpp-transparan.png"></h1> -->
                  <!-- <p>©2024 All Rights Reserved. PT Global Petro Pasific</p> -->
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
