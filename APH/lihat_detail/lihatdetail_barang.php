<?php
require '../koneksi.php';

if ($_SESSION['role'] !== 'admin_aph' && $_SESSION['role'] !== 'logistik_aph') {
    header("Location: ../login.php");
    exit;
}

$idb = $_GET['id_barang'];

$get = mysqli_prepare($conn_aph, "SELECT * FROM stok WHERE idbarang=?");
mysqli_stmt_bind_param($get, "s", $idb);
mysqli_stmt_execute($get);
$result = mysqli_stmt_get_result($get);
$fetch = mysqli_fetch_assoc($result);

$gambar = $fetch['dokumentasi'];
$namabarang = htmlspecialchars($fetch['namabarang']); 
$jmlhstok = htmlspecialchars($fetch['jmlhstok']); 
$tanggal_update = htmlspecialchars($fetch['update_stok']); 
$lokasi_penyimpanan = htmlspecialchars($fetch['lokasi_penyimpanan']); 
$keterangan = htmlspecialchars($fetch['keterangan']); 
$unit = htmlspecialchars($fetch['unit']); 

$get_karyawan = mysqli_prepare($conn_aph, "SELECT * FROM karyawan WHERE idkaryawan = ?");
mysqli_stmt_bind_param($get_karyawan, "s", $fetch['idkaryawan']);
mysqli_stmt_execute($get_karyawan);
$result_karyawan = mysqli_stmt_get_result($get_karyawan);

if ($row_karyawan = mysqli_fetch_assoc($result_karyawan)) {
    $nama_pic = htmlspecialchars($row_karyawan['namakaryawan']);
}

