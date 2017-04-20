DROP Table if exists cardType;

create table cardType(
    id INT NOT NULL AUTO_INCREMENT,
    CardName VARCHAR(20) NOT NULL,
    PRIMARY KEY(id)
);

Insert into cardType(CardName)Values('Visa');
Insert into cardType(CardName)Values('Mastercard');
Insert into cardType(CardName)Values('American Express');
Insert into cardType(CardName)Values('Discover');

