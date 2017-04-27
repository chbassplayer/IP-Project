DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS SubCats;

CREATE TABLE categories (
    id INT NOT NULL AUTO_INCREMENT,
    catName VARCHAR(40) NOT NULL,
    StoreID int NOT NULL,--remember to take this out
    PRIMARY KEY (id,StoreID)
);

CREATE TABLE SubCats(
    id INT NOT NULL AUTO_INCREMENT,
    subName VARCHAR(40) NOT NULL,
    MainCatID INT NOT NULL,
    StoreID int NOT NULL,
    Primary KEY(id)
);


INSERT INTO categories (catName,StoreID)VALUES ('Dairy',1);
INSERT INTO categories (catName,StoreID)VALUES ('Produce',1);
INSERT INTO categories (catName,StoreID)VALUES ('Cleaning',1);
INSERT INTO categories (catName,StoreID)VALUES ('Frozen',1);
INSERT INTO categories (catName,StoreID)VALUES ('Frozen2',2);

INSERT INTO SubCats(subName,MainCatID,StoreID)VALUES('Yogurt',1,1);
INSERT INTO SubCats(subName,MainCatID,StoreID)Values('Vegetable',2,1);
INSERT INTO SubCats(subName,MainCatID,StoreID)Values('Carpet Cleaning',3,1);
INSERT INTO SubCats(subName,MainCatID,StoreID)Values('Pizza',4,1);
INSERT INTO SubCats(subName,MainCatID,StoreID)Values('Pizza2',4,2);