if($gambar==null){
    $gambar='Tidak Ada Photo';
}else {
    $gambar = '<img src="../images/'.$gambar.'" class="gambarfoto"> ';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>DETAIL BARANG STOK</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../sweetalert2.min.css">
    <style>
         .gambarfoto{
            width:100%;
            height:90%;
            border-radius:5px;
        }
        h5{
            font-size:15px;
        }
        .gambarterkait{
            width:70%;
            
        }
        .gambarterkait:hover{
            transform: scale(1.7);
            transition: 0.5 ease;
        }
        .gambarfoto img {
            border: 2px solid #fff; 
            border-radius: 5px; 
        }
        
        .btn-custom {
            background-color: #3E578D;
            color: #fff;
            transition: background-color 0.3s ease; 
        }

      
        .btn-custom:hover {
            opacity : 0.9;
            color: #fff;
        }
      
        .nav-link.active,
        .nav-link:hover {
            position: relative;
        }

      
        .nav-link.active::before,
        .nav-link:hover::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: -20px; 
            width: 4px; 
            background-color: white; 
            border-radius: 0 2px 2px 0; 
        }
        .dropdown-item:hover{
            background-color: #164863;
            color: #fff;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <div id="prelouder"></div>

    <?php include 'navdetail.php'; ?>

    <div id="layoutSidenav">
        <?php include 'sidenavdetail.php'; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="row py-2 ">    
                        <a href="../barang.php" class="btn btn-danger mb-2 shadow" style="font-size:14px; font-weight: lighter;"><i class="fas fa-arrow-left"></i></a><br>
                    </div>    
                    <h1 class="mt-3 text-center mb-4" style="color:#3E578D; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);"><?=$namabarang;?></h1>
                        <div class="card-body">
                            <div class="row mt-5">
                                <h4 style="color:#3E578D; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Detail Barang</h4>
                            </div>
                            <div class="row mt-3" style="background-color:#3E578D; border-radius:3px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">
                                <div class="col-md-5">
                                    <div class="gambarfoto mt-2 d-flex align-items-center justify-content-center shadow"><?=$gambar;?></div>
                                </div>
                                <div class="col-md-7 mt-3">
                                    <div class="row" style="color:#fff; font-size:12px;">
                                        <div class="col-md-6 col-12">
                                            <h5>NAMA BARANG :</h5>
                                            <p><?=$namabarang;?></p>

                                            <h5>JUMLAH STOK :</h5>
                                            <p><?=$jmlhstok;?></p>
                                            
                                            <h5>UNIT :</h5>
                                            <p><?=$unit;?></p>

                                            <h5>TANGGAL UPDATE STOK :</h5>
                                            <p><?=$tanggal_update;?></p>
                                                
                                        </div>
                                        <div class="col-6">
                                            <h5>LOKASI PENYIMPANAN BARANG :</h5>
                                            <p><?=$lokasi_penyimpanan;?></p>

                                            <h5>NAMA PIC :</h5>
                                            <p><?=$nama_pic;?></p>
                                            
                                            <h5>KETERANGAN :</h5>
                                            <p><?=$keterangan;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row justify-content-center mt-5" id="foto_lokasi">
                                <div class="col-md-6">
                                    <h4 style="color:#3E578D;">FOTO BARANG/ LOKASI BARANG :</h4>
                                </div>    
                                <div class="col-md-6">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#myModal" style="background-color:#3E578D; float: right; color:white;">Tambah Dokumen/Gambar +</button>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <!-- UNTUK MENAMPILKAN GAMBAR -->
                                <div class="col-md-12 mt-3">
                                <?php
                                    $query = "SELECT * FROM dokumen_lokasi_barang where idbarang = '$idb'";
                                    $result = mysqli_query($conn_aph, $query);

                                    if ($result && mysqli_num_rows($result) > 0) {
                                        echo '<div class="row d-flex bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $nama_gambar = $row['nama_gambar'];
                                            $link_gambar = $row['gambar_path'];
                                            $id_lok_barang = $row['id_lok_barang'];


                                            if ($nama_gambar == NULL) {
                                               
                                            } else {
                                                echo '<div class="col-md-3 d-flex align-items-center text-center mt-3 mb-3">';
                                                    echo '<a href="' . $row['gambar_path'] . '" target="_blank">';
                                                    echo '<img src="' . $row['gambar_path'] . '" alt="Gambar" class="gambarterkait"></a>';
                                                    ?>
                                                    <button type="button" class="btn btn-danger mb-2 mx-2 mt-4 justify-content-center align-items-center d-flex" data-toggle="modal" data-target="#deleteGambarModal<?= $id_lok_barang; ?>" style="width: 20px;">
                                                    <div class="fas fa-trash" style="width: 15px;"></div>
                                                    </button>
                                                    <?php
                                                  
                                        
                                                echo '</div>';
                                            }
                                        
                                            ?>

                                            <!-- MODAL HAPUS GAMBAR -->
                                            <div class="modal fade" id="deleteGambarModal<?= $id_lok_barang; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteGambarModalLabel<?= $id_lok_barang; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteGambarModalLabel<?= $id_lok_barang; ?>">Konfirmasi Hapus Gambar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus <strong><?= $nama_gambar?> ?</strong>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post">
                                                            <input type="hidden" name="id_lok_barang" value="<?= $id_lok_barang; ?>">
                                                            <button type="submit" name="hapus_gambar_lokasi" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php                                            

                                        }
                                        echo '</div>';
                                    } else {
                                        echo '<div class="row px-2 py-3 bg-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.4);">';
                                        echo "*Data Gambar Tidak Ditemukan";
                                        echo '</div>';
                                    }
                                    ?>
                                </div> 
                            </div>
                            </div>
                            <br><br>
                            <hr>
                            <div class="col-md-12">
                                <h4 style="color:#3E578D;">DATA BARANG MASUK :</h4>
                            </div>   
                            <!-- TABLE BARANG MASUK -->
                            <div class="table-responsive shadow-lg px-1 py-5">
                                <table class="table table-bordered text-center" id="dataTable" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">
                                    <thead style="background-color: #3E578D; color:white;">
                                        <tr>
                                            <th>No Transaksi</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Nama Supplier</th>
                                            <th>Nama Barang</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Harga Satuan</th>
                                            <th>Total Harga</th>
                                            <th>Nomor PO</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $ambilsemuadata = mysqli_query($conn_aph, "SELECT * FROM masuk m JOIN stok s ON s.idbarang = m.idbarang WHERE m.idbarang = '$idb'");
                                        $i= 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                            $tanggal_penerimaan = $data['tanggal_penerimaan'];
                                            $nama_supplier = $data['nama_supplier'];
                                            $nama_barang = $data['nama_barang'];
                                            $jumlah = $data['jumlah'];
                                            $harga_satuan = $data['harga_satuan'];
                                            $total_harga = $data['total_harga'];
                                            $faktur = $data['faktur'];
                                            $idb = $data['idbarang'];
                                            $idm = $data['idmasuk'];
                                            $keterangan = $data['keterangan'];
                                            $id_supplier = $data['idsupplier'];
                                            $unit = $data['unit_masuk'];

                                            $tanggalterima = TanggalIndo($tanggal_penerimaan);

                                            $kodeTransaksi = $data['kode_transaksi_masuk'];

                                            $gambar = $data['dokumentasi'];
                                            if($gambar==null){
                                                $gambar='Tidak Ada Photo';
                                            }else {
                                                $gambar = '<img src="images/'.$gambar.'" class="gambarfoto"> ';
                                            }

                                        ?>

                                            <tr>
                                                <td><?= $kodeTransaksi; ?></td>
                                                <td><?= htmlspecialchars($tanggalterima) ?></td>
                                                <td><?= htmlspecialchars($nama_supplier) ?></td>
                                                <td><?= htmlspecialchars($nama_barang) ?></td>
                                                <td><?= htmlspecialchars($jumlah) ?></td>
                                                <td><?= htmlspecialchars($unit) ?></td>
                                                <td><?= htmlspecialchars($harga_satuan) ?></td>
                                                <td style="font-weight : bold;">Rp <?= number_format($total_harga, 0, ',', '.') ?></td>
                                                <td><?= htmlspecialchars($faktur) ?></td>
                                                <td><?= htmlspecialchars($keterangan) ?></td>
                                               
                                            
                                            </tr>
                                            <!--Edit Modal -->
                                            <div class="modal fade" id="edit<?= $idm; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                <input type="hidden" name="idm" value="<?= $idm; ?>">
                                                                Nama Barang (tidak bisa diubah):
                                                                <div class="form-control bg-warning " style="opacity: 0.8;"><?= $nama_barang; ?></div><br>
                                                                Tanggal Masuk Barang :
                                                                <input type="date" name="tanggalmasuk_" id="tanggalmasuk_<?= $idm; ?>" value="<?= $tanggal_penerimaan; ?>" class="form-control datepicker" required><br>
                                                                Nama Supplier :
                                                                <select name="supplier2" class="form-control" required>
                                                                    <?php
                                                                    $ambilsemuadatasupplier = mysqli_query($conn_aph, "select * from supplier");
                                                                    while ($fetcharray = mysqli_fetch_array($ambilsemuadatasupplier)) {
                                                                        $namasupplier = $fetcharray['namasupplier'];
                                                                        $idsupplier = $fetcharray['idsupplier'];
                                                                        $selected = ($id_supplier == $idsupplier) ? 'selected' : ''; 
                                                                    ?>
                                                                        <option value="<?= $idsupplier; ?>"<?= $selected?>><?= $namasupplier; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <br>
                                                                Quantity : <br>
                                                                <input type="number" name="qty" value="<?= $jumlah; ?>" class="form-control" required><br>
                                                                Unit :
                                                                <select name="unit" id="unit" class="form-control" required>
                                                                    <?php
                                                                    $units = ["PCS", "ROLL", "KG", "LITER", "GRAM", "TON"]; 
                                                                    foreach ($units as $satuan_bentuk) {
                                                                        $selected = ($satuan_bentuk == $unit) ? 'selected' : ''; 
                                                                        echo '<option value="' . $satuan_bentuk . '" ' . $selected . '>' . ucfirst($satuan_bentuk) . '</option>';
                                                                    }
                                                                    ?>
                                                                </select><br>
                                                                Harga Satuan : <br>
                                                                <input type="number" name="hargasatuan" value="<?= $harga_satuan; ?>" class="form-control" required><br>
                                                                Nomor PO :
                                                                <input type="text" name="invoice" value="<?= $faktur; ?>" class="form-control" required><br>
                                                                Keterangan :
                                                                <input type="text" name="keterangan" value="<?= $keterangan; ?>" class="form-control" required><br>
                                                                <button type="submit" class="btn btn-custom" name="updatebarangmasuk">Submit</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!--Delete Modal -->
                                            <div class="modal fade" id="delete<?= $idm; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data Masuk?</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah Anda Yakin Ingin Menghapus Data Masuk <strong> <?= $nama_barang; ?></strong> Pada Tanggal <strong><?= $tanggalterima?>?</strong>
                                                                <input type="hidden" name="idm" value="<?= $idm; ?>">
                                                                <br><br>
                                                                <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        };

                                        ?>

                                    </tbody>
                                </table>
                            </div>

                            <br>
                            <hr>
                            <div class="col-md-12">
                                <h4 style="color:#3E578D;">DATA BARANG KELUAR :</h4>
                            </div>   
                            <!-- TABLE BARANG KELUAR -->
                            <div class="table-responsive shadow-lg px-1 py-5">
                                <table class="table table-bordered text-center" id="dataTableKeluar" width="" cellspacing="0" style="font-size:11px; text-transform: uppercase;">
                                    <thead style="background-color: #3E578D; color:white;">
                                        <tr>
                                            <th>No Transaksi</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Unit</th>
                                            <th>Keperluan</th>
                                            <th>Tujuan/Penerima</th>
                                            <th>Keterangan</th>
                                            <th>Status ACC</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i= 1;
                                        $ambilsemuadata = mysqli_query($conn_aph, "SELECT * FROM keluar k JOIN stok s ON k.idbarang = s.idbarang WHERE k.idbarang = '$idb' ORDER BY k.kode_transaksi ASC");
                                        while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                            $idk = $data['idkeluar'];
                                            $idb = $data['idbarang'];
                                            $tanggalkeluar = $data['tanggal_keluar'];
                                            $nama_barang = $data['namabarang'];
                                            $jumlah = $data['jumlah'];
                                            $tujuan = $data['penerima'];
                                            $keperluan = $data['keperluan'];
                                            $keterangan = $data['keterangank'];
                                            $unit = $data['units'];
                                            $status = $data['status'];


                                            $kodeTransaksi = $data['kode_transaksi'];

                                            $tanggalkeluar_indo = TanggalIndo($tanggalkeluar);

                                            $gambar = $data['dokumentasi'];
                                            if($gambar==null){
                                                $gambar='Tidak Ada Photo';
                                            }else {
                                                $gambar = '<img src="../images/'.$gambar.'" class="gambarfoto"> ';
                                            }
                                          
                                        ?>

                                            <tr style="background-color: <?php echo ($status == 'ACCEPTED') ? 'rgba(0, 255, 0, 0.2)' : (($status == 'REJECTED') ? 'rgba(255, 0, 0, 0.2)' : ''); ?>">
                                               
                                                <td><?= $kodeTransaksi; ?></td>
                                                <td><?= htmlspecialchars($tanggalkeluar_indo) ?></td>
                                                <td><?= htmlspecialchars($nama_barang) ?></td>
                                                <td><?= htmlspecialchars($jumlah) ?></td>
                                                <td><?= htmlspecialchars($unit) ?></td>
                                                <td><?= htmlspecialchars($keperluan) ?></td>
                                                <td><?= htmlspecialchars($tujuan) ?></td>
                                                <td><?= htmlspecialchars($keterangan) ?></td>
                                                <td>
                                                    <?php
                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS approvals_count FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                        $result_count_approvals = mysqli_query($conn_aph, $query_count_approvals);
                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                        $approvals_count = $row_count_approvals['approvals_count'];
                                                        
                                                        $query_count_approvals = "SELECT COUNT(DISTINCT id_user) AS rejected_count FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                        $result_count_approvals = mysqli_query($conn_aph, $query_count_approvals);
                                                        $row_count_approvals = mysqli_fetch_assoc($result_count_approvals);
                                                        $rejected_count = $row_count_approvals['rejected_count'];
                                                        
                                                         // Mengambil informasi user yang sudah menyetujui
                                                         $query_approved_users = "SELECT DISTINCT id_user FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'approve'";
                                                         $result_approved_users = mysqli_query($conn_aph, $query_approved_users);
                                                         $approved_users = [];
                                                         while ($row = mysqli_fetch_assoc($result_approved_users)) {
                                                             $approved_users[] = $row['id_user'];
                                                         }
 
                                                         $approved_users_info = [];
                                                         foreach ($approved_users as $user_id) {
                                                             $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                             $result_username = mysqli_query($conn_aph, $query_username);
                                                             $row_username = mysqli_fetch_assoc($result_username);
                                                             $approved_users_info[$user_id] = $row_username['username'];
                                                         }

                                                        // Mengambil informasi user yang melakukan penolakan
                                                        $query_rejected_users = "SELECT DISTINCT id_user FROM persetujuan_keluar WHERE id_keluar = $idk AND aksi = 'reject'";
                                                        $result_rejected_users = mysqli_query($conn_aph, $query_rejected_users);
                                                        $rejected_users = [];
                                                        while ($row = mysqli_fetch_assoc($result_rejected_users)) {
                                                            $rejected_users[] = $row['id_user'];
                                                        }

                                                        // Mengambil informasi username dari tabel login berdasarkan id_user untuk user yang melakukan penolakan
                                                        $rejected_users_info = [];
                                                        foreach ($rejected_users as $user_id) {
                                                            $query_username = "SELECT username FROM login WHERE iduser = $user_id";
                                                            $result_username = mysqli_query($conn_aph, $query_username);
                                                            $row_username = mysqli_fetch_assoc($result_username);
                                                            $rejected_users_info[$user_id] = $row_username['username'];
                                                        }
                                                     ?>
                                                     <a href="#" data-toggle="modal" data-target="#statusModal<?= $idk; ?>"><?= $status; ?></a>
                                                </td>
                                               
                                            </tr>
                                             <!-- Modal -->
                                             <div class="modal fade" id="statusModal<?= $idk; ?>" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel<?= $idk; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="text-align: center;">
                                                            <h5 class="modal-title" id="statusModalLabel<?= $idk; ?>">Status Barang Keluar</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>No Transaksi: <?= $kodeTransaksi?></p>
                                                            <p>Nama Barang: <?= $nama_barang?></p>
                                                            <p>Jumlah: <?= $jumlah?> <?= $unit?></p>
                                                            <p>Tanggal Keluar Barang: <?= $tanggalkeluar_indo?></p>
                                                            <hr>
                                                            <p>Status Request: <?= $status; ?></p>
                                                            <p>Total Approvals: <?= $approvals_count; ?></p>
                                                            <?php if (!empty($approved_users_info)) : ?>
                                                                <p>Users who approved:</p>
                                                                <ul style="background-color : rgba(0, 128, 0, 0.2);">
                                                                    <?php foreach ($approved_users_info as $user_id => $username) : ?>
                                                                        <li>User ID: <?= $user_id; ?>, Username: <?= $username; ?></li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                            <p>Total Rejected: <?= $rejected_count; ?></p>
                                                            <?php if (!empty($rejected_users_info)) : ?>
                                                                <p>Users who rejected:</p>
                                                                <ul style="background-color : rgba(128, 0, 0, 0.2);">
                                                                    <?php foreach ($rejected_users_info as $user_id => $username) : ?>
                                                                        <li>User ID: <?= $user_id; ?>, Username: <?= $username; ?></li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        };

                                        ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/datatables-demo.js"></script>

    <script>
        var loader = document.getElementById("prelouder");

        window.addEventListener("load", function() {
            loader.style.display = "none";
        })
    </script>


