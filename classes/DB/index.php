<?php
class PostgresException extends Exception {
    function __construct($msg) { parent::__construct($msg); }
}

class DependencyException extends PostgresException {
    function __construct() { parent::__construct("deadlock"); }
}

class pg {
    public static $connection;

    private static function connect() {
        self::$connection = @pg_connect("host=localhost port=5432 dbname=REST user=postgres password=Rgrur4frg56eq16");
        if (self::$connection === FALSE) {
            throw(new PostgresException("Can't connect to database server."));
        }
    }

    public static function query($sql) {
        if (!isset(self::$connection)) {
            self::connect();
        }

        $result = @pg_query(self::$connection, $sql);
        if ($result === FALSE) {
            $error = pg_last_error(self::$connection);
            if (stripos($error, "deadlock detected") !== false) throw(new DependencyException());

            throw(new PostgresException($error.": ".$sql));
        }

        $out = array();
        while ( ($d = pg_fetch_assoc($result)) !== FALSE) {
            $out[] = $d;
        }

        return $out;
    }
}

function getFlowsInfo() {

$sqlstr = <<<EOT
select rst.flow_name, rst.description, lvls.lvl_code
  from
    rest.flows rst
    inner join
    access.accesses_lvls lvls
    on rst.min_access_lvl = lvls.id
;
EOT;

    do {
        $repeat = false;
        try {
            pg::query("begin");

            $result = pg::query($sqlstr);

            pg::query("commit");

            return $result;
        }
        catch (DependencyException $e) {
            pg::query("rollback");
            $repeat = true;
        }
        catch (PostgresException $e) {
            $mess; //".*"
            preg_match_all('/{"code":\s[0-9]{1,1000},\s*"message":\s*(".*")\s*}/', $e->getMessage(), $mess);
            header("HTTP/1.0 400 Bad Request");
            echo $mess[0][0];
            exit;
        }
    } while ($repeat);
}

function sqlFunction(string $query, string $funcName) {
    do {
        $repeat = false;
        try {
            pg::query("begin");

            $result = pg::query($query);

            pg::query("commit");

            return $result[0][$funcName];
        }
        catch (DependencyException $e) {
            pg::query("rollback");
            $repeat = true;
        }
        catch (PostgresException $e) {
            $mess; //".*"
            preg_match_all('/{"code":\s[0-9]{1,1000},\s*"message":\s*(".*")\s*}/', $e->getMessage(), $mess);
            header("HTTP/1.0 400 Not Acceptable");
            echo $mess[0][0];
            exit;
        }
    } while ($repeat);
}

function standartSql (string $query) {
    do {
        $repeat = false;
        try {
            pg::query("begin");

            $result = pg::query($query);

            pg::query("commit");

            return $result;
        }
        catch (DependencyException $e) {
            pg::query("rollback");
            $repeat = true;
        }
        catch (PostgresException $e) {
            $mess; //".*"
            preg_match_all('/{"code":\s[0-9]{1,1000},\s*"message":\s*(".*")\s*}/', $e->getMessage(), $mess);
            header("HTTP/1.0 400 Not Acceptable");
            echo $mess[0][0];
            exit;
        }
    } while ($repeat);
}