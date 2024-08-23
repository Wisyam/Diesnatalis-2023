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
                                        <form method="post">


                                            <!-- Dropdown Menu -->
                                            <div class="form-group">
                                                <label for="produk">Pilih Stand : </label>
                                                <select class="form-control" id="stand" name="stand" onchange="this.form.submit()">
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
                                            <div class="container-fluid px-4">
                                                <div class="row">
                                                    <div class="col-xl-3 col-md-6">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        <i class="fas fa-table me-1"></i>
                                                        Menu
                                                    </div>
                                                    <div class="card-body">
                                                        <table id="datatablesSimple">
                                                            <thead>
                                                                <tr>
                                                                    <th>Code</th>
                                                                    <th>Menu</th>
                                                                    <th>Harga</th>
                                                                    <th>Count</th>
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Code</th>
                                                                    <th>Menu</th>
                                                                    <th>Harga</th>
                                                                    <th>Count</th>
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

                                                                $selectedStand = '';

                                                                if (isset($_POST['stand'])) {
                                                                    $selectedStand = $_POST['stand'];
                                                                }

                                                                $sql = "SELECT * FROM menu WHERE stand = '$selectedStand'";
                                                                $result = mysqli_query($c, $sql);

                                                                if (mysqli_num_rows($result) > 0) {
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo "<tr>";
                                                                        echo '<td data-nama-menu="' . $row["code"] . '">' . $row["code"] . '</td>';
                                                                        echo '<td data-nama-menu="' . $row["n_menu"] . '">' . $row["n_menu"] . '</td>';
                                                                        echo '<td data-harga-menu="' . $row["harga"] . '">' . $row["harga"] . '</td>';

                                                                        echo '<td>
                                                                        <span class="count">0</span>
                                                                        <button type="button" class="btn btn-dark btn-sm btn-plus float-end mx-2" onclick="increment(this)">+</button>
                                                                        <button type="button" class="btn btn-dark btn-sm btn-minus float-end mx-2" onclick="decrement(this)">-</button>
                                                                        </td>';
                                                                        echo "</tr>";
                                                                    }
                                                                } else {
                                                                    echo "Belum ada nomor pesanan.";
                                                                }

                                                                // Tutup koneksi
                                                                mysqli_close($c);
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                                                        <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                                        <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z" />
                                                    </svg>
                                                </span>
                                                <input type="number" class="form-control form-control-lg" id="total_harga" name="total_harga" placeholder="Total Pesanan" aria-label="Total Harga" aria-describedby="basic-addon1" required>
                                            </div> -->
                                            <input type="hidden" name="total_harga" id="total_harga_input" value="">
                                            <input type="hidden" name="biaya_layanan" id="biaya_layanan_input" value="">
                                            <input type="hidden" id="menu_list_input" name="menu_list">
                                            <input type="hidden" id="total_menu_count" name="total_menu_count" value="0">

                                            <p id="total_harga">Harga : Rp. </p>
                                            <p id="biaya_layanan">Biaya Layanan: Rp. </p>
                                            <p id="total_bayar">Total Harga : Rp. </p>
                                            <div class="d-flex justify-content-end mt-4 mb-0">
                                                <button type="submit" class="btn btn-danger" id="deleteBtn" name="delete" style="margin-right: 10px">Delete</button>
                                                <button type="submit" class="btn btn-success" name="total">Submit</button>
                                            </div>
                                            <br>
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
                                            <script>
                                                $(document).ready(function() {
                                                    $('#datatablesSimple').DataTable();
                                                });

                                                function increment(btn) {
                                                    const countSpan = btn.parentNode.querySelector('.count');
                                                    let count = parseInt(countSpan.textContent);
                                                    count++;
                                                    countSpan.textContent = count;
                                                    updateTotalHarga();
                                                }

                                                function decrement(btn) {
                                                    const countSpan = btn.parentNode.querySelector('.count');
                                                    let count = parseInt(countSpan.textContent);
                                                    if (count > 0) {
                                                        count--;
                                                        countSpan.textContent = count;
                                                        updateTotalHarga();
                                                    }
                                                }

                                                function updateTotalHarga() {
                                                    const rows = document.querySelectorAll('#datatablesSimple tbody tr');
                                                    let totalHarga = 0;
                                                    const menuList = [];
                                                    const menuCounts = {};

                                                    rows.forEach(function(row) {
                                                        const count = parseInt(row.querySelector('.count').textContent);
                                                        const harga = parseInt(row.querySelector('td:nth-child(3)').textContent); // Ambil harga dari elemen kedua di setiap baris
                                                        const menuName = row.querySelector('td:nth-child(2)').textContent; // Ambil harga dari elemen kedua di setiap baris

                                                        if (count > 0) {
                                                            totalHarga += count * harga;
                                                            menuList.push(menuName + ' (' + count + ')')
                                                        }
                                                        if (menuCounts[menuName]) {
                                                            menuCounts[menuName] += count; // Menambahkan jumlah menu ke menuCounts yang sudah ada
                                                        } else {
                                                            menuCounts[menuName] = count; // Menambahkan menuName ke menuCounts jika belum ada
                                                        }

                                                        let totalMenuCount = 0;
                                                        for (const menuName in menuCounts) {
                                                            if (menuCounts.hasOwnProperty(menuName)) {
                                                                totalMenuCount += menuCounts[menuName];
                                                            }
                                                        }
                                                        document.getElementById('total_menu_count').value = totalMenuCount;
                                                    });

                                                    var biayaLayanan = 0.1 * totalHarga;
                                                    let totbay = biayaLayanan + totalHarga;
                                                    // Konversi biaya layanan ke angka dengan tepat dua desimal
                                                    biayaLayanan = parseFloat(biayaLayanan.toFixed(2));

                                                    // Tampilkan biaya layanan tanpa angka nol di akhir desimal jika ada
                                                    var biayaLayananText = biayaLayanan.toString();
                                                    if (biayaLayananText.indexOf('.') !== -1) {
                                                        biayaLayananText = biayaLayananText.replace(/\.?0*$/, '');
                                                    }
                                                    document.getElementById('total_harga_input').value = totalHarga;
                                                    // document.getElementById('total_menu_count').value = totalHarga;
                                                    document.getElementById('biaya_layanan_input').value = biayaLayanan;
                                                    document.getElementById('menu_list_input').value = menuList.join(', ');
                                                    // Tampilkan biaya layanan
                                                    document.getElementById('biaya_layanan').textContent = 'Biaya Layanan: Rp. ' + biayaLayananText;
                                                    document.getElementById('total_bayar').textContent = 'Biaya Layanan: Rp. ' + totbay;

                                                    // Tampilkan total harga
                                                    document.querySelector('#total_harga').textContent = 'Total Harga : Rp. ' + totalHarga;
                                                }
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