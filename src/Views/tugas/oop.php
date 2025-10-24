<?php
class Hewan
{
    public string $nama;
    public string $warna;
}

// #1 Buat Array Untuk menampung hewan
$hewans = [];

// #2 Panggil Class

$hewan = new Hewan();

// #3 Isi Class
$hewan->nama = "Kudanil";
$hewan->warna = "Abu Kudanil";

// #4 Masukin ke array
$hewans[] = [
    "nama" => $hewan->nama,
    "warna" => $hewan->warna,
];

$hewan->nama = "Badak";
$hewan->warna = "Abu Badak";
$hewans[] = [
    "nama" => $hewan->nama,
    "warna" => $hewan->warna,
];

$hewan->nama = "Monyet";
$hewan->warna = "Abu Monyet";

$hewans[] = [
    "nama" => $hewan->nama,
    "warna" => $hewan->warna,
];

foreach ($hewans as $h) {
    echo "Nama :" . $h['nama'] . "<br>";
    echo "Warna :" . $h['warna'] . "<br>";
}

echo "<br>";

class Shape
{
    public int $corner;
    public int $length;

    public function __construct($corner, $length)
    {
        $this->corner = $corner;
        $this->length = $length;
    }
    public function area(): int
    {
        return $this->corner * $this->length;
    }

    public function toArray()
    {
        return ["corner" => $this->corner, "length" => $this->length, "result" => $this->area()];
    }
}

$square1 = new Shape(4, 10);
$square2 = new Shape(4, 12);
$square3 = new Shape(4, 14);

$arr = [$square1->toArray(), $square2->toArray(), $square3->toArray()];

print_r($arr);
echo "<br>";
echo "<br>";

class Matakuliah
{
    public string $nama;
}
class Dosen
{
    public string $nama;
    public string $alamat;
    public string $matkul;
}

$matkul = new Matakuliah();
$matkul->nama = "IPS";

$dosen = new Dosen();
$dosen->nama = "Waluyo";
$dosen->matkul = $matkul->nama;
$dosen->alamat = "JakSel";

echo $dosen->nama;
echo $dosen->matkul;

class Pegawai
{
    public string $nama;

    public function tampilkanData()
    {
        return $this->nama;
    }
}

class Manajer extends Pegawai
{
    public string $departemen;
    public function tampilkanData()
    {
        return $this->nama . ' - ' . $this->departemen;
    }
}

echo "<br>";
echo "<br>";

$pegawai1 = new Pegawai();
$pegawai1->nama = "Kurniawan";
echo $pegawai1->tampilkanData();

echo "<br>";
echo "<br>";

$manajer1 = new Manajer();
$manajer1->nama = "Pratama";
$manajer1->departemen = "Keuangan";
echo $manajer1->tampilkanData();

echo "<br>";
echo "<br>";

class Produk
{
    public $nama;
    protected $harga;
    private $stock;

    public function __construct($nama, $harga)
    {
        $this->nama = $nama;
        $this->harga = $harga;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function getStock()
    {
        return $this->stock;
    }
}

class Ciki extends Produk {}

$ciki1 = new Produk("a", "1");
$ciki1->setStock("abs");
$ciki1->getStock();

var_dump($ciki3);
