CREATE TABLE equipes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pays VARCHAR(100) NOT NULL
);

CREATE TABLE stades (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    ville VARCHAR(100) NOT NULL
);

CREATE TABLE joueurs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    position VARCHAR(50) NOT NULL,
    numero_maillot TINYINT UNSIGNED NOT NULL,
    equipe_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_joueurs_equipe
        FOREIGN KEY (equipe_id) REFERENCES equipes(id)
        ON DELETE CASCADE
);

CREATE TABLE vignettes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    numero INT UNSIGNED NOT NULL,
    equipe_id INT UNSIGNED NOT NULL,
    type VARCHAR(50) NOT NULL,
    CONSTRAINT fk_vignettes_equipe
        FOREIGN KEY (equipe_id) REFERENCES equipes(id)
        ON DELETE CASCADE
);

CREATE TABLE vignettes_joueurs (
    vignette_id INT UNSIGNED PRIMARY KEY,
    joueur_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_vj_vignette
        FOREIGN KEY (vignette_id) REFERENCES vignettes(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_vj_joueur
        FOREIGN KEY (joueur_id) REFERENCES joueurs(id)
        ON DELETE CASCADE
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

-- Colombie (equipe_id = 1)
INSERT INTO joueurs (nom, prenom, position , numero_maillot, equipe_id) VALUES
('Rodriguez', 'James', 'Milieu', 10, 1),
('Sanchez', 'Davinson', 'Defenseur', 23, 1);

-- Suisse (equipe_id = 2)
INSERT INTO joueurs (nom, prenom, position , numero_maillot, equipe_id) VALUES
('Xhaka', 'Granit', 'Milieu', 10, 2),
('Sommer', 'Yann', 'Gardien', 1, 2);

INSERT INTO vignettes (numero, equipe_id, type) VALUES
(10, 1, 'joueur'),
(23, 1, 'joueur'),
(10, 2, 'joueur'),
(1, 2, 'joueur');

INSERT INTO vignettes_joueurs (vignette_id, joueur_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);