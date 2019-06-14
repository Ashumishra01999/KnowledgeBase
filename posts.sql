-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2019 at 10:58 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kb_storage`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `resolution` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `description`, `resolution`, `user_id`) VALUES
(1, 'MacOS Flink-1.8.0 WordCount.java Issue', 'I downloaded flink-1.8.0-bin-scala_2.11.tgz from official link and installed apache-maven-3.6.1-bin.tar.gz.\r\n\r\nI have already run Flink on my Mac successfully with the command line\r\n\r\n./bin/start-cluster.sh\r\nI uploaded the flink-1.8.0/examples/batch/WordCount.jar and run successfully.\r\n\r\nI create a project in IntelliJ IDEA to learn writing codes with Flink.\r\n\r\n', 'Review Project Structure and Libraries', 2),
(2, 'how to call destructor on some of the objects in a Dynamic Array', 'I finally got around to trying placement new to create an efficient dynamic array. the purpose is to understand how it works, not to replace class vector. The constructor works. A block is allocated but uninitialized. As each element is added, it is initialized. But I don\'t see how to use placement delete to call the destructor on only those elements that exist. Can anyone explain that one? This code works for allocating the elements one by one as the array grows, but the delete is not right.\r\n\r\n\r\n\r\n\r\nI finally got around to trying placement new to create an efficient dynamic array. the purpose is to understand how it works, not to replace class vector. The constructor works. A block is allocated but uninitialized. As each element is added, it is initialized. But I don\'t see how to use placement delete to call the destructor on only those elements that exist. Can anyone explain that one? This code works for allocating the elements one by one as the array grows, but the delete is not right.\r\n\r\ntemplate<typename T>\r\nclass DynArray {\r\nprivate:\r\n  uint32_t capacity;\r\n  uint32_t size;\r\n  T* data;\r\n  void* operator new(size_t sz, T* place) {\r\n    return place;\r\n  }\r\n  void operator delete(void* p, DynArray* place) {\r\n  }\r\n\r\npublic:\r\n  DynArray(uint32_t capacity) :\r\n     capacity(capacity), size(0), data((T*)new char[capacity*sizeof(T)]) {}\r\n  void add(const T& v) {\r\n        new(data+size++) T(v);\r\n  }\r\n  ~DynArray() {\r\n     for (int i = 0; i < size; i++)\r\n       delete (this) &data[i];\r\n     delete [] (char*)data;\r\n  }\r\n};', '1\r\n\r\nYou actually found the only case (at least that I\'m aware of) where you want to invoke the destructor manually:\r\n\r\n  ~DynArray() {\r\n     for (int i = 0; i < size; i++)\r\n       data[i].~T();\r\n     delete [] (char*)data;\r\n  }\r\nCombined with a trivial class and main, you should get the expected results:\r\n\r\nstruct S {\r\n    ~S() { std::cout << __PRETTY_FUNCTION__ << \'\\n\'; }\r\n};\r\n\r\nint main() {\r\n    DynArray<S> da{10};\r\n    da.add(S{});\r\n    return 0;\r\n}\r\nNote that you see the destructor called twice since DynArray takes objects by const reference, thus it has a temporary.\r\n\r\n$./a.out \r\nS::~S()\r\nS::~S()', 2),
(3, 'Ubuntu unable to locate package', '1\r\n\r\n\r\nI have installed devstack for openstack on ubuntu system. I am trying to install quantum-lbaas-agent. I get the error Unable to locate package. I tried changing the the sources list in the /etc/apt/sources.list file. I was unable to edit it and hence I changed permissions to 777 for sources.list. I ran sudo apt-get update after changing the permission. I still get the unable to locate package error. I tried running sudo apt-get upgrade as well. Still there was no progress.\r\n\r\nHere is the output of sudo apt-get install quantum-lbaas-agent:\r\n\r\nReading package lists... Done\r\nBuilding dependency tree       \r\nReading state information... Done\r\nE: Unable to locate package quantum-lbaas-agent', 'You can do :\r\n\r\nsudo apt-get purge \r\nThis will clean up the configs which may be stopping you form installing the package', 2),
(4, 'Access variable in function which executes after setstate', 'I need to set the state in reactjs \"sync\". The way I do this is with a callback:\r\n\r\nmyFunction(){\r\n    var arr = [];\r\n\r\n    for(var i = 0 ; i > 100; i++){\r\n        arr[i] = i;\r\n    }\r\n\r\n    this.setState({\r\n        someValue: 999\r\n    }, () => {\r\n        //this.arr return undefined\r\n        return this.arr;                \r\n    });\r\n}\r\nI am almost sure this is a scoping issue. I thought if it has the arrow function it should work? I tried using \"this\" and without \"this\", but it is undefined.', '0\r\n\r\ndon\'t use var for define variables (you can read about scoping with var and let)\r\n\r\njust use let in you case problem with var i = 0', 2),
(5, 'Visual Basic 2010: How to start Windows 7 Sound Application on Recording Tab', 'I am trying to get MasterPeakValue of any connected, active microphone in Visual-Basic 2010. Using the Naudio framework I can do so for the default audio device, but for non default devices, the Windows (7) Sound App on Recording Tab has to be opened. Therefore, I am searching for a way to Open this App on this exact Tab from Visual Basic code.\r\n\r\n', 'Enble open GL', 2),
(6, 'Cannot delete Program Files to create a Symlinkâ€¦ Says I need permission from myself?', 'Trying to move my program files to a drive B: and leaving a symlink pointing to it in C:\r\n\r\nI have copied the folder, however when I try to delete the one in C:, windows says I need permission from myself to delete the folder. I have already set myself as owner and given full control. What else am I supposed to do?', 'press Start Menu(Windows Logo) and Typing regedit, run as administrator; Open:\r\n\r\nHKEY_LOCAL_MACHINE->SOFTWARE->Microsoft->Windows->CurrentVersion\r\n\r\nin the right, modify first letter from ProgramFilesDir', 2),
(7, 'Binary Data in MySQL [closed]', 'How do I store binary data in MySQL?', 'The answer by phpguy is correct but I think there is a lot of confusion in the additional details there.\r\n\r\nThe basic answer is in a BLOB data type / attribute domain. BLOB is short for Binary Large Object and that column data type is specific for handling binary data.\r\n\r\nSee the relevant manual page for MySQL.', 2),
(8, 'Calculate relative time in C#', 'Given a specific DateTime value, how do I display relative time, like:\r\n\r\n2 hours ago\r\n3 days ago\r\na month ago', 'Jeff, because Stack Overflow uses jQuery extensively, I recommend the jquery.timeago plugin.\r\n\r\nBenefits:\r\n\r\nAvoid timestamps dated \"1 minute ago\" even though the page was opened 10 minutes ago; timeago refreshes automatically.\r\nYou can take full advantage of page and/or fragment caching in your web applications, because the timestamps aren\'t calculated on the server.\r\nYou get to use microformats like the cool kids.\r\nJust attach it to your timestamps on DOM ready:\r\n\r\njQuery(document).ready(function() {\r\n    jQuery(\'abbr.timeago\').timeago();\r\n});\r\nThis will turn all abbr elements with a class of timeago and an ISO 8601 timestamp in the title:\r\n\r\n<abbr class=\"timeago\" title=\"2008-07-17T09:24:17Z\">July 17, 2008</abbr>\r\ninto something like this:\r\n\r\n<abbr class=\"timeago\" title=\"July 17, 2008\">4 months ago</abbr>\r\nwhich yields: 4 months ago. As time passes, the timestamps will automatically update.\r\n\r\nDisclaimer: I wrote this plugin, so I\'m biased.', 2),
(9, 'Percentage width child element in absolutely positioned parent on Internet Explorer 7', 'I have an absolutely positioned div containing several children, one of which is a relatively positioned div. When I use a percentage-based width on the child div, it collapses to \'0\' width on Internet Explorer 7, but not on Firefox or Safari.\r\n\r\nIf I use pixel width, it works. If the parent is relatively positioned, the percentage width on the child works.\r\n\r\nIs there something I\'m missing here?\r\nIs there an easy fix for this besides the pixel-based width on the child?\r\nIs there an area of the CSS specification that covers this?', 'The parent div needs to have a defined width, either in pixels or as a percentage. In Internet Explorer 7, the parent div needs a defined width for child percentage divs to work correctly.', 2),
(10, 'Convert Decimal to Double?', 'I want to use a track-bar to change a form\'s opacity.\r\n\r\nThis is my code:\r\n\r\ndecimal trans = trackBar1.Value / 5000;\r\nthis.Opacity = trans;\r\nWhen I build the application, it gives the following error:\r\n\r\nCannot implicitly convert type \'decimal\' to \'double\'.\r\n\r\nI tried using trans and double but then the control doesn\'t work. This code worked fine in a past VB.NET project.\r\n\r\n', 'An explicit cast to double like this isn\'t necessary:\r\n\r\ndouble trans = (double) trackBar1.Value / 5000.0;\r\nIdentifying the constant as 5000.0 (or as 5000d) is sufficient:\r\n\r\ndouble trans = trackBar1.Value / 5000.0;\r\ndouble trans = trackBar1.Value / 5000d;', 2),
(11, 'How to speed up data transfer while capturing rejected rows from tMySqlOutput?', 'I am transferring data from table in one schema to the table in another schema. I also need to record rows that get rejected in the process, due to one of the many reasons, for example, constraint of NOT NULL failing.\r\n\r\nWhen I attach the reject link with the output component, the transfer speed decreases drastically to 2-3 rows per second. On the other hand, without reject link, I can use \"Extend Insert\" option and the speed increases to 400 rows per second.\r\n\r\nHow can I capture rejected rows without compromising on the performance?\r\n', 'In my opinion there is no perfect choice : in your case I think the best thing to do is trying to catch null fields before inserting , with a tMap placed before tDBOutput : there you can have a filter on your output (\"row.field1 is not null\") , and a second output dedicated to output rejects. This way you can get your rejected data, and still be using the extended insert for better performances.', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
