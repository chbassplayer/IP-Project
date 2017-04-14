 --the goal here is to be able to show the database of items the store holds
 --can only enter subcategories
drop table if exists KindOfWeight;
drop table if exists items;

create table items(
ID int unsigned not null auto_increment,
StoreID int not null,
Categor int not null,
Nam varchar(30) not null,
Brand varchar(30) not null, 
ByWeight boolean not null,
KindOfWeight int,
Price FLOAT(7,2) not null,
KeepCold boolean not null,
KeepFrozen boolean not null,
Perishable boolean not null,
AgeRestrict boolean not null,
AgeCanBuy int,
Stock int,
image varchar(128),
Primary Key(ID));

create table KindOfWeight(
    ID int unsigned not null auto_increment,
    Description varchar(20) not null,
    Primary Key(ID)
);
Insert into KindOfWeight(Description)Values('pound');
Insert into KindOfWeight(Description)Values('gallon');
Insert into KindOfWeight(Description)Values('ounce');
Insert into KindOfWeight(Description)Values('gram');
Insert into KindOfWeight(Description)Values('--');


Insert into items(StoreID,Categor,Nam,Brand,ByWeight,Price,KeepCold,KeepFrozen,Perishable,AgeRestrict,Stock)
Values(1,1,'Strawberry Yogurt','Yoplait',false,.77,true,false,true,false,58);
Insert into items(StoreID,Categor,Nam,Brand,ByWeight,Price,KeepCold,KeepFrozen,Perishable,AgeRestrict,Stock)
Values(1,1,'Banana Yogurt','Yoplait',false,.77,true,false,true,false,58);
Insert into items(StoreID,Categor,Nam,Brand,ByWeight,Price,KeepCold,KeepFrozen,Perishable,AgeRestrict,Stock)
Values(2,1,'Strawberry Yogurt','Yoplait',false,.77,true,false,true,false,58);
