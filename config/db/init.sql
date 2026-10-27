CREATE TABLE equipes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pays VARCHAR(100) NOT NULL
);

CREATE TABLE stades (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    ville VARCHAR(100) NOT NULL
);

INSERT INTO equipes (pays) VALUES
('Colombie'),
('Suisse'),
('France'),
('Argentine');

INSERT INTO stades (nom, ville) VALUES
('MetLife Stadium', 'New York'),
('Estadio Azteca', 'Mexico City'),
('BC Place', 'Vancouver');