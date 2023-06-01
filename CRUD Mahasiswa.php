<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa</title>
</head>
<body>
    <?php
    // Konfigurasi koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "siakad";

    // Membuat koneksi ke database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Fungsi untuk menambahkan data mahasiswa
    if (isset($_POST['create'])) {
        $Nama = $_POST['Nama'];
        $NIM = $_POST['NIM'];
        $Program_Studi = $_POST['Program_Studi'];

        $sql = "INSERT INTO mahasiswa (Nama, NIM, Program_Studi) VALUES ('$Nama', '$NIM', '$Program_Studi')";

        if ($conn->query($sql) === TRUE) {
            echo "Data mahasiswa berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Fungsi Update
    if (isset($_POST['update'])) {
        $ID = $_POST['ID'];
        $Nama = $_POST['Nama'];
        $NIM = $_POST['NIM'];
        $Program_Studi = $_POST['Program_Studi'];
    
        $sql = "UPDATE mahasiswa SET Nama='$Nama', NIM='$NIM', Program_Studi='$Program_Studi' WHERE ID='$ID'";
    
        if ($conn->query($sql) === TRUE) {
            echo "Data mahasiswa berhasil diupdate.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Fungsi untuk membaca data mahasiswa
    function readMahasiswa() {
        global $conn;
        $sql = "SELECT * FROM mahasiswa";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data setiap baris
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["Nama"] . "</td>";
                echo "<td>" . $row["NIM"] . "</td>";
                echo "<td>" . $row["Program_Studi"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "Tidak ada data mahasiswa.";
        }
    }

    // Fungsi untuk menghapus data mahasiswa
    if (isset($_GET['delete'])) {
        $ID = $_GET['delete'];
        $sql = "DELETE FROM mahasiswa WHERE ID = $ID";

        if ($conn->query($sql) === TRUE) {
            echo "Data mahasiswa berhasil dihapus.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <center>=====CRUD Mahasiswa=====</center>
    <table>
        <tr>
            <td>ID</td>
            <td>Nama</td>
            <td>NIM</td>
            <td>Program Studi</td>
            <td>Action</td>
        </tr>
        <?php readMahasiswa(); ?>
    </table>

    <form method="post">
        <input type="text" name="Nama" placeholder="Nama" maxlength="255" >
        <input type="text" name="NIM" placeholder="NIM"  maxlength="10">
        <input type="text" name="Program_Studi" placeholder="Program Studi" maxlength="255">
        <button type="submit" name="create">Tambah Mahasiswa</button><br>
        ==================================================================<br>
        <input type="text" name="ID" placeholdser="ID">
        <input type="text" name="Nama" placeholder="Nama" maxlength="255">
        <input type="text" name="NIM" placeholder="NIM" maxlength="10">
        <input type="text" name="Program_Studi" placeholder="Program Studi" maxlength="255">
        <button type="submit" name="update">Update</button>
    </form>
</body>