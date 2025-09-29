<?php
// 1. Veritabanı bağlantısı
$dsn = 'mysql:host=localhost;dbname=otel;charset=utf8mb4';
$username = 'root';
$password = '';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}

// 2. Sorgu: Çalışanları Dnumber'a göre sıralı şekilde departmanla birlikte al
$sql = "
    SELECT e.fname, e.lname, e.age, e.address, e.sex, e.photo_path, d.Dname AS department, d.Dnumber
    FROM Employee e
    LEFT JOIN Department d ON e.Dnumber = d.Dnumber
    ORDER BY d.Dnumber ASC, e.fname, e.lname
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$staffMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 3. Departman numarasına göre grupla
$grouped = [];
foreach ($staffMembers as $staff) {
    $depKey = $staff['department'] ?? 'Bilinmiyor'; // sadece departman adı görünsün
    if (!isset($grouped[$depKey])) {
        $grouped[$depKey] = [];
    }
    $grouped[$depKey][] = $staff;
}


?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dino Hotel Staff</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0; padding: 0;
    }
    .navbar {
      background-color: #2c3e50;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      flex-wrap: wrap;
    }

    .navbar h1 {
      margin: 0;
      font-size: 24px;
    }

    .stars {
      color: gold;
      margin-left: 10px;
    }

    .navbar a {
      color: white;
      text-decoration: none;
      margin-left: 20px;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .navbar a:hover {
      color: #1abc9c;
    }
    .staff-section { padding: 20px; }
    .staff-card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    .staff-card {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      margin: 10px;
      width: 250px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: center;
    }
    .staff-card img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
    }
    .stars { color: gold; }
    h2 { text-align: center; margin-top: 40px; }
  </style>
</head>
<body>
  <nav class="navbar">
    <h1>Dino Hotel <span class="stars">★★★★★</span></h1>
    <div>
      <a href="main1.php">Home</a>
      <a href="rezervation.php">Reservation</a>
      <a href="staff.php">Hotel Staff</a>
      <a href="contact.php">Contact Us</a>
    </div>
  </nav>

  <section class="staff-section">
    <?php foreach ($grouped as $depKey => $members): ?>
      <h2><?= htmlspecialchars($depKey) ?></h2>
      <div class="staff-card-container">
        <?php foreach ($members as $staff): ?>
          <div class="staff-card">
            <?php
              $photo = $staff['photo_path'] ?? '';
              $imgSrc = ($photo && file_exists($photo)) ? htmlspecialchars($photo) : 'images/default.png';
            ?>
            <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($staff['fname'] . ' ' . $staff['lname']) ?>">
            <h4><?= htmlspecialchars($staff['fname'] . ' ' . $staff['lname']) ?> (<?= $staff['age'] ?>)</h4>
            <p>Adres: <?= htmlspecialchars($staff['address']) ?></p>
            <p>Cinsiyet:
              <?php if ($staff['sex'] === 'M'): ?>
                <i class="fas fa-mars" title="Erkek" style="color:blue;"></i>
              <?php elseif ($staff['sex'] === 'F'): ?>
                <i class="fas fa-venus" title="Kadın" style="color:hotpink;"></i>
              <?php else: ?>
                <i class="fas fa-genderless" title="Diğer"></i>
              <?php endif; ?>
            </p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  </section>
</body>
</html>
