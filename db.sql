-- --------------------------------------------------------
-- Hoszt:                        127.0.0.1
-- Szerver verzió:               PostgreSQL 14.6 on x86_64-pc-linux-musl, compiled by gcc (Alpine 11.2.1_git20220219) 11.2.1 20220219, 64-bit
-- Szerver OS:                   
-- HeidiSQL Verzió:              12.2.0.6576
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES  */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Tábla adatainak mentése public.toilet: 20 rows
/*!40000 ALTER TABLE "toilet" DISABLE KEYS */;
INSERT IGNORE INTO "toilet" ("id", "type", "address", "gps_coordinates", "price", "opening_times", "is_accessible", "comments", "isaccepted") VALUES
	(2, 'Nyilvános', ' Zechmeister u. 1', '47.686103274432526,17.630719186237123', 200, 'H-V 0-24', 'true', '(Virágpiac)', 'true'),
	(3, 'Nyilvános', ' Baross Gábor út 35', '47.684515600409064,17.634997736419123', 200, 'H-P 8-20; SZO 8-18; V 10-18', 'false', '(Sétálóutca Városháza felőli elején)', 'true'),
	(4, 'Nyilvános', ' Szabadsajtó u. 24', '47.68802787177609,17.633553995530693', 200, 'H-SZO 8-18', 'false', '(Széchenyi tér)', 'true'),
	(5, 'Nyilvános', ' Dunakapu tér', '47.690034702340284,17.632935933106744', 20, 'H-SZO 10-20; V 10-18', 'true', '(Dunakapu mélygarázs)', 'true'),
	(6, 'Nyilvános', ' Bisinger József stny. 15', '47.68482498434725,17.63871039005709', 200, 'H-V 6-22', 'true', '(Bisinger sétány)', 'true'),
	(7, 'Nyilvános', ' Eötvös park', '47.68141170995319,17.630807182249413', 200, 'H-V 6-22', 'true', '(Eötvös park)', 'true'),
	(8, 'Nyilvános', ' Bem tér 14', '47.67793173067568,17.634764865841515', 200, 'H-V 6-22', 'true', '(Bem tér)', 'true'),
	(9, 'Nyilvános', ' Álmos u. 21', '47.67916914475014,17.643672612819365', 200, 'H-V 6-22', 'true', '(Malom liget)', 'true'),
	(10, 'Nyilvános', ' Ifjúság krt. 91', '47.67077154900637,17.655615265960968', 200, 'H-V 6-22', 'true', '(Adyvárosi tó mellett)', 'true'),
	(11, 'Magán', ' Budai út 1', '47.69054022611017,17.64457185172739', 50, 'H-SZO 9-20; V 10-18', 'false', 'Földszint', 'true'),
	(12, 'Magán', ' Budai út 1', '47.69064607737905,17.64438780310869', 50, 'H-SZO 9-20; V 10-18', 'true', 'Emelet', 'true'),
	(13, 'Magán', ' Budai út 1', '47.69012811319212,17.64430664019338', 50, 'H-SZO 9-20; V 10-18', 'true', 'Földszint', 'true'),
	(14, 'Magán', ' Budai út 1', '47.69012811319212,17.64430664019338', 50, 'H-SZO 9-20; V 10-18', 'true', 'Emelet', 'true'),
	(15, 'Nyilvános', ' Révai Miklós utca 4', '47.68217040231239,17.634522047641568', 200, 'H-V 5:40-20:15', 'false', 'Aluljárószinten (Vasútállomás)', 'true'),
	(16, 'Magán', ' Baross Gábor út 23', '47.686084195962344,17.63413046969159', 200, 'H-CS 7-23; P 7-24; SZO 0-2; 7-24; V 0-2; 8-23;', 'false', 'Főbejárat után jobbra (McDonald''s)', 'true'),
	(17, 'Magán', ' Vasvári Pál u. 1', '47.66994222099452,17.64908002321328', 0, 'H-V 7-23', 'true', '(McDonald''s)', 'true'),
	(18, 'Magán', ' Pápai út 2856/3. Hrsz', '47.65676224968703,17.634896176254674', 0, 'H-V 7-23', 'true', '(McDonald''s)', 'true'),
	(19, 'Nyilvános', ' Vasvári Pál u. 4', '47.67014107813979,17.648106110112682', 200, 'H-V 0-24', 'true', '(Dr. Pezt Lajos Parkolóház)', 'true'),
	(20, 'Magán', ' Vasvári Pál u. 1', '47.66947567752465,17.65112281757871', 0, 'H-SZO 9-20; V 10-18', 'true', '(Győr Pláza)', 'true'),
	(21, 'Magán', ' Baross Gábor út 24', '47.68570589720944,17.633939038805497', 200, 'H-CS 8-21:30; P-SZO 8-24', 'false', 'Kód a Blokkon (KFC Baross út)', 'true');
/*!40000 ALTER TABLE "toilet" ENABLE KEYS */;

-- Tábla adatainak mentése public.user: 5 rows
/*!40000 ALTER TABLE "user" DISABLE KEYS */;
INSERT IGNORE INTO "user" ("id", "email", "roles", "password") VALUES
	(1, 'rqweqwe', '[]', '$2y$13$ISkpCF/UGUmrtuOTq4qG/udBr106xPpkMnLJ2AeJIoXoj5SgWSEPW'),
	(3, 'ee@gmail.com', '[]', '$2y$13$cOGvZOG3VkY0fsLT8SmcH.LxUYlNFMU4Kg9tDYFcKm9zEtWw7d4me'),
	(2, 'richardkohegyi@gmail.com', '["ROLE_ADMIN"]', '$2y$13$9UVNMSsrBhMUlBOzgaAEnO3EUPrRLkrKJJRhaDFm5CQvwtcjQqeNa'),
	(4, 'richaeeqrdkohegyi@gmail.com', '[]', '$2y$13$6NJ3n61tkeLS4JXiiMhtx.V2pQNjhya5tu1tWYszjj3tRrviDKkTW'),
	(5, 'richardkoheeegyi@gmail.com', '[]', '$2y$13$RxwyYa6fFQqwSRXJSCj8CeBsjI.hyAauZHgE44Y6953S16dlo0DOO');
/*!40000 ALTER TABLE "user" ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
