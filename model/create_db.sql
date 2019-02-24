-- Database rules:
--  All tables must not use any uppercase letters.          categories, books
--  _ may only be used in link-tables (n-n connections).    books_categories
--  categories names must be unique.
--  categories names must match their table names, with spaces
--   in place of _ chars.  Uppercase/Lowercase doesn't matter.

DROP DATABASE IF EXISTS battletech;
CREATE DATABASE battletech;
USE battletech; -- MySQL command

-- == -- == -- Category Management -- == -- == --
CREATE TABLE categories (
	ID						INT						NOT NULL	AUTO_INCREMENT,
	parentID				INT,
	name					VARCHAR(255)			NOT NULL,
	description				VARCHAR(255)			NOT NULL,
	PRIMARY KEY (ID, name)
);

-- == -- == -- Books Management -- == -- == --
CREATE TABLE books (
	ID						INT						NOT NULL	AUTO_INCREMENT,
  	coverImageID  			INT,
  	backImageID   			INT,
	title					VARCHAR(255)			NOT NULL,
	description				VARCHAR(511)			NOT NULL,
-- REMEMBER: ORDER BY CAST(col AS CHAR) or ORDER BY CONCAT(col).
	version					ENUM('original', 'revised', 'upgrade') NOT NULL,
	year					INT(4)					NOT NULL,
	pages					INT						NOT NULL,
	PRIMARY KEY (ID)
);
CREATE TABLE books_categories (
	bookID        			INT           			NOT NULL,
	categoryID    			INT           			NOT NULL,
	PRIMARY KEY (bookID, categoryID)
);
CREATE TABLE books_realcompanies (
  	bookID        			INT           			NOT NULL,
  	realCompanyID 			INT           			NOT NULL,
  	PRIMARY KEY (bookID, realCompanyID)
);
CREATE TABLE books_realpersons (
  	bookID        			INT           			NOT NULL,
  	realPersonID  			INT           			NOT NULL,
  	PRIMARY KEY (bookID, realPersonID)
);
CREATE TABLE books_images (
  	bookID        			INT           			NOT NULL,
  	imageID       			INT           			NOT NULL,
  	PRIMARY KEY (bookID, imageID)
);

-- == -- == -- Real Company Management -- == -- == --
CREATE TABLE realcompanies (
	ID						INT						NOT NULL	AUTO_INCREMENT,
	name 					VARCHAR(255)			NOT NULL,
  	description   			VARCHAR(511)  			NOT NULL,
	PRIMARY KEY (ID)
);
CREATE TABLE realcompanies_categories (
	realCompanyID 			INT          			NOT NULL,
	categoryID    			INT           			NOT NULL,
	PRIMARY KEY (realCompanyID, categoryID)
);

-- == -- == -- Real Person Management -- == -- == --
CREATE TABLE realpersons (
	ID						INT						NOT NULL	AUTO_INCREMENT,
	name					VARCHAR(255)			NOT NULL,
	PRIMARY KEY (ID)
);
CREATE TABLE realpersons_categories (
	realPersonID  			INT           			NOT NULL,
	categoryID    			INT           			NOT NULL,
	PRIMARY KEY (realPersonID, categoryID)
);

-- == -- == -- Quote Management -- == -- == --
CREATE TABLE quotes (
  	ID            			INT           			NOT NULL  AUTO_INCREMENT,
  	quote         			VARCHAR(511),
  	reasoning     			VARCHAR(511),
  	PRIMARY KEY (ID)
);
CREATE TABLE quotes_categories (
	quoteID       			INT           			NOT NULL,
	categoryID    			INT           			NOT NULL,
	PRIMARY KEY (quoteID, categoryID)
);
CREATE TABLE quotes_books (
	quoteID       			INT						NOT NULL,
	bookID					INT						NOT NULL,
	page					INT						NOT NULL,
	PRIMARY KEY (quoteID, bookID)
);

