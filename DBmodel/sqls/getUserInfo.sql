select * from users.users;
-- функция получения данных пользователя
CREATE or replace FUNCTION getUserInfo (id int4)
--	$1 id пользователя обязательно
	RETURNS table(name text, sName text, patronymic text, nick text) AS $$
declare
var_r record;
begin
	
select usr."name", usr.surname sName, usr.patronymic
into var_r
from users.users usr
where usr.id = $1;

name := var_r."name";
sName := var_r.sName;
patronymic := var_r.patronymic;

select pwd.login
into var_r
from users.passwords pwd
where pwd.user_id = $1;

nick := var_r.login;
return next;

END;
$$  LANGUAGE plpgsql;

select * from getUserInfo(1);