DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS SubCats;

CREATE TABLE categories (
    id INT NOT NULL AUTO_INCREMENT,
    catName VARCHAR(40) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE SubCats(
    id INT NOT NULL AUTO_INCREMENT,
    subName VARCHAR(40) NOT NULL,
    MainCatID INT NOT NULL,
    Primary KEY(id)
);


INSERT INTO categories (catName)VALUES ('Dairy');
INSERT INTO categories (catName)VALUES ('Produce');
INSERT INTO categories (catName)VALUES ('Cleaning');
INSERT INTO categories (catName)VALUES ('Frozen');

INSERT INTO SubCats(subName,MainCatID)VALUES('Yogurt',1);
INSERT INTO SubCats(subName,MainCatID)Values('Vegetable',2);
INSERT INTO SubCats(subName,MainCatID)Values('Carpet Cleaning',3);
INSERT INTO SubCats(subName,MainCatID)Values('Pizza',4);