</body>

<!-- MODAL UNTUK INPUT DATA  -->
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Foto Lokasi Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body" style="font-size: 15px;">
                    <input type="hidden" name="idb" value="<?= $idb; ?>">
                    Pilih Gambar:
                    <input type="file" name="image_file2[]" id="image_file2" multiple accept="image/*" class="form-control"><br>
                    <button type="submit" class="btn btn-custom" name="submit_dokumen_barang">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>


<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
                if ($.fn.DataTable.isDataTable('#dataTable')) {
                    $('#dataTable').DataTable().destroy(); // Menghancurkan inisialisasi DataTable sebelumnya
                }
                
                $('#dataTable').DataTable({
                    "pageLength": 50,
                    // Konfigurasi lainnya
                });
            });
        </script>
<script>
    $(document).ready(function() {
        $('#dataTableKeluar').DataTable({
            "paging": true, 
            "searching": true, 
        });
        if ($.fn.DataTable.isDataTable('#dataTableKeluar')) {
                    $('#dataTableKeluar').DataTable().destroy(); // Menghancurkan inisialisasi DataTable sebelumnya
                }
                
                $('#dataTableKeluar').DataTable({
                    "pageLength": 50,
                    // Konfigurasi lainnya
                });
    });
</script>
<script>
    $(function() {
        $("#tanggalmasuk").datepicker({
            dateFormat: "dd/mm/yy",
            dateMonth: true,
            dateYear: true

        });
    });

