<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        Tambah Gambar
    </button>
    <div class="row">
        <div class="table-responsive" id="gallery_data"></div>

        <!-- Awal Modal Tambah -->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Gambar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Gambar" required>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                            <!-- Hidden input untuk ID dan gambar lama -->
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="gambar_lama" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Modal Tambah -->
    </div>
</div>

<script>
$(document).ready(function() {
    load_data();

    function load_data(hlm) {
        $.ajax({
            url: "gallery_data.php",
            method: "POST",
            data: { hlm: hlm },
            success: function(data) {
                $('#gallery_data').html(data);
            }
        });
    }

    $(document).on('click', '.halaman', function() {
        var hlm = $(this).attr("id");
        load_data(hlm);
    });
});
</script>

<?php
include "upload_foto.php";

// Jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    // Jika ada file yang dikirim  
    if ($nama_gambar != '') {
        $cek_upload = upload_foto($_FILES["gambar"]);
        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    }

    // Cek apakah ada ID (untuk edit)
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];

        // Jika tidak ganti gambar, gunakan gambar lama
        if ($nama_gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            unlink("img/" . $_POST['gambar_lama']);
        }

        $stmt = $conn->prepare("UPDATE gallery SET judul = ?, gambar = ?, tanggal = ?, username = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $judul, $gambar, $tanggal, $username, $id);
    } else {
        // Insert data baru
        $stmt = $conn->prepare("INSERT INTO gallery (judul, gambar, tanggal, username) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $judul, $gambar, $tanggal, $username);
    }

    if ($stmt->execute()) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

// Jika tombol hapus diklik
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Hapus gambar sukses');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Hapus gambar gagal');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>