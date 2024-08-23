<?php
require 'function.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Kasir</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>



</head>

<body class="bg-dark">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                    <?php
                                        if (!$successlogin) {
                                            echo '<div class="alert alert-danger">Incorrect User or Passsword. Please try again</div>';
                                            echo '<script>
                                            setTimeout(function() {
                                                document.querySelector(".alert-success").style.display = "none";
                                                }, 2000);
                                                </script>';
                                        }
                                        ?>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" id="inputUser" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-lock q"></i></span>
                                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2" required>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" name="login" class="btn btn-success" href="index.html">Login</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>