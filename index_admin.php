<?php

require 'function.php';
// Pemeriksaan peran pengguna
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] === 'user') {
        header('location: index.php');
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
    <title>Dashboard - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+5/JQA5JsXs1Pd+P6bhLcbQOf1ww5esM2S4U+76EB3KM/lq3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new simpleDatatables.DataTable('#datatablesSimple1'); // Ganti dengan ID yang sesuai
            new simpleDatatables.DataTable('#datatablesSimple2'); // Ganti dengan ID yang sesuai
        });
    </script>


</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Admin</a>
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
                    <?php
                    if (isset($tbsucc)) {
                        if ($tbsucc) {
                            echo '<div class="alert alert-success">' . $alert_message . '</div>';
                        } else {
                            echo '<div class="alert alert-danger">' . $alert_message . '</div>';
                        }
                    }
                    ?>
                    <script>
                        setTimeout(function() {
                            var alertSuccess = document.querySelector(".alert-success");
                            if (alertSuccess) {
                                alertSuccess.style.display = "none";
                            }

                            var alertDanger = document.querySelector(".alert-danger");
                            if (alertDanger) {
                                alertDanger.style.display = "none";
                            }
                        }, 2000);
                    </script>
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Name :
                            <?php

                            if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
                                $nama_pengguna = $_SESSION['nama_pengguna'];
                                echo $nama_pengguna;
                            } else {
                                header('location: login.php'); // Redirect ke halaman login jika tidak ada sesi login
                                exit();
                            }
                            ?>
                            <br>
                            Role :
                            <?php

                            if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
                                $role = $_SESSION['role'];
                                echo $role;
                            } else {
                                header('location: login.php'); // Redirect ke halaman login jika tidak ada sesi login
                                exit();
                            }
                            ?>
                        </li>
                    </ol>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-secondary btn-sm mx-2 col-md-1 shadow" data-bs-toggle="modal" data-bs-target="#KasirModal">Tambah Kasir</button>
                        <button type="button" class="btn btn-secondary btn-sm mx-2 col-md-1.5 shadow" data-bs-toggle="modal" data-bs-target="#StandModal">Tambah Stand</button>
                        <button type="button" class="btn btn-secondary btn-sm mx-2 col-md-1.5 shadow" data-bs-toggle="modal" data-bs-target="#StandMenu">Tambah Menu</button>
                    </div>
                    <div class="modal fade" id="KasirModal" tabindex="-1" aria-labelledby="KasirModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kasir</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">

                                        <div class="mb-3">
                                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" name="kontak" class="form-control" id="kontak" placeholder="Kontak" required>
                                        </div>
                                        <fieldset disabled>
                                            <div class="mb-3">
                                                <input type="text" id="disabledTextInput" class="form-control" placeholder="Kasir" required>
                                            </div>
                                        </fieldset>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" name="tbkasir">Submit</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="StandModal" tabindex="-1" aria-labelledby="StandModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Stand</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        
                                        <div class="mb-3">
                                            <input type="text" name="nomor" class="form-control" id="nomor" placeholder="Code Stand" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="pemilik" class="form-control" id="pemilik" placeholder="Pemilik" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" name="kontaks" class="form-control" id="kontaks" placeholder="Kontak" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" name="tbstand">Submit</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="StandMenu" tabindex="-1" aria-labelledby="StandMenu" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">

                                        <div class="mb-3">
                                            <input type="text" name="menu" class="form-control" id="menu" placeholder="Nama Product" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="c_menu" class="form-control" id="c_menu" placeholder="Code Menu" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" name="harga" class="form-control" id="harga" placeholder="Harga" required>
                                        </div>
                                        <div class="mb-3">
                                            <!-- <input type="number" name="idstd" class="form-control" id="idstd" placeholder="Nomor Stand" required> -->
                                            <select class="form-control" name="idstd" id="idstd" required>
                                                <option value="">Select Stand</option>
                                                <?php
                                                    // Buat koneksi ke database
                                                    $c = mysqli_connect('localhost', 'root', '', 'kasir');

                                                    // Periksa koneksi
                                                    if (!$c) {
                                                        die("Koneksi gagal: " . mysqli_connect_error());
                                                    }
                                                    $selectedStand = $_POST['stand'];
                                                    // Query untuk mengambil data nomor dari database
                                                    $sql = "SELECT nomor FROM stand";
                                                    $result = mysqli_query($c, $sql);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        // Loop melalui hasil query dan tambahkan setiap opsi ke dropdown
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $nomor_stand = $row['nomor'];
                                                            $selected = ($nomor_stand == $selectedStand) ? 'selected' : '';
                                                            echo '<option value="' . $nomor_stand . '" ' . $selected . '>Stand ' . $nomor_stand . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">Tidak ada data stand.</option>';
                                                    }

                                                    // Tutup koneksi
                                                    mysqli_close($c);
                                                    ?>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" name="tbmenu">Submit</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card-footer d-flex align-items-center justify-content-between">
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 shadow">
                        <div class="card-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop-window me-1" viewBox="0 0 16 16">
                                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zm2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5z" />
                            </svg>
                            Data Stand
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple1">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Pemilik</th>
                                        <th>Kontak</th>
                                        <th>Total Nomor Pesanan</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Pemilik</th>
                                        <th>Kontak</th>
                                        <th>Total Nomor Pesanan</th>
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

                                    // Query untuk mengambil data dari tabel "stand" dan menghitung total nomor pesanan
                                    $sql = "SELECT stand.nomor, stand.Pemilik, stand.Kontak,
                                     (SELECT COUNT(*) FROM transasksi WHERE id_stand = stand.nomor) AS total_pesanan
                                       FROM stand";

                                    $result = mysqli_query($c, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop melalui hasil query dan tampilkan data dalam baris-baris tabel
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>Stand " . $row['nomor'] . "</td>";
                                            echo "<td>" . $row['Pemilik'] . "</td>";
                                            echo "<td>" . $row['Kontak'] . "</td>";
                                            echo "<td>" . $row['total_pesanan'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo '<tr><td colspan="4">Tidak ada data stand.</td></tr>';
                                    }

                                    // Tutup koneksi
                                    mysqli_close($c);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card-footer d-flex align-items-center justify-content-between">
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 shadow">
                        <div class="card-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z" />
                            </svg>
                            Data Kasir
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple2">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama</th>
                                        <th>Kontak</th>
                                        <th>Total Nomor Pesanan</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama</th>
                                        <th>Kontak</th>
                                        <th>Total Nomor Pesanan</th>
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

                                    // Query untuk mengambil data dari tabel "stand" dan menghitung total nomor pesanan
                                    $sql = "SELECT u.Kontak, u.id_user, u.nama, u.username, COUNT(transasksi.np) AS np
                                    FROM user u
                                    LEFT JOIN transasksi ON u.id_user = transasksi.id_user
                                    GROUP BY u.id_user, u.nama, u.username, u.Kontak";

                                    $result = mysqli_query($c, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop melalui hasil query dan tampilkan data dalam baris-baris tabel
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>Kasir " . $row['id_user'] . "</td>";
                                            echo "<td>" . $row['nama'] . "</td>";
                                            echo "<td>" . $row['Kontak'] . "</td>";
                                            echo "<td>" . $row['np'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo '<tr><td colspan="4">Tidak ada data stand.</td></tr>';
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