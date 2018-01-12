-- функция добавления нового пользователя
drop function if exists newUser (name text, surname text, patronymic text, login text, pass text);
CREATE or replace FUNCTION newUser (name text, surname text, patronymic text, login text , pass text)
--	$1 имя пользователя
--	$2 Фамилия пользователя
--	$3 Отчество пользователя
--	$4 login пользователя обязательно
--	$5 хэшированный пароль пользователя обязательно
	RETURNS int4 AS $$
DECLARE
user_id int4;
login_id int4;
error text;
begin
	if $4 is null then
		error := getError(1);
		raise exception '%', error;
	else
		begin
			if $5 is null then
				error := getError(2);
				raise exception '%', error;
			else
				begin
					select id into login_id from users.passwords where users.passwords.login = $4;
					if not found then

						insert into users.users(id, "name", surname, patronymic)
						values (default, $1, $2, $3)
						returning id into user_id;
						
						insert into users.passwords(id, user_id, login, pass)
						values (default, user_id, $4, $5);
						
						return user_id;
					else
						error := getError(101);
						raise exception '%', error;
					end if;
				end; 
			end if;
		end;
	end if;
END;
$$  LANGUAGE plpgsql;