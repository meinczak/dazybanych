-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 10:20 AM
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
-- Database: `ksiazkimanczak`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `cover` text NOT NULL,
  `category` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `author`, `description`, `cover`, `category`) VALUES
(1, 'Zbrodnia i kara', 'Fiodor Dostojewski', 'Klasyczna powieść o winie, karze i moralności – młody student morduje lichwiarkę, by sprawdzić granice ludzkiej etyki.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-pRDZL92zNGTZPGfXNGrtCecdumEYlnitNw&s', 'powieść psychologiczna'),
(2, 'Małe życie', 'Hanya Yanagihara', 'Wstrząsająca historia o przyjaźni, traumie i cierpieniu – śledzimy losy czterech przyjaciół w Nowym Jorku.', 'https://ecsmedia.pl/c/male-zycie-ebook-mobi-b-iext180742484.jpg', 'powieść psychologiczna'),
(3, 'Obcy', 'Albert Camus', 'Egzystencjalna opowieść o obojętności świata i absurde istnienia – mężczyzna popełnia zbrodnię bez wyraźnego powodu.', 'https://dziupla.sowa.pl/f/q1v0awl8m3h31.jpg', 'powieść psychologiczna'),
(4, 'Portret Doriana Graya', 'Oscar Wilde', 'Mroczna refleksja nad pięknem, moralnością i upadkiem człowieka – młodzieniec się nie starzeje, ale jego dusza niszczeje.', 'https://ecsmedia.pl/c/portret-doriana-graya-b-iext168190304.jpg', 'powieść psychologiczna'),
(5, '1984', 'George Orwell', 'Przerażająca wizja totalitarnego państwa, gdzie każda myśl jest kontrolowana, a wolność nie istnieje.', 'https://m.media-amazon.com/images/I/612ADI+BVlL.jpg', 'społeczne sci-fi'),
(6, 'Nowy wspaniały świat', 'Aldous Huxley', 'Społeczeństwo przyszłości oparte na konsumpcji i kontroli emocji – utopia, która skrywa koszmarne podstawy.', 'https://ecsmedia.pl/c/nowy-wspanialy-swiat-b-iext183485263.jpg', 'społeczne sci-fi'),
(7, 'Opowieść podręcznej', 'Margaret Atwood', 'W państwie religijnym kobiety są sprowadzone do ról reprodukcyjnych – przejmująca historia o opresji i buncie.', 'https://fwcdn.pl/fpo/16/34/771634/8027451_1.3.jpg', 'społeczne sci-fi'),
(8, 'Mechaniczna pomarańcza', 'Anthony Burgess', 'Brutalna, futurystyczna opowieść o młodocianym przestępcy – eksperymentalna terapia ma odebrać mu wolną wolę.', 'https://s.lubimyczytac.pl/upload/books/5039000/5039895/1082552-352x500.jpg', 'społeczne sci-fi'),
(9, 'Chłopi', 'Władysław Reymont', 'Epopeja wiejska ukazująca życie chłopów w rytmie natury i tradycji – głęboki obraz polskiej wsi przełomu wieków.', 'https://ecsmedia.pl/c/chlopi-b-iext181191400.jpg', 'powieść historyczna'),
(10, 'Imię róży', 'Umberto Eco', 'Intelektualny kryminał osadzony w średniowiecznym klasztorze – mnich bada serię tajemniczych zgonów wśród zakonników.', 'https://s.lubimyczytac.pl/upload/books/4946000/4946948/1110366-352x500.jpg', 'powieść historyczna');

-- --------------------------------------------------------

--
-- Table structure for table `copies`
--

CREATE TABLE `copies` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `is_returned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `copies`
--

INSERT INTO `copies` (`id`, `book_id`, `is_returned`) VALUES
(1, 1, 1),
(2, 3, 0),
(3, 3, 1),
(4, 4, 0),
(5, 5, 0),
(6, 7, 0),
(7, 7, 0),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `copy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `start_date`, `end_date`, `copy_id`) VALUES
(1, 1, '2025-05-04', '2025-05-08', 1),
(2, 1, '2025-05-16', '2025-05-23', 2),
(3, 1, '2025-05-06', '2025-05-22', 3),
(4, 1, '2025-05-13', '2025-05-22', 4),
(5, 2, '2025-05-08', '2025-05-17', 5),
(6, 2, '2025-05-12', '2025-05-14', 6),
(7, 3, '2025-05-01', '2025-05-03', 7),
(8, 4, '2025-05-07', '2025-05-28', 8),
(9, 5, '2025-05-01', '2025-05-29', 10),
(10, 6, '2025-05-08', '2025-05-22', 9);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `stars` int(1) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `book_id`, `stars`, `text`) VALUES
(1, 1, 1, 5, 'super sigma'),
(2, 2, 2, 2, 'meh'),
(3, 2, 3, 4, 'fajne nawet'),
(4, 3, 4, 5, 'świetna książka gorąco polecam!!!'),
(5, 4, 4, 5, 'Super'),
(6, 5, 6, 1, 'nie polecam'),
(7, 7, 5, 4, 'git'),
(8, 1, 10, 1, 'nie polecam'),
(9, 2, 7, 5, 'najlepsza książka ever!!!'),
(10, 10, 1, 4, 'spoko spoko');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'manczak', 'Sala332!'),
(2, 'gorzel', 'Sala332!'),
(3, 'maras', 'cwaniak'),
(4, 'szymon', 'sigma'),
(5, 'kamieniczny', 'Sala332!'),
(6, 'kubu01', 'Sala332!'),
(7, 'banach', 'bardzolubiesiurki'),
(8, 'maksiu', 'plutka'),
(9, 'korczu', 'Sala332!'),
(10, 'mati', 'Sala332!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copies`
--
ALTER TABLE `copies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `copies`
--
ALTER TABLE `copies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