</script>

</html>

<?php
// Menambah data legal
if (isset($_POST['submit_dokumen_barang'])) {
    // Sanitize and validate input
    $idb = filter_input(INPUT_POST, 'idb', FILTER_SANITIZE_NUMBER_INT);

    // Upload and process image files
    $imageUploadDir2 = "../lihat_detail/lokasi_barang_stok/";
    $imageFiles2 = $_FILES['image_file2'];

    foreach ($imageFiles2['tmp_name'] as $key2 => $tmp_name) {
        $imageFileName2 = $imageFiles2['name'][$key2];
        $imageFilePath2 = $imageUploadDir2 . $imageFileName2;

        if (!empty($imageFileName2)) {
            // Move the uploaded file to the destination directory
            move_uploaded_file($imageFiles2['tmp_name'][$key2], $imageFilePath2);

            // Insert image details into the database using prepared statements
            $sqlImage = "INSERT INTO dokumen_lokasi_barang (nama_gambar, gambar_path, idbarang) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn_aph, $sqlImage);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ssi', $imageFileName2, $imageFilePath2, $idb);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                echo '<script type="text/javascript">      
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Data Telah Ditambahkan",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function () { 
                            window.location.href = "lihatdetail_barang.php?id_barang=' . $idb . '";  
                        }, 1500);
                        </script>';
            } else {
                echo "Failed to execute prepared statement.";
            }
        } else {
        }
    }
}


