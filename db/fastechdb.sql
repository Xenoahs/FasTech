-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2021 at 07:52 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fastechdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(11, 41, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_disp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_disp`) VALUES
(1, 'CPU', 'cpu'),
(2, 'Motherboard', 'motherboard'),
(3, 'Graphics Card', 'graphics-card'),
(4, 'Casing', 'casing'),
(5, 'RAM', 'ram'),
(6, 'PSU', 'psu');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `activate_code` varchar(15) NOT NULL,
  `reset_code` varchar(15) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `email`, `password`, `type`, `first_name`, `last_name`, `address`, `contact_number`, `photo`, `status`, `activate_code`, `reset_code`, `creation_date`) VALUES
(1, 'admin@admin.com', '$2y$10$3WLpqbW8GFjzJhYZj13ZFOvSjmXgJLb6D/h4MS6ZwKW4BZdR0NrsG', 1, 'Earl', 'Pogi', '', '', 'krazy.jpg', 1, '', '', '2021-12-01'),
(41, 'earlzeann10@gmail.com', '$2y$10$3WLpqbW8GFjzJhYZj13ZFOvSjmXgJLb6D/h4MS6ZwKW4BZdR0NrsG', 0, 'Earl Zeann', 'Lumanlan', 'Bulacan', '09217248559', 'Fubuki.jpg', 1, '2sV3MEdDHrI4', '', '2021-12-01'),
(43, 'selrahcigop@gmail.com', '$2y$10$5oTHCCZ5k/0NQIXVa0JjlOR/ABi075.YBDmdeWZJG2ZjmEeqO8RG2', 0, 'Charles Dune', 'Villegas', 'Quezon City', '09217248559', 'charles.jpg', 1, '', '', '2021-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `sales_id`, `product_id`, `quantity`) VALUES
(0, 1, 1, 1),
(0, 2, 11, 1),
(0, 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_desc` text NOT NULL,
  `product_disp` varchar(200) NOT NULL,
  `product_price` double NOT NULL,
  `photo` varchar(200) NOT NULL,
  `product_view` date NOT NULL,
  `product_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_desc`, `product_disp`, `product_price`, `photo`, `product_view`, `product_count`) VALUES
