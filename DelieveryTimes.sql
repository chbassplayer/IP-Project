DROP TABLE IF EXISTS DeliveryTime;
DROP TABLE IF EXISTS DeliveryTime2;
CREATE TABLE DeliveryTime(
    id int NOT NULL Auto_Increment,
    military Time,
    clock Varchar(15) NOT NULL,
    Primary Key(id)
);

Insert into DeliveryTime (military,clock) Values('00:00:00','12:00 AM');
Insert into DeliveryTime (military,clock) Values('00:30:00','12:30 AM');
Insert into DeliveryTime (military,clock) Values('01:00:00','1:00 AM');
Insert into DeliveryTime (military,clock) Values('01:30:00','1:30 AM');
Insert into DeliveryTime (military,clock) Values('02:00:00','2:00 AM');
Insert into DeliveryTime (military,clock) Values('02:30:00','2:30 AM');
Insert into DeliveryTime (military,clock) Values('03:00:00','3:00 AM');
Insert into DeliveryTime (military,clock) Values('03:30:00','3:30 AM');
Insert into DeliveryTime (military,clock) Values('04:00:00','4:00 AM');
Insert into DeliveryTime (military,clock) Values('04:30:00','4:30 AM');
Insert into DeliveryTime (military,clock) Values('05:00:00','5:00 AM');
Insert into DeliveryTime (military,clock) Values('05:30:00','5:30 AM');
Insert into DeliveryTime (military,clock) Values('06:00:00','6:00 AM');
Insert into DeliveryTime (military,clock) Values('06:30:00','6:30 AM');
Insert into DeliveryTime (military,clock) Values('07:00:00','7:00 AM');
Insert into DeliveryTime (military,clock) Values('07:30:00','7:30 AM');
Insert into DeliveryTime (military,clock) Values('08:00:00','8:00 AM');
Insert into DeliveryTime (military,clock) Values('08:30:00','8:30 AM');
Insert into DeliveryTime (military,clock) Values('09:00:00','9:00 AM');
Insert into DeliveryTime (military,clock) Values('09:30:00','9:30 AM');
Insert into DeliveryTime (military,clock) Values('10:00:00','10:00 AM');
Insert into DeliveryTime (military,clock) Values('10:30:00','10:30 AM');
Insert into DeliveryTime (military,clock) Values('11:00:00','11:00 AM');
Insert into DeliveryTime (military,clock) Values('11:30:00','11:30 AM');
Insert into DeliveryTime (military,clock) Values('12:00:00','12:00 PM');
Insert into DeliveryTime (military,clock) Values('12:30:00','12:30 PM');
Insert into DeliveryTime (military,clock) Values('13:00:00','1:00 PM');
Insert into DeliveryTime (military,clock) Values('13:30:00','1:30 PM');
Insert into DeliveryTime (military,clock) Values('14:00:00','2:00 PM');
Insert into DeliveryTime (military,clock) Values('14:30:00','2:30 PM');
Insert into DeliveryTime (military,clock) Values('15:00:00','3:00 PM');
Insert into DeliveryTime (military,clock) Values('15:30:00','3:30 PM');
Insert into DeliveryTime (military,clock) Values('16:00:00','4:00 PM');
Insert into DeliveryTime (military,clock) Values('16:30:00','4:30 PM');
Insert into DeliveryTime (military,clock) Values('17:00:00','5:00 PM');
Insert into DeliveryTime (military,clock) Values('17:30:00','5:30 PM');
Insert into DeliveryTime (military,clock) Values('18:00:00','6:00 PM');
Insert into DeliveryTime (military,clock) Values('18:30:00','6:30 PM');
Insert into DeliveryTime (military,clock) Values('19:00:00','7:00 PM');
Insert into DeliveryTime (military,clock) Values('19:30:00','7:30 PM');
Insert into DeliveryTime (military,clock) Values('20:00:00','8:00 PM');
Insert into DeliveryTime (military,clock) Values('20:30:00','8:30 PM');
Insert into DeliveryTime (military,clock) Values('21:00:00','9:00 PM');
Insert into DeliveryTime (military,clock) Values('21:30:00','9:30 PM');
Insert into DeliveryTime (military,clock) Values('22:00:00','10:00 PM');
Insert into DeliveryTime (military,clock) Values('22:30:00','10:30 PM');
Insert into DeliveryTime (military,clock) Values('23:00:00','11:00 PM');
Insert into DeliveryTime (military,clock) Values('23:30:00','11:30 PM');
CREATE TABLE DeliveryTime2(
    id int NOT NULL Auto_Increment,
    military Time,
    clock Varchar(15) NOT NULL,
    Primary Key(id)
);
Insert into DeliveryTime2 (military,clock) Values('00:00:00','12:00 AM');
Insert into DeliveryTime2 (military,clock) Values('00:30:00','12:30 AM');
Insert into DeliveryTime2 (military,clock) Values('01:00:00','1:00 AM');
Insert into DeliveryTime2 (military,clock) Values('01:30:00','1:30 AM');
Insert into DeliveryTime2 (military,clock) Values('02:00:00','2:00 AM');
Insert into DeliveryTime2 (military,clock) Values('02:30:00','2:30 AM');
Insert into DeliveryTime2 (military,clock) Values('03:00:00','3:00 AM');
Insert into DeliveryTime2 (military,clock) Values('03:30:00','3:30 AM');
Insert into DeliveryTime2 (military,clock) Values('04:00:00','4:00 AM');
Insert into DeliveryTime2 (military,clock) Values('04:30:00','4:30 AM');
Insert into DeliveryTime2 (military,clock) Values('05:00:00','5:00 AM');
Insert into DeliveryTime2 (military,clock) Values('05:30:00','5:30 AM');
Insert into DeliveryTime2 (military,clock) Values('06:00:00','6:00 AM');
Insert into DeliveryTime2 (military,clock) Values('06:30:00','6:30 AM');
Insert into DeliveryTime2 (military,clock) Values('07:00:00','7:00 AM');
Insert into DeliveryTime2 (military,clock) Values('07:30:00','7:30 AM');
Insert into DeliveryTime2 (military,clock) Values('08:00:00','8:00 AM');
Insert into DeliveryTime2 (military,clock) Values('08:30:00','8:30 AM');
Insert into DeliveryTime2 (military,clock) Values('09:00:00','9:00 AM');
Insert into DeliveryTime2 (military,clock) Values('09:30:00','9:30 AM');
Insert into DeliveryTime2 (military,clock) Values('10:00:00','10:00 AM');
Insert into DeliveryTime2 (military,clock) Values('10:30:00','10:30 AM');
Insert into DeliveryTime2 (military,clock) Values('11:00:00','11:00 AM');
Insert into DeliveryTime2 (military,clock) Values('11:30:00','11:30 AM');
Insert into DeliveryTime2 (military,clock) Values('12:00:00','12:00 PM');
Insert into DeliveryTime2 (military,clock) Values('12:30:00','12:30 PM');
Insert into DeliveryTime2 (military,clock) Values('13:00:00','1:00 PM');
Insert into DeliveryTime2 (military,clock) Values('13:30:00','1:30 PM');
Insert into DeliveryTime2 (military,clock) Values('14:00:00','2:00 PM');
Insert into DeliveryTime2 (military,clock) Values('14:30:00','2:30 PM');
Insert into DeliveryTime2 (military,clock) Values('15:00:00','3:00 PM');
Insert into DeliveryTime2 (military,clock) Values('15:30:00','3:30 PM');
Insert into DeliveryTime2 (military,clock) Values('16:00:00','4:00 PM');
Insert into DeliveryTime2 (military,clock) Values('16:30:00','4:30 PM');
Insert into DeliveryTime2 (military,clock) Values('17:00:00','5:00 PM');
Insert into DeliveryTime2 (military,clock) Values('17:30:00','5:30 PM');
Insert into DeliveryTime2 (military,clock) Values('18:00:00','6:00 PM');
Insert into DeliveryTime2 (military,clock) Values('18:30:00','6:30 PM');
Insert into DeliveryTime2 (military,clock) Values('19:00:00','7:00 PM');
Insert into DeliveryTime2 (military,clock) Values('19:30:00','7:30 PM');
Insert into DeliveryTime2 (military,clock) Values('20:00:00','8:00 PM');
Insert into DeliveryTime2 (military,clock) Values('20:30:00','8:30 PM');
Insert into DeliveryTime2 (military,clock) Values('21:00:00','9:00 PM');
Insert into DeliveryTime2 (military,clock) Values('21:30:00','9:30 PM');
Insert into DeliveryTime2 (military,clock) Values('22:00:00','10:00 PM');
Insert into DeliveryTime2 (military,clock) Values('22:30:00','10:30 PM');
Insert into DeliveryTime2 (military,clock) Values('23:00:00','11:00 PM');
Insert into DeliveryTime2 (military,clock) Values('23:30:00','11:30 PM');