//Hapus Gambar
if (isset($_POST['hapus_gambar_lokasi'])) {
    $id_lok_barang = filter_input(INPUT_POST, 'id_lok_barang', FILTER_SANITIZE_NUMBER_INT);

    $gambarQuery = mysqli_query($conn_aph, "SELECT * FROM dokumen_lokasi_barang WHERE id_lok_barang='$id_lok_barang'");
    $get = mysqli_fetch_array($gambarQuery);

    if ($get) {
        $lokgambar = "../lihat_detail/lokasi_barang_stok/" . $get['nama_gambar'];

        if (unlink($lokgambar)) {
            $hapusgambar = mysqli_query($conn_aph, "DELETE FROM dokumen_lokasi_barang WHERE id_lok_barang='$id_lok_barang'");
            if ($hapusgambar) {
                echo '<script type="text/javascript">      
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Data Berhasil Dihapus",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function () { 
                            window.location.href = "lihatdetail_barang.php?id_barang=' . $idb . '";  
                        }, 1500);
                        </script>';
            } else {
                echo 'Gagal menghapus data dari database.';
                header('Location: lihatdetail_barang.php?id_barang=' . $idb);
            }
        } else {
            echo 'Gagal menghapus file gambar.';
            header('Location: lihatdetail_barang.php?id_barang=' . $idb);
        }
    } else {
        echo 'Data tidak ditemukan.';
        header('Location: lihatdetail_barang.php?id_barang=' . $idb);
    }
}



