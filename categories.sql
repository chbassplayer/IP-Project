DROP TABLE IF EXISTS categories;

CREATE TABLE categories (
    id INT NOT NULL AUTO_INCREMENT,
    catName VARCHAR(40) NOT NULL,
    PRIMARY KEY (id)
);