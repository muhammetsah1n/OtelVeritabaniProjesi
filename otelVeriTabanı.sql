-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 May 2025, 18:32:53
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `otel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` int(11) NOT NULL,
  `DOB` date DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `First_Name` varchar(30) DEFAULT NULL,
  `Last_Name` varchar(30) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `customer`
--

INSERT INTO `customer` (`Customer_ID`, `DOB`, `Email`, `First_Name`, `Last_Name`, `Gender`) VALUES
(1, '2025-02-24', 'muhammetsah1n.2105@gmail.com', 'Muhammet', 'Şahin', 'M'),
(2, '2025-05-29', 'yagmur@gmail.com', 'yagmur', 'kalyoncu', 'F'),
(3, '2025-05-11', 'sahnur@gmail.com', 'sahnur', 'cogur', 'M');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `department`
--

CREATE TABLE `department` (
  `Dnumber` int(11) NOT NULL,
  `Dname` varchar(30) DEFAULT NULL,
  `salary` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `department`
--

INSERT INTO `department` (`Dnumber`, `Dname`, `salary`) VALUES
(1, 'Manager', '7000$'),
(2, 'Receptionist', '4000$'),
(3, 'House Keeping', '2500$'),
(4, 'Kitchen Staff', '3000$'),
(5, 'Lige Guard', '3000$'),
(6, 'Valet', '2000$'),
(7, 'Security', '3750$');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `employee`
--

CREATE TABLE `employee` (
  `ssn` char(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `age` int(11) DEFAULT NULL CHECK (`age` > 0),
  `address` varchar(255) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL CHECK (`sex` in ('M','F')),
  `photo_path` varchar(255) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `Dnumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `employee`
--

INSERT INTO `employee` (`ssn`, `fname`, `lname`, `age`, `address`, `sex`, `photo_path`, `hotel_id`, `Dnumber`) VALUES
('123-45-6789', 'Dean', 'Winchester', 25, 'Ankara', 'M', 'images/DeanWinchester.jpg', 12345, 1),
('124-45-6789', 'Penolope', 'Garcia', 32, 'Ankara', 'F', 'images/PenolopeGarcia.jpg', 12345, 2),
('124-45-6791', 'Spencer', 'Reid', 27, 'Ankara', 'M', 'images/SpencerReid.jpeg', 12345, 2),
('124-45-6792', 'Lorelai', 'Gilmore', 32, 'Ankara', 'F', 'images/LorelaiGilmore.jpg', 12345, 2),
('124-45-6793', 'Rupert', 'Giles', 45, 'Ankara', 'M', 'images/RupertGiles.jpg', 12345, 2),
('125-45-6789', 'Ariana', 'Grande', 32, 'Ankara', 'F', 'images/ArianaGrande.jpg', 12345, 3),
('125-45-6791', 'Ana', 'Lukic', 69, 'Ankara', 'F', 'images/AnaLukic.jpg', 12345, 3),
('125-45-6792', 'Argus', 'Filch', 63, 'Ankara', 'M', 'images/ArgusFilch.jpg', 12345, 3),
('125-45-6793', 'Draco', 'Malfoy', 19, 'Ankara', 'M', 'images/DracoMalfoy.jpg', 12345, 3),
('126-45-6789', 'Carmen', 'Berzatto', 32, 'Ankara', 'M', 'images/CarmenBerzatto.jpg', 12345, 4),
('126-45-6791', 'Selena', 'Gomez', 34, 'Ankara', 'F', 'images/SelenaGomez.jpg', 12345, 4),
('126-45-6792', 'Kendall', 'Jenner', 26, 'Ankara', 'F', 'images/KendallJenner.jpg', 12345, 4),
('126-45-6793', 'Hannibal', 'Lecter', 57, 'Ankara', 'M', 'images/HannibalLecter.jpg', 12345, 4),
('127-45-6789', 'Damon', 'Salvatore', 28, 'Ankara', 'M', 'images/DamonSalvatore.jpg', 12345, 5),
('127-45-6791', 'Stefan', 'Salvatore', 34, 'Ankara', 'M', 'images/StefanSalvatore.webp', 12345, 5),
('127-45-6792', 'Dwayne', 'Jhonson', 57, 'Ankara', 'M', 'images/DwayneJhonson.jpg', 12345, 5),
('127-45-6793', 'Clayton', 'Danvers', 29, 'Ankara', 'M', 'images/ClaytonDanvers.jpg', 12345, 5),
('128-45-6789', 'Barry', 'Sloane', 38, 'Ankara', 'M', 'images/BarrySloane.jpg', 12345, 6),
('128-45-6791', 'Nicki', 'Minaj', 34, 'Ankara', 'F', 'images/NickiMinaj.jpg', 12345, 6),
('128-45-6792', 'Jisoo', 'Kim', 29, 'SouthKorea', 'F', 'images/Jisoo.jpg', 12345, 6),
('128-45-6793', 'Jennie', 'Kim', 30, 'NorthKorea', 'F', 'images/Jennie.jpg', 12345, 6),
('129-45-6789', 'Klaus', 'Mikaelson', 30, 'Ankara', 'M', 'images/KlausMikaelson.webp', 12345, 7),
('129-45-6791', 'Buffy', 'Summers', 18, 'Ankara', 'F', 'images/BuffySummers.png', 12345, 7),
('129-45-6792', 'Spike', 'Pratt', 32, 'Ankara', 'M', 'images/Spike.webp', 12345, 7),
('129-45-6793', 'Tom', 'Hardy', 46, 'Ankara', 'M', 'images/TomHardy.jpg', 12345, 7);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hotel`
--

CREATE TABLE `hotel` (
  `HOTEL_ID` int(11) NOT NULL,
  `Hotel_Name` varchar(50) DEFAULT NULL,
  `Location` varchar(200) DEFAULT NULL,
  `Star_Number` int(11) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Phone_Number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hotel`
--

INSERT INTO `hotel` (`HOTEL_ID`, `Hotel_Name`, `Location`, `Star_Number`, `Email`, `Phone_Number`) VALUES
(12345, 'Dino Hotel', 'Alifakovac 18, 71000 Sarajevo, Bosnia & Herzegovina', 5, 'info@dinohotel.com', '+387 61 000 000');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `payment`
--

CREATE TABLE `payment` (
  `Payment_No` int(11) NOT NULL,
  `Customer_ID` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `Total_Price` int(11) DEFAULT NULL,
  `Payment_Date` date DEFAULT NULL,
  `Payment_Method` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `payment`
--

INSERT INTO `payment` (`Payment_No`, `Customer_ID`, `reservation_id`, `Total_Price`, `Payment_Date`, `Payment_Method`) VALUES
(1, 1, 1, 200, '2025-05-24', 'Cash'),
(2, 2, 2, 150, '2025-05-24', 'Cash'),
(3, 3, 3, 150, '2025-05-24', 'Card');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phone_number`
--

CREATE TABLE `phone_number` (
  `Customer_ID` int(11) NOT NULL,
  `Phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `phone_number`
--

INSERT INTO `phone_number` (`Customer_ID`, `Phone_number`) VALUES
(1, '123445'),
(2, '123445'),
(3, '5433');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reservation`
--

CREATE TABLE `reservation` (
  `Reservation_ID` int(11) NOT NULL,
  `Customer_ID` int(11) DEFAULT NULL,
  `Start_date` date DEFAULT NULL,
  `End_date` date DEFAULT NULL,
  `Room_No` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `reservation`
--

INSERT INTO `reservation` (`Reservation_ID`, `Customer_ID`, `Start_date`, `End_date`, `Room_No`) VALUES
(1, 1, '2025-05-02', '2025-05-03', 402),
(2, 2, '2025-05-02', '2025-05-03', 302),
(3, 3, '2025-05-02', '2025-05-03', 302);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rooms`
--

CREATE TABLE `rooms` (
  `Room_No` int(11) NOT NULL,
  `Rooms_Status` varchar(20) DEFAULT NULL,
  `Rooms_floor` int(11) DEFAULT NULL,
  `Room_Type_ID` int(11) DEFAULT NULL,
  `HOTEL_ID` int(11) DEFAULT NULL,
  `photo_path1` varchar(255) DEFAULT NULL,
  `photo_path2` varchar(255) DEFAULT NULL,
  `photo_path3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `rooms`
--

INSERT INTO `rooms` (`Room_No`, `Rooms_Status`, `Rooms_floor`, `Room_Type_ID`, `HOTEL_ID`, `photo_path1`, `photo_path2`, `photo_path3`) VALUES
(101, '0', 1, 1, 12345, 'images/otelOdaları/101/1.jpg', 'images/otelOdaları/101/2.jpg', 'images/otelOdaları/101/3.jpg'),
(102, '0', 1, 1, 12345, 'images/otelOdaları/102/1.jpg', 'images/otelOdaları/102/2.jpg', 'images/otelOdaları/102/3.jpg'),
(201, '0', 2, 2, 12345, 'images/otelOdaları/201/1.jpg', 'images/otelOdaları/201/2.jpg', 'images/otelOdaları/201/3.jpg'),
(202, '0', 2, 2, 12345, 'images/otelOdaları/202/1.jpg', 'images/otelOdaları/202/2.jpg', 'images/otelOdaları/202/3.jpg'),
(301, '0', 3, 3, 12345, 'images/otelOdaları/301/1.jpg', 'images/otelOdaları/301/2.jpg', 'images/otelOdaları/301/3.jpg'),
(302, '0', 3, 3, 12345, 'images/otelOdaları/302/1.jpg', 'images/otelOdaları/302/2.jpg', 'images/otelOdaları/302/3.jpg'),
(401, '0', 4, 4, 12345, 'images/otelOdaları/401/1.jpg', 'images/otelOdaları/401/2.jpg', 'images/otelOdaları/401/3.jpg'),
(402, '0', 4, 4, 12345, 'images/otelOdaları/402/1.jpg', 'images/otelOdaları/402/2.jpg', 'images/otelOdaları/402/3.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rooms_category`
--

CREATE TABLE `rooms_category` (
  `Type_ID` int(11) NOT NULL,
  `Room_Name` varchar(30) DEFAULT NULL,
  `Max_Guest` int(11) DEFAULT NULL,
  `room_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `rooms_category`
--

INSERT INTO `rooms_category` (`Type_ID`, `Room_Name`, `Max_Guest`, `room_price`) VALUES
(1, 'Single Room', 1, 80),
(2, 'Double Room', 2, 120),
(3, 'Triple Room', 3, 150),
(4, 'Family Room', 4, 200);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Tablo için indeksler `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Dnumber`);

--
-- Tablo için indeksler `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ssn`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `Dnumber` (`Dnumber`);

--
-- Tablo için indeksler `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`HOTEL_ID`);

--
-- Tablo için indeksler `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_No`),
  ADD KEY `Customer_ID` (`Customer_ID`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Tablo için indeksler `phone_number`
--
ALTER TABLE `phone_number`
  ADD PRIMARY KEY (`Customer_ID`,`Phone_number`);

--
-- Tablo için indeksler `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Reservation_ID`),
  ADD KEY `Room_No` (`Room_No`),
  ADD KEY `Customer_ID` (`Customer_ID`);

--
-- Tablo için indeksler `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`Room_No`),
  ADD KEY `HOTEL_ID` (`HOTEL_ID`),
  ADD KEY `Room_Type_ID` (`Room_Type_ID`);

--
-- Tablo için indeksler `rooms_category`
--
ALTER TABLE `rooms_category`
  ADD PRIMARY KEY (`Type_ID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Reservation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`HOTEL_ID`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`Dnumber`) REFERENCES `department` (`Dnumber`);

--
-- Tablo kısıtlamaları `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`Reservation_ID`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `phone_number`
--
ALTER TABLE `phone_number`
  ADD CONSTRAINT `phone_number_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`Room_No`) REFERENCES `rooms` (`Room_No`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`HOTEL_ID`) REFERENCES `hotel` (`HOTEL_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`Room_Type_ID`) REFERENCES `rooms_category` (`Type_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
