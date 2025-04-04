﻿CREATE DATABASE rentals
	CHARACTER SET utf8
	COLLATE utf8_hungarian_ci;

Select * from books;
Select * from users;
Select * from groups;
Select * from rentals;
Select * from readingdiaries;
Select * from roles;
Select * from specimens;

SELECT b.id, b.poet, b.title, g.group from books b
inner join groups g on b.groupId= g.id ;

SELECT u.id, u.name, g.`group`,  u.email FROM users u
  INNER JOIN groups g ON u.groupId = g.id
where u.roleId = 2 ;


#kikölcsönzött könyvek táblázata
#rentedBooksByUsers
select r.id, r.specimenId, r.userId, u.name, b.title, b.poet, s.bookId, r.startingDate, r.endingDate from rentals r
  inner JOIN specimens s on r.specimenId = s.id
  INNER JOIN users u on r.userId = u.id
  inner join books b on s.bookId = b.id
  order by u.name, b.title;

#kölcsönzési form listák

#user ABC
#studentAbc

SELECT name, id from users
  where roleId = 2
  order by name;

select s.id, r.specimenId from specimens s
  left JOIN rentals r on s.id = r.specimenId;





