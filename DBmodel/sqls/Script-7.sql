select * from users.users;
select * from users.passwords;
select * from users.new_user_request;

select * from newUser('Александр', 'Примакорв', '1987-08-21', 'Egomaniack', '123');
select * from newUser(null, null, '1987-08-21', 'Egomaniack2', '123');
select * from newUser('Александр', 'Примакорв', '1987-08-21', 'Egomaniack2', '123');
select * from newUser('Александр', 'Примакорв', '1987-08-21', 'Egomaniack', null);
select * from newUser('Александр', 'Примакорв', '1987-08-21', null, null);
select * from newUser('Александр', 'Примакорв', null, 'Egomaniack4', '123');

select * from logUser('Egomaniack', '123');
select * from logUser('Egomaniack', '1234');
select * from logUser('Egomaniack', null);
select * from logUser(null, null);

select * from newUserRequest('Александр', 'Примакорв', 'Egomaniack2', '123', '192.168.0.2');
select * from newUserRequest('Александр', 'Примакорв', 'Egomaniack12', '123', '192.168.0.1');

--ALTER USER postgres WITH PASSWORD 'pass';


update users.new_user_request
set status = 1
where id = 1;

select * from acceptUserRequest(8);