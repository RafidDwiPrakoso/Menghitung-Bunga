<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Bunga</title>
    <script>
        // Fungsi untuk menampilkan form sesuai pilihan
        function showForm() {
            var type = document.getElementById('interest_type').value;
            var tunggalInterestForm = document.getElementById('tunggalInterestForm');
            var majemukInterestForm = document.getElementById('majemukInterestForm');

            if (type === 'tunggal') {
                tunggalInterestForm.style.display = 'block';
                majemukInterestForm.style.display = 'none';
            } else if (type === 'majemuk') {
                tunggalInterestForm.style.display = 'none';
                majemukInterestForm.style.display = 'block';
            } else {
                tunggalInterestForm.style.display = 'none';
                majemukInterestForm.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <h2>Kalkulator Bunga</h2>

    <label for="interest_type">Pilih jenis bunga:</label>
    <select id="interest_type" onchange="showForm()">
        <option value="">--Pilih jenis bunga--</option>
        <option value="tunggal">Bunga Tunggal</option>
        <option value="majemuk">Bunga Majemuk</option>
    </select>
    
    <br><br>

    <!-- Form Bunga Tunggal -->
    <div id="tunggalInterestForm" style="display:none;">
        <h3>Hitung Bunga Tunggal</h3>
        <form method="POST" action="">
            <label for="ModalAwal">Modal Awal:</label><br>
            <input type="number" name="ModalAwal" required><br><br>
            
            <label for="bunga">Tingkat Bunga (%) per tahun:</label><br>
            <input type="number" step="0.01" name="bunga" required><br><br>

            <label for="waktu">Waktu (tahun):</label><br>
            <input type="number" name="waktu" required><br><br>

            <label for="waktu_unit">Pilih jangka waktu:</label><br>
            <select name="waktu_unit">
                <option value="year">Tahun</option>
                <option value="month">Bulan</option>
                <option value="day">Hari</option>
            </select><br><br>

            <input type="submit" name="calculate_tunggal" value="Hitung Bunga Tunggal">
        </form>
    </div>

    <!-- Form Bunga Majemuk -->
    <div id="majemukInterestForm" style="display:none;">
        <h3>Hitung Bunga Majemuk</h3>
        <form method="POST" action="">
            <label for="ModalAwal">Pokok (P):</label><br>
            <input type="number" name="ModalAwal" required><br><br>
            
            <label for="bunga">Tingkat Bunga (%) per tahun:</label><br>
            <input type="number" step="0.01" name="bunga" required><br><br>

            <label for="waktu">Waktu (tahun):</label><br>
            <input type="number" name="waktu" required><br><br>

            <label for="waktu_unit">Pilih jangka waktu:</label><br>
            <select name="waktu_unit">
                <option value="year">Tahun</option>
                <option value="month">Bulan</option>
                <option value="day">Hari</option>
            </select><br><br>

            <label for="majemuk">Frekuensi Penggabungan Bunga (n):</label><br>
            <input type="number" name="majemuk" value="1" required><br><br>

            <input type="submit" name="calculate_majemuk" value="Hitung Bunga Majemuk">
        </form>
    </div>

    <?php
    // Jika form Bunga Tunggal di-submit
    if (isset($_POST['calculate_tunggal'])) {
        // Ambil data dari form
        $ModalAwal = $_POST['ModalAwal'];
        $bunga = $_POST['bunga'] / 100; // Ubah persentase menjadi desimal
        $waktu = $_POST['waktu'];
        $waktu_unit = $_POST['waktu_unit'];

        // Sesuaikan waktu berdasarkan pilihan (tahun, bulan, hari)
        switch ($waktu_unit) {
            case 'month':
                $waktu = $waktu / 12; // Jika bulan, ubah menjadi tahun
                break;
            case 'day':
                $waktu = $waktu / 365; // Jika hari, ubah menjadi tahun
                break;
        }

        // Hitung Bunga Tunggal
        $tunggal_interest = $ModalAwal * $bunga * $waktu;

        // Tampilkan hasil
        echo "<h3>Hasil Bunga Tunggal:</h3>";
        echo "Bunga: Rp " . number_format($tunggal_interest, 2) . "<br>";
        echo "Jumlah Total: Rp " . number_format($ModalAwal + $tunggal_interest, 2) . "<br><br>";
    }

    // Jika form Bunga Majemuk di-submit
    if (isset($_POST['calculate_majemuk'])) {
        // Ambil data dari form
        $ModalAwal = $_POST['ModalAwal'];
        $bunga = $_POST['bunga'] / 100; // Ubah persentase menjadi desimal
        $waktu = $_POST['waktu'];
        $waktu_unit = $_POST['waktu_unit'];
        $majemuk = $_POST['majemuk'];

        // Sesuaikan waktu berdasarkan pilihan (tahun, bulan, hari)
        switch ($waktu_unit) {
            case 'month':
                $waktu = $waktu / 12; // Jika bulan, ubah menjadi tahun
                break;
            case 'day':
                $waktu = $waktu / 365; // Jika hari, ubah menjadi tahun
                break;
        }

        // Hitung Bunga Majemuk
        $majemuk_interest = $ModalAwal * pow((1 + ($bunga / $majemuk)), $majemuk * $waktu);

        // Tampilkan hasil
        echo "<h3>Hasil Bunga Majemuk:</h3>";
        echo "Jumlah Total: Rp " . number_format($majemuk_interest, 2) . "<br><br>";
    }
    ?>
</body>
</html>
