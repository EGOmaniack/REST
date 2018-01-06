select * from users.users;
select * from users.passwords;
select * from users.new_user_request;
select * from users.connections;

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

select * from newUserRequest('Александр', 'Примакорв',null, 'Egomaniack2', '123', '192.168.0.2');
select * from newUserRequest('Александр', 'Примакорв', 'Egomaniack12', '123', '192.168.0.1');

--ALTER USER postgres WITH PASSWORD 'pass';


update users.new_user_request
set status = 1
where id = 1;

select * from logUser('root', CAST('cef9be2622851fe89ad9a686e3e38b8b9c6fc1a371a1a84cb09c52de7669c8b6' as text));
select * from logUser(cast ('260c66b1d99948fe011586bfc7fcbfd6' as text));

select * from acceptUserRequest(1);