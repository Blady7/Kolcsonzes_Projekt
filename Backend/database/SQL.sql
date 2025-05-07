CREATE DATABASE rentals
	CHARACTER SET utf8
	COLLATE utf8_hungarian_ci;

Select * from books;
Select * from users;
Select * from groups;
Select * from rentals;
Select * from roles;
Select * from specimens;

SELECT b.id, b.poet, b.title, g.group from books b
inner join groups g on b.groupId= g.id ;

SELECT u.id, u.name, g.`group`,  u.email, u.roleId, r.role, u.groupId FROM users u
  INNER JOIN groups g ON u.groupId = g.id
  inner join  roles r on r.id = u.roleId
where u.roleId = 2 ;


#kikölcsönzött könyvek táblázata
#rentedBooksByUsers
select r.id, b.poet, b.title, u.name, r.startingDate, r.endingDate from rentals r
  inner JOIN specimens s on r.specimenId = s.id
  INNER JOIN users u on r.userId = u.id
  inner join books b on s.bookId = b.id
  order by r.id
  limit 50 OFFSET 50;

#kölcsönzési form listák
#kölcsönözhetőség megszűntetése
UPDATE rentals set endingDate = NULL
  WHERE id = 2;

#user ABC
#studentAbc

SELECT name, id from users
  where roleId = 2
  order by name;

#kikölcsönözhető példányok
#nem kölcsönözhető könyvek dátum alapján
SELECT specimenId FROM rentals
  where endingDate is NULL;

#api/canRentSpecimens
select DISTINCT s.id, b.title, b.poet from specimens s
  left JOIN rentals r on s.id = r.specimenId
  inner JOIN books b on s.bookId = b.id
  where r.specimenId is NULL OR not s.id in (SELECT specimenId FROM rentals
  where endingDate is NULL)
  ORDER BY b.title;

SELECT * FROM books; 

-- SELECT g.id, g.`group`, u.name FROM users u
--   INNER JOIN groups g ON u.groupId = g.id
-- where u.roleId = 3;

SELECT * FROM groups;

SELECT u.name, r.startingDate, r.endingDate FROM rentals r
  inner join users u on r.userId = u.id
  ORDER BY r.id;





