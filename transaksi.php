<?php
require 'function.php';
// Pemeriksaan peran pengguna
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] === 'Admin') {
        header('location: index_admin.php');
        exit();
    }
} else {
    header('location: login.php');
    exit();
}

// ... Kode lainnya untuk halaman index.php ...
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - User</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Transaksi</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form> -->
        <!-- Navbar-->
        <!-- <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul> -->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                            Kasir Menu
                        </a>
                        <a class="nav-link" href="index_total.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                            Kasir Total
                        </a>
                        <a class="nav-link" href="transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-exchange-alt"></i></div>
                            Transaksi
                        </a>

                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </div>
                </div>

                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php

                    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
                        $nama_pengguna = $_SESSION['nama_pengguna'];
                        echo $nama_pengguna;
                    } else {
                        header('location: login.php'); // Redirect ke halaman login jika tidak ada sesi login
                        exit();
                    }
                    ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Riwayat pembayaran</h1>
                    <br>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card-footer d-flex align-items-center justify-content-between">
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Transaksi
                        </div>
                        <?php
                        // Buat koneksi ke database
                        $c = mysqli_connect('localhost', 'root', '', 'kasir');

                        // Periksa koneksi
                        if (!$c) {
                            die("Koneksi gagal: " . mysqli_connect_error());
                        }

                        // Ambil id_user dari sesi
                        $id_user_login = $_SESSION['id_user'];

                        // Query untuk mengambil total harga dari transaksi
                        $sql_total_harga = "SELECT SUM(total) AS total_harga FROM transasksi WHERE id_user = '$id_user_login'";
                        $result_total_harga = mysqli_query($c, $sql_total_harga);
                        $row_total_harga = mysqli_fetch_assoc($result_total_harga);
                        $total_harga = $row_total_harga['total_harga'];

                        // Tutup koneksi
                        mysqli_close($c);
                        ?>
                        <div class="card-body">
                        <p>Total Harga: Rp. <?php echo number_format($total_harga, 0, ',', '.'); ?></p>
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nomor Stand</th>
                                        <th>Nomor Kasir</th>
                                        <th>Pesanan</th>
                                        <th>Total</th>
                                        <th>No Pesanan</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nomor Stand</th>
                                        <th>Nomor Kasir</th>
                                        <th>Pesanan</th>
                                        <th>Total</th>
                                        <th>No Pesanan</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    // Buat koneksi ke database
                                    $c = mysqli_connect('localhost', 'root', '', 'kasir');

                                    // Periksa koneksi
                                    if (!$c) {
                                        die("Koneksi gagal: " . mysqli_connect_error());
                                    }

                                    // Ambil id_user dari sesi
                                    $id_user_login = $_SESSION['id_user'];

                                    // Query untuk mengambil data dari database
                                    $sql = "SELECT * FROM transasksi WHERE id_user = '$id_user_login'";
                                    $result = mysqli_query($c, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id_stand'] . "</td>";
                                            echo "<td>" . $row['id_user'] . "</td>";
                                            echo "<td>" . $row['n_menu'] . "</td>";
                                            echo "<td>" . $row['total'] . "</td>";
                                            echo "<td>" . $row['np'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                                    }

                                    // Tutup koneksi
                                    mysqli_close($c);
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>