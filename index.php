<?php
include "koneksi.php";
include "Produk.php";
include "Transaksi.php";

$p = new Produk($koneksi);
$t = new Transaksi($koneksi);

if(isset($_POST['tambah'])){
    $p->tambah($_POST['nama'],$_POST['stok']);
}
if(isset($_POST['transaksi'])){
    $t->catat($_POST['produk_id'],$_POST['jumlah']);
}

$produk = $p->semua();
$transaksi = $t->semua();
?>
<html>
<body>
<h2>Tambah Produk</h2>
<form method="post">
Nama: <input name="nama">
Stok: <input name="stok" type="number">
<button name="tambah">Simpan</button>
</form>

<h2>Transaksi</h2>
<form method="post">
Produk:
<select name="produk_id">
<?php
$produk = $p->semua();
while($row=$produk->fetch_assoc()){
    echo "<option value='".$row['id']."'>".$row['nama']."</option>";
}
?>
</select>
Jumlah: <input name="jumlah" type="number">
<button name="transaksi">Proses</button>
</form>

<h2>Data Produk</h2>
<table border="1">
<tr><th>Nama</th><th>Stok</th></tr>
<?php
$produk = $p->semua();
while($row=$produk->fetch_assoc()){
    echo "<tr><td>".$row['nama']."</td><td>".$row['stok']."</td></tr>";
    if($row['stok']<5){
        echo "<tr><td colspan=2>Stok Menipis</td></tr>";
    }
}
?>
</table>

<h2>Rekap Transaksi</h2>
<table border="1">
<tr><th>Produk ID</th><th>Jumlah</th><th>Tanggal</th></tr>
<?php
while($row=$transaksi->fetch_assoc()){
    echo "<tr><td>".$row['produk_id']."</td><td>".$row['jumlah']."</td><td>".$row['tanggal']."</td></tr>";
}
?>
</table>
</body>
</html>
