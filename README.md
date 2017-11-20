# IT6203-IT-Design-Studio
Group 5 project


CREATE DATABASE aqutaish;

 USE aqutaish;

CREATE USER 'AQ_user'@'localhost' IDENTIFIED BY 'my*password';

CREATE TABLE Services (Service_ID INT NOT NULL AUTO_INCREMENT, Service_DSC varchar(100) NOT NULL, primary key(Service_ID));

CREATE TABLE Profiles (Profile_ID INT NOT NULL  AUTO_INCREMENT, NetID INT NOT NULL, First_Name varchar(100) NOT NULL , Last_Name varchar(100) NOT NULL, Email varchar(100)   NOT NULL, Service_Offered varchar(100)   NOT NULL ,  Availability varchar(100) NOT NULL, Notification_Email varchar(100) NOT NULL, Username varchar(100)   NOT NULL, Password varchar(100)   NOT NULL, primary key(Profile_ID)); 



CREATE TABLE services_provided ( Service_ID  INT NOT NULL , Profile_ID  INT  NOT NULL,FOREIGN KEY (Profile_ID) REFERENCES Profiles (Profile_ID));


Also
ALTER TABLE profiles AUTO_INCREMENT=1000;


CREATE TABLE Task (Task_ID INT NOT NULL  AUTO_INCREMENT, User_NetID  INT NOT NULL, Service_ID INT NOT NULL, Task_description  varchar(100) NOT NULL  ,Profile_ID INT NOT NULL, Availability varchar(100) NOT NULL, primary key(Task_ID));


GRANT SELECT, UPDATE, INSERT ON aqutaish.services TO 'AQ_user'@'localhost';

GRANT SELECT, UPDATE, INSERT ON aqutaish.Profiles TO 'AQ_user'@'localhost';

GRANT SELECT, UPDATE, INSERT ON aqutaish.services_provided TO 'AQ_user'@'localhost';

GRANT SELECT, UPDATE, INSERT,DELETE ON aqutaish.Task TO 'AQ_user'@'localhost';




INSERT INTO services (Service_ID, Service_DSC) VALUES ('1','PHP Tutoring');
INSERT INTO services (Service_DSC) VALUES ('C Tutoring');
INSERT INTO services (Service_DSC) VALUES ('Java Tutoring');
INSERT INTO services (Service_DSC) VALUES ('Computer fixing');
