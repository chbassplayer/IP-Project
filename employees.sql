--ugh im not sure how to control who is able to change the order information
--all employees can see orders.not all can change
--all employees can see items not all can change
-- not all employees can see employees(if you can see it you can change it)
DROP TABLE IF EXISTS employees;
CREATE TABLE employees (
    id INT NOT NULL AUTO_INCREMENT,
    fName VARCHAR(40) NOT NULL,
    lName VARCHAR(40) NOT NULL,
    orders BOOLEAN NOT NULL,
    employees BOOLEAN NOT NULL,
    items BOOLEAN NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO employees (fName,lName,orders, employees,items) VALUES ('Jessica','Lu',true,true,true);
INSERT INTO employees (fName,lName,orders, employees,items) VALUES ('Alex','Baldwin',false,true,false);
INSERT INTO employees (fName,lName,orders, employees,items) VALUES ('Julia','Roberts',false,true, true);
INSERT INTO employees (fName,lName,orders, employees,items) VALUES ('Zeds','Ded',true, false,true);
INSERT INTO employees (fName,lName,orders, employees,items) VALUES ('Shelia','Knowles',false,true,true);