-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2025 at 04:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `bio`
--
DROP DATABASE projet;
CREATE DATABASE projet;
USE projet;
CREATE TABLE `bio` (
                       `id` int(11) NOT NULL,
                       `name` varchar(50) NOT NULL,
                       `description` varchar(255) NOT NULL,
                       `prix` float NOT NULL,
                       `photo` varchar(255) NOT NULL,
                       `promotion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bio`
--

INSERT INTO `bio` (`id`, `name`, `description`, `prix`, `photo`, `promotion`) VALUES
                                                                                  (1, 'Alverde – Crème Nettoyante Clear Bio, 100 ml', 'La douce Crème Nettoyante Clear d’Alverde aide à o', 8.99, 'https://german-beautyshop.com/wp-content/uploads/2020/09/Design-ohne-Titel469.jpg', '-30%'),
                                                                                  (2, 'Alverde – Eau Florale Bio Rose, 100 ml', 'L’eau florale à la Rose de Damas Bio, de chez Alve', 8.99, 'https://german-beautyshop.com/wp-content/uploads/2020/09/Design-ohne-Titel253.jpg', '-30%'),
                                                                                  (3, 'Alverde – Pack Nutri Care Bio Pour Cheveux Secs Et', 'Le Pack Alverde Nutri-Care Bio à base d’Amande et ', 29.99, 'https://german-beautyshop.com/wp-content/uploads/2021/08/Alverde-Maroc-9.jpg', ''),
                                                                                  (4, 'Alverde – Pack Repair Bio Pour Cheveux Abîmés Et C', 'Le Pack Alverde Repair Bio à l’huile d’avocat biol', 29.99, 'https://german-beautyshop.com/wp-content/uploads/2021/08/Alverde-Maroc-5.jpg', ''),
                                                                                  (5, 'ORS – Hair Mayonnaise, Traitement Capillaire, 454g', 'La Hair Mayonnaise de ORS, Organic Root Stimulator', 17.99, 'https://german-beautyshop.com/wp-content/uploads/2020/02/Design-ohne-Titel-2020-02-25T120958.350.jpg', ''),
                                                                                  (6, 'Alverde – Beurre Capillaire Réparateur Bio, 200 ml', ' Le beurre capillaire réparateur bio de chez Alver', 79.99, 'https://german-beautyshop.com/wp-content/uploads/2020/02/Alverde-Maroc-2.jpg', ''),
                                                                                  (7, 'Alverde – Lotion Corporelle Q10 Bio, 250 ml', ' Cette Lotion Corporelle Q10 Bio donne à la peau u', 9000000000, 'https://german-beautyshop.com/wp-content/uploads/2020/08/Design-ohne-Titel161.jpg', ''),
                                                                                  (8, 'Dm Bio – Huile de Coco Bio, 300 ml', 'Véritable concentré d’acide gras saturés, l’huile ', 9.99, 'https://german-beautyshop.com/wp-content/uploads/2020/05/huile-de-coco-bio-maroc.jpg\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
                         `id` int(11) NOT NULL,
                         `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`) VALUES
                                          (15, 8),
                                          (16, 11);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
                              `id` int(11) NOT NULL,
                              `cart_id` int(11) NOT NULL,
                              `product_id` int(11) NOT NULL,
                              `quantity` int(11) NOT NULL,
                              `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `category`) VALUES
                                                                                     (32, 15, 4, 12, 'serums'),
                                                                                     (38, 16, 4, 1, 'serums'),
                                                                                     (39, 16, 5, 1, 'serums'),
                                                                                     (40, 15, 8, 1, 'vitamines'),
                                                                                     (41, 15, 6, 1, 'maquillage');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
                             `id` int(11) NOT NULL,
                             `user_id` int(11) NOT NULL,
                             `category` varchar(100) NOT NULL,
                             `product_id` int(11) NOT NULL,
                             `quantity` int(11) NOT NULL,
                             `address` varchar(255) NOT NULL,
                             `prenom` varchar(100) NOT NULL,
                             `nom` varchar(100) NOT NULL,
                             `ville` varchar(100) NOT NULL,
                             `telephone` varchar(20) NOT NULL,
                             `email` varchar(255) NOT NULL,
                             `notes` text DEFAULT NULL,
                             `payment_method` varchar(50) NOT NULL,
                             `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maquillage`
--

CREATE TABLE `maquillage` (
                              `id` int(11) NOT NULL,
                              `name` varchar(50) NOT NULL,
                              `description` varchar(100) NOT NULL,
                              `prix` float NOT NULL,
                              `photo` text NOT NULL,
                              `promotion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maquillage`
--

INSERT INTO `maquillage` (`id`, `name`, `description`, `prix`, `photo`, `promotion`) VALUES
                                                                                         (1, 'Benefit Cosmetics – The POREfessional Base de tein', 'Et si vous faisiez disparaitre vos pores en un coup de baguette magique? La base de teint The POREfe', 18.99, 'https://german-beautyshop.com/wp-content/uploads/2020/02/benefit-cosmetics-maroc.jpg', '-30%'),
                                                                                         (2, 'Erborian – BB Crème Au Ginseng, Doré, 45 ml', 'La BB Crème au Ginseng de Erborian est une Crème Teintée Soin 5-En-1 avec une formule coréenne pour ', 50, 'https://german-beautyshop.com/wp-content/uploads/2021/03/Erborian-Maroc-6.jpg', '-30%'),
                                                                                         (3, 'IT Cosmetics – CC Crème Correctrice + SPF 50, Medi', 'Your Skin But Better CC+ Cream SPF 50+ de IT Cosmetics est une Crème Correctrice haute couvrance, sé', 60, 'https://german-beautyshop.com/wp-content/uploads/2020/09/Design-ohne-Titel204.jpg', ''),
                                                                                         (4, 'Erborian – CC Crème À la Centella Asiatica, Doré, ', 'Erborian CC Crème est un soin multiple, illuminateur de teint « Haute Définition » et perfecteur de ', 60, 'https://german-beautyshop.com/wp-content/uploads/2020/08/Design-ohne-Titel35.jpg', ''),
                                                                                         (5, 'Alverde – Mascara Transparant Bio, 7 ml', 'Enrichi en huile de jojoba nourrissante, ce Mascara Transparent, de chez Alverde, fixe vos cils et v', 7.99, 'https://german-beautyshop.com/wp-content/uploads/2020/02/Design-ohne-Titel-2020-02-24T131259.838.jpg', ''),
                                                                                         (6, 'Ebelin – Rasoirs Sourcils et Visage', 'Les Rasoirs Sourcils et Visage de Ebelin mettent en forme vos sourcils facilement et avec précision.', 8, 'https://german-beautyshop.com/wp-content/uploads/2020/04/rasoirs-sourcils-et-visage-maroc.jpg', ''),
                                                                                         (7, 'BeautyBlender – BeautyBlender Pro, Éponge à Maquil', 'L’éponge BeautyBlender de couleur noire, votre nouvelle nuance chouchou. L’éponge à maquillage noire', 10, 'https://german-beautyshop.com/wp-content/uploads/2020/02/design-ohne-titel-2020-02-25t153534319.jpg', ''),
                                                                                         (8, 'Alverde – Crayon pour les Yeux Bio, Pearly White', 'Voici une proposition en deux lignes :\r\n\r\nUn crayon khôl alverde couleur blanc pur, présenté dans un', 5, 'https://german-beautyshop.com/wp-content/uploads/2020/02/Design-ohne-Titel-2020-02-22T232302.228.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
                                `id` int(11) NOT NULL,
                                `name` varchar(40) NOT NULL,
                                `email` varchar(40) NOT NULL,
                                `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `email`, `password`) VALUES
                                                                   (2, 'www', 'walid13@gmail.com', 'jkhjkhk'),
                                                                   (3, 'walid', 'walidjouker13@gmail.com', '$2y$10$P9EJdzhZoevaNc1H4arzBOQ/JRjTPTRAZ'),
                                                                   (5, 'marwan', 'mm4943891@gmail.com', '$2y$10$A9nUiMgUkQ5NF/W3LMkBTO.0WxW6NuX7P'),
                                                                   (7, 'bbbbbbbb', 'walidjouker147@gmail.com', '$2y$10$W6ILUyQ2mIbUOkd6TpfbXO8.T1mqJDXBH'),
                                                                   (8, 'Jamal', 'jamal69@gmail.com', '$2y$10$JaqeMDkNBr5J4VFt.UF4hegG2ins7iw/WMM6hqlsEgAflVjBSYROS'),
                                                                   (9, 'KJK', 'hjhg@gmail.com', '$2y$10$DSqTMVQ7xTW10cQFY/bEy.fw1rtNR4xSgxDVRipne1f8VUHfMZg8u'),
                                                                   (10, 'Admin', 'admin@gmail.com', 'admin123'),
                                                                   (11, 'kaw', 'paw@gmail.com', '$2y$10$v0vWvtL9Zn0ueUQ61LfpausYEHMC2Y0IF7OV2LvryP2.X8VS0fNFS');

