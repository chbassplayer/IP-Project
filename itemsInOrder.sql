drop table if exists itemsInOrder;
CREATE TABLE itemsInOrder (
    itemID int NOT NULL,
    orderID int NOT NULL,
    quantityInOrder int NOT NULL,
    CONSTRAINT PK_itemsInOrder PRIMARY KEY (itemID,orderID)
);
--from here we can pull all Item IDs and quantity ids where an orderID=something.

INSERT INTO itemsInOrder(itemID,orderID,quantityInOrder)Values(1,1,4);
INSERT INTO itemsInOrder(itemID,orderID,quantityInOrder)Values(2,1,1);
