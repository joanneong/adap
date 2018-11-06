/**
* Specifies the schema for the project
*/

DROP TABLE IF EXISTS company_account CASCADE;
DROP TABLE IF EXISTS router CASCADE;
DROP TABLE IF EXISTS cve CASCADE;

CREATE TABLE company_account (
	company_name VARCHAR(64) NOT NULL,
	email VARCHAR(355) PRIMARY KEY,
	password VARCHAR(50) NOT NULL,
	contact CHAR(8) NOT NULL,
	address VARCHAR(355) NOT NULL,
	postal_code CHAR(6) NOT NULL,
	identification boolean NOT NULL DEFAULT false
);

CREATE TABLE router (
	company_email VARCHAR(355) REFERENCES company_account(email) ON UPDATE CASCADE ON DELETE CASCADE,
	mac_address CHAR(17) PRIMARY KEY,
	model VARCHAR(150) NOT NULL,
	version VARCHAR(20) NOT NULL
);

CREATE TABLE cve (
	router_model VARCHAR(150),
	router_version VARCHAR(20),
	cve_id VARCHAR(16),
	cve_severity VARCHAR(7),
	cve_description VARCHAR(500),
	PRIMARY KEY (router_model, router_version, cve_id)
);

/* SET datestyle = "ISO, YMD"; */
