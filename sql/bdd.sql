USE user1;

DROP TABLE IF EXISTS parametre;
DROP TABLE IF EXISTS cambrure;

CREATE TABLE parametre(
    id INT NOT NULL auto_increment,
    libelle VARCHAR(128),
    corde FLOAT NOT NULL,
    tmaxmm FLOAT NOT NULL,
    tmaxpercent FLOAT NOT NULL,
    fmaxmm FLOAT NOT NULL,
    fmaxpercent FLOAT NOT NULL,
    nb_points INT NOT NULL,
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
    yintra FLOAT NOT NULL,
    yextra FLOAT NOT NULL,
    id_param INT NOT NULL,
    igx FLOAT NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(id_param) REFERENCES parametre(id)
)
engine = innodb;

set autocommit = 0;
set names utf8;