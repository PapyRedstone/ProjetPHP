USE user1;

DROP TABLE IF EXISTS cambrure;
DROP TABLE IF EXISTS parametre;

CREATE TABLE parametre(
    id INT NOT NULL auto_increment,
    libelle VARCHAR(128),
    corde FLOAT NOT NULL,
    tMaxmm FLOAT NOT NULL,
    tMaxPercent FLOAT NOT NULL,
    fMaxmm FLOAT NOT NULL,
    fMaxPercent FLOAT NOT NULL,
    nbPoints INT NOT NULL,
    date DATETIME,
    fic_img VARCHAR(128),
    fic_csv VARCHAR(128),

    PRIMARY KEY(id)
)
engine = innodb;

CREATE TABLE cambrure(
    id INT NOT NULL auto_increment,
    x FLOAT NOT NULL,
    t FLOAT NOT NULL,
    f FLOAT NOT NULL,
    id_param INT NOT NULL,
    yIntrados FLOAT NOT NULL,
    yExtrados FLOAT NOT NULL,
    idParametre INT NOT NULL,
    igX FLOAT NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(id_param) REFERENCES parametre(id)
)
engine = innodb;

set autocommit = 0;
set names utf8;
