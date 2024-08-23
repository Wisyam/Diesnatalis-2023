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
        <a class="navbar-brand ps-3" href="index.php">Kasir</a>
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
                        $role = $_SESSION['role'];
                        echo $nama_pengguna;
                    } else {
                        header('location: login.php'); // Redirect ke halaman login jika tidak ada sesi login
                        exit();
                    }
                    ?>
                    (<?php

                        if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
                            $role = $_SESSION['role'];
                            echo $role;
                        } else {
                            header('location: login.php'); // Redirect ke halaman login jika tidak ada sesi login
                            exit();
                        }
                        ?>)
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <br><br><br>
                <div class="container-fluid px-40">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="card shadow-lg border-1 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Kasir</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" id="form-id">
                                            <?php
                                            if ($success) {
                                                echo '<div class="alert alert-success">Data berhasil disimpan!</div>';
                                                echo '<script>
                                            setTimeout(function() {
                                                document.querySelector(".alert-success").style.display = "none";
                                                }, 3000);
                                                </script>';
                                            }
                                            ?>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                                                        <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                                        <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z" />
                                                    </svg>
                                                </span>
                                                <input type="number" class="form-control form-control-lg" id="total_harga" name="total_harga" placeholder="Total Pesanan" aria-label="Total Harga" aria-describedby="basic-addon1" required>
                                            </div>


                                            <!-- Dropdown Menu -->
                                            <div class="form-group">
                                                <label for="produk">Pilih Stand : </label>
                                                <select class="form-control" id="stand" name="stand">
                                                    <option value="">Select Stand</option>
                                                    <?php
                                                    // Buat koneksi ke database
                                                    $c = mysqli_connect('localhost', 'root', '', 'kasir');

                                                    // Periksa koneksi
                                                    if (!$c) {
                                                        die("Koneksi gagal: " . mysqli_connect_error());
                                                    }

                                                    // Query untuk mengambil data nomor dari database
                                                    $sql = "SELECT nomor FROM stand";
                                                    $result = mysqli_query($c, $sql);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        // Loop melalui hasil query dan tambahkan setiap opsi ke dropdown
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $nomor_stand = $row['nomor'];
                                                            // Tambahkan teks "Stand" sebelum nomor
                                                            echo '<option value="' . $nomor_stand . '">Stand ' . $nomor_stand . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">Tidak ada data stand.</option>';
                                                    }

                                                    // Tutup koneksi
                                                    mysqli_close($c);
                                                    ?>

                                                </select>
                                            </div>
                                            <ol class="breadcrumb mb-4">
                                                <li class="breadcrumb-item active text-right">Nomor Pesanan :
                                                    <?php
                                                    // Buat koneksi ke database
                                                    $c = mysqli_connect('localhost', 'root', '', 'kasir');

                                                    // Periksa koneksi
                                                    if (!$c) {
                                                        die("Koneksi gagal: " . mysqli_connect_error());
                                                    }

                                                    // Ambil id_user dari sesi
                                                    $id_user_login = $_SESSION['id_user'];

                                                    // Query untuk mengambil nomor pesanan (np) sesuai dengan id_user yang login
                                                    $sql = "SELECT np FROM transasksi WHERE id_user = '$id_user_login' ORDER BY np DESC LIMIT 1";
                                                    $result = mysqli_query($c, $sql);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        $row = mysqli_fetch_assoc($result);
                                                        $nomor_pesanan = $row['np'];
                                                        echo $nomor_pesanan;
                                                    } else {
                                                        echo "Belum ada nomor pesanan.";
                                                    }

                                                    // Tutup koneksi
                                                    mysqli_close($c);
                                                    ?>
                                                </li>
                                            </ol>
                                            <p id="biaya_layanan">Biaya Layanan: Rp. </p>
                                            <p id="total_bayar">Total Bayar: Rp. </p>
                                            <div class="d-flex justify-content-end mt-4 mb-0">
                                                <button type="submit" class="btn btn-danger" id="deleteBtn" name="delete" style="margin-right: 10px">Delete</button>
                                                <button type="submit" class="btn btn-success" name="total_btn">Submit</button>
                                            </div>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    // Dapatkan elemen <select> dan elemen formulir
                                                    var selectStand = document.getElementById("stand");
                                                    var form = document.getElementById("form-id"); // Gantilah "form-id" dengan ID formulir sebenarnya Anda

                                                    // Tambahkan event listener ke formulir saat pengiriman
                                                    form.addEventListener("submit", function(event) {
                                                        // Periksa apakah nilai yang dipilih adalah kosong
                                                        if (selectStand.value === "") {
                                                            // Mencegah formulir dikirim jika nilai kosong
                                                            event.preventDefault();
                                                            alert("Silakan pilih stand sebelum mengirim formulir.");
                                                        }
                                                    });
                                                });
                                            </script>
                                            <script>
                                                document.getElementById('total_harga').addEventListener('input', function() {
                                                    // Dapatkan nilai total dari input
                                                    var totalHarga = parseFloat(this.value);

                                                    // Hitung biaya layanan (10% dari total)
                                                    var biayaLayanan = 0.1 * totalHarga;

                                                    // Konversi biaya layanan ke angka dengan tepat dua desimal
                                                    biayaLayanan = parseFloat(biayaLayanan.toFixed(2));

                                                    // Tampilkan biaya layanan tanpa angka nol di akhir desimal jika ada
                                                    var biayaLayananText = biayaLayanan.toString();
                                                    if (biayaLayananText.indexOf('.') !== -1) {
                                                        biayaLayananText = biayaLayananText.replace(/\.?0*$/, '');
                                                    }
                                                    let totbay = totalHarga + biayaLayanan;
                                                    // Tampilkan biaya layanan
                                                    document.getElementById('biaya_layanan').textContent = 'Biaya Layanan: Rp. ' + biayaLayananText;
                                                    document.getElementById('total_bayar').textContent = 'Biaya Layanan: Rp. ' + totbay;
                                                });
                                            </script>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script>
                // JavaScript untuk menghapus nilai di kolom "Total Pesanan"
                document.getElementById("deleteBtn").addEventListener("click", function() {
                    document.getElementById("total_harga").value = ""; // Menghapus nilai di kolom "Total Pesanan"
                });
            </script>
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