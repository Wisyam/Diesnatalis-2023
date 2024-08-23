<?php
require 'function.php';
// Pemeriksaan peran pengguna
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] === 'Kasir') {
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
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index_admin.php">
                            <div class="sb-nav-link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                </svg>
                            </div>

                            Dashboard
                        </a>
                        <a class="nav-link" href="transaksi_admin.php">
                            <div class="sb-nav-link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                                </svg>
                            </div>
                            Stand
                        </a>
                        <a class="nav-link" href="kasir_admin.php">
                            <div class="sb-nav-link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                                </svg>
                            </div>
                            Kasir
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
                    <h1 class="mt-4">Riwayat kasir</h1>
                    <br>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card-footer d-flex align-items-center justify-content-between">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <?php
                            // Buat koneksi ke database
                            $c = mysqli_connect('localhost', 'root', '', 'kasir');

                            // Periksa koneksi
                            if (!$c) {
                                die("Koneksi gagal: " . mysqli_connect_error());
                            }

                            $sql = "SELECT u.nomor, u.nama, u.Kontak, COUNT(transasksi.id_user) AS total_pesanan, SUM(transasksi.total) AS total_harga
                            FROM user u
                            LEFT JOIN transasksi ON u.nomor = transasksi.id_user
                            WHERE u.role = 'Kasir'
                            GROUP BY u.nomor";

                            $result = mysqli_query($c, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // Loop melalui hasil query dan tampilkan data dalam kartu horizontal
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<div class="col-md-3 mb-2">';
                                    echo '<div class="card" style="width: 18rem;">';
                                    echo '<div class="card-body">';
                                    echo '<h5 class="card-title">Kasir ' . $row['nomor'] . '</h5>';
                                    echo '<p class="card-text">Nama : ' . $row['nama'] . '</p>';
                                    echo '<p class="card-text">Kontak : ' . $row['Kontak'] . '</p>';
                                    echo '<p class="card-text">Total Pesanan: ' . $row['total_pesanan'] . '</p>';
                                    echo '<p class="card-text">Total : Rp.' . number_format($row['total_harga'], 0, ',', '.') . '</p>';
                                    echo '<a href="#" class="btn btn-primary d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#StandModal' . $row['nomor'] . '">Detail Transaksi</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    // Tambahkan modal dengan id yang sesuai
                                    echo '<div class="modal fade" id="StandModal' . $row['nomor'] . '" tabindex="-1" aria-labelledby="StandModal' . $row['nomor'] . '" aria-hidden="true">';
                                    echo '<div class="modal-dialog">';
                                    echo '<div class="modal-content">';
                                    echo '<div class="modal-header">';
                                    echo '<h5 class="modal-title" id="exampleModalLabel">Stand ' . $row['nomor'] . ' </h5>';
                                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                                    echo '</div>';
                                    echo '<div class="modal-body">';

                                    // Tambahkan tabel dengan informasi yang sesuai
                                    echo '<table class="table table-striped">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Nomor Kasir</th>';
                                    echo '<th>Nomor Stand</th>';
                                    echo '<th>Product</th>';
                                    echo '<th>Total</th>';
                                    echo '<th>Nomor Pesanan</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    // $sql_transaksi = "SELECT id_user, total, np FROM transasksi WHERE id_stand = " . $row['nomor'];
                                    $sql_transaksi = "SELECT * FROM transasksi WHERE id_user =" . $row['nomor'] . "";
                                    $result_transaksi = mysqli_query($c, $sql_transaksi);

                                    if (mysqli_num_rows($result_transaksi) > 0) {
                                        while ($row_transaksi = mysqli_fetch_assoc($result_transaksi)) {
                                            echo '<tr>';
                                            echo '<td>' . $row_transaksi['id_user'] . '</td>';
                                            echo '<td>' . $row_transaksi['id_stand'] . '</td>';
                                            echo '<td>' . $row_transaksi['n_menu'] . '</td>';
                                            echo '<td>' . $row_transaksi['total'] . '</td>';
                                            echo '<td>' . $row_transaksi['np'] . '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="3">Tidak ada data transaksi</td></tr>';
                                    }

                                    // Tutup tabel transaksi
                                    echo '</tbody>';
                                    echo '</table>';

                                    // Akhir dari konten modal
                                    echo '</div>';
                                    echo '<div class="modal-footer">';
                                    echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<p>Tidak ada data stand.</p>';
                            }


                            // Tutup koneksi
                            mysqli_close($c);
                            ?>
                        </div>
                    </div>



                    <!-- <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Transaksi
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Stand (ID)</th>
                                        <th>User (ID)</th>
                                        <th>Total</th>
                                        <th>No Pesanan</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Stand (ID)</th>
                                        <th>User (ID)</th>
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
                    </div> -->
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