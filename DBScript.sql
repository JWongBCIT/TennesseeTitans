DROP TABLE IF EXISTS `league`;
CREATE TABLE IF NOT EXISTS `league` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(64) NOT NULL,
    `code` varchar(3) NOT NULL,
    `city` varchar(64) NOT NULL,
    `conference` varchar(64) NOT NULL,
    `division` varchar(64) NOT NULL,
    `filename` varchar(256) NOT NULL,
    `wins` int(3),
    `losses` int(3),
    `ties` int(3),
    `netpoints` int(3),
    PRIMARY KEY (id)
);

INSERT INTO `league` (`name`,`code`,`city`,`conference`, `division`, `filename`) VALUES
('Buffalo Bills', 'BUF','Buffalo', 'American Football Conference', 'AFC East', 'AFC_East.jpg'),
('Miami Dolphins', 'MIA', 'Miami', 'American Football Conference', 'AFC East', 'AFC_East.jpg'),
('New England Patriots', 'NE', 'New England', 'American Football Conference', 'AFC East', 'AFC_East.jpg'),
('New York Jets', 'NYJ', 'New York', 'American Football Conference', 'AFC East', 'AFC_East.jpg'),

('Baltimore Ravens', 'BAL', 'Baltimore', 'American Football Conference', 'AFC North', 'AFC_North.jpg'),
('Cincinnati Bengals', 'CIN', 'Cincinnati', 'American Football Conference', 'AFC North', 'AFC_North.jpg'),
('Cleveland Browns', 'CLE', 'Cleveland', 'American Football Conference', 'AFC North', 'AFC_North.jpg'),
('Pittsburgh Steelers', 'PIT', 'Pittsburgh', 'American Football Conference', 'AFC North', 'AFC_North.jpg'),

('Houston Texans', 'HOU', 'Houston', 'American Football Conference', 'AFC South', 'AFC_South.jpg'),
('Indianapolis Colts', 'IND', 'Indianapolis', 'American Football Conference', 'AFC South', 'AFC_South.jpg'),
('Jacksonville Jaguars', 'JAC', 'Jacksonville', 'American Football Conference', 'AFC South', 'AFC_South.jpg'),
('Tennessee Titans', 'TEN', 'Tennessee', 'American Football Conference', 'AFC South', 'AFC_South.jpg'),

('Denver Broncos', 'DEN', 'Denver', 'American Football Conference', 'AFC West', 'AFC_West.jpg'),
('Kansas City Chiefs', 'KC', 'Kansas City', 'American Football Conference', 'AFC West', 'AFC_West.jpg'),
('Oakland Raiders', 'OAK', 'Oakland', 'American Football Conference', 'AFC West', 'AFC_West.jpg'),
('San Diego Chargers', 'SD', 'San Diego', 'American Football Conference', 'AFC West', 'AFC_West.jpg'),

('Dallas Cowboys', 'DAL', 'Dallas', 'National Football Conference', 'NFC East', 'NFC_East.jpg'),
('New York Giants', 'NYG', 'New York', 'National Football Conference', 'NFC East', 'NFC_East.jpg'),
('Philadelphia Eagles', 'PHI', 'Philadelphia', 'National Football Conference', 'NFC East', 'NFC_East.jpg'),
('Washington Redskins', 'WAS', 'Washington', 'National Football Conference', 'NFC East', 'NFC_East.jpg'),

('Chicago Bears', 'CHI', 'Chicago', 'National Football Conference', 'NFC North', 'NFC_North.jpg'),
('Detroit Lions', 'DET', 'Detroit', 'National Football Conference', 'NFC North', 'NFC_North.jpg'),
('Green Bay Packers', 'GB', 'Green Bay', 'National Football Conference', 'NFC North', 'NFC_North.jpg'),
('Minnesota Vikings', 'MIN', 'Minnesota', 'National Football Conference', 'NFC North', 'NFC_North.jpg'),

('Atlanta Falcons', 'ATL', 'Atlanta', 'National Football Conference', 'NFC South', 'NFC_South.jpg'),
('Carolina Panthers', 'CAR', 'Carolina', 'National Football Conference', 'NFC South', 'NFC_South.jpg'),
('New Orleans Saints', 'NO', 'New Orleans', 'National Football Conference', 'NFC South', 'NFC_South.jpg'),
('Tampa Bay Buccaneers', 'TB', 'Tampa Bay', 'National Football Conference', 'NFC South', 'NFC_South.jpg'),

('Arizona Cardinals', 'ARI', 'Arizona', 'National Football Conference', 'NFC West', 'NFC_West.jpg'),
('San Francisco 49ers', 'SF', 'San Francisco', 'National Football Conference', 'NFC West', 'NFC_West.jpg'),
('Seattle Seahawks', 'SEA', 'Seattle', 'National Football Conference', 'NFC West', 'NFC_West.jpg'),
('St. Louis Rams', 'STL', 'St. Louis', 'National Football Conference', 'NFC West', 'NFC_West.jpg');

