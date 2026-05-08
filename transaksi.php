<?php
class Transaksi {
    private $db;
    function __construct($db){ $this->db=$db; }
    function catat($id,$jumlah){
        $cek=$this->db->query("SELECT stok FROM produk WHERE id=$id")->fetch_assoc();
        if($jumlah<0 || $cek['stok']<$jumlah) return;
        $this->db->query("INSERT INTO transaksi(produk_id,jumlah,tanggal) VALUES($id,$jumlah,NOW())");
        $this->db->query("UPDATE produk SET stok=stok-$jumlah WHERE id=$id");
    }
    function semua(){
        return $this->db->query("SELECT * FROM transaksi");
    }
}
?>
