<?php
// book_room.php

$host = 'localhost';
$db   = 'otel';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$room_no = $_GET['room_no'] ?? null;
$start   = $_GET['start'] ?? null;
$end     = $_GET['end'] ?? null;

if (!$room_no || !$start || !$end) {
    die("Eksik bilgi ile sayfa açıldı.");
}

// Oda fiyatı, tipi ve kat bilgisi
$room_sql = "SELECT rc.room_price, rc.Room_name, r.rooms_Floor 
             FROM Rooms r 
             JOIN Rooms_Category rc ON r.Room_Type_ID = rc.Type_ID 
             WHERE r.Room_No = ?";
$stmt = $conn->prepare($room_sql);

if (!$stmt) {
    die("Hazırlama hatası: " . $conn->error);
}

$stmt->bind_param("i", $room_no);
$stmt->execute();
$stmt->bind_result($price, $room_type, $floor);
$stmt->fetch();
$stmt->close();

$days = (strtotime($end) - strtotime($start)) / (60*60*24);
$total_price = $days * $price;
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Rezervasyon Yap - Dino Hotel</title>
  <style>
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
    .otelName  {
        color: white;
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
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
   margin: 0;
  background: #f0f2f5;
  color: #2c3e50;
  
}

h1, h2 {
  margin: 20px 0 10px;
  text-align: center;
}

.section {
  background: rgba(163, 163, 163, 0.62);
  margin: 30px auto;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
  max-width: 600px;
  
}

label {
  display: block;
  margin: 15px 0 5px;
  font-weight: 600;
}

input, select {
  width: 570px;
  padding: 12px 14px;
  margin-bottom: 12px;
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 14px;
  transition: border 0.3s ease;
}

input:focus, select:focus {
  border-color: #1abc9c;
  outline: none;
  box-shadow: 0 0 0 2px rgba(26, 188, 156, 0.2);
}

.btn {
  background: #1abc9c;
  color: white;
  padding: 14px;
  border: none;
  cursor: pointer;
  border-radius: 8px;
  width: 200px;
  font-size: 16px;
  transition: background 0.3s ease;
  display: block;
  margin: 20px auto 0 auto; /* Ortalamak için */
}


.popup {
  display: none;
  position: fixed;
  top: 20%;
  left: 50%;
  transform: translate(-50%, -20%);
  background: white;
  padding: 30px;
  border: 2px solid #1abc9c;
  border-radius: 12px;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
  z-index: 9999;
  max-width: 500px;
  text-align: center;
}

.popup button {
  margin-top: 20px;
  background: #2c3e50;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.popup button:hover {
  background: #1abc9c;
}

  </style>
</head>
<body>
    <nav class="navbar">
    <h1 class="otelName">Dino Hotel <span class="stars">★★★★★</span></h1>
    <div>
      <a href="main1.php">Home</a>
      <a href="rezervation.php">Reservation</a>
      <a href="staff.php">Hotel Staff</a>
      <a href="contact.php">Contact Us</a>
    </div>
  </nav>

<h1>Oda No: <?php echo $room_no; ?> | Toplam Fiyat: $<?php echo $total_price; ?></h1>

<form method="post">
  <div class="section">
    <h2>Müşteri Bilgileri</h2>
    <label>Ad</label>
    <input type="text" name="first_name" required>
    <label>Soyad</label>
    <input type="text" name="last_name" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Cinsiyet</label>
    <select name="gender">
      <option value="M">Erkek</option>
      <option value="F">Kadın</option>
    </select>
    <label>Telefon</label>
    <input type="text" name="phone_number" required>
    <label>Doğum Tarihi</label>
    <input type="date" name="dob" required>
  </div>

  <div class="section">
    <h2>Ödeme Detayları</h2>
    <label>Ödeme Yöntemi</label>
    <select name="payment_method" id="payment_method" onchange="toggleCard(this.value)" required>
      <option value="Cash">Nakit</option>
      <option value="Card">Banka Kartı</option>
    </select>
    <div id="card_info" style="display:none;">
      <label>Kart Üzerindeki İsim</label>
      <input type="text" name="card_name">
      <label>Kart Numarası</label>
      <input type="text" name="card_number">
      <label>Son Kullanma Tarihi</label>
      <input type="month" name="expire_date">
      <label>CVV</label>
      <input type="text" name="cvv">
    </div>
  </div>
  <input type="submit" class="btn" name="submit" value="Ödeme Yap">
</form>

<div class="popup" id="popup"></div>

<script>
function toggleCard(value) {
  document.getElementById("card_info").style.display = value === "Card" ? "block" : "none";
}

document.querySelector("form").addEventListener("submit", function(e) {
  const dob = new Date(document.querySelector("input[name='dob']").value);
  const today = new Date();
  const age = today.getFullYear() - dob.getFullYear();
  const m = today.getMonth() - dob.getMonth();
  const d = today.getDate() - dob.getDate();

  if (age < 18 || (age === 18 && (m < 0 || (m === 0 && d < 0)))) {
    e.preventDefault();
    alert("18 yaşından büyük olmanız gerekmektedir.");
  }
});
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $conn->begin_transaction();
  try {
    // Müşteri kaydı
    $stmt = $conn->prepare("INSERT INTO CUSTOMER (DOB, Email, First_Name, Last_Name, Gender) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $_POST['dob'], $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['gender']);
    $stmt->execute();
    $customer_id = $stmt->insert_id;
    $stmt->close();

    // Telefon
    $stmt = $conn->prepare("INSERT INTO Phone_Number (Customer_ID, Phone_number) VALUES (?, ?)");
    $stmt->bind_param("is", $customer_id, $_POST['phone_number']);
    $stmt->execute();
    $stmt->close();

    // Rezervasyon
    $stmt = $conn->prepare("INSERT INTO RESERVATION (Customer_ID, Start_date, End_date, Room_No) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $customer_id, $start, $end, $room_no);
    $stmt->execute();
    $reservation_id = $stmt->insert_id;
    $stmt->close();

    // Ödeme
    $payment_date = date('Y-m-d');
    $stmt = $conn->prepare("INSERT INTO PAYMENT (Customer_ID, Reservation_ID, Total_Price, Payment_Date, Payment_Method) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiss", $customer_id, $reservation_id, $total_price, $payment_date, $_POST['payment_method']);
    $stmt->execute();
    $stmt->close();

    $conn->commit();

    // Popup göster
    echo "<script>
      const popup = document.getElementById('popup');
      popup.innerHTML = `<h2>Ödeme Başarılı!</h2>
        <p>Rezerve edilen oda: $room_no | $room_type | Kat $floor</p>
        <p>Giriş Tarihi: $start</p>
        <p>Çıkış Tarihi: $end</p>
        <p>Toplam Ücret: $$total_price</p>
        <button onclick='window.location.href=\"main1.php\"'>Ana Sayfaya Dön</button>`;
      popup.style.display = 'block';
    </script>";
  } catch (Exception $e) {
    $conn->rollback();
    echo "<p style='color:red;'>Hata oluştu: " . $e->getMessage() . "</p>";
  }
}
$conn->close();
?>

</body>
</html>