DROP TABLE IF EXISTS `roster`;
CREATE TABLE IF NOT EXISTS `roster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `number` int(3) NOT NULL,
  `position` varchar(3) NOT NULL,
  `mugshot` varchar(64) NOT NULL,
   PRIMARY KEY (id)
);

INSERT INTO `roster` (`surname`, `firstname`, `number`, `position`, 
`mugshot`) VALUES
('Andrews', 'Antonio', 26, 'RB', 'mugshot_1.jpg'),
('Bass', 'David', 51, 'LB', 'mugshot_2.jpg'),
('Bell', 'Byron', 76, 'T', 'mugshot_3.jpg'),
('Blackson', 'Angelo', 95, 'DT', 'mugshot_4.jpg'),
('Brinkley', 'Beau', 48, 'LS', 'mugshot_5.jpg'),
('Brown', 'Zach', 55, 'LB', 'mugshot_6.jpg'),
('Casey', 'Jurrell', 99, 'DT', 'mugshot_7.jpg'),
('Coffman', 'Chase', 85, 'TE', 'mugshot_8.jpg'),
('Cox', 'Perrish', 29, 'CB', 'mugshot_9.jpg'),
('Fasano', 'Harry', 80, 'TE', 'mugshot_10.jpg'),
('Fowler', 'Jalston', 45, 'FB', 'mugshot_1.jpg'),
('Gallik', 'Andy', 69, 'C', 'mugshot_2.jpg'),
('Green-Beckham', 'Dorial', 17, 'WR', 'mugshot_3.jpg'),
('Griffin', 'Michael', 33, 'S', 'mugshot_4.jpg'),
('Hill', 'Sammie', 94, 'NT', 'mugshot_5.jpg'),
('Huff', 'Marqueston', 28, 'DB', 'mugshot_6.jpg'),
('Hunter', 'Justin', 15, 'WR', 'mugshot_7.jpg'),
('Johnson', 'Steven', 52, 'MLB', 'mugshot_8.jpg'),
('Jones', 'QaQuan', 90, 'DL', 'mugshot_9.jpg'),
('Kern', 'Brett', 6, 'P', 'mugshot_10.jpg'),
('Klug', 'Karl', 97, 'DL', 'mugshot_1.jpg'),
('Lewan', 'Taylor', 77, 'P', 'mugshot_2.jpg'),
('Mariota', 'Marcus', 8, 'DL', 'mugshot_3.jpg'),
('Martin', 'Mike', 93, 'T', 'mugshot_4.jpg'),
('McCluster', 'Dexter', 22, 'QB', 'mugshot_5.jpg'),
('McCourty', 'Jason', 30, 'DL', 'mugshot_6.jpg'),
('Meredith', 'Jamon', 79, 'RB', 'mugshot_7.jpg'),
('Mettenberger', 'Zach', 7, 'CB', 'mugshot_8.jpg'),
('Morgan', 'Derrick', 91, 'T', 'mugshot_9.jpg'),
('Mount', 'Deiontrex', 53, 'QB', 'mugshot_10.jpg'),
('Orakpo', 'Brian', 98, 'OLB', 'mugshot_1.jpg'),
('Pitoitua', 'Ropati', 92, 'OLB', 'mugshot_2.jpg'),
('Poutasi', 'Jeremiah', 72, 'OLB', 'mugshot_3.jpg'),
('Riggs', 'Cody', 37, 'DE', 'mugshot_4.jpg'),
('Sankey', 'Bishop', 20, 'T', 'mugshot_5.jpg'),
('Schwenke', 'Brian', 62, 'RB', 'mugshot_6.jpg'),
('Searcy', 'Da Narris', 21, 'C', 'mugshot_7.jpg'),
('Sensabaugh', 'Coty', 24, 'S', 'mugshot_8.jpg'),
('Spain', 'Quinton', 60, 'CB', 'mugshot_9.jpg'),
('Stafford', 'Daimion', 39, 'G', 'mugshot_10.jpg'),
('Stevens', 'Craig', 88, 'S', 'mugshot_1.jpg'),
('Succop', 'Ryan', 4, 'T', 'mugshot_2.jpg'),
('Supernaw', 'Phillip', 89, 'K', 'mugshot_3.jpg'),
('Walker', 'Delanie', 82, 'TE', 'mugshot_4.jpg'),
('Warmack', 'Chance', 70, 'TE', 'mugshot_5.jpg'),
('West', 'Terrance', 35, 'G', 'mugshot_6.jpg'),
('Whitehurst', 'Charlie', 12, 'RB', 'mugshot_7.jpg'),
('Williamson', 'Avery', 54, 'QB', 'mugshot_8.jpg'),
('Woods', 'Al', 96, 'LB', 'mugshot_9.jpg'),
('Woodyard', 'Wesley', 59, 'DL', 'mugshot_10.jpg'),
('Wreh-Wilson', 'Blidi', 25, 'LB', 'mugshot_1.jpg'),
('Wright', 'Kendall', 13, 'CB', 'mugshot_2.jpg');

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
    `home` varchar(3) NOT NULL,
    `away` varchar(3) NOT NULL,
    `score` varchar(5) NOT NULL,
    `date` varchar(8) NOT NULL,
    `inserted` datetime DEFAULT CURRENT_TIMESTAMP
);