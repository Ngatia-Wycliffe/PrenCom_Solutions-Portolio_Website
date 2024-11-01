-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2021 at 11:52 PM
-- Server version: 5.7.34
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prencoms_workscheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(30) NOT NULL,
  `parent_task` varchar(30) NOT NULL,
  `subtask_id` int(30) NOT NULL,
  `activity_name` varchar(300) NOT NULL,
  `completed` varchar(30) NOT NULL DEFAULT 'unchecked',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_id`, `parent_task`, `subtask_id`, `activity_name`, `completed`, `created`) VALUES
(40, '128', 51, 'Do This #1', 'checked', '2018-08-28 17:41:25'),
(41, '128', 51, 'Do This #2', 'checked', '2018-08-28 17:41:26'),
(42, '128', 51, 'Do This #3', 'unchecked', '2018-08-28 12:30:28'),
(43, '128', 51, 'Do This #4', 'unchecked', '2018-08-28 12:30:31'),
(44, '127', 55, 'Do This #1', 'checked', '2018-08-28 12:58:14'),
(45, '127', 55, 'Do This #2', 'checked', '2018-08-28 17:14:14'),
(46, '127', 55, 'Do This #3', 'checked', '2018-08-28 17:19:37'),
(47, '127', 55, 'Do This #6', 'checked', '2018-08-28 17:20:04'),
(48, '5', 1, 'choose specific plan', 'checked', '2018-08-29 05:50:56'),
(49, '5', 1, 'subscribe to specific plan', 'checked', '2018-08-29 05:51:00'),
(50, '5', 2, 'design layout using bootstrap templates', 'checked', '2018-08-29 05:52:28'),
(51, '5', 3, 'create alternative processor options', 'checked', '2018-08-29 05:52:33'),
(52, '5', 3, 'choose and implement one', 'checked', '2018-08-29 05:52:33'),
(53, '7', 4, 'Pick template', 'checked', '2018-08-29 05:55:25'),
(54, '7', 4, 'Add functionalites', 'unchecked', '2018-08-29 05:55:14'),
(55, '6', 5, 'Pick template', 'checked', '2018-08-29 06:41:11'),
(56, '6', 5, 'Add functionalites', 'unchecked', '2018-08-29 06:41:12'),
(57, '6', 6, 'Pick template', 'unchecked', '2018-08-29 05:58:39'),
(58, '6', 6, 'Add functionalities', 'unchecked', '2018-08-29 05:58:55'),
(59, '8', 7, 'Fetch filtered data', 'unchecked', '2018-08-29 06:07:32'),
(60, '8', 7, 'Display data on table layout', 'unchecked', '2018-08-29 06:07:45'),
(61, '8', 7, 'Filter through transactions', 'unchecked', '2018-08-29 06:08:22'),
(62, '9', 8, 'Develop back-end logic', 'checked', '2018-08-29 06:11:41'),
(63, '9', 8, 'Develop database', 'checked', '2018-08-29 06:11:45'),
(64, '9', 8, 'Select template ', 'unchecked', '2018-08-29 06:10:02'),
(65, '9', 8, 'Intergrate', 'unchecked', '2018-08-29 06:10:11'),
(66, '9', 9, 'Develop back-end logic', 'checked', '2018-08-29 06:11:43'),
(67, '9', 9, 'Develop database', 'checked', '2018-08-29 06:11:46'),
(68, '9', 9, 'Select template ', 'unchecked', '2018-08-29 06:11:01'),
(69, '9', 9, 'Intergrate', 'unchecked', '2018-08-29 06:11:10'),
(70, '10', 10, 'create pop up to display update ', 'unchecked', '2018-08-29 06:13:58'),
(72, '10', 10, 'fetch results from database', 'unchecked', '2018-08-29 06:14:19'),
(73, '10', 10, 'submit and update values', 'unchecked', '2018-08-29 06:14:28'),
(74, '11', 11, 'create Login form', 'checked', '2018-08-29 06:18:36'),
(75, '11', 11, 'create registration form', 'unchecked', '2018-08-29 06:17:27'),
(76, '11', 11, 'validate user', 'unchecked', '2018-08-29 06:17:35'),
(77, '11', 12, 'validate form input', 'checked', '2018-08-29 06:18:45'),
(78, '11', 12, 'insert user to database', 'unchecked', '2018-08-29 06:18:11'),
(79, '12', 14, 'validate email address used', 'checked', '2018-08-29 06:25:01'),
(81, '12', 14, 'send reset link to email address', 'checked', '2018-08-29 06:25:00'),
(82, '12', 15, 'redirect to password reset page', 'unchecked', '2018-08-29 06:23:48'),
(83, '12', 15, 'confirm password change', 'unchecked', '2018-08-29 06:24:02'),
(84, '12', 15, 'update table with changes', 'unchecked', '2018-08-29 06:24:13'),
(85, '15', 20, 'develop summaries', 'checked', '2018-08-29 06:35:02'),
(87, '15', 20, 'filter results', 'checked', '2018-08-29 06:35:05'),
(88, '15', 20, 'update with date and time', 'unchecked', '2018-08-29 06:33:37'),
(89, '15', 21, 'choose layout design', 'unchecked', '2018-08-29 06:34:10'),
(90, '15', 21, 'implement design', 'unchecked', '2018-08-29 06:34:23'),
(91, '16', 22, 'choose strong network ', 'unchecked', '2018-08-29 07:10:52'),
(92, '16', 22, 'finish registration details', 'unchecked', '2018-08-29 07:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `member_id` int(11) NOT NULL,
  `chat_id` int(10) NOT NULL,
  `chat` text NOT NULL,
  `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sender` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`member_id`, `chat_id`, `chat`, `sent`, `sender`) VALUES
(1, 1, 'Hey ', '2018-08-28 18:26:50', 'guy2.jpg'),
(4, 2, 'Hey there something wrong with your private chat room as well', '2018-08-28 18:28:43', 'rapper.png');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `folder` varchar(30) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `cat` char(6) NOT NULL,
  `upload_date` varchar(30) NOT NULL,
  `size` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL,
  `folder_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `folder_name`) VALUES
