-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 02:52 PM
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
-- Database: `uploadpdf`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `short`) VALUES
(1, 'PT. Ispat Indo', 'INDO'),
(2, 'PT. Ispat Bukit Baja', 'IBB'),
(3, 'PT. Ispat Wire Product', 'IWPL');

-- --------------------------------------------------------

--
-- Table structure for table `dep`
--

CREATE TABLE `dep` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short` varchar(3) NOT NULL,
  `com_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dep`
--

INSERT INTO `dep` (`id`, `name`, `short`, `com_id`) VALUES
(8, 'Central Document Control', 'CDC', 1),
(9, 'CIVIL', 'CVL', 1),
(10, 'Dispatch', 'DSP', 1),
(11, 'Electrical', 'ELC', 1),
(12, 'Finance', 'FIN', 1),
(13, 'General Affair', 'GAF', 1),
(14, 'Logistic', 'LOG', 1),
(15, 'Management Information System', 'MIS', 1),
(16, 'Marketing', 'MKT', 1),
(17, 'Mechanic Rolling Mill', 'MRM', 1),
(18, 'Mechanical Steel Melting Shop', 'MSM', 1),
(19, 'Personnel Department', 'PER', 1),
(20, 'Purchasing', 'PUR', 1),
(21, 'QA & PDD', 'QA', 1),
(22, 'Rolling Mill Operation', 'RMO', 1),
(23, 'Security', 'SCR', 1),
(24, 'Safety Health Environment', 'SHE', 1),
(25, 'Steel Melting Shop', 'SMS', 1),
(26, 'Store', 'STR', 1),
(27, 'Training Department', 'TRG', 1),
(28, 'Vehicle', 'VEH', 1),
(29, 'Workshop Department', 'WSP', 1),
(30, 'Utility Department', 'UTL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doc_dept`
--

