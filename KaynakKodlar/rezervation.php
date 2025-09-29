<?php
// Veritabanı bağlantısı
$host = 'localhost';
$db = 'otel';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Oda kategorilerini ve ilgili odaları çek
$sql = "SELECT rc.Type_ID, rc.Room_Name, rc.Max_Guest, rc.Room_Price,
               r.Room_No, r.Rooms_Status, r.Rooms_floor,
               r.photo_path1, r.photo_path2, r.photo_path3
        FROM Rooms_Category rc
        LEFT JOIN Rooms r ON rc.Type_ID = r.Room_Type_ID
        ORDER BY rc.Type_ID, r.Room_No";

$result = $conn->query($sql);

$rooms_by_category = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $type_id = $row['Type_ID'];
        if (!isset($rooms_by_category[$type_id])) {
            $rooms_by_category[$type_id] = [
                'Room_Name' => $row['Room_Name'],
                'Room_Price' => $row['Room_Price'],
                'Max_Guest' => $row['Max_Guest'],
                'Rooms' => []
            ];
        }
        if (!is_null($row['Room_No'])) {
            $rooms_by_category[$type_id]['Rooms'][] = $row;
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Room Categories - Dino Hotel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      background-color: #f5f5f5;
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
      display: flex;
      padding: 30px;
    }
    .sidebar {
      flex: 0 0 200px;
      position: sticky;
      top: 90px;
      align-self: flex-start;
      height: fit-content;
    }
    .sidebar h2 {
      font-size: 18px;
      margin-bottom: 10px;
    }
    .sidebar button {
      display: block;
      width: 100%;
      margin: 10px 0;
      padding: 10px;
      border-radius: 5px;
      font-weight: bold;
      background-color: #2c3e50;
      color: white;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .sidebar button:hover {
      background-color: #1abc9c;
    }
    .date-picker label {
      font-weight: bold;
      display: block;
      margin-top: 20px;
    }
    .date-picker input[type="date"], .date-picker button {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-weight: bold;
    }
    .date-picker button {
      background-color: #2c3e50;
      color: white;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 15px;
    }
    .date-picker button:hover {
      background-color: #1abc9c;
    }
    .content {
      flex: 1;
      padding-left: 30px;
    }
    .room-section {
      margin-bottom: 50px;
    }
    .room-section h3 {
      font-size: 22px;
      margin-bottom: 15px;
    }
    .room-info {
      display: flex;
      align-items: flex-start;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    .room-details {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .room-details span {
      font-size: 16px;
    }
    .photo-slider {
      display: flex;
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      gap: 10px;
      max-width: 220px;
      margin-right: 20px;
    }
    .photo-slider img {
      width: 200px;
      height: auto;
      border-radius: 10px;
      flex-shrink: 0;
      scroll-snap-align: start;
    }
  </style>
  <script>
    function scrollToSection(id) {
      document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
    }
    function updateEndDateMin() {
      const startDate = document.getElementById('start-date').value;
      document.getElementById('end-date').min = startDate;
    }
  </script>
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
    <aside class="sidebar">
      <h2>Room Categories</h2>
      <?php foreach ($rooms_by_category as $type_id => $category): ?>
        <button onclick="scrollToSection('category-<?php echo $type_id; ?>')"><?php echo htmlspecialchars($category['Room_Name']); ?></button>
      <?php endforeach; ?>

      <div class="date-picker">
        <form action="available_rooms.php" method="get" id="availability-form">
          <label for="start-date">Start Date:</label>
          <input type="date" id="start-date" name="start" required onchange="updateEndDateMin()">

          <label for="end-date">End Date:</label>
          <input type="date" id="end-date" name="end" required>

          <button type="submit">Check Availability</button>
        </form>
      </div>
    </aside>

    <main class="content">
      <?php foreach ($rooms_by_category as $type_id => $category): ?>
        <section id="category-<?php echo $type_id; ?>" class="room-section">
          <h3><?php echo htmlspecialchars($category['Room_Name']); ?></h3>
          <?php if (!empty($category['Rooms'])): ?>
            <?php foreach ($category['Rooms'] as $room): ?>
              <div class="room-info">
                <div class="photo-slider">
                  <?php for ($i = 1; $i <= 3; $i++):
                    $photo = $room["photo_path$i"] ?? null;
                    if (!empty($photo)): ?>
                      <img src="<?php echo htmlspecialchars($photo); ?>" alt="Room Photo <?php echo $i; ?>">
                  <?php endif; endfor; ?>
                </div>
                <div class="room-details">
                  <span><strong>Room No:</strong> <?php echo $room['Room_No']; ?></span>
                  <span><strong>Status:</strong> <?php echo $room['Rooms_Status']; ?></span>
                  <span><strong>Floor:</strong> <?php echo $room['Rooms_floor']; ?></span>
                  <span><strong>Max Guest:</strong> <?php echo $category['Max_Guest']; ?></span>
                  <span><strong>Price:</strong> $<?php echo $category['Room_Price']; ?> / night</span>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No rooms currently available in this category.</p>
          <?php endif; ?>
        </section>
      <?php endforeach; ?>
    </main>
  </div>
</body>
</html>
