-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2019 at 05:02 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_home`
--

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `user_id`, `address`, `details`, `created_at`, `updated_at`) VALUES
(1, 3, '746/C, Banarupra Road, Chanadana, Chowrasta, Gazipur', 'East Side of Jahanara Business Point', '2019-12-05 03:24:48', '2019-12-05 03:24:48'),
(2, 2, 'Nagbari, Gazipur, Dhaka, Bangladesh', 'Newly Added Home', '2019-12-08 06:20:56', '2019-12-08 06:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `meter`
--

CREATE TABLE `meter` (
  `id` int(11) NOT NULL,
  `home_id` int(11) NOT NULL,
  `meter_number` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `service` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meter_transaction`
--

CREATE TABLE `meter_transaction` (
  `id` int(11) NOT NULL,
  `meter_id` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `palli_trans_id` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE `motor` (
  `id` int(11) NOT NULL,
  `home_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `user_id`, `owner_name`, `created_at`, `updated_at`) VALUES
(1, 3, 'mazibur_rahman', '2019-12-05 03:23:01', '2019-12-05 03:23:01'),
(2, 2, 'shahabuddin', '2019-12-08 06:20:45', '2019-12-08 06:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `varatia_id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nid` int(11) NOT NULL,
  `total_person` int(11) NOT NULL,
  `fair` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `user_id`, `varatia_id`, `img`, `nid`, `total_person`, `fair`, `status`, `due`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 'uploads/ccfb827a32.png', 120, 3, 5000, 0, 0, '2019-12-05 03:25:47', '2019-12-08 16:48:08'),
(2, 3, 5, 'uploads/13e83f1187.png', 220, 4, 5500, 0, 0, '2019-12-05 03:27:45', '2019-12-05 03:27:45'),
(3, 3, 6, 'uploads/7d972e296c.png', 2147483647, 2, 5500, 0, 0, '2019-12-05 03:28:42', '2019-12-05 03:28:42'),
(4, 3, 7, 'uploads/02e28398ab.png', 45354, 4, 10000, 0, 0, '2019-12-05 03:29:15', '2019-12-05 03:29:15'),
(5, 2, 8, 'uploads/b9f346aa61.png', 21312312, 1, 1900, 0, 0, '2019-12-08 06:44:38', '2019-12-08 06:44:38'),
(6, 2, 9, 'uploads/2644e9e430.png', 5767567, 1, 1900, 0, 0, '2019-12-08 06:45:03', '2019-12-08 06:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `random_transaction_id` varchar(255) NOT NULL,
  `get_owner_verification` int(11) NOT NULL,
  `get_varatia_verification` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `owner_id`, `room_id`, `month`, `year`, `payment`, `status`, `due`, `payment_type`, `random_transaction_id`, `get_owner_verification`, `get_varatia_verification`, `created_at`) VALUES
(1, 3, 5, 'December', 2019, 5500, 0, 0, 0, '5', 0, 0, '2019-12-08 16:53:33'),
(2, 3, 7, 'December', 2019, 5000, 1, 5000, 0, '7-8108638c03d8', 0, 0, '2019-12-08 16:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'root', 'root', 'root@gmail.com', 0, '2019-12-05 03:16:10', '2019-12-05 03:16:10'),
(2, 'shahabuddin', 'secret', 'shanahan.alek@example.com', 0, '2019-12-05 03:17:42', '2019-12-05 03:17:42'),
(3, 'mazibur_rahman', 'secret', 'mhilpert@example.org', 0, '2019-12-05 03:18:09', '2019-12-05 03:18:09'),
(4, 'shohel', 'secret', 'shopup@email.com', 1, '2019-12-05 03:19:02', '2019-12-05 03:19:02'),
(5, 'shafi', 'secret', 'shafi@yahoo.com', 1, '2019-12-05 03:19:32', '2019-12-05 03:34:25'),
(6, 'saidul', 'secret', 'saidul@yahoo.com', 1, '2019-12-05 03:20:15', '2019-12-05 03:20:15'),
(7, 'alauddin', 'secret', 'alexis.hudson@example.net', 1, '2019-12-05 03:20:50', '2019-12-05 03:20:50'),
(8, 'wasim', 'secret', 'wasim@hotmail.com', 1, '2019-12-05 03:21:16', '2019-12-05 03:21:16'),
(9, 'mijan', 'secret', 'mijan@yahoo.com', 1, '2019-12-05 03:21:32', '2019-12-05 03:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `varatia`
--

CREATE TABLE `varatia` (
  `id` int(11) NOT NULL,
  `varatia_id` int(11) NOT NULL,
  `varatia_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `varatia`
--

INSERT INTO `varatia` (`id`, `varatia_id`, `varatia_name`, `created_at`, `updated_at`) VALUES
(1, 4, 'shohel', '2019-12-05 03:21:47', '2019-12-05 03:21:47'),
(2, 5, 'shafi', '2019-12-05 03:21:52', '2019-12-05 03:21:52'),
(3, 6, 'saidul', '2019-12-05 03:21:58', '2019-12-05 03:21:58'),
(4, 7, 'alauddin', '2019-12-05 03:22:06', '2019-12-05 03:22:06'),
(5, 8, 'wasim', '2019-12-05 03:22:12', '2019-12-05 03:22:12'),
(6, 9, 'mijan', '2019-12-05 03:22:18', '2019-12-05 03:22:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meter`
--
ALTER TABLE `meter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meter_transaction`
--
ALTER TABLE `meter_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `varatia`
--
ALTER TABLE `varatia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meter`
--
ALTER TABLE `meter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meter_transaction`
--
ALTER TABLE `meter_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `varatia`
--
ALTER TABLE `varatia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
