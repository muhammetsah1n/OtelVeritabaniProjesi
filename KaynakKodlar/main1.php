<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dino Hotel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      background-color: #f5f5f5;
      color: #333;
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

    .hotel-header {
      text-align: center;
      background-color: white;
      padding: 20px;
    }

    .location {
      font-size: 16px;
      color: #555;
      margin-bottom: 10px;
    }

    .location i {
      margin-right: 8px;
      color: #e74c3c;
    }

    .hotel-header img {
      width: 50%;
      max-width: 500px;
      border-radius: 10px;
      margin-top: 15px;
    }

    .features {
      background-color: #fff;
      padding: 30px 20px;
      text-align: center;
    }

    .features h2 {
      margin-bottom: 20px;
    }

    .features ul {
      list-style: none;
      padding: 0;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 15px;
    }

    .features li {
      background-color: #ecf0f1;
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 16px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .contact-section {
      background-color: #f9f9f9;
      padding: 40px 20px;
    }

    .contact-wrapper {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      flex-wrap: wrap;
      gap: 30px;
    }

    .left-contact {
      flex: 1;
      min-width: 300px;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .right-contact {
      flex: 1;
      min-width: 300px;
    }

    .left-contact h2 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #2c3e50;
    }

    .left-contact .stars {
      color: gold;
      font-size: 18px;
      margin-left: 10px;
    }

    .left-contact p {
      font-size: 16px;
      margin: 15px 0;
    }

    .left-contact i {
      margin-right: 10px;
      color: #3498db;
    }

    .left-contact a {
      text-decoration: none;
      color: #2c3e50;
      font-weight: bold;
    }

    .left-contact a:hover {
      color: #1abc9c;
    }

    .map-embed {
      width: 100%;
      height: 300px;
      border: 0;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar">
    <h1>Dino Hotel <span class="stars">★★★★★</span></h1>
    <div>
      <a href="main1.php">Home</a>
      <a href="rezervation.php">Reservation</a>
      <a href="staff.php">Hotel Staff</a>
      <a href="contact.php">Contact Us</a>
    </div>
  </nav>

  <!-- Hotel Header -->
  <section class="hotel-header">
    <div class="location">
      <i class="fas fa-map-marker-alt"></i>
      Alifakovac 18, 71000 Sarajevo, Bosnia & Herzegovina
    </div>
    <img src="images/images.jpeg" alt="Hotel Image">
  </section>

  <!-- Features -->
  <section class="features">
    <h2>Hotel Features</h2>
    <ul>
      <li>Free Parking</li>
      <li>Free Wi-Fi</li>
      <li>Pet Friendly</li>
      <li>Private Bathroom</li>
      <li>Scenic View</li>
      <li>Kitchen</li>
      <li>Shower</li>
      <li>Flat-Screen TV</li>
      <li>Cable Channels</li>
    </ul>
  </section>

  <!-- Contact Us -->
  <section id="contact" class="contact-section">
    <div class="contact-wrapper">

      <!-- Left: Contact Info -->
      <div class="left-contact">
        <h2>Dino Hotel <span class="stars">★★★★★</span></h2>
        <p><i class="fas fa-envelope"></i>
          <a href="mailto:info@dinohotel.com">info@dinohotel.com</a>
        </p>
        <p><i class="fas fa-phone"></i>
          <a href="tel:+38761000000">+387 61 000 000</a>
        </p>
        <p><i class="fas fa-map-marker-alt"></i>
          <a href="https://www.google.com/maps?q=Alifakovac+18,+Sarajevo" target="_blank">
            Alifakovac 18, 71000 Sarajevo, Bosnia & Herzegovina
          </a>
        </p>
      </div>

      <!-- Right: Interactive Map -->
      <div class="right-contact">
        <iframe
          class="map-embed"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2870.1705243139007!2d18.43122531550854!3d43.860383479115876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4758c91f0dff3a7f%3A0x7d7b01fc362a4b4a!2sAlifakovac%2018%2C%20Sarajevo%2071000%2C%20Bosnia%20and%20Herzegovina!5e0!3m2!1sen!2sba!4v1685794699227!5m2!1sen!2sba"
          allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>

    </div>
  </section>

</body>
</html>