<?php

namespace App\Models\Contracts;

class JsonBaseModel extends BaseModel
{
    private $db_location;
    private $table_file_path;

    public function __construct()
    {
        $this->db_location = BASE_PATH . "/storage/jsondb/";

        $this->table_file_path = $this->db_location . $this->table . ".json";
    }


    public function read_table()
    {
        return json_decode(file_get_contents($this->table_file_path));
    }

    private function write_table(array $data): void
    {
        $json_data = json_encode($data, JSON_UNESCAPED_UNICODE);

        file_put_contents($this->table_file_path, $json_data);
    }


    public function create(array $data): int
    {

        $table_data = $this->read_table(); // json to array

        $table_data[] = $data; // add given data to the table-data

        $this->write_table($table_data); // array to json

        return 1;
    }


    public function find(int $id): object|null
    {
        $table_data = $this->read_table();

        foreach ($table_data as $row) {
            if ($row->{$this->primaryKey} == $id) {
                return $row;
            }
        }

        return null;
    }


    public function get(array $columns, array $where): array
    {
        $table_data = $this->read_table();

        return [];
    }


    public function getAll(): array
    {
        return $this->read_table();
    }


    public function update(array $data, array $where): int
    {
        // TODO: Implement update() method.
        return 1;
    }


    public function delete(array $where): int
    {
        // TODO: Implement delete() method.
        return 1;
    }
}