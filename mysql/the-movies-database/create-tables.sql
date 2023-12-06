CREATE TABLE IF NOT EXISTS movies (
  title                      VARCHAR(128) NOT NULL,
  year                       INT          NOT NULL,
  length                     INT          NOT NULL,
  genre                      VARCHAR(64)  NOT NULL,
  studioName                 VARCHAR(128) NOT NULL,
  producerCertificateNumber  INT          NOT NULL, -- “…an integer that represents the producer of the movie…”

  PRIMARY KEY (title, year)
);

CREATE TABLE IF NOT EXISTS movie_star (
  name                       VARCHAR(128) NOT NULL,
  address                    VARCHAR(256) NOT NULL,
  gender                     VARCHAR(1)   NOT NULL, -- 'M', 'F', 'L', 'G', 'B', 'T', 'Q', 'I', 'A', 'N'
  birthdate                  DATE         NOT NULL,

  PRIMARY KEY (name)
);

CREATE TABLE IF NOT EXISTS stars_in (
  movieTitle                 VARCHAR(128) NOT NULL,
  movieYear                  INT          NOT NULL,
  starName                   VARCHAR(128) NOT NULL,

  PRIMARY KEY (movieTitle, movieYear, starName)
);

CREATE TABLE IF NOT EXISTS movie_exec (
  name                       VARCHAR(128) NOT NULL,
  address                    VARCHAR(256) NOT NULL,
  certificateNumber          INT          NOT NULL, -- “These are integers; a different one is assigned to each executive”
  netWorth                   BIGINT       NOT NULL,

  PRIMARY KEY (certificateNumber)
);

CREATE TABLE IF NOT EXISTS studio (
  name                       VARCHAR(128) NOT NULL,
  address                    VARCHAR(256) NOT NULL,
  presidentCertificateNumber INT          NOT NULL, -- “We assume that the studio president is surely a movie executive and therefore appears in MovieExec”

  PRIMARY KEY (name)
);
