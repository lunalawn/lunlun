<?php
$ukuran = $_POST["ukuran"];
$warna = $_POST["warna"];
$halaman = $_POST["halaman"];
$rangkap = $_POST["rangkap"];

$tarif = 0;
$total = 0;
$valid = false;
$pesan = "Perhitungan belum dibuat.";

// Daftar tarif per halaman: [ukuran][warna]
$daftar_tarif = [
    "A4" => ["Hitam Putih" => 500, "Berwarna" => 1500],
    "F4" => ["Hitam Putih" => 700, "Berwarna" => 1800],
];

// Pastikan semua input berupa string (cegah input array seperti halaman[]=1)
if (!is_string($ukuran) || !is_string($warna) || !is_string($halaman) || !is_string($rangkap)) {
    $ukuran = is_string($ukuran) ? $ukuran : "";
    $warna = is_string($warna) ? $warna : "";
    $halaman = "";
    $rangkap = "";
}

$halaman = trim($halaman);
$rangkap = trim($rangkap);

// Bilangan bulat positif: hanya digit, maksimal 9 digit, dan nilainya > 0
function bilangan_bulat_positif($nilai)
{
    return $nilai !== ""
        && ctype_digit($nilai)
        && strlen($nilai) <= 9
        && (int) $nilai > 0;
}

if (!isset($daftar_tarif[$ukuran])) {
    $pesan = "Ukuran kertas tidak valid.";
} elseif (!isset($daftar_tarif[$ukuran][$warna])) {
    $pesan = "Warna cetak tidak valid.";
} elseif (!bilangan_bulat_positif($halaman)) {
    $pesan = "Jumlah halaman harus berupa bilangan bulat positif.";
} elseif (!bilangan_bulat_positif($rangkap)) {
    $pesan = "Jumlah rangkap harus berupa bilangan bulat positif.";
} else {
    $halaman = (int) $halaman;
    $rangkap = (int) $rangkap;
    $tarif = $daftar_tarif[$ukuran][$warna];
    $valid = true;
}

if ($valid) {
    $total = $tarif * $halaman * $rangkap;
}
