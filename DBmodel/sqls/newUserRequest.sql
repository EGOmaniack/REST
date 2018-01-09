-- функция создания запроса нового пользователя
drop function if exists newUserRequest (name text, surname text, patronymic text, login text, pass text, ip text);
CREATE or replace FUNCTION newUserRequest (name text, surname text, patronymic text, login text , pass text, ip text)
--	$1 имя пользователя
--	$2 Фамилия пользователя
--	$3 отчество пользователя
--	$4 login пользователя обязательно
--	$5 хэшированный пароль пользователя обязательно
--	$6 ip пользователя
	RETURNS text AS $$
DECLARE
login_id int4;
error text;
begin
	if $4 = '' then
		error := getError(1);
		raise unique_violation 
		USING MESSAGE = error;
	else
		begin
			if $5 = '' then
				error := getError(2);
				raise unique_violation 
				USING MESSAGE = error;
			else
				begin
					select id into login_id from users.passwords where users.passwords.login = $4;
					if not found then
				
						insert into users.new_user_request (id, "name", surname, patronymic, login, pass, status, user_ip, "date")
						values (default, $1, $2, $3, $4, $5, default, $6, default);
						
						return 'accepted';
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