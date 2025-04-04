CREATE DATABASE rentals
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




