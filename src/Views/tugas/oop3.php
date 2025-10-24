<?php

class Mahasiswa {
    public $nama;
    public $nim;

    public function __construct($nama, $nim) {
        $this -> nama = $nama;
        $this-> nim = $nim;
    }
}


$mahasiwa1 = new Mahasiswa("noval", '08756');
// $mahasiwa1 -> nama = "Noval";
// $mahasiwa1 -> nim = "09876";

echo $mahasiwa1 -> nama;
echo $mahasiwa1 -> nim;