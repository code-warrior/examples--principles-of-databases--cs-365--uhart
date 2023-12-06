INSERT INTO movies
VALUES
("Star Wars", 1977, 121, "sciFi", "Lucasfilm Ltd", 1),
("The Empire Strikes Back", 1980, 124, "sciFi", "Lucasfilm Ltd", 1),
("Return of the Jedi", 1983, 132, "sciFi", "Lucasfilm Ltd", 1);

INSERT INTO movie_star
VALUES
("Mark Hamill", "12345 Main St, Oakland, CA", "M", "1951-10-25"),
("Carrie Fisher", "456789 Franklin Ave, Los Angeles, CA", "F", "1956-10-21"),
("Harrison Ford", "66-24 Classon St, Los Angeles, CA", "M", "1942-07-13");

INSERT INTO stars_in
VALUES
("Star Wars", 1977, "Mark Hamill"),
("Star Wars", 1977, "Carrie Fisher"),
("Star Wars", 1977, "Harrison Ford"),
("The Empire Strikes Back", 1980, "Mark Hamill"),
("The Empire Strikes Back", 1980, "Carrie Fisher"),
("The Empire Strikes Back", 1980, "Harrison Ford"),
("Return of the Jedi", 1982, "Mark Hamill"),
("Return of the Jedi", 1982, "Carrie Fisher"),
("Return of the Jedi", 1982, "Harrison Ford");

INSERT INTO movie_exec
VALUES
("George Lucas", "666 Some St, Hollywood, CA", 1, 10000000000);

INSERT INTO studio
VALUES
("Lucasfilm Ltd", "6040 Negra Arroyo Ln, Hollywood, CA", 1);
