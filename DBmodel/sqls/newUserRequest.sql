-- функция создания запроса нового пользователя
drop function if exists newUserRequest (name text, surname text, login text, pass text, ip text);
CREATE or replace FUNCTION newUserRequest (name text, surname text, login text , pass text, ip text)
--	$1 имя пользователя
--	$2 Фамилия пользователя
--	$3 login пользователя обязательно
--	$4 хэшированный пароль пользователя обязательно
	RETURNS boolean AS $$
DECLARE
login_id int4;
begin
	if $3 is null then
		raise exception 'Необходимо задать логин';
	else
		begin
			if $4 is null then
				raise exception 'Необходимо задать пароль';
			else
				begin
					select id into login_id from users.passwords where users.passwords.login = $3;
					if not found then
				
						insert into users.new_user_request (id, "name", surname, login, pass, status, user_ip, "date")
						values (default, $1, $2, $3, $4, default, $5, default);
						
						return true;
					else
						raise exception 'пользователь с таким логином уже существует';
					end if;
				end; 
			end if;
		end;
	end if;
END;
$$  LANGUAGE plpgsql;