<?php

require_once __DIR__ . "/Connection.php";

class Crud 
{
    private static $pdo = null;
    private static $table = null;

    private static function getPDO()
    {
        if (!self::$pdo) {
            self::$pdo = Connection::getConnection();
        }
        return self::$pdo;
    }

    public static function search($data, $debug = false)
    {
        $table = static::$table;
        $sqlData = self::sql($data);

        $sql = "SELECT {$sqlData['select']}
        FROM {$table}";

        if ($sqlData['joins']) {
            $sql .= "\n{$sqlData['joins']}";
        }

        if ($sqlData['where']) {
            $sql .= "\nWHERE {$sqlData['where']}";
        }

        if ($sqlData['order']) {
            $sql .= "\nORDER BY {$sqlData['order']}";
        }

        if ($sqlData['limit']) {
            $sql .= "\nLIMIT {$sqlData['limit']}";
        }

        try {
            $stmt = self::getPDO()->prepare($sql);
            $stmt->execute($sqlData['params']);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($debug) {
                $data = [
                    'query' => $sql,
                    'params' => $sqlData['params'],
                    'result' => $result
                ];
                //Debugger
                echo '<pre>';
                print_r($data);
                die();
            }

            return $result;

        } catch (PDOException $e) {
            if ($debug) {
                $data = [
                    'query' => $sql,
                    'table' => static::$table,
                    'params' => $sqlData['params'],
                    'error' => $e->getMessage(),
                    'error_code' => $e->getCode()
                ];
                //Debugger
                echo '<pre>';
                print_r($data);
                die();
            }

            return Response::send(500, ['error' => 'SQL error']);
        }
    }

        public static function inserir($data, $debug = false)
    {
        $table = static::$table;

        $cols = implode(', ', array_keys($data));
        $binds = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$table} ({$cols}) VALUES ({$binds})";

        try {
            $stmt = self::getPDO()->prepare($sql);

            if ($debug) {
                return [
                    'query' => $sql,
                    'params' => $data
                ];
            }

            $stmt->execute($data);
            return self::getPDO()->lastInsertId();

        } catch (PDOException $e) {
            if ($debug) {
                return [
                    'query' => $sql,
                    'params' => $data,
                    'error' => $e->getMessage(),
                    'error_code' => $e->getCode()
                ];
            }

            return Response::send(500, ['error' => 'SQL error']);
        }
    }

    
    private static function sql($data)
    {
        $select = $data['select'] ?? '*';
        $joins  = $data['joins'] ?? '';
        $order  = $data['order'] ?? '';
        $limit  = $data['limit'] ?? '';
        $where = '';

        $params = [];

        // Tratando o where como array [query, param1, param2...]
        if (isset($data['where'])) {
            if (is_array($data['where'])) {
                $where  = $data['where'][0];
                $params = array_slice($data['where'], 1);
            } 
        }

        return [
            "select" => $select,
            "where" => $where,
            "joins" => $joins,
            "order" => $order,
            "limit" => $limit,
            "params" => $params
        ];
    }

}
