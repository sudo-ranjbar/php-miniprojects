<?php

namespace App\Models\Contracts;

use Medoo\Medoo;

class MysqlBaseModel extends BaseModel
{

    protected function __construct()
    {

        try {
            $this->connection = new Medoo([
                'type' => 'mysql',
                'host' => $_ENV['DB_HOST'],
                'database' => $_ENV['DB_NAME'],
                'username' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
            ]);
        } catch (\Exception $e) {
            echo "Connection Failed ..." . $e->getMessage();
        }
    }


    public function create(array $data): int
    {
        $this->connection->insert($this->table, $data);
        return 1 ?? 0;
    }


    public function find(int $id): object|null
    {
        return (object)$this->connection->get($this->table, "*", [$this->primaryKey => $id]);
    }


    public function get($columns, array $where): array
    {
        # pagination part
        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

        $start = ($page - 1) * $this->pageSize;
        $where['LIMIT'] = [$start, $this->pageSize];



        return $this->connection->select($this->table, $columns, $where);
    }


    public function getAll(): array
    {
        return $this->get("*", []);
    }


    public function update(array $where, array $data): int
    {
        $this->connection->update($this->table, $data, $where);
        return 1 ?? 0;
    }


    public function delete(array $where): int
    {
        $this->connection->delete($this->table, $where);
        return 1 ?? 0;
    }


    public function record_Count(array $where): int
    {
        return $this->connection->count($this->table, $where);
    }
}
