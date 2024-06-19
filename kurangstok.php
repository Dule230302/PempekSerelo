<?php

include 'koneksi.php';

function kurangiStokFIFO($koneksi, $produkID, $jumlah) {
  try {
      // Memulai transaksi
      $koneksi->begin_transaction();

      // Variabel untuk menyimpan jumlah yang harus dikurangi
      $jumlahDikurangi = $jumlah;

      // Mendapatkan stok berdasarkan FIFO
      $stmt = $koneksi->prepare("SELECT idstok, stok FROM stok WHERE idproduk = ? AND stok > 0 ORDER BY tanggalstok ASC");
      $stmt->bind_param("i", $produkID);
      $stmt->execute();
      $result = $stmt->get_result();
      $stokData = $result->fetch_all(MYSQLI_ASSOC);

      // Loop untuk mengurangi stok secara FIFO
      foreach ($stokData as $row) {
          if ($jumlahDikurangi <= 0) {
              break;
          }

          $idstok = $row['idstok'];
          $stok = $row['stok'];

          if ($stok >= $jumlahDikurangi) {
              $newStok = $stok - $jumlahDikurangi;
              $jumlahDikurangi = 0;
          } else {
              $newStok = 0;
              $jumlahDikurangi -= $stok;
          }

          // Update stok
          $updateStmt = $koneksi->prepare("UPDATE stok SET stok = ? WHERE idstok = ?");
          $updateStmt->bind_param("ii", $newStok, $idstok);
          $updateStmt->execute();
      }

      // Commit transaksi
      $koneksi->commit();
      echo "Stok berhasil dikurangi.";
  } catch (Exception $e) {
      // Rollback transaksi jika terjadi kesalahan
      $koneksi->rollback();
      echo "Gagal mengurangi stok: " . $e->getMessage();
  }
}
