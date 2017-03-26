-- The best pizza database in Iowa City
DROP TABLE IF EXISTS pizzatopping;
DROP TABLE IF EXISTS pizza;
DROP TABLE IF EXISTS topping;
DROP TABLE IF EXISTS shape;

-- TABLE with toppings
CREATE TABLE topping (
    id int unsigned NOT NULL AUTO_INCREMENT,
    name varchar(128),
    vegetarian boolean NOT NULL,
    vegan boolean NOT NULL,
    glutenfree boolean NOT NULL,
    lactosefree boolean NOT NULL,
    PRIMARY KEY (id)    
);

-- TABLE WITH shapes
CREATE TABLE shape (
    id int unsigned NOT NULL AUTO_INCREMENT,
    name varchar(128),
    PRIMARY KEY (id)        
);

-- pizzas
CREATE TABLE pizza (
    id int unsigned NOT NULL AUTO_INCREMENT,
    shapeid int unsigned NOT NULL,
    crust varchar(20) NOT NULL,
    size int unsigned NOT NULL,
    cheese boolean NOT NULL,
    name varchar(128),
    PRIMARY KEY (id)
);

-- listing of toppings per pizza
CREATE TABLE pizzatopping (
    id int unsigned NOT NULL AUTO_INCREMENT,
    pizzaid int unsigned NOT NULL,
    toppingid int unsigned NOT NULL,
    PRIMARY KEY (id)    
);

-- Add some sample data
INSERT INTO shape(name) VALUES ('circular');
INSERT INTO shape(name) VALUES('rectangular');

INSERT INTO topping(name, vegetarian, vegan, glutenfree, lactosefree) VALUES ('pepperoni', FALSE, FALSE, TRUE, TRUE);
INSERT INTO topping(name, vegetarian, vegan, glutenfree, lactosefree) VALUES ('olives', TRUE, TRUE, TRUE, TRUE);
INSERT INTO topping(name, vegetarian, vegan, glutenfree, lactosefree) VALUES ('sausage', FALSE, FALSE, TRUE, TRUE);
INSERT INTO topping(name, vegetarian, vegan, glutenfree, lactosefree) VALUES ('sundried tomatoes', TRUE, TRUE, TRUE, TRUE);

INSERT INTO pizza(shapeid, crust, size, cheese, name) VALUES (1, 'thin', 11, TRUE, 'sorrentina');
INSERT INTO pizza(shapeid, crust, size, cheese, name) VALUES (1, 'thin', 11, TRUE, 'calabrese');

INSERT INTO pizzatopping(pizzaid, toppingid) VALUES (1, 2);
INSERT INTO pizzatopping(pizzaid, toppingid) VALUES (1, 4);
INSERT INTO pizzatopping(pizzaid, toppingid) VALUES (2, 1);
INSERT INTO pizzatopping(pizzaid, toppingid) VALUES (2, 3);