-- --------------------------------------------------------

--
-- Table structure for table `serums`
--

CREATE TABLE `serums` (
                          `id` int(11) NOT NULL,
                          `name` varchar(50) NOT NULL,
                          `description` varchar(200) NOT NULL,
                          `prix` float NOT NULL,
                          `photo` text NOT NULL,
                          `promotion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serums`
--

INSERT INTO `serums` (`id`, `name`, `description`, `prix`, `photo`, `promotion`) VALUES
                                                                                     (2, 'The Ordinary – Poudre d’Acide L-Ascorbique 100% Vi', 'La Vitamine C est un antioxydant puissant qui cible l’éclat du teint et les signes du vieillissement cutané. La formule de The Ordinary contient une poudre d’Acide L-Ascorbique qui agit sur les irrégu', 20, 'https://german-beautyshop.com/wp-content/uploads/2022/11/The-Ordinary-Maroc-Poudre-dAcide-L-Ascorbique-100-Vitamine-C.png', '-30%'),
                                                                                     (3, 'The Ordinary – Acide Lactique 5% + HA 2%, 30 ml', 'Une formulation de l’Acide Lactique 5% + HA 2%, de The Ordinary, vegan légère à moyenne de peeling superficiel.', 20, 'https://german-beautyshop.com/wp-content/uploads/2020/11/the-ordinary-maroc.jpg', '-30%'),
                                                                                     (4, 'Daytox – Sérum Vitamine C, 30 ml', 'Le Sérum Vitamine C de DayTox rend votre teint rayonnant et fait paraître la peau plus ferme et plus jeune. La vitamine C réduit visiblement les taches brunes et équilibre le teint de la peau. Les rid', 30, 'https://german-beautyshop.com/wp-content/uploads/2020/10/DayTox-Maroc-6.jpg', ''),
                                                                                     (5, 'Alverde – Eau Florale Bio Rose, 100 ml', 'L’eau florale à la Rose de Damas Bio, de chez Alverde, apaise les peaux sensibles, qui tiraillent et a également la capacité de régénérer les peaux abîmées.', 10, 'https://german-beautyshop.com/wp-content/uploads/2020/09/Design-ohne-Titel253.jpg', ''),
                                                                                     (6, 'Paula’s Choice – Booster 10% Acide Azélaïque, 30 m', 'Booster de Paula’s Choice estompe les taches brunes, apaise la peau et réduit les décolorations laissées par les éruptions cutanées. Il illumine la peau et aide à réduire les boutons.', 50, 'https://german-beautyshop.com/wp-content/uploads/2021/04/Paulas-Choice-Maroc-1-1.jpg', ''),
                                                                                     (7, 'Paula’s Choice – 10% Niacinamide Booster, 20 ml', 'Le 10% Niacinamide Booster de Paula’s Choice lisse la surface de la peau, rend les pores moins visibles et estompe les imperfections.', 70, 'https://german-beautyshop.com/wp-content/uploads/2021/04/Paulas-Choice-Maroc-5.jpg', ''),
                                                                                     (8, 'Daytox – Sérum Vitamine C, 30 ml', 'Le Sérum Vitamine C de DayTox rend votre teint rayonnant et fait paraître la peau plus ferme et plus jeune. La vitamine C réduit visiblement les taches brunes et équilibre le teint de la peau. Les rid', 30, 'https://german-beautyshop.com/wp-content/uploads/2020/10/DayTox-Maroc-6.jpg', ''),
                                                                                     (9, 'The Ordinary – Rétinol 0,2% dans du Squalane, 30 m', 'Le Rétinol de The Ordinary 0,2% est une solution sans eau offrant une concentration de rétinol pur de 1%, permettant de lutter contre les signes de l’âge, notamment les rides et le photo-vieillissemen', 20, 'https://german-beautyshop.com/wp-content/uploads/2022/11/The-Ordinary-Maroc-Retinol-02-.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `vitamines`
--

CREATE TABLE `vitamines` (
                             `id` int(11) NOT NULL,
                             `name` varchar(50) NOT NULL,
                             `description` varchar(255) NOT NULL,
                             `prix` float NOT NULL,
                             `photo` text NOT NULL,
                             `promotion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vitamines`
--

INSERT INTO `vitamines` (`id`, `name`, `description`, `prix`, `photo`, `promotion`) VALUES
                                                                                        (2, 'Balea – Concentré de Vitamine C, 7 Capsules', 'Un soin spécial chouchoutant au pouvoir actif: le Concentré de Vitamine C Balea apporte à votre peau des ingrédients précieux.', 5.99, 'https://german-beautyshop.com/wp-content/uploads/2020/08/Design-ohne-Titel141.jpg', '-30%'),
                                                                                        (3, 'The Ordinary – Niacinamide 10% + Zinc 1%, 30 ml', 'Sérum de chez The Ordinary ultra-concentré en vitamines et minéraux pour lutter contre les imperfections et les inflammations cutanées.', 20, 'https://german-beautyshop.com/wp-content/uploads/2020/03/The-Ordinary-%E2%80%93-Niacinamide-10-Zinc-1.jpg', '-30%'),
                                                                                        (4, 'Balea – Concentré de Vitamine C, 7 Capsule', 'Un soin spécial chouchoutant au pouvoir actif: le Concentré de Vitamine C Balea apporte à votre peau des ingrédients précieux.', 3, 'https://german-beautyshop.com/wp-content/uploads/2020/08/Design-ohne-Titel141.jpg', ''),
                                                                                        (5, 'Balea – Concentré Hydratant, 7 Capsules', 'Un soin spécial avec des ingrédients actifs: le Concentré Hydratant Balea apporte à votre peau des ingrédients précieux.', 3, 'https://german-beautyshop.com/wp-content/uploads/2020/08/Design-ohne-Titel145.jpg', ''),
                                                                                        (6, 'Now Foods – Propolis 2000, 90 Capsules', 'La Propolis de Now Foods collectée par les apiculteurs dans des ruches en bonne santé et active est en riches de nombreux bioflavonoïdes.', 30, 'https://german-beautyshop.com/wp-content/uploads/2021/08/Propolis-Maroc-.jpg', ''),
                                                                                        (7, 'Nature Love – Fer + Vitamine C, 240 Comprimés', 'Ce complement alimentaire de Nature Love offre par comprimé 40 mg de Bisglycinate de Fer et 40 mg de vitamine C supplémentaire de cerise d’Acérola.', 40, 'https://german-beautyshop.com/wp-content/uploads/2021/08/Bisglycinate-de-Fer-Maroc-3.jpg', ''),
                                                                                        (8, 'Nature’s Way – Marshmallow Racine de Guimauve, 100', 'La Racine de Guimauve est traditionnellement utilisé pour apaiser le système respiratoire et soutienir une digestion saine.\r\n\r\n', 20, 'https://german-beautyshop.com/wp-content/uploads/2021/08/Racine-de-Guimauve-Maroc-.jpg', ''),
                                                                                        (9, 'WeightWorld – Vitamines C liposomal – 1000 mg de v', 'Si vous recherchez un moyen efficace de soutenir votre immunité et d’optimiser votre énergie, ne passez pas à côté de la vitamine C liposomal de WeightWorld.\r\nCommandez dès maintenant et faites le plein de vitalité au naturel !', 5, 'https://german-beautyshop.com/wp-content/uploads/2025/01/Vitamine-C-liposomal.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bio`
--
ALTER TABLE `bio`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_item_per_cart` (`cart_id`,`product_id`,`category`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maquillage`
--
ALTER TABLE `maquillage`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serums`
--
ALTER TABLE `serums`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vitamines`
--
ALTER TABLE `vitamines`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bio`
--
ALTER TABLE `bio`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `maquillage`
--
ALTER TABLE `maquillage`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `serums`
--
ALTER TABLE `serums`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vitamines`
--
ALTER TABLE `vitamines`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
    ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
    ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
