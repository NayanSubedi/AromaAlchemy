-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 09:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aromaalchemy`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'Men'),
(2, 'Women'),
(3, 'Unisex');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `ImageID` int(11) NOT NULL,
  `ImageTitle` varchar(255) NOT NULL,
  `ImagePath` varchar(255) NOT NULL,
  `ProductID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`ImageID`, `ImageTitle`, `ImagePath`, `ProductID`) VALUES
(1, 'Vercase Eros Eau De Toilette 100 ml', '..\\assets\\Veedp100ml.png\r\n', 2),
(2, 'Creed Aventus Parfum Eau De Parfum 100ml', '..\\assets\\Aventus.png\r\n', 3),
(3, 'Spicebomb Extreme Eau de Toilette', '..\\assets\\spicebomb.png', 4),
(5, 'Dior 60ml', '..\\assets\\DiorE60ml.png', 26),
(7, 'Yves Saint Lauren Libre Le Perfume', '..\\assets\\YSLF.png', 28),
(8, 'SWY', '..\\assets\\SWY.png', 29),
(9, 'BORN IN ROMA GREEN STRAVAGANZA', '..\\assets\\Valentino.png', 30),
(10, 'Jazz Club Eau de Toilette', '..\\assets\\replica.png', 31),
(11, 'Marly', '..\\assets\\Marly.png', 32),
(12, 'Herod', '..\\assets\\Herod.png', 33),
(13, 'Mancera', '..\\assets\\Redtobacoo.png', 34),
(14, 'N5', '..\\assets\\chanel.png', 35),
(15, 'yslyedp', '..\\assets\\ysledp.png', 36),
(16, 'Dolce&Gabbana', '..\\assets\\dg.png', 37),
(17, 'valentinow', '..\\assets\\valentinow.png', 38);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `TotalAmount` decimal(10,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PaymentStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `ProductID`, `OrderDate`, `TotalAmount`, `Quantity`, `PaymentStatus`) VALUES
(10, 28, 3, '2024-03-04 05:11:20', 350.00, 1, 'Success'),
(11, 28, 2, '2024-03-04 05:11:20', 100.00, 1, 'Success'),
(12, 30, 3, '2024-03-04 07:31:17', 350.00, 1, 'Success'),
(13, 32, 2, '2024-03-04 12:21:42', 600.00, 6, 'Success'),
(14, 34, 4, '2024-03-04 12:30:20', 125.00, 1, 'Success'),
(15, 35, 4, '2024-03-04 12:33:08', 125.00, 1, 'Success'),
(16, 36, 32, '2024-03-04 12:38:55', 265.00, 1, 'Success'),
(17, 37, 2, '2024-03-04 14:56:44', 100.00, 1, 'Success'),
(18, 37, 3, '2024-03-04 14:56:44', 350.00, 1, 'Success'),
(19, 38, 30, '2024-03-04 14:59:40', 180.00, 1, 'Success');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PaymentDate` date NOT NULL,
  `PaymentAmount` decimal(10,2) NOT NULL,
  `PaymentMethod` varchar(50) NOT NULL,
  `CardNumber` varchar(255) NOT NULL,
  `Cvc` varchar(255) NOT NULL,
  `ExpiryDate` varchar(7) DEFAULT NULL,
  `NameOnCard` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `OrderID`, `UserID`, `PaymentDate`, `PaymentAmount`, `PaymentMethod`, `CardNumber`, `Cvc`, `ExpiryDate`, `NameOnCard`) VALUES
(16, 17, 37, '2024-03-04', 100.00, 'Visa', '65958959', '256', '', 'Nayan Subedi'),
(17, 18, 37, '2024-03-04', 350.00, 'Visa', '65958959', '256', '', 'Nayan Subedi');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Brand` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Name`, `Brand`, `Description`, `Price`, `Quantity`, `CategoryID`) VALUES
(2, 'Vercase Eros Eau De Toilette 100 ml', 'Versace ', 'Masculine and confident, the Eros Eau de Toilette is a sensual scent that fuses woody, oriental and fresh notes, creating a powerful perfume that evokes Eros the god of love. \"I envisioned an heroic, passionate man, almost a Greek God. The fragrance is made up of notes that express sensuality and power, an extreme force,\" says Donatella Versace.', 100, 10, 1),
(3, 'Creed Aventus Parfum Eau De Parfum 100ml', 'Creed Fragrance', 'Aventus Cologne is a citrus fruity scent with uplifting head notes of ginger, pink peppercorn and mandarin. Perfectly complemented with hearty notes of patchouli, vetiver and pineapple, the dry and woody base of birch, musk and styrax provide the final touch to this exquisite scent. Sophisticated and iconic, Aventus Cologne is a fragrance of true distinction.', 350, 11, 1),
(4, 'Spicebomb Extreme Eau de Toilette 100ml', 'Viktor & Rolf', 'Spicebomb was launched by the Viktor & Rolf design label in 2012. The dynamite of a fragrance brings fiery scents like saffron and chilli with fresh energizing bergamot and grapefruit, alongside a more woody leather and tobacco scent. Suited for anytime of the day, whether you want to stay alert at work or bring your dynamic personality to the party!', 125, 9, 1),
(26, 'Dior Sauvage Elixir Eau de Toilette 60ml', 'Christian Dior', 'Sauvage Elixir is an extraordinarily* concentrated fragrance steeped in the emblematic freshness of Sauvage with an intoxicating heart of Spices, a \"tailor-made\" Lavender essence and a blend of rich Woods forming the signature of its powerful, lavish and captivating trail.', 250, 12, 1),
(28, 'Yves Saint Lauren Libre Le Parfum 90ML', 'Yves Saint Lauren', 'Libre Le Parfum is a luxurious warm and spicy interpretation on the classic Eau de Parfum with an endless floral trail. Our most intense and long-lasting floral perfume for women enriched with fresh lavender, sensual orange blossom and rare warm saffron accord from the YSL Beauty Ourika Community Garden. The saffron accord is an olfactive tribute to the spicy ‘Fleurs de feu’ praised by Mr. Saint Laurent himself, creating an unapologetically sensual twist.', 195, 11, 2),
(29, 'Emporio Armani Stronger With You Giorgio Armani Eau De Parfum 90ML', 'Emporio Armani', 'Emporio Armani Stronger with You Intensely is an oriental-woody fragrance for men launched in 2019. It is described as a warm and inviting scent that tells the story of the excitement of a new and young love.\r\nThe top notes of Emporio Armani Stronger with You Intensely include pink pepper, juniper, and violet. The heart notes include toffee, cinnamon, lavender, and sage. The base notes include vanilla, tonka bean, amber, and suede.', 125, 8, 1),
(30, 'Valentino BORN IN ROMA GREEN STRAVAGANZA EAU DE TOILETTE 100ML', 'Valentino', 'BORN IN ROMA GREEN STRAVAGANZA takes you on a bold adventure to the cool gardens of Roma where you are free to live and express your unique ways. Dare to be excessively you in the bold & abundant city of Roma. Live the passion & the extravagance of the eternal city. Re-discover the cool gardens of Roma and feel the energy of our alter ego couple & their friends as they take you on a new journey that will make you stand out.', 180, 8, 1),
(31, 'REPLICA\' Jazz Club Eau de Toilette 100ML', 'Maison Margiela', 'The exhilarating and intimate ambiance of a confidential jazz club. Replica Jazz Club evokes the exhilarating atmosphere of a private club where the jazz music and scent of cocktails permeate late into the night.\r\n', 165, 5, 3),
(32, 'LAYTON EAU DE PARFUM 125ML', 'Parfums de Marly', 'Layton is a fragrance which captures the essence of the debonair. This floral and oriental fragrance with an intense olfactory signature opens with bergamot and its tangy passion, while lavender and geranium blend into a fresh note, chic and chivalrous all at once. The intensity of the eau de parfum is further amplified by amber, enhanced by the natural elegance of pink pepper.', 265, 11, 1),
(33, 'HEROD EAU DE PARFUM 125ML', 'Parfums de Marly', 'Herod is personified by its blend of diverse notes, exuding a smoky vanilla scent. This eau de parfum opens on spicy top notes of cinnamon and pepper to then show its powerful heart of tobacco leaf, incense, ciste and osmanthus. These peppery notes are further surrounded by vanilla pods, musk, patchouli and woody accord at the base. An elegant and discernible perfume, for both men and women, it is the epitome of old-world sophistication. ', 300, 15, 3),
(34, 'Red Tobacco Mancera for women and men', 'Mancera', 'Launched by the design house of Mancera in the year of 2017.This aromatic fougere fragrance has a blend of cinnamon, agarwood (oud), incense, saffron, nutmeg, green apple, white pear, patchouli, jasmine, tobacco, madagascar vanilla, amber, guaiac wood, sandalwood, white musk, and haitian vetiver.\r\n', 200, 15, 3),
(35, 'N05 Eau de Parfum Spray 100ML', 'Chanel', 'Since its creation in 1921, N°5 has exuded the very essence of femininity. The abstract, mysterious scent—alive with countless subtle facets—radiates an extravagant floral richness. In 1986, Jacques Polge reinterpreted his predecessor Ernest Beaux’s composition to create a fuller, more voluminous version of the now and forever fragrance: the Eau de Parfum.', 172, 6, 2),
(36, 'YSL Y Eau De Parfum 100ML', 'Yves Saint Lauren', 'The signature YSL Y cologne is a bold and woody men\'s fragrance, infused with sophisticated and revitalizing notes of sage and geranium and rounded out with a hint of sensual wood.', 155, 13, 1),
(37, 'Dolce&Gabbana Light Blue Pour Homme Eau de Toilette Spray 125ML', 'Dolce&Gabbana', 'The sensuality of sun-drenched skin, the bracing breeze of the Mediterranean Sea, the fruity and floral scents of the vegetation: Dolce&Gabbana Light Blue captures the quintessence of a summer day lulled by gentle waves lapping against the enchanting cliffs of Capri.', 100, 16, 1),
(38, 'Donna Born In Roma Eau de Parfum  100ML', 'Valentino', 'Valentino Donna Born In Roma Eau de Parfum is a modern haute couture floriental vanilla perfume. The perfume bottle is designed with the iconic Valentino stud, the signature of Valentino Couture, which is inspired by Roma architecture. Three qualities of jasmine bring a luxurious femininity that is blended with vanilla bourbon, the most expensive extract in the world. This is twisted with radiant trio of modern wood, giving an edgy touch reminiscent of Rome street culture.', 165, 16, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `RepeatPassword` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `usertype` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `Email`, `Username`, `Password`, `RepeatPassword`, `Address`, `Phone`, `usertype`) VALUES
(5, 'Nayan', 'nayansubedi08@gmail.com', 'nayan', '$2y$10$yh2FLIXXsk.FPACrg0VkdOS6GUGmJBAa3vGUpPExSkuHuZBg002PG', '', '', '', 'admin'),
(28, 'Nayan Subedi', 'nayansubedi365@gmail.com', '', '', '', 'Kathmandu', '9810125390', 'user'),
(30, '', '', '', '', '', '', '', 'user'),
(31, 'Nayan Subedi', 'nayansubedi22@gmail.com', 'nayan', '$2y$10$AzVqRWZ6tZykLP7ROynHhey0Y7B8cDPhiPF/hKg.Uxc6fgMntNk9K', '', '', '', 'user'),
(32, 'Nayan Subedi', 'nayansubedi456@gmail.com', '', '', '', 'Kathmandu, Nepal', '9810125390', 'user'),
(33, 'Nayan Subedi', 'nayansubedi456@gmail.com', '', '', '', 'Kathmandu, Nepal', '9810125390', 'user'),
(34, 'Nayan Subedi', 'nayansubedi4586@gmail.com', '', '', '', 'Kathmandu', '9810125390', 'user'),
(35, 'Nayan Subedi', 'nayansubedi3669@gmail.com', '', '', '', 'edfwgwerw', '9810125390', 'user'),
(36, 'Nayan Subedi', 'n@gmail.com', '', '', '', 'Kathmandu', '981369872', 'user'),
(37, 'Nayan Subedi', 'nayansubedi456@gmail.com', '', '', '', 'Kathmandu', '981369872', 'user'),
(38, 'Nayan Subedi', 'hczxxzc@example.com', '', '', '', 'bjsabnjdsa', '7884', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
