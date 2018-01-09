-- функция формирует json с ошибкой по коду
drop function if exists getError (code integer);
CREATE or replace FUNCTION getError (code integer)
--	$1 код ошибки
	RETURNS text AS $$
declare
message text;
begin
	if $1 is null then
		select err.message into message from dictionary.errors err where err.code = 201;
		return '{"code": 201, "message": "' || message || '"}';
	else
		select err.message into message from dictionary.errors err where err.code = $1;
		if not found then
			select err.message into message from dictionary.errors err where err.code = 201;
			return '{"code": 201, "message": "' || message || '"}';
		end if;
		return '{"code": ' || $1 || ', "message": "' || message || '"}';
	end if;
END;
$$  LANGUAGE plpgsql;