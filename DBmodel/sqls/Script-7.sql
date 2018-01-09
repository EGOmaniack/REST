select * from users.users;
select * from users.passwords;
select * from users.new_user_request;
select * from users.connections;


select * from newUserRequest('Александр', 'Примакорв',null, 'Egomaniack2', '123', '192.168.0.2');
select * from newUserRequest('Александр', 'Примакорв', 'Александрович', 'Egomaniack12', '123', '192.168.0.1');

--ALTER USER postgres WITH PASSWORD 'pass';

update users.new_user_request
set status = 1
where id = 1;

select * from logInUser('root', CAST('cef9be2622851fe89ad9a686e3e38b8b9c6fc1a371a1a84cb09c52de7669c8b6' as text));
select * from logInUser(cast ('81f6ae525527bb1062ec1af6b9df7bf9' as text));
select * from users.connections;

select * from acceptUserRequest(32);