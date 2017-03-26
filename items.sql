 --the goal here is to be able to show the database of items the store holds
 
drop table if exists items;

create table items(
ID int unsigned not null auto_increment,
Categor varchar(30) not null,
Nam varchar(30) not null,
Brand varchar(30) not null, 
ByWeight boolean not null,
Price FLOAT(7,2) not null,
KeepCold boolean not null,
KeepFrozen boolean not null,
Perishable boolean not null,
AgeRestrict boolean not null,
AgeCanBuy int,
Stock int,
Primary Key(ID));