//fungsi tanngal 
function InputTgl($tanggal)
{
    $pisah = explode('/', $tanggal);
    $lari = array($pisah[2], $pisah[1], $pisah[0]);
    $satukan = implode("-", $lari);

    return $satukan;
}
//fungsi edit tanngal 
function EditTgl($tanggal)
{
    $pisah = explode('/', $tanggal);
    $lari = array($pisah[2], $pisah[1], $pisah[0]);
    $satukan = implode("-", $lari);

    return $satukan;
}
//agar berurutan tanggalnya dan muncul bulannya
function TanggalIndo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = Bulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);

    return $tanggal . " " . $bulan . " " . $tahun;
}

function Bulan($bln)
{
    if ($bln == "01") {
        return "Januari";
    } elseif ($bln == "02") {
        return "Februari";
    } elseif ($bln == "03") {
        return "Maret";
    } elseif ($bln == "04") {
        return "April";
    } elseif ($bln == "05") {
        return "Mei";
    } elseif ($bln == "06") {
        return "Juni";
    } elseif ($bln == "07") {
        return "Juli";
    } elseif ($bln == "08") {
        return "Agustus";
    } elseif ($bln == "09") {
        return "September";
    } elseif ($bln == "10") {
        return "Oktober";
    } elseif ($bln == "11") {
        return "November";
    } elseif ($bln == "12") {
        return "Desember";
    }
}
?>