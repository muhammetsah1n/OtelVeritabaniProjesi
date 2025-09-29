<?php
// available_rooms.php

$host = 'localhost';
$db   = 'otel';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$start = $_GET['start'] ?? null;
$end   = $_GET['end']   ?? null;
if (!$start || !$end) {
    die("Lütfen başlangıç ve bitiş tarihlerini girin.");
}

$sql = "
SELECT r.Room_No, rc.Room_Name, r.Rooms_floor, rc.Room_Price,
       r.photo_path1, r.photo_path2, r.photo_path3
FROM Rooms r
JOIN Rooms_Category rc ON r.Room_Type_ID = rc.Type_ID
WHERE r.Room_No NOT IN (
    SELECT Room_No
    FROM reservation
    WHERE NOT (End_Date < ? OR Start_Date > ?)
)
ORDER BY rc.Type_ID, r.Room_No
";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ss", $start, $end);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Uygun Odalar - Dino Hotel</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      background-color: #f5f5f5;
      color: #2c3e50;
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
    .container {
      max-width: 1100px;
      margin: 30px auto;
      padding: 0 15px;
    }
    h1.page-title {
      margin-bottom: 25px;
      font-weight: 700;
      font-size: 28px;
    }
    .room {
      background: #fff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
      display: flex;
      gap: 20px;
      align-items: center;
      flex-wrap: wrap;
    }
    .photo-slider {
      display: flex;
      gap: 15px;
      overflow-x: auto;
      max-width: 360px;
      flex-shrink: 0;
      scroll-snap-type: x mandatory;
    }
    .photo-slider img {
      width: 140px;
      height: 90px;
      border-radius: 8px;
      object-fit: cover;
      flex-shrink: 0;
      scroll-snap-align: start;
      box-shadow: 0 1px 3px rgba(0,0,0,0.2);
      cursor: pointer;
      transition: transform 0.3s ease;
    }
    .photo-slider img:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 10px rgba(0,0,0,0.4);
    }
    .room-info {
      flex: 1;
      min-width: 250px;
    }
    .room-info strong {
      color: #34495e;
    }
    .room-info span {
      display: block;
      margin: 6px 0;
      font-weight: 600;
    }
    .btn {
      display: inline-block;
      padding: 12px 20px;
      background: #2c3e50;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 600;
      margin-top: 10px;
      transition: background-color 0.3s ease;
      white-space: nowrap;
    }
    .btn:hover {
      background: #1abc9c;
    }
    p.no-rooms {
      font-size: 18px;
      font-weight: 600;
      color: #e74c3c;
    }
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

  <div class="container">
    <h1 class="page-title">Uygun Odalar (<?php echo htmlspecialchars($start); ?> – <?php echo htmlspecialchars($end); ?>)</h1>

    <?php if ($result->num_rows === 0): ?>
      <p class="no-rooms">Seçilen tarihlerde uygun oda bulunamadı.</p>
    <?php else: ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="room">
          <div class="photo-slider">
            <?php 
            for ($i = 1; $i <= 3; $i++):
              $photo = $row["photo_path$i"] ?? null;
              if (!empty($photo)): ?>
                <img src="<?php echo htmlspecialchars($photo); ?>" alt="Oda Fotoğrafı <?php echo $i; ?>">
            <?php endif; endfor; ?>
          </div>

          <div class="room-info">
            <strong>Oda No:</strong> <?php echo $row['Room_No']; ?><br>
            <span><strong>Kategori:</strong> <?php echo htmlspecialchars($row['Room_Name']); ?></span>
            <span><strong>Kat:</strong> <?php echo $row['Rooms_floor']; ?></span>
            <span><strong>Fiyat:</strong> $<?php echo $row['Room_Price']; ?> / gece</span>
            <a class="btn" 
   href="book_room.php?room_no=<?php echo $row['Room_No']; ?>
   &start=<?php echo urlencode($start); ?>
   &end=<?php echo urlencode($end); ?>
   &price=<?php echo $row['Room_Price']; ?>">
  Rezerve Et
</a>

          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
