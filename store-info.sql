DROP TABLE IF EXISTS stores;

CREATE TABLE stores (
    id INT NOT NULL AUTO_INCREMENT,
    storeName VARCHAR(40) NOT NULL,
    stateID VARCHAR(2),
    address VARCHAR(100),
    zip INT,
    MaxDelDis INT NOT NULL,
    MaxDaysInAdvance INT NOT NULL,
    TimeRestricts1 VARCHAR(10),
    TimeRestricts2 VARCHAR(10),
    email VARCHAR(100) NOT NULL,
    hashedpass VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);