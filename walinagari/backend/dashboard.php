<?php
// dashboard.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Contoh data statistik (bisa diganti dengan data dari database)
$totalUsers = 120;
$totalPosts = 45;
$totalComments = 230;
$welcomeMessage = "Selamat Datang di Dashboard Walinagari!";

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Walinagari</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(120deg, #4e54c8, #8f94fb);
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 900px;
      margin: 40px auto;
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 8px 32px rgba(44,62,80,0.18);
      padding: 40px 30px;
    }
    h1 {
      color: #4e54c8;
      margin-bottom: 10px;
      font-size: 2.5em;
    }
    .subtitle {
      color: #555;
      margin-bottom: 30px;
      font-size: 1.2em;
    }
    .stats {
      display: flex;
      justify-content: space-between;
      margin-bottom: 40px;
    }
    .card {
      background: linear-gradient(120deg, #8f94fb 60%, #4e54c8 100%);
      color: #fff;
      border-radius: 14px;
      flex: 1;
      margin: 0 10px;
      padding: 30px 20px;
      box-shadow: 0 4px 16px rgba(44,62,80,0.08);
      text-align: center;
      transition: transform 0.2s;
    }
    .card:hover {
      transform: translateY(-8px) scale(1.03);
    }
    .card h2 {
      font-size: 2.2em;
      margin: 0 0 10px 0;
    }
    .card p {
      margin: 0;
      font-size: 1.1em;
      letter-spacing: 1px;
    }
    .footer {
      text-align: center;
      color: #888;
      margin-top: 30px;
      font-size: 1em;
    }
    @media (max-width: 700px) {
      .stats {
        flex-direction: column;
      }
      .card {
        margin: 10px 0;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1><?= $welcomeMessage ?></h1>
    <div class="subtitle">
      Bersama membangun nagari yang lebih maju, transparan, dan berdaya saing.<br>
      Pantau perkembangan, kelola data, dan wujudkan pelayanan terbaik untuk masyarakat.
    </div>
    <div class="stats">
      <div class="card">
        <h2><?= $totalUsers ?></h2>
        <p>Pengguna Terdaftar</p>
      </div>
      <div class="card">
        <h2><?= $totalPosts ?></h2>
        <p>Berita & Informasi</p>
      </div>
      <div class="card">
        <h2><?= $totalComments ?></h2>
        <p>Komentar Masyarakat</p>
      </div>
    </div>
    <div class="footer">
      &copy; <?= date('Y') ?> Walinagari. Bersama untuk kemajuan nagari.
    </div>
  </div>
</body>
</html>