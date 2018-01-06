-- функция принятия запроса пользователя
drop function if exists acceptUserRequest (id int4);
CREATE or replace FUNCTION acceptUserRequest (id int4)
--	$1 id пользователя из таблицы запросов на регистрацию
	RETURNS int4 AS $$
--	возвращает id нового пользователя из таблицы users.users
DECLARE
request record;
result_id int4;
begin
	select * into request from users.new_user_request req where req.id = $1 and req.status = 0;
	update users.new_user_request set status = 1 where users.new_user_request.id = $1;
	select * into result_id from newUser(request."name", request.surname, request.patronymic, request.login, request.pass);
	return result_id;
END;
$$  LANGUAGE plpgsql;