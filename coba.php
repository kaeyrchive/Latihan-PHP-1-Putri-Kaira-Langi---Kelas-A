<?php
// 1. Array multidimensi $matkul (minimal 5 mata kuliah)
$matkul = [
    ["nama" => "Pemrograman Web",    "sks" => 3, "nilai" => 90],
    ["nama" => "Basis Data",         "sks" => 3, "nilai" => 96],
    ["nama" => "Algoritma",          "sks" => 4, "nilai" => 55],
    ["nama" => "Matematika Diskrit", "sks" => 3, "nilai" => 88],
    ["nama" => "Bahasa Inggris",     "sks" => 2, "nilai" => 92],
];

// 2. Fungsi helper: nilai angka (0-100) -> huruf & bobot
function hitungBobot($nilai)
{
    if ($nilai >= 80)      return ["huruf" => "A", "bobot" => 4.0];
    elseif ($nilai >= 70)  return ["huruf" => "B", "bobot" => 3.0];
    elseif ($nilai >= 60)  return ["huruf" => "C", "bobot" => 2.0];
    elseif ($nilai >= 50)  return ["huruf" => "D", "bobot" => 1.0];
    else                   return ["huruf" => "E", "bobot" => 0.0];
}

// Hitung total untuk IPS
$totalSks = 0;
$totalMutu = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan PHP - Nilai Semester</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 8px 12px; text-align: center; }
        th { background: #ddd; }
        .mengulang { background: #ffcccc; color: #b00000; font-weight: bold; }
        .ringkasan { margin-top: 20px; line-height: 1.8; }
    </style>
</head>
<body>
    <h2>Daftar Nilai Semester</h2>

    <!-- 3. Tampilkan tabel -->
    <table>
        <tr>
            <th>No</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Bobot</th>
            <th>Status</th>
        </tr>
        <?php foreach ($matkul as $i => $mk):
            $hasil  = hitungBobot($mk["nilai"]);
            $status = ($hasil["bobot"] >= 2.0) ? "LULUS" : "MENGULANG";

            $totalSks  += $mk["sks"];
            $totalMutu += $mk["sks"] * $hasil["bobot"];

            // 4. Warna merah untuk status MENGULANG
            $kelas = ($status === "MENGULANG") ? "mengulang" : "";
        ?>
        <tr class="<?= $kelas ?>">
            <td><?= $i + 1 ?></td>
            <td style="text-align:left"><?= $mk["nama"] ?></td>
            <td><?= $mk["sks"] ?></td>
            <td><?= $mk["nilai"] ?></td>
            <td><?= $hasil["huruf"] ?></td>
            <td><?= number_format($hasil["bobot"], 1) ?></td>
            <td><?= $status ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php
    // 4. Hitung IPS = total (sks x bobot) / total sks
    $ips = $totalSks > 0 ? $totalMutu / $totalSks : 0;

    // 5. Batas maksimal SKS semester depan
    $maksSks = ($ips >= 3.00) ? 24 : 20;
    ?>

    <div class="ringkasan">
        <h3>Ringkasan IPS</h3>
        Total SKS: <b><?= $totalSks ?></b><br>
        Total Mutu (SKS x Bobot): <b><?= number_format($totalMutu, 1) ?></b><br>
        IPS: <b><?= number_format($ips, 2) ?></b><br>
        Batas maksimal SKS semester depan: <b><?= $maksSks ?> SKS</b>
    </div>
</body>
</html>