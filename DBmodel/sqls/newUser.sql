-- функция добавления нового пользователя
drop function if exists newUser (name text, surname text, birthday text, login text, pass text);
CREATE or replace FUNCTION newUser (name text, surname text, birthday text, login text , pass text)
--	$1 имя пользователя
--	$2 Фамилия пользователя
--	$3 дата рождения пользователя
--	$4 login пользователя обязательно
--	$5 хэшированный пароль пользователя обязательно
	RETURNS int4 AS $$
DECLARE
user_id int4;
login_id int4;
begin
	if $4 is null then
		raise exception 'Необходимо задать логин';
	else
		begin
			if $5 is null then
				raise exception 'Необходимо задать пароль';
			else
				begin
					select id into login_id from users.passwords where users.passwords.login = $4;
					if not found then
				
						insert into users.users(id, "name", surname, birthday)
						values (default, $1, $2, date($3))
						returning id into user_id;
						
						insert into users.passwords(id, user_id, login, pass)
						values (default, user_id, $4, $5);
						
						return user_id;
					else
						raise exception 'пользователь с таким логином уже существует';
					end if;
				end; 
			end if;
		end;
	end if;
END;
$$  LANGUAGE plpgsql;