CREATE TABLE `doc_dept` (
  `id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dt_histcatmut`
--

CREATE TABLE `dt_histcatmut` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `doc_id` int(11) NOT NULL,
  `revisi` varchar(255) DEFAULT NULL,
  `id_sebelum` int(11) DEFAULT NULL,
  `link_document` varchar(255) NOT NULL,
  `vc_created_user` varchar(4) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `nodoc` varchar(50) NOT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `tgl_berlaku` date DEFAULT NULL,
  `sequence` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dt_histcatmut`
--

INSERT INTO `dt_histcatmut` (`id`, `description`, `updated_at`, `created_at`, `doc_id`, `revisi`, `id_sebelum`, `link_document`, `vc_created_user`, `comp_id`, `nodoc`, `doc_name`, `tgl_berlaku`, `sequence`) VALUES
(58, 'PT. Ispat Indo Quality Manual.', '2024-02-06 02:52:55', '2024-02-06 02:52:55', 61, 'original', NULL, 'uploads/ISO_9001_2015/PT__Ispat_Indo_Quality_Manual_/record/b024ec495ed925f2.pdf', '9163', 1, 'b024ec495ed925f2', 'QM ISP 01', '2024-02-14', NULL),
(60, 'PT. Ispat Indo Quality Manual.', '2024-02-11 21:25:56', '2024-02-11 21:25:56', 66, NULL, NULL, 'uploads/ISO_9001_2015/PT__Ispat_Indo_Quality_Manual_/record/7486bdf79d846a00.pdf', '7141', 1, '7486bdf79d846a00', 'QM ISP 01', '2024-02-12', NULL),
(61, 'PT. Ispat Indo Quality Manual Labaratorium', '2024-02-11 21:27:13', '2024-02-11 21:27:13', 67, NULL, NULL, 'uploads/ISO_17025_2017/PT__Ispat_Indo_Quality_Manual_Labaratorium/record/046b115fd8ad0069.pdf', '7141', 1, '046b115fd8ad0069', 'QM ISP 02', '2024-02-12', NULL),
(62, 'Creating and Updating Documented Information', '2024-02-15 21:31:10', '2024-02-15 21:31:10', 68, 'original', NULL, 'uploads/ISO_9001_2015/Creating_and_Updating_Documented_Information/record/2fe8df7796657364.pdf', '9163', 1, '2fe8df7796657364', 'QP 7.5.3 CDC 01', '2024-02-17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dt_histcover`
--

CREATE TABLE `dt_histcover` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `doc_id` int(11) NOT NULL,
  `revisi` varchar(255) DEFAULT NULL,
  `id_sebelum` int(11) DEFAULT NULL,
  `link_document` varchar(255) NOT NULL,
  `vc_created_user` varchar(4) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `nodoc` varchar(50) NOT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `tgl_berlaku` date DEFAULT NULL,
  `sequence` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dt_histcover`
--

INSERT INTO `dt_histcover` (`id`, `description`, `updated_at`, `created_at`, `doc_id`, `revisi`, `id_sebelum`, `link_document`, `vc_created_user`, `comp_id`, `nodoc`, `doc_name`, `tgl_berlaku`, `sequence`) VALUES
(78, 'PT. Ispat Indo Quality Manual.', '2024-02-06 02:51:24', '2024-02-06 02:51:24', 61, 'original', NULL, 'uploads/ISO_9001_2015/PT__Ispat_Indo_Quality_Manual_/cover/271161f47327561f.pdf', '9163', 1, '271161f47327561f', 'QM ISP 01', '2024-02-06', NULL),
(80, 'PT. Ispat Indo Quality Manual.', '2024-02-11 21:25:56', '2024-02-11 21:25:56', 66, NULL, NULL, 'uploads/ISO_9001_2015/PT__Ispat_Indo_Quality_Manual_/cover/c323368e7cb0bbba.pdf', '7141', 1, 'c323368e7cb0bbba', 'QM ISP 01', '2024-02-12', NULL),
(81, 'PT. Ispat Indo Quality Manual Labaratorium', '2024-02-11 21:27:13', '2024-02-11 21:27:13', 67, NULL, NULL, 'uploads/ISO_17025_2017/PT__Ispat_Indo_Quality_Manual_Labaratorium/cover/c58867a6d3fa315c.pdf', '7141', 1, 'c58867a6d3fa315c', 'QM ISP 02', '2024-02-12', NULL),
(82, 'Creating and Updating Documented Information', '2024-02-15 21:30:17', '2024-02-15 21:30:17', 68, 'original', NULL, 'uploads/ISO_9001_2015/Creating_and_Updating_Documented_Information/cover/5838c4b6a2740a21.pdf', '9163', 1, '5838c4b6a2740a21', 'QP 7.5.3 CDC 01', '2024-02-16', 3);

-- --------------------------------------------------------

--
-- Table structure for table `dt_histdoc`
--

CREATE TABLE `dt_histdoc` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `doc_id` int(11) NOT NULL,
  `revisi` varchar(255) DEFAULT NULL,
  `id_sebelum` int(11) DEFAULT NULL,
  `link_document` varchar(500) NOT NULL,
  `vc_created_user` varchar(4) DEFAULT NULL,
  `comp_id` int(11) NOT NULL,
  `nodoc` varchar(50) NOT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `tgl_berlaku` date DEFAULT NULL,
  `sequence` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dt_histdoc`
--

INSERT INTO `dt_histdoc` (`id`, `description`, `updated_at`, `created_at`, `doc_id`, `revisi`, `id_sebelum`, `link_document`, `vc_created_user`, `comp_id`, `nodoc`, `doc_name`, `tgl_berlaku`, `sequence`) VALUES
(80, 'PT. Ispat Indo Quality Manual.', '2024-02-11 21:25:56', '2024-02-11 21:25:56', 66, NULL, NULL, 'uploads/ISO_9001_2015/PT__Ispat_Indo_Quality_Manual_/isi/286b3617a648549d.pdf', '7141', 1, '286b3617a648549d', 'QM ISP 01', '2024-02-12', 1),
(81, 'PT. Ispat Indo Quality Manual Labaratorium', '2024-02-11 21:27:13', '2024-02-11 21:27:13', 67, NULL, NULL, 'uploads/ISO_17025_2017/PT__Ispat_Indo_Quality_Manual_Labaratorium/isi/33b23c525f55bf29.pdf', '7141', 1, '33b23c525f55bf29', 'QM ISP 02', '2024-02-12', 2),
(82, 'Creating and Updating Documented Information', '2024-02-15 21:30:17', '2024-02-15 21:30:17', 68, 'original', NULL, 'uploads/ISO_9001_2015/Creating_and_Updating_Documented_Information/isi/0d1c4b521533dbd0.pdf', '9163', 1, '0d1c4b521533dbd0', 'QP 7.5.3 CDC 01', '2024-02-16', 3),
(83, 'Creating and Updating Documented Information', '2024-02-15 21:31:09', '2024-02-15 21:31:09', 68, 'revisi 1', 82, 'uploads/ISO_9001_2015/Creating_and_Updating_Documented_Information/isi/01ecc3e18c8893b9.pdf', '9163', 1, '01ecc3e18c8893b9', 'QP 7.5.3 CDC 01', '2024-02-17', NULL),
(84, 'Creating and Updating Documented Information', '2024-02-16 07:24:11', '2024-02-16 07:24:11', 69, NULL, NULL, 'uploads/ISO_17025_2017/Creating_and_Updating_Documented_Information/isi/5822350a5e8b9375.pdf', '7141', 1, '5822350a5e8b9375', 'QP 4.2.3 CDC 01', '2024-02-16', 4),
(85, 'Updating and control documented information', '2024-02-16 07:28:16', '2024-02-16 07:28:16', 70, NULL, NULL, 'uploads/ISO_9001_2015/Updating_and_control_documented_information/isi/8814999aed4ceb8d.pdf', '7141', 1, '8814999aed4ceb8d', 'QP 7.5.3 CDC 02', '2024-02-16', 5),
(86, 'Updating and Control Documented Information', '2024-02-16 07:29:03', '2024-02-16 07:29:03', 71, NULL, NULL, 'uploads/ISO_17025_2017/Updating_and_Control_Documented_Information/isi/cd76b72991f2f1e6.pdf', '7141', 1, 'cd76b72991f2f1e6', 'QP 4.2.4 CDC 03', '2024-02-16', 6),
(87, 'Internal Communication', '2024-02-16 07:30:59', '2024-02-16 07:30:59', 72, NULL, NULL, 'uploads/ISO_9001_2015/Internal_Communication/isi/dd11e1d1598d763f.pdf', '7141', 1, 'dd11e1d1598d763f', 'QP 7.4.0 CDC 03', '2024-02-16', 7),
(88, 'Internal Communication', '2024-02-16 07:31:56', '2024-02-16 07:31:56', 73, NULL, NULL, 'uploads/ISO_17025_2017/Internal_Communication/isi/8843be348d3b41b3.pdf', '7141', 1, '8843be348d3b41b3', 'QP 5.5.3 CDC 02', NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `dt_histlampiran`
--

CREATE TABLE `dt_histlampiran` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `doc_id` int(11) NOT NULL,
  `revisi` varchar(255) DEFAULT NULL,
  `id_sebelum` int(11) DEFAULT NULL,
  `link_document` varchar(255) NOT NULL,
  `vc_created_user` varchar(4) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `nodoc` varchar(50) NOT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `tgl_berlaku` date DEFAULT NULL,
  `sequence` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dt_histlampiran`
--

INSERT INTO `dt_histlampiran` (`id`, `description`, `updated_at`, `created_at`, `doc_id`, `revisi`, `id_sebelum`, `link_document`, `vc_created_user`, `comp_id`, `nodoc`, `doc_name`, `tgl_berlaku`, `sequence`) VALUES
(42, 'PT. Ispat Indo Quality Manual.', '2024-02-06 02:52:55', '2024-02-06 02:52:55', 61, 'original', NULL, 'uploads/ISO_9001_2015/PT__Ispat_Indo_Quality_Manual_/attachment/04d14757915229c5.pdf', '9163', 1, '04d14757915229c5', 'QM ISP 01', '2024-02-14', NULL),
(43, 'PT. Ispat Indo Quality Manual.', '2024-02-11 21:25:56', '2024-02-11 21:25:56', 66, NULL, NULL, 'uploads/ISO_9001_2015/PT__Ispat_Indo_Quality_Manual_/attachment/3ef677380fdf382d.pdf', '7141', 1, '3ef677380fdf382d', 'QM ISP 01', '2024-02-12', NULL),
(44, 'PT. Ispat Indo Quality Manual Labaratorium', '2024-02-11 21:27:13', '2024-02-11 21:27:13', 67, NULL, NULL, 'uploads/ISO_17025_2017/PT__Ispat_Indo_Quality_Manual_Labaratorium/attachment/bd7586762602489e.pdf', '7141', 1, 'bd7586762602489e', 'QM ISP 02', '2024-02-12', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `histcatmutbaru`
-- (See below for the actual view)
--
CREATE TABLE `histcatmutbaru` (
`comp_id` int(11)
,`doc_id` int(11)
,`lastdate` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `histcatmutlast`
-- (See below for the actual view)
--
CREATE TABLE `histcatmutlast` (
`comp_id` int(11)
,`doc_id` int(11)
,`lastdate` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `histcoverbaru`
-- (See below for the actual view)
--
CREATE TABLE `histcoverbaru` (
`comp_id` int(11)
,`doc_id` int(11)
,`lastdate` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `histcoverlast`
-- (See below for the actual view)
--
CREATE TABLE `histcoverlast` (
`comp_id` int(11)
,`doc_id` int(11)
,`lastdate` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `histdocbaru`
-- (See below for the actual view)
--
CREATE TABLE `histdocbaru` (
`comp_id` int(11)
,`doc_id` int(11)
,`lastdate` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `histdoclast`
-- (See below for the actual view)
--
CREATE TABLE `histdoclast` (
`comp_id` int(11)
,`doc_id` int(11)
,`lastdate` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `histlambaru`
-- (See below for the actual view)
--
CREATE TABLE `histlambaru` (
`comp_id` int(11)
,`doc_id` int(11)
,`lastdate` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `histlamlast`
-- (See below for the actual view)
--
CREATE TABLE `histlamlast` (
`comp_id` int(11)
,`doc_id` int(11)
,`lastdate` date
);

-- --------------------------------------------------------

--
-- Table structure for table `mst_catmut`
--

CREATE TABLE `mst_catmut` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `dt_created_date` date DEFAULT NULL,
  `vc_created_user` varchar(4) DEFAULT NULL,
  `dt_modified_date` date NOT NULL,
  `vc_modified_user` varchar(4) NOT NULL,
  `comp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_cover`
--

CREATE TABLE `mst_cover` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `dt_created_date` date DEFAULT NULL,
  `vc_created_user` varchar(4) DEFAULT NULL,
  `dt_modified_date` date NOT NULL,
  `vc_modified_user` varchar(4) NOT NULL,
  `comp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_doctype`
--

CREATE TABLE `mst_doctype` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `short` varchar(3) NOT NULL,
  `dt_created_date` date DEFAULT NULL,
  `vc_created_user` varchar(4) DEFAULT NULL,
  `dt_modified_date` date NOT NULL,
  `vc_modified_user` varchar(4) NOT NULL,
  `comp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mst_doctype`
--

INSERT INTO `mst_doctype` (`id`, `description`, `short`, `dt_created_date`, `vc_created_user`, `dt_modified_date`, `vc_modified_user`, `comp_id`) VALUES
(5, 'Quality Manual', 'QM', '2023-12-25', '9163', '2024-02-12', '7141', 1),
(6, 'System of Document', 'SD', '2023-12-23', '9163', '2024-02-13', '7141', 1),
(7, 'Quality Procedure', 'QP', '2024-01-01', '9163', '2024-02-12', '7141', 1),
(8, 'Work Instruction', 'WI', '2024-01-16', '9163', '2024-02-12', '7141', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_document`
--

CREATE TABLE `mst_document` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `doctype_id` int(11) NOT NULL,
  `iso_id` int(11) NOT NULL,
  `dt_created_date` timestamp NULL DEFAULT NULL,
  `vc_created_user` varchar(4) DEFAULT NULL,
  `dt_modified_date` timestamp NULL DEFAULT NULL,
  `vc_modified_user` varchar(4) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `dep_terkait` varchar(255) DEFAULT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `sequence` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mst_document`
--

INSERT INTO `mst_document` (`id`, `description`, `doctype_id`, `iso_id`, `dt_created_date`, `vc_created_user`, `dt_modified_date`, `vc_modified_user`, `comp_id`, `path`, `dep_terkait`, `doc_name`, `sequence`) VALUES
(66, 'PT. Ispat Indo Quality Manual.', 5, 4, '2024-02-09 09:52:01', '7141', '2024-02-09 09:52:01', '7141', 1, 'uploads/ISO_9001_2015/PT__Ispat_Indo_Quality_Manual_', 'CDC', 'QM ISP 01', 1),
(67, 'PT. Ispat Indo Quality Manual Labaratorium', 5, 8, '2024-02-09 09:52:02', '7141', '2024-02-11 17:00:00', '9163', 1, 'uploads/ISO_17025_2017/PT__Ispat_Indo_Quality_Manual_Labaratorium', 'CDC', 'QM ISP 02', 2),
(68, 'Creating and Updating Documented Information', 7, 4, '2024-02-09 09:52:03', '7141', '2024-02-09 09:52:03', '7141', 1, 'uploads/ISO_9001_2015/Creating_and_Updating_Documented_Information', 'CDC', 'QP 7.5.3 CDC 01', 3),
(69, 'Creating and Updating Documented Information', 7, 8, '2024-02-09 09:52:04', '7141', '2024-02-09 09:52:04', '7141', 1, 'uploads/ISO_17025_2017/Creating_and_Updating_Documented_Information', 'CDC', 'QP 4.2.3 CDC 01', 4),
(70, 'Updating and control documented information', 7, 4, '2024-02-09 09:52:05', '7141', '2024-02-09 09:52:05', '7141', 1, 'uploads/ISO_9001_2015/Updating_and_control_documented_information', 'CDC', 'QP 7.5.3 CDC 02', 5),
(71, 'Updating and Control Documented Information', 7, 8, '2024-02-09 09:52:06', '7141', '2024-02-09 09:52:06', '7141', 1, 'uploads/ISO_17025_2017/Updating_and_Control_Documented_Information', 'CDC', 'QP 4.2.4 CDC 03', 6),
(72, 'Internal Communication', 7, 4, '2024-02-11 21:07:47', '7141', '2024-02-11 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Internal_Communication', 'CDC', 'QP 7.4.0 CDC 03', 7),
(73, 'Internal Communication', 7, 8, '2024-02-11 21:09:09', '7141', '2024-02-11 17:00:00', '7141', 1, 'uploads/ISO_17025_2017/Internal_Communication', 'CDC', 'QP 5.5.3 CDC 02', 8),
(74, 'Internal quality audit procedure', 7, 4, '2024-02-11 21:10:16', '7141', '2024-02-11 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Internal_quality_audit_procedure', 'CDC', 'QP 9.2.0 CDC 04', 9),
(75, 'Internal Quality Audit Procedure', 7, 8, '2024-02-11 21:11:30', '7141', '2024-02-11 17:00:00', '7141', 1, 'uploads/ISO_17025_2017/Internal_Quality_Audit_Procedure', 'CDC', 'QP 8.2.2 CDC 04', 10),
(76, 'Nonconformity and Corrective Action Procedure.', 7, 4, '2024-02-11 21:16:49', '7141', '2024-02-11 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Nonconformity_and_Corrective_Action_Procedure_', 'CDC', 'QP 10.2  CDC 05', 11),
(77, 'Nonconformity and Corrective Action Procedure.', 7, 8, '2024-02-11 21:18:52', '7141', '2024-02-11 17:00:00', '7141', 1, 'uploads/ISO_17025_2017/Nonconformity_and_Corrective_Action_Procedure_', 'CDC', 'QP 8.5.2 CDC 05', 12),
(78, 'Management Review Meeting.', 7, 4, '2024-02-11 21:22:28', '7141', '2024-02-11 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Management_Review_Meeting_', 'CDC', 'QP 9.3.0 CDC 06', 13),
(79, 'Management Review Meeting.', 7, 8, '2024-02-11 21:37:51', '7141', '2024-02-11 17:00:00', '7141', 1, 'uploads/ISO_17025_2017/Management_Review_Meeting_', 'CDC', 'QP 5.6.0 CDC 07', 14),
(80, 'Quality Management System Planning', 7, 4, '2024-02-11 22:54:04', '7141', '2024-02-11 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Quality_Management_System_Planning', 'CDC', 'QP 6.3.0 CDC 07', 15),
(81, 'Quality Management System Planning', 5, 8, '2024-02-11 22:57:33', '7141', '2024-02-11 17:00:00', '7141', 1, 'uploads/ISO_17025_2017/Quality_Management_System_Planning', 'CDC', 'QP 5.4.2 CDC 08', 16),
(82, 'Continual Improvement', 7, 4, '2024-02-11 23:00:43', '7141', '2024-02-11 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Continual_Improvement', 'CDC', 'QP 10.3 CDC 08', 17),
(83, 'Context of the Organization', 7, 4, '2024-02-13 09:27:28', '7141', NULL, '7141', 1, 'uploads/ISO_9001_2015/Context_of_the_organization', 'CDC', 'QP 9.2.0 CDC 09', 18),
(84, 'Leadership & Commitment', 7, 4, '2024-02-13 09:41:44', '7141', NULL, '7141', 1, 'uploads/ISO_9001_2015/Leadership___commitment', 'CDC', 'QP 5.1.0 CDC 10', 19),
(85, 'General Procedure for Use of Statistical Technique', 8, 4, '2024-02-13 09:51:10', '7141', NULL, '7141', 1, 'uploads/ISO_9001_2015/General_procedure_for_use_of_statistical_technique', 'CDC', 'WI 9.1.3 CDC 01', 20),
(86, 'General Procedure for Use of Statistical Technique.', 8, 8, '2024-02-13 09:51:35', '7141', NULL, '7141', 1, 'uploads/ISO_17025_2017/General_procedure_for_use_of_statistical_technique_', 'CDC', 'WI 8.4.0 CDC 01', 21),
(87, 'Qualification Criterion, Authority and Responsibility of QC Promoter and Management Representative.', 6, 4, '2024-02-13 10:02:45', '7141', '2024-02-12 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Qualification_Criterion__Authority_and_Responsibility_of_QC_Promoter_and_Management_Representative_', 'CDC', 'SD 7.2.0 CDC 02', 22),
(88, 'Qualification Criterion, Authority and Responsibility of QC Promoter and Management Representative.', 6, 8, '2024-02-13 10:03:31', '7141', '2024-02-12 17:00:00', '7141', 1, 'uploads/ISO_17025_2017/Qualification_Criterion__Authority_and_Responsibility_of_QC_Promoter_and_Management_Representative_', 'CDC', 'SD 6.2.2 CDC 01', 23),
(89, 'Master list of documents level I (QM),   II (QP), III (WI & SD).', 6, 4, '2024-02-13 10:06:55', '7141', '2024-02-12 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Master_list_of_documents_level_I__QM_____II__QP___III__WI___SD__', 'CDC', 'SD 7.5.3 CDC 03', 24),
(90, 'Master list of documents level I (QM),   II (QP), III (WI & SD).', 6, 8, '2024-02-13 10:07:47', '7141', '2024-02-12 17:00:00', '7141', 1, 'uploads/ISO_17025_2017/Master_list_of_documents_level_I__QM_____II__QP___III__WI___SD__', 'CDC', 'SD 4.2.3 CDC 01', 25),
(91, 'General procedure for civil department.', 7, 4, '2024-02-13 10:10:33', '7141', '2024-02-12 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/General_procedure_for_civil_department_', 'CVL', 'QP 7.1.3 CVL 01', 26),
(92, 'Working practice civil department.', 8, 4, '2024-02-13 10:14:31', '7141', '2024-02-12 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Working_practice_civil_department_', 'CVL', 'WI 7.1.3 CVL 01', 27),
(93, 'Job description in civil department.', 6, 4, '2024-02-13 10:16:17', '7141', '2024-02-12 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Job_description_in_civil_department_', 'CVL', 'SD 7.1.3 CVL 01', 28),
(94, 'Civil department quality objective and target', 6, 4, '2024-02-13 10:17:27', '7141', '2024-02-12 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Civil_department_quality_objective_and_target', 'CVL', 'SD 6.2.0 CVL 02', 29),
(95, 'Procedure manual for despatch and shipping department.', 7, 4, '2024-02-13 10:19:48', '7141', '2024-02-12 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Procedure_manual_for_despatch_and_shipping_department_', 'DSP', 'QP 8.5.4 DSP 01', 30),
(98, 'Pedoman Tentang Prosedur Mengenai Despatch and Shipping Department', 7, 4, '2024-02-16 07:36:02', '7141', NULL, '7141', 1, 'uploads/ISO_9001_2015/Pedoman_tentang_prosedur_mengenai_Despatch_and_Shipping_Department', 'DSP', 'QP 8.5.4 DSP 01B', 31),
(99, 'Procedure of Handling of Wire rod dan D-Bar.', 8, 4, '2024-02-16 07:40:12', '7141', '2024-02-15 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Procedure_of_Handling_of_Wire_rod_dan_D_Bar_', 'DSP', 'WI 8.5.4 DSP 01', 32),
(100, 'Prosedur Handling Wire rod dan D-Bar.', 8, 4, '2024-02-16 07:43:41', '7141', '2024-02-15 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_Handling_Wire_rod_dan_D_Bar_', 'DSP', 'WI 8.5.4 DSP 01B', 33),
(101, 'Procedure for stacking / storage and despatch of non-conforming producks / reject.', 8, 4, '2024-02-16 07:48:18', '7141', '2024-02-15 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Procedure_for_stacking___storage_and_despatch_of_non_conforming_producks___reject_', 'DSP', 'WI 8.5.4 DSP 02', 34),
(102, 'Prosedur untuk stacking/storage dan Despacth of non conforming produksi (avalan/reject)', 8, 4, '2024-02-16 09:46:26', '7141', '2024-02-15 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_untuk_stacking_storage_dan_Despacth_of_non_conforming_produksi__avalan_reject_', 'DSP', 'WI 8.5.4 DSP 02B', 35),
(103, 'Working Procedure of Yard Incharge.', 8, 4, '2024-02-17 02:35:14', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Working_Procedure_of_Yard_Incharge_', 'DSP', 'WI 8.5.4 DSP 03', 36),
(104, 'Prosedur kerja supervisor Despacth', 8, 4, '2024-02-17 02:36:28', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_kerja_supervisor_Despacth', 'DSP', 'WI 8.5.4 DSP 03B', 37),
(105, 'Storage plan for Wire. Rod and St. Bar.', 8, 4, '2024-02-17 02:37:28', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Storage_plan_for_Wire__Rod_and_St__Bar_', 'DSP', 'WI 8.5.4 DSP 04', 38),
(106, 'Rencana penyimpanan untuk wire rod dan ST-Bar', 8, 4, '2024-02-17 02:40:07', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Rencana_penyimpanan_untuk_wire_rod_dan_ST_Bar', 'DSP', 'WI 8.5.4 DSP 04B', 39),
(107, 'Export conduct procedure in shipping department.', 8, 4, '2024-02-17 02:43:49', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Export_conduct_procedure_in_shipping_department_', 'DSP', 'WI 8.5.4 SHP 01', 40),
(108, 'Prosedur pelaksanaan ekspor pada shpping departmen', 8, 4, '2024-02-17 02:44:34', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_pelaksanaan_ekspor_pada_shpping_departmen', 'DSP', 'WI 8.5.4 SHP 01B', 41),
(109, 'Procedure of scrap/pig iron/sponge import', 8, 4, '2024-02-17 02:45:22', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Procedure_of_scrap_pig_iron_sponge_import', 'DSP', 'WI 8.5.4 SHP 02', 42),
(110, 'Prosedur pelaksanaan import scrap/pig iron/HBI/Sponge Iron', 8, 4, '2024-02-17 02:47:40', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_pelaksanaan_import_scrap_pig_iron_HBI_Sponge_Iron', 'DSP', 'WI 8.5.4 SHP 02B', 43),
(111, 'Organization chart despatch and shipping department.', 6, 4, '2024-02-17 02:48:39', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Organization_chart_despatch_and_shipping_department_', 'DSP', 'SD 7.2.0 DSP 01', 44),
(112, 'Struktur organisasi dari department Despacth dan shpping', 6, 4, '2024-02-17 02:52:55', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Struktur_organisasi_dari_department_Despacth_dan_shpping', 'DSP', 'SD 7.2.0 DSP 01B', 45),
(113, 'Despatch and shipping quality objective and target', 6, 4, '2024-02-17 02:55:35', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Despatch_and_shipping_quality_objective_and_target', 'DSP', 'SD 6.2.0 DSP 02', 46),
(114, 'General maintenance manual for electrical department.', 7, 4, '2024-02-17 02:57:01', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/General_maintenance_manual_for_electrical_department_', 'ELC', 'QP 7.1.3 GEL 01', 47),
(115, 'Procedure for the preventive maintenance of electrical and electronic equipment device.', 8, 4, '2024-02-17 02:58:01', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Procedure_for_the_preventive_maintenance_of_electrical_and_electronic_equipment_device_', 'ELC', 'WI 7.1.3 GEL 01', 48),
(116, 'Procedure for breakdown maintenance.', 8, 4, '2024-02-17 03:00:21', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Procedure_for_breakdown_maintenance_', 'ELC', 'WI 7.1.3 GEL 02', 49),
(117, 'Procedure for carrying out repairs to electrical motors and other electrical device in winding shop.', 8, 4, '2024-02-17 03:01:25', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Procedure_for_carrying_out_repairs_to_electrical_motors_and_other_electrical_device_in_winding_shop_', 'ELC', 'WI 7.1.3 GEL 03', 50),
(118, 'Procedure for training of electrical department man power.', 8, 4, '2024-02-17 03:02:10', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Procedure_for_training_of_electrical_department_man_power_', 'ELC', 'WI 7.2.0 GEL 04', 51),
(119, 'Procedure for calibration of measuring instruments.', 8, 4, '2024-02-17 03:05:51', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Procedure_for_calibration_of_measuring_instruments_', 'ELC', 'WI 7.1.5 GEL 05', 52),
(120, 'Procedure for electrical drawings storage and control.', 8, 4, '2024-02-17 03:06:23', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Procedure_for_electrical_drawings_storage_and_control_', 'ELC', 'WI 7.5.3 GEL 06', 53),
(121, 'Electrical  Department quality objective and target', 6, 4, '2024-02-17 03:07:31', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Electrical__Department_quality_objective_and_target', 'ELC', 'WI 6.2.0 GEL 01', 54),
(122, 'Accounting system and procedures.', 7, 4, '2024-02-17 03:08:30', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Accounting_system_and_procedures_', 'FIN', 'QP 7.1.1 FIN 01', 55),
(123, 'Responsibilities of finance and accounts.', 8, 4, '2024-02-17 03:09:06', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Responsibilities_of_finance_and_accounts_', 'FIN', 'WI 7.2.0 FIN 01', 56),
(124, 'Finance department quality objctive and target', 6, 4, '2024-02-17 03:10:20', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Finance_department_quality_objctive_and_target', 'FIN', 'SD 6.2.0 FIN 02', 57),
(125, 'Staff rules.', 6, 4, '2024-02-17 03:11:02', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Staff_rules_', 'FIN', 'SD 7.1.1 FIN 01', 58),
(126, 'Administration/general affairs department quality objective and target', 6, 4, '2024-02-17 03:12:33', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Administration_general_affairs_department_quality_objective_and_target', 'GAF', 'SD 6.2.0 GAF 01', 59),
(127, 'Prosedur umum fungsional dari departemen administrasi dan general affairs.', 7, 4, '2024-02-17 03:14:33', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_umum_fungsional_dari_departemen_administrasi_dan_general_affairs_', 'GAF', 'QP 5.3.0 GAF 01', 60),
(128, 'Prosedur perijinan.', 8, 4, '2024-02-17 03:16:03', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_perijinan_', 'GAF', 'WI 5.3.0 GAF 01', 61),
(129, 'Prosedur dokumen keimigrasian.', 8, 4, '2024-02-17 03:17:11', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_dokumen_keimigrasian_', 'GAF', 'WI 5.3.0 GAF 02', 62),
(130, 'Prosedur staff dan expatriates pergi ke luar negeri.', 8, 4, '2024-02-17 03:17:45', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_staff_dan_expatriates_pergi_ke_luar_negeri_', 'GAF', 'WI 6.2.0 GAF 03', 63),
(131, 'Prosedur umum untuk dept. logistik. Termasuk semua kegiatan dan pertanggung jawabannya.', 7, 4, '2024-02-17 03:19:34', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_umum_untuk_dept__logistik__Termasuk_semua_kegiatan_dan_pertanggung_jawabannya_', 'LOG', 'QP 8.5.4 LOG 01B', 64),
(132, 'Cara penerimaan, pembongkaran dan penempatan scrap lokal.', 8, 4, '2024-02-17 03:23:22', '7141', NULL, '7141', 1, 'uploads/ISO_9001_2015/Cara_penerimaan__pembongkaran_dan_penempatan_scrap_lokal_', 'LOG', '-', 65),
(133, 'Cara penerimaan, pembongkaran dan penempatan dari scrap import.', 8, 4, '2024-02-17 03:24:08', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Cara_penerimaan__pembongkaran_dan_penempatan_dari_scrap_import_', 'LOG', 'WI 8.5.4 LOG 02B', 66),
(134, 'Proses scrap', 8, 4, '2024-02-17 03:25:45', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Proses_scrap', 'LOG', 'WI 8.5.4 LOG 03B', 67),
(135, 'Tata cara pengiriman scrap dari lapangan scrap logistics ke SMS charging pit.', 8, 4, '2024-02-17 03:26:18', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Tata_cara_pengiriman_scrap_dari_lapangan_scrap_logistics_ke_SMS_charging_pit_', 'LOG', 'WI 8.5.4 LOG 04B', 68),
(136, 'Prosedur weight bridge operation untuk pembelian dan penjualan secara continue.', 8, 4, '2024-02-17 03:27:04', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_weight_bridge_operation_untuk_pembelian_dan_penjualan_secara_continue_', 'LOG', 'WI 8.5.4 LOG 05B', 69),
(137, 'Pemeliharaan / Kalibrasi jembatan timbangan.', 8, 4, '2024-02-17 03:28:41', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Pemeliharaan___Kalibrasi_jembatan_timbangan_', 'LOG', 'WI 7.1.5 LOG 06B', 70),
(138, 'Pedoman pengolahan dan penempatan scrap.', 8, 4, '2024-02-17 03:36:51', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Pedoman_pengolahan_dan_penempatan_scrap_', 'LOG', 'WI 8.5.4 LOG 07B', 71),
(139, 'Prosedur penanganan sehubungan dengan barang mudah meledak di area scrap yard.', 8, 4, '2024-02-17 03:39:38', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_penanganan_sehubungan_dengan_barang_mudah_meledak_di_area_scrap_yard_', 'LOG', 'WI 8.5.1 LOG 08B', 72),
(140, 'Standard penerimaan scrap.', 6, 4, '2024-02-17 03:40:26', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Standard_penerimaan_scrap_', 'LOG', 'SD 8.5.1 LOG 01B', 73),
(141, 'Logistics department quality objective and target', 6, 4, '2024-02-17 03:41:58', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Logistics_department_quality_objective_and_target', 'LOG', 'SD 6.2.0 LOG 02', 74),
(142, 'Scope responsibility and authority of IT Department.', 7, 4, '2024-02-17 03:53:28', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Scope_responsibility_and_authority_of_IT_Department_', 'MIS', 'QP 7.1.3 MIS 01', 75),
(143, 'Prosedur pekerjaan perangkat lunak/ software.', 8, 4, '2024-02-17 03:54:33', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_pekerjaan_perangkat_lunak__software_', 'MIS', 'WI 7.1.3 MIS 01B', 76),
(144, 'Prosedur pekerjaan perangkat keras/ hardware.', 8, 4, '2024-02-17 04:04:57', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_pekerjaan_perangkat_keras__hardware_', 'MIS', 'WI 7.1.3 MIS 02B', 77),
(145, 'Sistem backup data.', 8, 4, '2024-02-17 04:06:08', '7141', '2024-02-16 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Sistem_backup_data_', 'MIS', 'WI 7.1.3 MIS 03B', 78),
(146, 'Prosedur training MIS Deptt.', 8, 4, '2024-02-25 02:18:28', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_training_MIS_Deptt_', 'MIS', 'WI 7.1.3 MIS 04B', 79),
(147, 'Prosedur maintenance MIS Deptt.', 8, 4, '2024-02-25 02:21:15', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Prosedur_maintenance_MIS_Deptt_', 'MIS', 'WI 7.1.3 MIS 05B', 80),
(148, 'Information technology department quality objective and target', 6, 4, '2024-02-25 02:22:38', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Information_technology_department_quality_objective_and_target', 'MIS', 'SD 6.2.0 MIS 01', 81),
(149, 'Marketing order generation and fulfillment process', 7, 4, '2024-02-25 02:28:51', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Marketing_order_generation_and_fulfillment_process', 'MKT', 'QP 8.2.2 MKT 01', 82),
(150, 'Marketing contract review and order booking for export sales', 7, 4, '2024-02-25 02:29:20', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Marketing_contract_review_and_order_booking_for_export_sales', 'MKT', 'QP 8.2.2 MKT 02', 83),
(151, 'Procedure for handling customer complaints and monitoring customer satisfaction.', 8, 4, '2024-02-25 02:31:16', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Procedure_for_handling_customer_complaints_and_monitoring_customer_satisfaction_', 'MKT', 'WI 8.2.1 MKT 01', 84),
(152, 'Marketing department guideliness for products, customer communication, order execution and feed back.', 8, 4, '2024-02-25 02:32:05', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Marketing_department_guideliness_for_products__customer_communication__order_execution_and_feed_back_', 'MKT', 'WI 8.2.1 MKT 02', 85),
(153, 'Procedure to be followed for preparing budget.', 6, 4, '2024-02-25 02:33:09', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Procedure_to_be_followed_for_preparing_budget_', 'MKT', 'SD 8.2.2 MKT 01', 86),
(154, 'Department quality objective and target', 6, 4, '2024-02-25 02:35:06', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Department_quality_objective_and_target', 'MKT', 'SD 6.2.0 MKT 02', 87),
(155, 'Maintenance practice in rolling mill.', 7, 4, '2024-02-25 02:41:13', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Maintenance_practice_in_rolling_mill_', 'MRM', 'QP 7.1.3 MRM 01', 88),
(156, 'Mechanical rolling mill quality objective and target', 6, 4, '2024-02-25 02:42:44', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Mechanical_rolling_mill_quality_objective_and_target', 'MRM', 'SD 6.2.0 MRM 01', 89),
(157, 'Maintenance procedure for BRF line A.', 8, 4, '2024-02-25 02:43:14', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Maintenance_procedure_for_BRF_line_A_', 'MRM', 'WI 7.1.3 MRM 01', 90),
(158, 'Manintenance procedure for BRF line B.', 8, 4, '2024-02-25 03:00:13', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Manintenance_procedure_for_BRF_line_B_', 'MRM', 'WI 7.1.3 MRM 02', 91),
(159, 'Manintenance procedure for rolling mill equipment of line A.', 8, 4, '2024-02-25 03:02:06', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Manintenance_procedure_for_rolling_mill_equipment_of_line_A_', 'MRM', 'WI 7.1.3 MRM 03', 92),
(160, 'Maintenance procedure the hydraulic system in the rolling mill.', 8, 4, '2024-02-25 03:02:44', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Maintenance_procedure_the_hydraulic_system_in_the_rolling_mill_', 'MRM', 'WI 7.1.3 MRM 04', 93),
(161, 'Maintenance procedure for pnumatic system.', 8, 4, '2024-02-25 03:09:15', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Maintenance_procedure_for_pnumatic_system_', 'MRM', 'WI 7.1.3 MRM 05', 94),
(162, 'Maintenance procedure for block mill area equipment line B.', 8, 4, '2024-02-25 03:18:21', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Maintenance_procedure_for_block_mill_area_equipment_line_B_', 'MRM', 'WI 7.1.3 MRM 06', 95),
(163, 'Maintenance procedure for cooling conveyor and coil collection area of line A.', 8, 4, '2024-02-25 03:24:11', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Maintenance_procedure_for_cooling_conveyor_and_coil_collection_area_of_line_A_', 'MRM', 'WI 7.1.3 MRM 07', 96),
(164, 'Maintenance procedure for coil collection area line B.', 8, 4, '2024-02-25 03:25:13', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Maintenance_procedure_for_coil_collection_area_line_B_', 'MRM', 'WI 7.1.3 MRM 08', 97),
(165, 'Maintenance procedure for the water pump and air compressor system.', 8, 4, '2024-02-25 03:25:57', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Maintenance_procedure_for_the_water_pump_and_air_compressor_system_', 'MRM', 'WI 7.1.3 MRM 09', 98),
(166, 'Maintenance procedure for lubrication oil system in the rolling mill.', 8, 4, '2024-02-25 03:26:29', '7141', '2024-02-24 17:00:00', '7141', 1, 'uploads/ISO_9001_2015/Maintenance_procedure_for_lubrication_oil_system_in_the_rolling_mill_', 'MRM', 'WI 7.1.3 MRM 10', 99);

-- --------------------------------------------------------

--
-- Table structure for table `mst_iso`
--

CREATE TABLE `mst_iso` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dt_created_date` date DEFAULT NULL,
  `vc_created_user` varchar(4) DEFAULT NULL,
  `dt_modified_date` date NOT NULL,
  `vc_modified_user` varchar(4) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mst_iso`
--

INSERT INTO `mst_iso` (`id`, `description`, `dt_created_date`, `vc_created_user`, `dt_modified_date`, `vc_modified_user`, `comp_id`, `path`) VALUES
(4, 'ISO 9001:2015', '2024-01-05', '9163', '2024-01-30', '7141', 1, 'ISO_9001_2015'),
(8, 'ISO 17025:2017', '2024-01-17', '9163', '2024-01-17', '9163', 1, 'ISO_17025_2017');

-- --------------------------------------------------------

--
-- Table structure for table `mst_lampiran`
--

CREATE TABLE `mst_lampiran` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `dt_created_date` date DEFAULT NULL,
  `vc_created_user` varchar(4) DEFAULT NULL,
  `dt_modified_date` date NOT NULL,
  `vc_modified_user` varchar(4) NOT NULL,
  `comp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `code_emp` varchar(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`code_emp`, `username`, `password`, `role`, `dep_id`, `comp_id`, `updated_at`, `created_at`) VALUES
('7141', 'sendy', 'Ispat123', 'Admin', 6, 1, '2024-01-21', '2024-01-21'),
('9163', 'dendiriki', 'ispat123', 'Admin', 8, 1, '2024-01-05', '2024-01-05'),
('9199', 'dafa', 'ispat123', 'View', 4, 1, '2024-01-05', '2024-01-05');

-- --------------------------------------------------------

--
-- Structure for view `histcatmutbaru`
--
DROP TABLE IF EXISTS `histcatmutbaru`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `histcatmutbaru`  AS SELECT `dt_histcatmut`.`comp_id` AS `comp_id`, `dt_histcatmut`.`doc_id` AS `doc_id`, max(`dt_histcatmut`.`created_at`) AS `lastdate` FROM `dt_histcatmut` GROUP BY `dt_histcatmut`.`comp_id`, `dt_histcatmut`.`doc_id` ;

-- --------------------------------------------------------

--
-- Structure for view `histcatmutlast`
--
DROP TABLE IF EXISTS `histcatmutlast`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `histcatmutlast`  AS SELECT `dt_histcatmut`.`comp_id` AS `comp_id`, `dt_histcatmut`.`doc_id` AS `doc_id`, max(`dt_histcatmut`.`tgl_berlaku`) AS `lastdate` FROM `dt_histcatmut` GROUP BY `dt_histcatmut`.`comp_id`, `dt_histcatmut`.`doc_id` ;

-- --------------------------------------------------------

--
-- Structure for view `histcoverbaru`
--
DROP TABLE IF EXISTS `histcoverbaru`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `histcoverbaru`  AS SELECT `dt_histcover`.`comp_id` AS `comp_id`, `dt_histcover`.`doc_id` AS `doc_id`, max(`dt_histcover`.`created_at`) AS `lastdate` FROM `dt_histcover` GROUP BY `dt_histcover`.`comp_id`, `dt_histcover`.`doc_id` ;

-- --------------------------------------------------------

--
-- Structure for view `histcoverlast`
--
DROP TABLE IF EXISTS `histcoverlast`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `histcoverlast`  AS SELECT `dt_histcover`.`comp_id` AS `comp_id`, `dt_histcover`.`doc_id` AS `doc_id`, max(`dt_histcover`.`tgl_berlaku`) AS `lastdate` FROM `dt_histcover` GROUP BY `dt_histcover`.`comp_id`, `dt_histcover`.`doc_id` ;

-- --------------------------------------------------------

--
-- Structure for view `histdocbaru`
--
DROP TABLE IF EXISTS `histdocbaru`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `histdocbaru`  AS SELECT `dt_histdoc`.`comp_id` AS `comp_id`, `dt_histdoc`.`doc_id` AS `doc_id`, max(`dt_histdoc`.`created_at`) AS `lastdate` FROM `dt_histdoc` GROUP BY `dt_histdoc`.`comp_id`, `dt_histdoc`.`doc_id` ;

-- --------------------------------------------------------

--
-- Structure for view `histdoclast`
--
DROP TABLE IF EXISTS `histdoclast`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `histdoclast`  AS SELECT `dt_histdoc`.`comp_id` AS `comp_id`, `dt_histdoc`.`doc_id` AS `doc_id`, max(`dt_histdoc`.`tgl_berlaku`) AS `lastdate` FROM `dt_histdoc` GROUP BY `dt_histdoc`.`comp_id`, `dt_histdoc`.`doc_id` ;

-- --------------------------------------------------------

--
-- Structure for view `histlambaru`
--
DROP TABLE IF EXISTS `histlambaru`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `histlambaru`  AS SELECT `dt_histlampiran`.`comp_id` AS `comp_id`, `dt_histlampiran`.`doc_id` AS `doc_id`, max(`dt_histlampiran`.`created_at`) AS `lastdate` FROM `dt_histlampiran` GROUP BY `dt_histlampiran`.`comp_id`, `dt_histlampiran`.`doc_id` ;

-- --------------------------------------------------------

--
-- Structure for view `histlamlast`
--
DROP TABLE IF EXISTS `histlamlast`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `histlamlast`  AS SELECT `dt_histlampiran`.`comp_id` AS `comp_id`, `dt_histlampiran`.`doc_id` AS `doc_id`, max(`dt_histlampiran`.`tgl_berlaku`) AS `lastdate` FROM `dt_histlampiran` GROUP BY `dt_histlampiran`.`comp_id`, `dt_histlampiran`.`doc_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dep`
--
ALTER TABLE `dep`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dep_company` (`com_id`);

--
-- Indexes for table `doc_dept`
--
ALTER TABLE `doc_dept`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doc_id` (`doc_id`),
  ADD KEY `dep_id` (`dep_id`);

--
-- Indexes for table `dt_histcatmut`
--
ALTER TABLE `dt_histcatmut`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doc_id` (`doc_id`),
  ADD KEY `id_sebelum` (`id_sebelum`),
  ADD KEY `vc_created_user` (`vc_created_user`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `dt_histcover`
--
ALTER TABLE `dt_histcover`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doc_id` (`doc_id`),
  ADD KEY `id_sebelum` (`id_sebelum`),
  ADD KEY `vc_created_user` (`vc_created_user`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `dt_histdoc`
--
ALTER TABLE `dt_histdoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doc_id` (`doc_id`),
  ADD KEY `id_sebelum` (`id_sebelum`),
  ADD KEY `vc_created_user` (`vc_created_user`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `dt_histlampiran`
--
ALTER TABLE `dt_histlampiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doc_id` (`doc_id`),
  ADD KEY `id_sebelum` (`id_sebelum`),
  ADD KEY `vc_created_user` (`vc_created_user`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `mst_catmut`
--
ALTER TABLE `mst_catmut`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doc_id` (`doc_id`),
  ADD KEY `vc_created_user` (`vc_created_user`),
  ADD KEY `vc_modified_user` (`vc_modified_user`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `mst_cover`
--
ALTER TABLE `mst_cover`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doc_id` (`doc_id`),
  ADD KEY `vc_created_user` (`vc_created_user`),
  ADD KEY `vc_modified_user` (`vc_modified_user`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `mst_doctype`
--
ALTER TABLE `mst_doctype`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vc_created_user` (`vc_created_user`),
  ADD KEY `vc_modified_user` (`vc_modified_user`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `mst_document`
--
ALTER TABLE `mst_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctype_id` (`doctype_id`),
  ADD KEY `iso_id` (`iso_id`),
  ADD KEY `vc_created_user` (`vc_created_user`),
  ADD KEY `vc_modified_user` (`vc_modified_user`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `mst_iso`
--
ALTER TABLE `mst_iso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vc_created_user` (`vc_created_user`),
  ADD KEY `vc_modified_user` (`vc_modified_user`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `mst_lampiran`
--
ALTER TABLE `mst_lampiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doc_id` (`doc_id`),
  ADD KEY `vc_created_user` (`vc_created_user`),
  ADD KEY `vc_modified_user` (`vc_modified_user`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`code_emp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dep`
--
ALTER TABLE `dep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `doc_dept`
--
ALTER TABLE `doc_dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `dt_histcatmut`
--
ALTER TABLE `dt_histcatmut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `dt_histcover`
--
ALTER TABLE `dt_histcover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `dt_histdoc`
--
ALTER TABLE `dt_histdoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `dt_histlampiran`
--
ALTER TABLE `dt_histlampiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `mst_doctype`
--
ALTER TABLE `mst_doctype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mst_document`
--
ALTER TABLE `mst_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `mst_iso`
--
ALTER TABLE `mst_iso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dep`
--
ALTER TABLE `dep`
  ADD CONSTRAINT `fk_dep_company` FOREIGN KEY (`com_id`) REFERENCES `company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
