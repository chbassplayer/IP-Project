DROP TABLE IF EXISTS customers;

CREATE TABLE customers (
    id INT NOT NULL AUTO_INCREMENT,
    fname VARCHAR(40),
    lname VARCHAR(40),
    address VARCHAR(100),
    stateID VARCHAR(2),
    zip INT,
    email VARCHAR(100) NOT NULL,
    hashedpass VARCHAR(255),
    PRIMARY KEY (id)
);