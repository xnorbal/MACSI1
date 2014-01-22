CREATE TABLE RESSOURCEL(
	ID INT AUTO_INCREMENT,
	INTITULE TEXT,
	COUT INT,
	PRIMARY KEY(ID)
);

CREATE TABLE RESSOURCEH(
	ID INT AUTO_INCREMENT,
	INTITULE TEXT,
	COUT INT,
	QUALIFICATIONS TEXT,
	PRIMARY KEY(ID)
);

CREATE TABLE RESSOURCEM(
	ID INT AUTO_INCREMENT,
	INTITULE TEXT,
	COUT INT,
	PRIMARY KEY(ID)
);

CREATE TABLE PROJET(
	ID INT AUTO_INCREMENT,
	INTITULE TEXT,
	PERIMETRE TEXT,
	PRIMARY KEY(ID)
);

CREATE TABLE SOUSPROJET(
	ID INT AUTO_INCREMENT,
	PID INT REFERENCES PROJET(ID) ON DELETE CASCADE,
	INTITULE TEXT,
	PERIMETRE TEXT,
	PRIMARY KEY(ID)
);

CREATE TABLE JALON(
	ID INT AUTO_INCREMENT,
	PID INT REFERENCES PROJET(ID) ON DELETE CASCADE,
	SYNCPOINT DATE,
	PRIMARY KEY(ID)
);

CREATE TABLE PHASE(
	ID INT AUTO_INCREMENT,
	PID INT REFERENCES PROJET(ID) ON DELETE CASCADE,
	INTITULE TEXT,
	PRIMARY KEY(ID)
);

CREATE TABLE LOT(
	ID INT AUTO_INCREMENT,
	SPID INT REFERENCES SOUSPROJET(ID) ON DELETE CASCADE,
	PhID INT REFERENCES PHASE(ID) ON DELETE CASCADE,
	PERIMETRE TEXT,
	PRIMARY KEY(ID)
);

CREATE TABLE TACHE(
	ID INT AUTO_INCREMENT,
	LID INT REFERENCES LOT(ID) ON DELETE CASCADE,
	OBJECTIF TEXT,
	DATEDEBUT DATE,
	DATEFIN DATE,
	DUREE INT,
	PRIMARY KEY(ID)
);

CREATE TABLE LIVRABLE(
	ID INT AUTO_INCREMENT,
	LID INT REFERENCES LOT(ID) ON DELETE CASCADE,
	INTITULE TEXT,
	PRIMARY KEY(ID)
);

CREATE TABLE TACHERL(
	TID INT REFERENCES TACHE(ID) ON DELETE CASCADE,
	RLID INT REFERENCES RESSOURCEL(ID) ON DELETE CASCADE,
	TAUX FLOAT,
	PRIMARY KEY(TID, RLID)
);

CREATE TABLE TACHERH(
	TID INT REFERENCES TACHE(ID) ON DELETE CASCADE,
	RHID INT REFERENCES RESSOURCEH(ID) ON DELETE CASCADE,
	TAUX FLOAT,
	PRIMARY KEY(TID, RHID)
);

CREATE TABLE TACHERM(
	TID INT REFERENCES TACHE(ID) ON DELETE CASCADE,
	RMID INT REFERENCES RESSOURCEM(ID) ON DELETE CASCADE,
	TAUX FLOAT,
	PRIMARY KEY(TID, RMID)
);

CREATE TABLE CHRONOTACHE(
	TID1 INT REFERENCES TACHE(ID) ON DELETE CASCADE,
	TID2 INT REFERENCES TACHE(ID) ON DELETE CASCADE,
	PRIMARY KEY(TID1, TID2)
);