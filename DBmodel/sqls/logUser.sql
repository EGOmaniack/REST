-- функция для входа пользователя
--если не найдено возвращает null иначе возвращает id пользователя
drop function if exists logInUser (login text, pass text);
CREATE or replace FUNCTION logInUser (login text , pass text)
--	$1 login пользователя обязательно
--	$2 хэшированный пароль пользователя обязательно
	RETURNS table(newUser_id int4, newUsertoken text) AS $$
DECLARE
user_id int4;
error text;
newToken text;
begin
	if $1 is null then
		error := getError(1);
		raise exception '%', error;
	else
		begin
			if $2 is null then
				error := getError(2);
				raise exception '%', error;
			else
					select pswds.user_id into user_id from users.passwords pswds
						where pswds.login = $1
						and pswds.pass = $2;
					if not found then
						error := getError(2);
						raise exception '%', error;
--						return table(null, null);
					else
						insert into users.connections (id, user_id, token, made)
							values (default, user_id, md5(cast(now() as text)), default)
							returning token into newToken;
						newUser_id := user_id;
						newUsertoken := newToken;
						return next;
					end if; 
			end if;
		end;
	end if;
END;
$$  LANGUAGE plpgsql;

-- функция для входа пользователя через токен
--если не найдено возвращает null иначе возвращает id пользователя
drop function if exists logInUser (token text);
CREATE or replace FUNCTION logInUser (token text)
--	$1 token предыдущего соединения
	RETURNS table(newUser_id int4, newUsertoken text) AS $$
declare
con_id int4;
user_id int4;
error text;
newToken text;
begin
	if $1 is null then
		error := getError(3);
		raise exception '%', error;
	else
		begin
			select cons.id, cons.user_id into con_id, user_id from users.connections cons
				where cons.token = $1
				and cons.removed = false
				and cons.made > now() - interval '48 hours';
			if not found then
				error := getError(301);
				raise exception '%', error;
			else
				update users.connections set removed = true
					where id = con_id;
				
				insert into users.connections (id, user_id, token, made)
	 			values (default, user_id, md5(cast(now() as text)), default)
	 			returning users.connections.token into newToken;
	 		newUser_id := user_id;
	 		newUsertoken := newToken;
			return next;

			end if;
		end;
	end if;
END;
$$  LANGUAGE plpgsql;