(1, 1, 'AMD Ryzen 5 5600X Socket AM4 3.7GHz Processor', 'Gaming desktop processors features 6 incredible cores for those who just want to game.', 'AMD Ryzen 5 5600X', 18000, 'AMD-Ryzen-5-5600X.jpeg', '2021-12-01', 1),
(2, 1, 'AMD Ryzen 9 5950X Socket AM4 3.7GHz Processor', '16 Cores. 0 Compromises. One processor that can game as well as it creates.', 'AMD-Ryzen-9-5950X', 55000, 'AMD-Ryzen-9-5950X.jpeg', '2021-12-01', 1),
(3, 1, 'Intel Core i9 12900K 16C/24T 3.2-5.3ghz 30mb UHD770 125W LGA1700', '30M Cache, up to 5.20 GHz', 'Intel-Core-i9-12900K', 48000, 'Intel-Core-i9-12900K.jpeg', '2021-11-19', 5),
(4, 1, 'Intel Core i7 12700K 12C/20T 3.6-5.0ghz 25mb UHD770 125W LGA1700', '25M Cache, up to 5.00 GHz', 'Intel-Core-i7-12700K', 31000, 'Intel-Core-i7-12700K.jpeg', '2021-11-19', 10),
(5, 1, 'AMD Ryzen 7 5700G Socket Am4 3.8GHz with Radeon Vega 8 Processor', 'G-Series Desktop Processors with Radeon™ Graphics. # of CPU Cores. 8. # of Threads. 16. Max. Boost Clock. Up to 4.6GHz. Base Clock. 3.8GHz.', 'AMD-Ryzen-7-5700G', 22000, 'AMD-Ryzen-7-5700G.jpeg', '2021-11-19', 5),
(6, 2, 'Asus ROG Maximus Z690 Formula (LGA1700) Z690, ATX, 4*ddr5, WiFi6 + BT', 'Intel® Z690 ATX motherboard with 20+1 power stages, DDR5, Five M.2, USB 3.2 Gen 2x2 front-panel connector, Dual Thunderbolt™ 4, PCIe® 5.0, Onboard WiFi 6E, 10 Gb Ethernet and Aura Sync RGB lighting', 'Asus-ROG-Maximus-Z690-Formula', 43000, 'Asus-ROG-Maximus-Z690-Formula.jpeg', '2021-11-30', 1),
(7, 2, 'Gigabyte Z690 Aorus Master (LGA1700) Z690, ATX, 4*ddr5, WiFi6 + BT', 'Intel® Z690 AORUS Motherboard with Direct 19+1+2 Phases Digital VRM Design, DDR5 XTREME MEMORY Design, Fins-Array III Heatsink, Direct-Touch Heatpipe II, NanoCarbon Baseplate, M.2 Thermal Guard III, 125dB ESS Sabre.', 'Gigabyte-Z690-Aorus-Master', 29000, 'Gigabyte-Z690-Aorus-Master.jpeg', '2021-11-19', 5),
(8, 2, 'Asus ROG Crosshair 8 Hero WiFi (AM4) X570, ATX, 4*ddr4, WiFi + BT', 'AMD X570 ATX gaming motherboard with PCIe 4.0, 16 power stages , OptiMem III, on-board Wi-Fi 6 (802.11ax), 2.5 Gbps LAN, USB 3.2, SATA, M.2 and Aura Sync RGB lighting', 'Asus-ROG-Crosshair-8-Hero', 20000, 'Asus-ROG-Crosshair-8-Hero.jpeg', '2021-11-19', 5),
(9, 2, 'Asrock X570 Taichi Razer Edition (AM4) X570, ATX, 4*ddr4, WiFi + BT', 'Supports AMD AM4 Socket Ryzen™ 3000, 4000 G-Series, 5000 and 5000 G-Series Desktop Processors', 'Asrock-X570-Taichi-Razer-Edition', 19000, 'Asrock-X570-Taichi-Razer-Edition.jpeg', '2021-11-19', 5),
(10, 2, 'MSI MEG Z590I Unify (LGA1200) Z590, ITX, 2*ddr4, WiFi + BT', 'Utilizing 11th Gen Intel processors, MSI Z590 motherboards feature latest Lightning Gen 4 M.2 which is the fastest onboard storage solution on the market with up to 64 Gb/s transfer speed.', 'MSI-MEG-Z590I-Unify', 18000, 'MSI-MEG-Z590I-Unify.jpeg', '2021-11-19', 5),
(11, 3, 'Inno3D RTX 3070', 'GPU Engine Specs: CUDA Cores 5888Boost Clock (MHz) 1785Base Clock(MHz) 1500Thermal and Power Spec: Minimum System Power Requirement (W) 650Supplementary Power Connectors 8+8-pinMemory Specs: Memory Clock 14GbpsStandard Memory Config 8GBMemory.', 'Inno3d-rtx-3070', 49000, 'Inno3d-rtx-3070.jpeg', '2021-11-21', 1),
(12, 3, 'MSI RTX 3070', 'QUICK OVERVIEW  MODEL NAME GeForce RTX™ 3070 Ti VENTUS 3X 8G OC GRAPHICS PROCESSING UNIT NVIDIA® GeForce RTX™ 3070 Ti INTERFACE PCI Express® Gen 4 CORES 6144 Units CORE CLOCKS Boost:1800 MHz', 'msi-rtx-3070', 56000, 'msi-rtx-3070.jpeg', '2021-11-19', 5),
(13, 3, 'POWERCOLOR RX 6600 XT', 'Graphics Engine AXRX 6600XT 8GBD6-3DH Video Memory 8GB GDDR6 Stream Processor 2048 Units Engine Clock(OC) up to 2359MHz(Game) up to 2589MHz(Boost) Engine Clock(STD/Silent) Memory Clock 16.0 Gbps Memory Interface 128-bit', 'powercolor-rx-6600-xt', 32000, 'powercolor-rx-6600-xt.jpeg', '2021-11-19', 5),
(14, 3, 'ASUS TUF GTX 1660TI', 'Graphic Engine NVIDIA® GeForce GTX 1660 Ti Bus Standard PCI Express 3.0 OpenGL OpenGL®4.6 Video Memory 6GB GDDR6 Engine ClockOC mode : 1800 MHz (Boost Clock)Gaming mode : 1770 MHz', 'asus-tuf-gtx-1660ti', 27000, 'asus-tuf-gtx-1660ti.jpeg', '2021-11-19', 5),
(15, 3, 'GIGABYTE RX 6600 EAGLE', 'Graphics Processing Radeon™ RX 6600 Core ClockBoost Clock* : up to 2491 MHzGame Clock* : up to 2044 MHz Stream Processors 1792 Memory Clock 14000 MHz Memory Size 8 GB', 'gigabyte-rx-6600-eagle', 29000, 'gigabyte-rx-6600-eagle.jpeg', '2021-11-19', 5),
(16, 4, 'Coolman Robin 2', 'A full tower case that can hold up to 12 fans', 'coolman-robin-2', 3200, 'coolman-robin-2.jpeg', '2021-11-19', 5),
(17, 4, 'Sting pro crystal', 'A full tower that can hold up to 10 fans', 'sting-pro-crystal', 2890, 'sting-pro-crystal.jpeg', '2021-11-19', 5),
(18, 4, 'Tecware Nexus M', 'A mid tower that includes 3 fans', 'tecware-nexus-m', 1750, 'tecware-nexus-m.jpeg', '2021-11-19', 5),
(19, 4, 'Deepcool Macube', 'A mid tower that includes 5 fans', 'deepcool-macube', 3750, 'deepcool-macube.jpeg', '2021-11-19', 5),
(20, 4, 'Tecware Forge M', 'A mid tower that can hold up to 6 fans with 3 fans included', 'tecware-forge-m', 2650, 'tecware-forge-m.jpeg', '2021-11-19', 5),
(21, 5, 'GSKILL TRIDENT Z NEO', 'Memory Type: DDR4 Capacity: 32GB (16GBx2) Multi-Channel Kit: Dual Channel Kit Tested Speed: 3600MHz Tested Latency: 18-22-22-42 Tested Voltage: 1.35V Registered/Unbuffered: Unbuffered Error Checking: Non-ECC SPD Speed: 2133MHz SPD', 'gskill-trident-z-neo', 9110, 'gskill-trident-z-neo.jpeg', '2021-11-19', 5),
(22, 5, 'Kingston Fury Beast', 'KF548C38BBK2-32 32GB (16GB 2G x 64-Bit x 2 pcs.) DDR5-4800 CL38 288-Pin DIMM Kit', 'kingston-fury-beast', 15600, 'kingston-fury-beast.jpeg', '2021-11-19', 5),
(23, 5, 'Corsair Vengeance RGB Pro', 'Memory Color: WHITE LED Lighting: RGB Single Zone / Multi-Zone Lighting: Dynamic Multi-Zone SPD Latency: 15-15-15-36 SPD Speed: 2133MHz SPD Voltage: 1.2V Speed Rating: PC4-25600 (3200MHz) Heat Spreader: Anodized Aluminum Package', 'corsair-vengeance-rgb-pro', 8600, 'corsair-vengeance-rgb-pro.jpeg', '2021-11-19', 5),
(24, 5, 'T Force Delta TUF RGB', 'Module Type DDR4 288 pin Non-ECC Unbuffered DIMM Capacity 32GB Frequency 3200MHz Data Transfer 25,600 MB/s Bandwidth (PC4 25600) Latency CL16-18-18-38 CL16-20-20-40 Voltage 1.35V', 't-force-delta-tuf-rgb', 8290, 't-force-delta-tuf-rgb.jpeg', '2021-11-19', 5),
(25, 5, 'Corsair Dominator Platinum RGB', 'Memory Series DOMINATOR PLATINUM RGB Memory Type DDR4 Memory Size 32GB Tested Latency 18-22-22-42 Tested Voltage 1.35 Tested Speed 3600 Memory Color BLACK LED', 'corsair-dominator-platinum-rgb', 14810, 'corsair-dominator-platinum-rgb.jpeg', '2021-11-19', 5),
(26, 6, 'Corsair RM650 Gold', 'A Corsair PSU with a wattage of 650', 'corsair-rm650-gold', 5590, 'corsair-rm650-gold.jpeg', '2021-11-21', 1),
(27, 6, 'Gigabyte Aorus Platinum', 'A Gigabyte PSU with a wattage of 1200', 'gigabyte-aorus-platinum', 17995, 'gigabyte-aorus-platinum.jpeg', '2021-11-19', 5),
(28, 6, 'NZXT C750 BRONZE', 'A NZXT PSU with a wattage of 750', 'nzxt-c750-bronze', 4050, 'nzxt-c750-bronze.jpeg', '2021-11-19', 5),
(29, 6, 'Seasonic Focus GM GOLD', 'A Seasonic PSU with a wattage of 850', 'seasonic-focus-gm-gold', 6670, 'seasonic-focus-gm-gold.jpeg', '2021-11-19', 5),
(30, 6, 'MSI MPG GOLD', 'A MSI PSU with a wattage of 650', 'msi-mpg-gold', 4850, 'msi-mpg-gold.jpeg', '2021-11-19', 5);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_id` varchar(50) NOT NULL,
  `sales_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
