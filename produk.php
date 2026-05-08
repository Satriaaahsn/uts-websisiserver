<?php
class Produk {
    private $db;
    function __construct($db){ $this->db=$db; }
    function tambah($nama,$stok){
        if($stok<0) return;
        $this->db->query("INSERT INTO produk(nama,stok) VALUES('$nama',$stok)");
    }
    function kurangi($id,$jumlah){
        $cek=$this->db->query("SELECT stok FROM produk WHERE id=$id")->fetch_assoc();
        if($jumlah<0 || $cek['stok']<$jumlah) return;
        $this->db->query("UPDATE produk SET stok=stok-$jumlah WHERE id=$id");
    }
    function semua(){
        return $this->db->query("SELECT * FROM produk");
    }
}
?>
