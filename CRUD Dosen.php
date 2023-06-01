<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Dosen</title>
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

    // Fungsi untuk menambahkan data dosen
    if (isset($_POST['create'])) {
        $Nama = $_POST['Nama'];
        $NIDN = $_POST['NIDN'];
        $Jenjang_pendidikan = $_POST['Jenjang_pendidikan'];

        $sql = "INSERT INTO dosen (Nama, NIDN, Jenjang_pendidikan) VALUES ('$Nama', '$NIDN', '$Jenjang_pendidikan')";

        if ($conn->query($sql) === TRUE) {
            echo "Data dosen berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    // Fungsi Update
    if (isset($_POST['update'])) {
        $ID = $_POST['ID'];
        $Nama = $_POST['Nama'];
        $NIDN = $_POST['NIDN'];
        $Jenjang_pendidikan = $_POST['Jenjang_pendidikan'];
    
        $sql = "UPDATE dosen SET Nama='$Nama', NIDN='$NIDN', Jenjang_pendidikan='$Jenjang_pendidikan' WHERE ID='$ID'";
    
        if ($conn->query($sql) === TRUE) {
            echo "Data dosen berhasil diupdate.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Fungsi untuk membaca data dosen
    function readdosen() {
        global $conn;
        $sql = "SELECT * FROM dosen";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data setiap baris
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["Nama"] . "</td>";
                echo "<td>" . $row["NIDN"] . "</td>";
                echo "<td>" . $row["Jenjang_pendidikan"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "Tidak ada data dosen.";
        }
    }

    // Fungsi untuk menghapus data dosen
    if (isset($_GET['delete'])) {
        $ID = $_GET['delete'];
        $sql = "DELETE FROM dosen WHERE ID = $ID";

        if ($conn->query($sql) === TRUE) {
            echo "Data dosen berhasil dihapus.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <center>=====CRUD Dosen=====</center>
    <table>
        <tr>
            <td>ID</td>
            <td>Nama</td>
            <td>NIDN</td>
            <td>Jenjang pendidikan</td>
            <td>Action</td>
        </tr>
        <?php readdosen(); ?>
    </table>

    <form method="post">
        <input type="text" name="Nama" placeholder="Nama" maxlength="255">
        <input type="text" name="NIDN" placeholder="NIDN"  maxlength="8"> 
        <input type="text" name="Jenjang_pendidikan" placeholder="Jenjang pendidikan">
        <button type="submit" name="create">Tambah dosen</button><br>
        ==================================================================<br>
        <input type="text" name="ID" placeholder="ID">
        <input type="text" name="Nama" placeholder="Nama" maxlength="255">
        <input type="text" name="NIDN" placeholder="NIDN" >
        <input type="radio" value="S2" name="Jenjang_pendidikan" placeholder="Jenjang pendidikan"><label for="">S2</label>
        <input type="radio" value="S3" name="Jenjang_pendidikan" placeholder="Jenjang pendidikan"><label for="">S3</label>
        <button type="submit" name="update">Update</button>
    </form>
</body>