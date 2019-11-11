<?php

class QueryBuilder

{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function sellectAll($table)

    {
        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (Exeption $e) {
            die('Whoops, something went wrong.');
        }

    }

    public function update($table, $parameters, $whereParameters)
    {

        $setString = "";
        foreach ($parameters as $parameter) {
            current($parameters);
            $setString .= " ".key($parameters)."=:".key($parameters).",";
            next($parameters);
        }
        $setString = rtrim($setString, ",");

        $whereString = "";
        foreach ($whereParameters as $whereParameter) {
            current($whereParameters);
            $whereString .= " ".key($whereParameters)."=:".key($whereParameters).",";
            next($whereParameters);
        }
        $whereString = rtrim($whereString, ",");

        $statement = $this->pdo->prepare("UPDATE {$table} SET{$setString} WHERE{$whereString}");

        if ($statement->execute(array_merge($parameters, $whereParameters))) {
            $detail = "Records UPDATED successfully";
        } else {
            $detail = "Whoops, something went wrong (mySql).";
        }

        return $detail;

    }

    public function selectFrom($table, $from, $fromValue)
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE {$from}=:{$from}");
            $statement->bindParam(':'.$from, $fromValue);
            $statement->execute();
            $row = $statement->fetch();
            return $row;
        } catch (Exeption $e) {
            die('Whoops, something went wrong.');
        }
    }

}