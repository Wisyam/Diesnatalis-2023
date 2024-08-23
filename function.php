<?php
session_start();

// Create Connection
$c = mysqli_connect('localhost', 'root', '', 'kasir');

if (!$c) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Login
$successlogin = true;
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqli = "SELECT * FROM user WHERE username = '$username' and password = '$password' ";
    $check = mysqli_query($c, $sqli);
    $count = mysqli_num_rows($check);

    if ($count > 0) {
        // Login Success

        // Ambil nama pengguna dari database
        $user_data = mysqli_fetch_assoc($check);
        $id_user_login = $user_data['id_user'];
        $nama_pengguna = $user_data['nama']; // Gantilah 'nama' dengan nama kolom yang sesuai di database
        $role = $user_data['role'];

        // Simpan nama pengguna dalam sesi
        $_SESSION['login'] = true;
        $_SESSION['id_user'] = $id_user_login;
        $_SESSION['nama_pengguna'] = $nama_pengguna;
        $_SESSION['role'] = $role;

        // Redirect ke halaman yang sesuai berdasarkan peran
        if ($role === 'Kasir') {
            header('location: index.php');
        } elseif ($role === 'Admin') {
            header('location: index_admin.php');
        } else {
            // Handle peran lainnya jika diperlukan
        }
    } else {
        // Login Error
        $successlogin = false;
    }
}

// Menyimpan data total ke database 'transasksi'
$success = false;
if (isset($_POST['total'])) {
    // Ambil nilai total dari input
    $total_harga = $_POST['total_harga'];
    $biayaLayanan = $_POST['biaya_layanan'];
    $totalKeseluruhan = $total_harga + $biayaLayanan;
    $id_stand_selected = $_POST["stand"];
    $id_user_login = $_SESSION['id_user'];
    $menuList = $_POST["menu_list"];
    $counts = $_POST["total_menu_count"];

    // Ambil nomor_pesanan terakhir dari database
    $sql_nomor_pesanan = "SELECT MAX(np) AS max_np FROM transasksi WHERE id_user = '$id_user_login'";
    $result = mysqli_query($c, $sql_nomor_pesanan);
    $row = mysqli_fetch_assoc($result);
    $nomor_pesanan_terakhir = $row['max_np'];
    $nomor_pesanan_baru = $nomor_pesanan_terakhir + 1;

    // Buat SQL untuk menyimpan data ke tabel 'transasksi' dengan nomor pesanan baru
    $sql = "INSERT INTO transasksi (id_stand, id_user, total, np, n_menu, count) VALUES ('$id_stand_selected', '$id_user_login', '$totalKeseluruhan', '$nomor_pesanan_baru', '$menuList', '$counts')";

    // Eksekusi query untuk menyimpan data
    if (mysqli_query($c, $sql)) {
        $success = true;
    } else {
        echo '<script>alert("Gagal menyimpan data. Error: ' . mysqli_error($c) . '");</script>';
    }
}
$success = false;
if (isset($_POST['total_btn'])) {
    // Ambil nilai total dari input
    $total_harga = $_POST['total_harga'];
    $id_stand_selected = $_POST["stand"];
    $id_user_login = $_SESSION['id_user'];
    $procces = $total_harga * 0.1;
    $total_bayar = $total_harga + $procces;

    // Ambil nomor_pesanan terakhir dari database
    $sql_nomor_pesanan = "SELECT MAX(np) AS max_np FROM transasksi WHERE id_user = '$id_user_login'";
    $result = mysqli_query($c, $sql_nomor_pesanan);
    $row = mysqli_fetch_assoc($result);
    $nomor_pesanan_terakhir = $row['max_np'];
    $nomor_pesanan_baru = $nomor_pesanan_terakhir + 1;

    // Buat SQL untuk menyimpan data ke tabel 'transasksi' dengan nomor pesanan baru
    $sql = "INSERT INTO transasksi (id_stand, id_user, total, np) VALUES ('$id_stand_selected', '$id_user_login', '$total_bayar', '$nomor_pesanan_baru')";

    // Eksekusi query untuk menyimpan data
    if (mysqli_query($c, $sql)) {
        $success = true;
    } else {
        echo '<script>alert("Gagal menyimpan data. Error: ' . mysqli_error($c) . '");</script>';
    }
}

if (isset($_POST['tbkasir'])) {
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $kontak = $_POST["kontak"];

    $sql_nomor = "SELECT MAX(nomor) AS max_nomor FROM user";
    $result = mysqli_query($c, $sql_nomor);
    $row = mysqli_fetch_assoc($result);
    $nomor_terakhir = $row['max_nomor'];
    $nomor_baru = $nomor_terakhir + 1;

    $check_username = "SELECT * FROM user WHERE username = '$username'";
    $hasil = $c->query($check_username);

    if ($hasil->num_rows > 0) {
        $tbsucc = false; // Set variabel tbsucc menjadi false
        $alert_message = "Username already exists. Please change the username.";
    } else {

        $insert = mysqli_query($c, "INSERT INTO user (nama, nomor, username, password, Kontak, role) VALUES ('$nama', '$nomor_baru', '$username', '$password', '$kontak', 'Kasir') ");
        if($insert){
            $tbsucc = true; // Set variabel tbsucc menjadi true
            $alert_message = "Data berhasil disimpan.";
            header('location:index_admin.php');
        } else {
            $tbsucc = false; // Set variabel tbsucc menjadi false
            $alert_message = "Error: " . $sql . "<br>" . $conn->error;

        }
    }
}

if(isset($_POST['tbstand'])){
    $pemilik = $_POST['pemilik'];
    $kontak = $_POST['kontaks'];
    $nomor_baru = $_POST['nomor'];

    // $sql_nomor = "SELECT MAX(nomor) AS max_nomor FROM stand";
    // $result = mysqli_query($c, $sql_nomor);
    // $row = mysqli_fetch_assoc($result);
    // $nomor_terakhir = $row['max_nomor'];
    // $nomor_baru = $nomor_terakhir + 1;

    $sql = mysqli_query($c, "INSERT INTO stand (Pemilik, Kontak, nomor) VALUES ('$pemilik', '$kontak', '$nomor_baru') ");

    if($sql){
        $tbsucc = true; // Set variabel tbsucc menjadi true
        $alert_message = "Data berhasil disimpan.";
        header('location:index_admin.php');
    } else {
        $tbsucc = false; // Set variabel tbsucc menjadi false
        $alert_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_POST['tbmenu'])){
    $nama_m = $_POST['menu'];
    $harga = $_POST['harga'];
    $std = $_POST['idstd'];
    $code = $_POST['c_menu'];

    // $sql_nomor = "SELECT MAX(nomor) AS max_nomor FROM stand";
    // $result = mysqli_query($c, $sql_nomor);
    // $row = mysqli_fetch_assoc($result);
    // $nomor_terakhir = $row['max_nomor'];
    // $nomor_baru = $nomor_terakhir + 1;

    $sql = mysqli_query($c, "INSERT INTO menu (n_menu, harga, stand, code) VALUES ('$nama_m', '$harga', '$std', '$code') ");

    if($sql){
        $tbsucc = true; // Set variabel tbsucc menjadi true
        $alert_message = "Data berhasil disimpan.";
        header('location:index_admin.php');
    } else {
        $tbsucc = false; // Set variabel tbsucc menjadi false
        $alert_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