-- == -- == -- Image Management -- == -- == --
CREATE TABLE images (
  	ID            			INT           			NOT NULL  AUTO_INCREMENT,
  	filename      			VARCHAR(63)   			NOT NULL,
  	description   			VARCHAR(255)  			NOT NULL,
  	PRIMARY KEY (ID)
);
CREATE TABLE images_categories (
  	imageID       			INT           			NOT NULL,
  	categoryID    			INT           			NOT NULL,
  	PRIMARY KEY (imageID, categoryID)
);

-- Test insertion of data into the tables.
INSERT INTO categories (ID, parentID, name, description) VALUES
(1, 0, 'Books', ''),
(2, 1, 'TROs', 'Technical ReadOuts'),
(3, 1, 'Era Reports', 'Regional or national reports'),
(4, 1, 'Rulebooks', 'Base rule books'),
(5, 13, 'Fusion Engines', 'Main source of power in the 31st century.'),
(6, 16, 'Early Star league Era', 'First Exodus'),
(7, 0, 'Real Companies', ''),
(8, 7, 'Publishers', ''),
(9, 0, 'Real Persons', ''),
(10, 9, 'Authors', ''),
(11, 0, 'Quotes', ''),
(12, 0, 'Images', ''),
(13, 0, 'Technologies', ''),
(14, 0, 'BattleMechs', ''),
(15, 0, 'Dates', ''),
(16, 15, 'Early Years', '');

INSERT INTO books (ID, coverImageID, backImageID, title, description, version, year, pages) VALUES
(1, 1, 1, 'Introduction to BattleTech', '4th Edition Quick-Start Rules, Brief History of the Inner Sphere, 3049 Tour of the Inner Sphere, and general technical overview of the BattleMech, including the specific capabilities and weapons of 24 chassis.', 'original', 1996, 32);
INSERT INTO books (ID, title, description, version, year, pages) VALUES
(2, 'Test', 'TestDescription', 'revised', 2000, 10);

INSERT INTO books_categories (bookID, categoryID) VALUES
(1, 3),
(2, 2);

INSERT INTO books_realcompanies (bookID, realCompanyID) VALUES
(1, 1),
(1, 2),
(2, 2);

INSERT INTO books_realpersons (bookID, realPersonID) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1);

INSERT INTO books_images (bookID, imageID) VALUES
(1, 1),
(2, 1),
(2, 2);

INSERT INTO realcompanies (ID, name, description) VALUES
(1, 'FASA', 'Original publisher of BattleTech.'),
(2, 'other', 'A test company.');

INSERT INTO realcompanies_categories (realCompanyID, categoryID) VALUES
(1, 7),
(2, 7);

INSERT INTO realpersons (ID, name) VALUES
(1, 'Jordan K. Weisman'),
(2, 'Sam Lewis'),
(3, 'L. Ross Babcock III');

INSERT INTO realpersons_categories (realPersonID, categoryID) VALUES
(1, 8),
(2, 8),
(3, 8);

INSERT INTO quotes (ID, quote, reasoning) VALUES
(1, 'The dissolution of traditional enmities in the late 20th and early 21st centuries created an era of unprecedented peace and cooperation among the ancient nations of Terra.', 'Earth was at peace at the turn of the 21st century.'),
(2, 'By 2020 the groundbreaking research of two scientists-Thomas Kearny and Takayoshi Fuchida-led to the development of a fusion reactor capable of powering a starship.', 'The Kearny-Fushida fusion drive was developed by 2020.');

INSERT INTO quotes_categories (quoteID, categoryID) VALUES
(1, 4),
(2, 5);

INSERT INTO quotes_books (quoteID, bookID, page) VALUES
(1, 1, 13),
(2, 1, 13);

INSERT INTO images (ID, filename, description) VALUES
(1, 'introduction_to_battletech_fasa_1996', "book cover"),
(2, 'timber_wolf', "battlemech");

INSERT INTO images_categories (imageID, categoryID) VALUES
(1, 10),
(2, 10);

-- Create an admin and regular users.
GRANT SELECT, INSERT, UPDATE, DELETE
ON *
TO jr_admin@localhost
IDENTIFIED BY 'pa55word';

GRANT SELECT
ON books
TO jr_user@localhost
IDENTIFIED BY 'pa55word';