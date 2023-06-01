<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD matakuliah</title>
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

    // Fungsi untuk menambahkan data matakuliah
    if (isset($_POST['create'])) {
        $Nama = $_POST['Nama'];
        $Kode_Matakuliah = $_POST['Kode_Matakuliah'];
        $Deskripsi = $_POST['Deskripsi'];

        $sql = "INSERT INTO matakuliah (Nama, Kode_Matakuliah, Deskripsi) VALUES ('$Nama', '$Kode_Matakuliah', '$Deskripsi')";

        if ($conn->query($sql) === TRUE) {
            echo "Data matakuliah berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    // Fungsi Update
    if (isset($_POST['update'])) {
        $ID = $_POST['ID'];
        $Nama = $_POST['Nama'];
        $Kode_Matakuliah = $_POST['Kode_Matakuliah'];
        $Deskripsi = $_POST['Deskripsi'];
    
        $sql = "UPDATE matakuliah SET Nama='$Nama', Kode_Matakuliah='$Kode_Matakuliah', Deskripsi='$Deskripsi' WHERE ID='$ID'";
    
        if ($conn->query($sql) === TRUE) {
            echo "Data matakuliah berhasil diupdate.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Fungsi untuk membaca data matakuliah
    function readmatakuliah() {
        global $conn;
        $sql = "SELECT * FROM matakuliah";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data setiap baris
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["Nama"] . "</td>";
                echo "<td>" . $row["Kode_Matakuliah"] . "</td>";
                echo "<td>" . $row["Deskripsi"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "Tidak ada data matakuliah.";
        }
    }

    // Fungsi untuk menghapus data matakuliah
    if (isset($_GET['delete'])) {
        $ID = $_GET['delete'];
        $sql = "DELETE FROM matakuliah WHERE ID = $ID";

        if ($conn->query($sql) === TRUE) {
            echo "Data matakuliah berhasil dihapus.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <center>=====CRUD Matakuliah=====</center>
    <table>
        <tr>
            <td>ID</td>
            <td>Nama</td>
            <td>Kode_Matakuliah</td>
            <td>Deskripsi</td>
            <td>Action</td>
        </tr>
        <?php readmatakuliah(); ?>
    </table>

    <form method="post">
        <input type="text" name="Nama" placeholder="Nama" maxlength="255">
        <input type="text" name="Kode_Matakuliah" placeholder="Kode_Matakuliah"  maxlength="5">
        <input type="text" name="Deskripsi" placeholder="Deskripsi">
        <button type="submit" name="create">Tambah matakuliah</button><br>
        ==================================================================<br>
        <input type="text" name="ID" placeholder="ID">
        <input type="text" name="Nama" placeholder="Nama" maxlength="255">
        <input type="text" name="Kode_Matakuliah" placeholder="Kode_Matakuliah" maxlength="5">
        <input type="text" name="Deskripsi" placeholder="Deskripsi">
        <button type="submit" name="update">Update Matakuliah</button>
    </form>
</body>