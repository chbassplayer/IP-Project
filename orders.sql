--not an itemized copy--
drop table =u7-67-==if exists orders;

create table orders(
    id INT NOT NULL AUTO_INCREMENT,
    customerID int NOT NULL,
    storeID int NOT NULL,
    orderDate date NOT NULL,
    orderStatus int NOT NULL,
    preferredDate date NOT NULL,
    preferredTime time NOT NULL,
    cartID int NOT NULL,
    PRIMARY KEY (id)
);