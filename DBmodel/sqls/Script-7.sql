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
select * from logInUser(cast ('403274c20d9b6974fe6548494f6fc1f7' as text));
select * from users.connections;

select * from acceptUserRequest(14);
select * from rest.flows;

select rst.flow_name, rst.description, lvls.lvl_code
	from rest.flows rst
	inner join
	access.accesses_lvls lvls
	on rst.min_access_lvl = lvls.id
;
