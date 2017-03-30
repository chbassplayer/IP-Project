--not an itemized copy--
drop table if exists orders;

create table orders(
    id INT NOT NULL AUTO_INCREMENT,
    customerID int NOT NULL,
    storeID int NOT NULL,
    orderDate date NOT NULL,
    orderStatus int NOT NULL,
    preferredDate date NOT NULL,
    preferredTime1 int NOT NULL,
    preferredTime2 int NOT NULL,
    PRIMARY KEY (id)
);
INSERT INTO orders(customerID,storeID,orderDate,orderStatus,preferredDate,preferredTime1,preferredTime2)VALUES(1234,4321,'17-02-17',0,'17-02-19',6,7);