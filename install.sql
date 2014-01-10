DROP TABLE IF EXISTS wcf1_teamspeak3viewer_servers;
CREATE TABLE wcf1_teamspeak3viewer_servers (
	serverID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	active SMALLINT(1) DEFAULT 1,
	serverAddress VARCHAR(16) NOT NULL,
	serverPort INT(5) NOT NULL,
        serverPassword VARCHAR(30) NOT NULL,
	queryAdminName VARCHAR(30) NOT NULL,
	queryAdminPassword VARCHAR(30) NOT NULL,
	queryPort INT(5) NOT NULL,
	joinName VARCHAR(30) NOT NULL,
        descr TEXT NULL
);