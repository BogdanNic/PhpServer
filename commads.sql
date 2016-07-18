



INSERT INTO `Devices`( `Model`, `UserID`, `OS`) VALUES ('GT500',124,'firefox')  on duplicate key update OS='firefox'
create table te (id int not null);
SELECT * 
FROM  `RaportNew` AS r
JOIN userRaport AS u ON r.Username = u.Username


UPDATE RaportNew 
SET r.Email=u.Email
FROM  `RaportNew` AS r
JOIN userRaport AS u ON r.Username = u.Username