(3, 'chris');

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `team_id` int(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`team_id`, `email`) VALUES
(1, 'princewycliffe@gmail.com'),
(1, 'prynce@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(100) NOT NULL,
  `team_id` int(30) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `job` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `profile_pic` varchar(150) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `team_id`, `fname`, `lname`, `job`, `email`, `password`, `profile_pic`, `date_registered`) VALUES
(1, 1, 'Ngatia ', 'Wycliffe', 'Team Manager', 'prencomsolutions@gmail.com', 'Shalom5;', 'guy2.jpg', '2020-06-25 15:27:06'),
(3, 1, 'Teresa', 'Wanjiku', 'Programmer', 'teresa@gmail.com', 'teresa', 'lady1.jpg', '2018-08-29 05:38:55'),
(4, 1, 'Tyron', 'Johnson', 'Programmer', 'tyron@gmail.com', 'tyron', 'rapper.png', '2018-07-18 07:44:29'),
(5, 1, 'David', 'Wanjala', 'Programmer', 'david@gmail.com', 'david', 'guy1.jpg', '2018-08-29 05:39:13'),
(6, 1, 'James', 'Maina', 'PR Manager', 'james@gmail.com', 'james', 'guy5.jpg', '2018-08-29 07:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `member_task`
--

CREATE TABLE `member_task` (
  `member_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `team_id` int(30) NOT NULL,
  `accepted` int(2) NOT NULL,
  `scheduled_date` date NOT NULL,
  `schedule` int(30) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_task`
--

INSERT INTO `member_task` (`member_id`, `assignment_id`, `task_id`, `team_id`, `accepted`, `scheduled_date`, `schedule`) VALUES
(5, 2, 5, 1, 1, '2018-08-29', 7),
(5, 3, 7, 1, 1, '2018-08-29', 1),
(5, 4, 6, 1, 1, '2018-08-30', 1),
(4, 5, 8, 1, 1, '2018-08-31', 1),
(4, 6, 9, 1, 1, '2018-09-03', 1),
(3, 7, 10, 1, 1, '2018-08-29', 1),
(3, 8, 11, 1, 1, '2018-08-30', 1),
(3, 9, 12, 1, 1, '2018-09-01', 1),
(4, 10, 13, 1, 1, '2018-09-07', 1),
(4, 11, 15, 1, 1, '2018-09-05', 1),
(6, 12, 16, 1, 1, '2018-08-29', 1),
(3, 13, 17, 1, 1, '2018-09-15', 1),
(5, 14, 18, 1, 1, '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(30) NOT NULL,
  `sender_id` int(30) NOT NULL,
  `recipient_id` int(30) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `sender_pic` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `notification_status` int(20) NOT NULL,
  `sent_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `recipient_id`, `fname`, `lname`, `sender_pic`, `message`, `notification_status`, `sent_on`) VALUES
(9, 4, 1, 'Tyron', 'Johnson', 'rapper.png', 'Hey Boss', 1, '2018-08-27 16:45:51'),
(10, 4, 1, 'Tyron', 'Johnson', 'rapper.png', 'Hello again', 1, '2018-08-27 17:11:36'),
(11, 1, 4, 'Chris', 'Kahiga', 'guy2.jpg', 'Sorry tyron I was in a Meeting', 1, '2018-08-27 17:17:57'),
(12, 1, 4, 'Chris', 'Kahiga', 'guy2.jpg', 'Good morining', 1, '2018-08-27 18:37:55'),
(13, 4, 1, 'Tyron', 'Johnson', 'rapper.png', 'Hey', 1, '2018-08-28 13:35:51'),
(14, 1, 4, 'Chris', 'Kahiga', 'guy2.jpg', 'I think Everything is okay now', 1, '2018-08-28 18:41:14'),
(15, 5, 1, 'David', 'Wanjala', 'guy1.jpg', 'Hello Boss', 1, '2018-08-29 06:43:30'),
(16, 1, 4, 'Chris', 'Kahiga', 'guy2.jpg', 'Where have you reached on your project so far', 1, '2018-08-29 16:40:02'),
(17, 3, 1, 'Teresa', 'Wanjiku', 'lady1.jpg', 'Hey Boss', 1, '2018-10-22 11:24:38'),
(18, 5, 3, 'David', 'Wanjala', 'guy1.jpg', 'Hey there Teresiah..', 1, '2020-06-25 16:46:08'),
(19, 1, 5, 'Ngatia ', 'Wycliffe', 'guy2.jpg', 'Hey.. What\'s up', 1, '2020-11-19 00:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(30) NOT NULL,
  `notification_text` text NOT NULL,
  `sender_id` int(30) NOT NULL,
  `recipient_id` int(30) NOT NULL,
  `sent_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notification_status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subtasks`
--

CREATE TABLE `subtasks` (
  `subtask_id` int(30) NOT NULL,
  `task_id` int(30) NOT NULL,
  `subtask_name` varchar(300) NOT NULL,
  `status` varchar(100) NOT NULL,
  `completed` varchar(30) NOT NULL DEFAULT 'unchecked',
  `contribution` int(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subtasks`
--

INSERT INTO `subtasks` (`subtask_id`, `task_id`, `subtask_name`, `status`, `completed`, `contribution`, `created`) VALUES
(1, 5, 'create specific plan to pick and subscribe', '', 'checked', 32, '2018-08-29 05:51:09'),
(2, 5, 'create layout to enter credit card details', '', 'checked', 32, '2018-08-29 05:52:27'),
(3, 5, 'choose payment processor to process credi card details', '', 'checked', 32, '2018-08-29 05:52:33'),
(4, 7, 'Define process for cancelling ', '', 'unchecked', 100, '2018-08-29 05:30:13'),
(5, 6, 'Design for upgrade functionalities', '', 'checked', 48, '2018-08-29 05:59:27'),
(6, 6, 'Design for downgrade functionalities', '', 'unchecked', 50, '2018-08-29 05:57:21'),
(7, 8, 'Create Option to view  history for all transactions', '', 'unchecked', 100, '2018-08-29 06:05:57'),
(8, 9, 'Detect and warn user', '', 'unchecked', 50, '2018-08-29 06:09:10'),
(9, 9, 'Track Expiring credit cards', '', 'unchecked', 50, '2018-08-29 06:09:10'),
(10, 10, 'develop working functionality', '', 'unchecked', 100, '2018-08-29 06:13:23'),
(11, 11, 'Create Option to Login', '', 'unchecked', 33, '2018-08-29 06:16:54'),
(12, 11, 'Create Option to Register', '', 'unchecked', 33, '2018-08-29 06:16:54'),
(13, 11, 'Track all sign in Activity', '', 'unchecked', 33, '2018-08-29 06:16:54'),
(14, 12, 'confirm identity to initiate password reset request', '', 'unchecked', 50, '2018-08-29 06:21:33'),
(15, 12, 'submit new password after clicking email sent link', '', 'unchecked', 50, '2018-08-29 06:21:33'),
(16, 13, 'edit login credentials', '', 'unchecked', 25, '2018-08-29 06:28:19'),
(17, 13, 'edit profile information', '', 'unchecked', 25, '2018-08-29 06:28:19'),
(18, 13, 'alter subscription status', '', 'unchecked', 25, '2018-08-29 06:28:19'),
(19, 13, 'view billing history', '', 'unchecked', 25, '2018-08-29 06:28:19'),
(20, 15, 'create summary dates', '', 'unchecked', 50, '2018-08-29 06:32:28'),
(21, 15, 'create accordion layout', '', 'unchecked', 50, '2018-08-29 06:32:28'),
(22, 16, 'select telecomm network', '', 'unchecked', 100, '2018-08-29 07:10:32'),
(23, 18, 'Mini Log', '', 'unchecked', 100, '2019-01-11 17:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `taskfiles`
--

CREATE TABLE `taskfiles` (
  `file_id` int(30) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `task_id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taskfiles`
--

INSERT INTO `taskfiles` (`file_id`, `file_name`, `task_id`, `member_id`, `uploaded`) VALUES
(1, 'dashboard-en.jpg', 119, 0, '2018-08-27 15:36:02'),
(2, 'Performance-Evaluation1.jpg', 119, 0, '2018-08-27 15:39:38'),
(3, 'SimpleEditorVETutorial.pdf', 119, 1, '2018-08-27 15:53:16'),
(4, 'dashboard-en.jpg', 119, 4, '2018-08-27 15:53:59'),
(5, 'Mwanzo Baraka Information Database.accdb', 120, 4, '2018-08-27 20:15:45'),
(6, 'linearprogramming.pdf', 124, 1, '2018-08-28 05:27:21'),
(7, '125735-case-1-yellowbox-enterprise-winter-2017.docx', 128, 4, '2018-08-28 17:49:04'),
(8, 'Employee-Performance-Review-Checklist.jpg', 6, 5, '2018-08-29 06:47:16'),
(9, 'Worship Night.docx', 17, 0, '2018-09-15 18:26:35'),
(10, '4.2 Results.docx', 18, 0, '2019-01-11 17:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `state` int(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` date NOT NULL,
  `attachment` text NOT NULL,
  `accepted` int(5) NOT NULL,
  `accepted_on` date NOT NULL,
  `submitted` int(20) NOT NULL DEFAULT '0',
  `submitted_on` date NOT NULL,
  `approved` int(10) NOT NULL DEFAULT '0',
  `approved_on` date NOT NULL,
  `progress` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `member_id`, `project_id`, `title`, `comment`, `state`, `date_created`, `due_date`, `attachment`, `accepted`, `accepted_on`, `submitted`, `submitted_on`, `approved`, `approved_on`, `progress`) VALUES
(5, 1, 0, 'Design pricing table to view multiple subscription', '', 2, '2018-08-29 05:19:45', '2018-09-03', '', 2, '2018-08-29', 1, '2018-08-29', 1, '2018-08-29', 100),
(6, 1, 0, 'Create Upgrade or downgrade subscriptions', '', 1, '2018-08-29 05:19:58', '2018-08-30', '', 2, '2018-08-29', 0, '0000-00-00', 0, '0000-00-00', 24),
(7, 1, 0, 'Design for cancelation of subscriptions', '', 1, '2018-08-29 05:20:06', '2018-09-10', '', 2, '2018-08-29', 0, '0000-00-00', 0, '0000-00-00', 50),
(8, 1, 0, ' Implement saving of invoices for all transactions', '', 1, '2018-08-29 05:20:18', '2018-09-03', '', 2, '2018-08-29', 0, '0000-00-00', 0, '0000-00-00', 0),
(9, 1, 0, 'Formulate method to detect and track expiring credit cards', '', 1, '2018-08-29 05:20:28', '2018-09-03', '', 2, '2018-08-29', 0, '0000-00-00', 0, '0000-00-00', 25),
(10, 1, 0, 'Create option to update credit card information', '', 1, '2018-08-29 05:20:42', '2018-09-10', '', 2, '2018-08-29', 0, '0000-00-00', 0, '0000-00-00', 0),
(11, 1, 0, 'Develop user identification module', '', 1, '2018-08-29 05:20:51', '2018-09-24', '', 2, '2018-08-29', 0, '0000-00-00', 0, '0000-00-00', 17),
(12, 1, 0, 'create option to reset password', '', 1, '2018-08-29 05:21:01', '2018-09-05', '', 2, '2018-08-29', 0, '0000-00-00', 0, '0000-00-00', 50),
(13, 1, 0, 'Develop account management module', '', 1, '2018-08-29 05:21:15', '2018-09-12', '', 2, '2018-08-29', 0, '0000-00-00', 0, '0000-00-00', 0),
(14, 1, 0, 'Create option to place bets by wagering coins', '', 0, '2018-08-29 05:21:45', '0000-00-00', '', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0),
(15, 1, 0, 'Create bet history to show life time bet history', '', 1, '2018-08-29 05:21:55', '2018-09-29', '', 2, '2018-08-29', 0, '0000-00-00', 0, '0000-00-00', 33),
(16, 1, 0, 'Setup customer call line', '', 1, '2018-08-29 07:09:02', '2018-09-05', '', 2, '2018-08-29', 0, '0000-00-00', 0, '0000-00-00', 0),
(17, 1, 0, 'Bubbling', 'Urgent', 1, '2018-09-15 18:23:59', '2018-09-16', '', 2, '2018-09-15', 0, '0000-00-00', 0, '0000-00-00', 0),
(18, 1, 0, 'Logo Design', 'I sent you a task', 1, '2019-01-11 17:50:07', '2019-01-30', '', 2, '2019-01-11', 0, '0000-00-00', 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(30) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `member_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `member_id`) VALUES
(1, 'Unik Web Developers', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `team_id_2` (`team_id`),
  ADD KEY `team_id_3` (`team_id`),
  ADD KEY `team_id_4` (`team_id`);

--
-- Indexes for table `member_task`
--
ALTER TABLE `member_task`
  ADD PRIMARY KEY (`assignment_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `subtasks`
--
ALTER TABLE `subtasks`
  ADD PRIMARY KEY (`subtask_id`);

--
-- Indexes for table `taskfiles`
--
ALTER TABLE `taskfiles`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `member_id_2` (`member_id`),
  ADD KEY `member_id_3` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `member_task`
--
ALTER TABLE `member_task`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subtasks`
--
ALTER TABLE `subtasks`
  MODIFY `subtask_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `taskfiles`
--
ALTER TABLE `taskfiles`
  MODIFY `file_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
