<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Penilaian</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,200&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div style="float: right;margin-top: -20px;margin-right: 10px;">
    <?php
        session_start();
        if (isset($_SESSION['logged_in']) == true) {
    ?>
        <p style="margin-bottom: -5px;">Selamat Datang, <span class="font-weight-bold"><?php echo $_SESSION['username']; ?></span></p>
        <button style="float: right" class="btn" type="button" onclick="logout()">Logout</button>
    <?php } else { ?>
            <br>
            <a class="btn" href="./pages/register.html">Daftar Akun</a> |
            <a class="btn" href="./pages/login.html">Login</a>
    <?php } ?>
</div>

<?php if(isset($_SESSION['logged_in']) == true){ ?>
    <h1>Tambah Data Nilai</h1>

    <!-- Form Input -->
    <hr style="margin-bottom: 10px;">
    <div class="form">
        <form id="educationForm" class="form-insert" method="post">
            <input type="hidden" id="userAgent" name="userAgent" value="">
            <input type="hidden" id="userIP" name="userIP" value="">

            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="subject">Mata Pelajaran:</label>
                <input type="text" id="subject" name="subject" required>
            </div>

            <div class="form-group">
                <label for="attendance">Kehadiran:</label>
                <input type="checkbox" id="attendance" name="attendance" value="1"> <span>Hadir</span>
            </div>

            <div class="form-group">
                <label for="grade">Nilai:</label>
                <input type="radio" id="gradeA" name="grade" value="A"> A
                <input type="radio" id="gradeB" name="grade" value="B"> B
                <input type="radio" id="gradeC" name="grade" value="C"> C
            </div>

            <div class="btn-form">
                <?php if(isset($_SESSION['logged_in']) == true){?>
                    <button type="button" class="btn" onclick="submitForm()">Tambah Data</button>
                <?php } else { ?>
                    <button type="button" class="btn" disabled">Tambah Data</button>
                    <p class="font-weight-bold" style="color: #dc2525;margin-top:2px;font-size: 12px;">Kamu Belum Login</p>
                <?php } ?>
            </div>
        </form>
    </div>

    <hr style="margin: 30px 0;">

    <h3 class="font-weight-bold">Daftar Penilaian.</h3>
    <table id="dataTable" border="1">
        <thead>
        <tr>
            <th>Nama</th>
            <th>Mata Pelajaran</th>
            <th>Kehadiran</th>
            <th>Nilai</th>
            <th>User Agent</th>
            <th>User IP</th>
            <th colspan="2">Aksi</th> <!-- Kolom baru untuk tombol Update -->
        </tr>
        </thead>
        <tbody style="text-align: center">
        <!-- Data akan ditampilkan di sini -->
        </tbody>
    </table>
<?php } else { ?>
    <h4 class="text-danger">Whopss!!, Kamu belum melakukan Login, Silakan Login terlabih dahulu.</h4>

    <div style="width: 550px;height: 400px;margin: 0 auto;">
        <img class="img-error" src="assets/images/error.jpg" alt="Error Image" width="550px" height="400px">
    </div>
<?php } ?>

<script  src="assets/script.js"></script>
</body>
</html>
