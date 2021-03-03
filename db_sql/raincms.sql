CREATE TABLE `cms_news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT '0',
  `shortstory` text NOT NULL,
  `longstory` text NOT NULL,
  `author` varchar(100) NOT NULL DEFAULT 'Tom',
  `date` int(11) NOT NULL DEFAULT 0,
  `type` varchar(100) NOT NULL DEFAULT '1',
  `roomid` varchar(100) NOT NULL DEFAULT '1',
  `updated` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `cms_news`
--

INSERT INTO `cms_news` (`id`, `title`, `image`, `shortstory`, `longstory`, `author`, `date`, `type`, `roomid`, `updated`) VALUES
(1, 'Welkom bij Raincms!\r\n', 'templates/images/news/22d5fe_generica2.png', 'Als je dit ziet heb je de cms goed geinstalleerd', 'Daan', 0, 'nieuws', '0', '0');
