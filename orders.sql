--not an itemized copy--
drop table if exists orders;
drop table if exists orderStatus;

create table orders(
    id INT NOT NULL AUTO_INCREMENT,
    customerID int NOT NULL,
    deliveryAddress varchar(50),
    deliveryState int NOT NULL,
    deliveryZIP int,
    storeID int NOT NULL,
    orderDate date NOT NULL,
    orderStatus int NOT NULL,
    preferredDate date NOT NULL,
    preferredTime1 int NOT NULL,
    preferredTime2 int NOT NULL,
    PRIMARY KEY (id)
);
INSERT INTO orders(customerID,deliveryAddress,deliveryState,deliveryZIP,storeID,orderDate,orderStatus,preferredDate,preferredTime1,preferredTime2)VALUES(1,"15614 Nottingham Dr.",28,68118,4321,'17-02-17',0,'17-02-19',6,7);
INSERT INTO orders(customerID,deliveryState,storeID,orderDate,orderStatus,preferredDate,preferredTime1,preferredTime2)VALUES(1235,12,5321,'17-02-17',0,'17-02-19',5,6);

create table orderStatus(
    id int not null,
    description varchar(20) not null,
    primary KEY(id)
);
Insert into orderStatus(id,description)Values(0,"IN STORE");
Insert into orderStatus(id,description)Values(1,"IN TRANSIT");
Insert into orderStatus(id,description)Values(2,"COMPLETE");
Insert into orderStatus(id,description)Values(3,"CANCELED");
