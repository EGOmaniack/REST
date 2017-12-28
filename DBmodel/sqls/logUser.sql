-- функция для входа пользователя
--если не найдено возвращает null иначе возвращает id пользователя
drop function if exists logUser (login text, pass text);
CREATE or replace FUNCTION logUser (login text , pass text)
--	$1 login пользователя обязательно
--	$2 хэшированный пароль пользователя обязательно
	RETURNS int4 AS $$
DECLARE
user_id int4;
begin
	if $1 is null then
		raise exception 'Необходимо задать логин';
	else
		begin
			if $2 is null then
				raise exception 'Необходимо задать пароль';
			else
				begin
					select pswds.user_id into user_id from users.passwords pswds where pswds.login = $1 and pswds.pass = $2;
					if not found then
						return null;
					else
						return user_id;
					end if;
				end; 
			end if;
		end;
	end if;
END;
$$  LANGUAGE plpgsql;