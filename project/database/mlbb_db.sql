-- Tabel Tim
CREATE TABLE teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    region VARCHAR(50),
    founded_year YEAR
);

-- Tabel Role
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
);

-- Tabel Players
CREATE TABLE players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT,
    role_id INT,
    team_id INT,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabel Coaches
CREATE TABLE coaches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    experience_year INT,
    team_id INT,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabel Analysts
CREATE TABLE analysts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    specialty VARCHAR(100),
    team_id INT,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabel MPL ID
CREATE TABLE mpl_ids (
    id INT AUTO_INCREMENT PRIMARY KEY,
    peringkat INT,
    team_id INT UNIQUE,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE CASCADE ON UPDATE CASCADE
);
 
INSERT INTO teams (id, name, region, founded_year) VALUES
(1, 'RRQ Hoshi', 'Indonesia', 2017),
(2, 'Team Liquid ID', 'Indonesia', 2023),
(3, 'Bigetron Alpha', 'Indonesia', 2018);

INSERT INTO roles (id, role_name) VALUES
(1, 'EXP Laner'),
(2, 'Gold Laner'),
(3, 'Mid Laner'),
(4, 'Jungler'),
(5, 'Roamer');

-- RRQ Hoshi (team_id = 1)
INSERT INTO players (name, age, role_id, team_id) VALUES
('Dyrennn', 20, 1, 1),
('Skylar', 21, 2, 1),
('Rinz', 22, 3, 1),
('Sutsujin', 21, 4, 1),
('Idok', 24, 5, 1);

-- Team Liquid ID (team_id = 2)
INSERT INTO players (name, age, role_id, team_id) VALUES
('Faviannn', 19, 4, 2),
('Yehezkiel', 20, 3, 2),
('Widy', 21, 5, 2),
('AeronShiki', 20, 2, 2),
('Aran', 22, 1, 2);

-- Bigetron Alpha (team_id = 3)
INSERT INTO players (name, age, role_id, team_id) VALUES
('Luke', 21, 1, 3),
('EMANN', 20, 2, 3),
('Moreno', 22, 3, 3),
('Kenn', 21, 4, 3),
('Finn', 23, 5, 3);

INSERT INTO coaches (name, experience_year, team_id) VALUES
('Khezcute', 5, 1),
('SaintDeLucas', 4, 2),
('E2Max', 3, 3);

INSERT INTO analysts (name, specialty, team_id) VALUES
('NMM', 'Data Analyst Gameplay', 1),
('Zinx', 'Analisis Permainan', 2),
('Wurah', 'Drafting', 3);

INSERT INTO mpl_ids (team_id, peringkat) VALUES
(1, 1),
(2, 2),
(3, 3);


