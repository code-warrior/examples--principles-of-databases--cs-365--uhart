/* mysql -u root -p < setup.sql */

DROP DATABASE IF EXISTS music;

CREATE DATABASE music;

USE music;

source create-tables.sql;
source insert-values.sql;
