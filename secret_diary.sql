-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2021 at 05:24 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `secret_diary`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `diary` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `diary`) VALUES
(1, 'test@admin.com', '42284f3438cd11991349951a036eec09', 'Terms and Conditions\nIntroduction\n\nWelcome to the japannotepc.com website (the \"Site\"). These terms & conditions (\"Terms and Conditions\") apply to the Site, and all of its divisions, subsidiaries, and affiliate operated Internet sites which reference these Terms and Conditions.\nThis website is owned and operated by Nugress GK. For the purposes of this website, \"seller\", \"we\", \"us\" and \"our\" all refer japannotepc.com. \nThe Site reserves the right, to change, modify, add, or remove portions of both the Terms and Conditions of Use and the Terms and Conditions of Sale at any time. Changes will be effective when posted on the Site with no other notice provided. Please check these Terms and Conditions regularly for updates. Your continued use of the Site following the posting of changes to these Terms and Conditions constitutes your acceptance of those changes.\nKindly review the Terms and Conditions listed below diligently prior to using this website as your use of the website indicates your agreement to be wholly bound by its Terms and Conditions without modification.\nYou agree that if you are unsure of the meaning of any part of these Terms and Conditions or have any questions regarding the Terms and Conditions, you will not hesitate to contact us for clarification. These Terms and Conditions fully govern the use of this website. No extrinsic evidence, whether oral or written, will be incorporated.\n\n\n or justification.\n'),
(2, 'info@testadmin.com', '430da3c041d48ed640348e4f5408fe7b', 'Hello');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
