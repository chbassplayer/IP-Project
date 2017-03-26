drop table if exists itemsInOrder;
CREATE TABLE itemsInOrder (
    itemID int NOT NULL,
    orderID int NOT NULL,
    quantityInOrder int NOT NULL,
    CONSTRAINT PK_itemsInOrder PRIMARY KEY (itemID,orderID)
);