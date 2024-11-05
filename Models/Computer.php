<?php

namespace App\Models;

use App\Models\BaseModel;

class Computer extends BaseModel {

    public function save() {
        $properties = get_object_vars($this);
        $columns = array_keys($properties);
        $values = array_values($properties);
        
        if (isset($this->{$this->pk})) {
            // Update existing record
            $setClause = implode(' = ?, ', $columns) . ' = ?';
            $sql = "UPDATE `{$this->table}` SET {$setClause} WHERE `{$this->pk}` = ?";
            $stmt = $this->db->prepare($sql);
            $values[] = $this->{$this->pk};
        } else {
            // Insert new record
            $placeholders = rtrim(str_repeat('?, ', count($columns)), ', ');
            $sql = "INSERT INTO `{$this->table}` (" . implode(', ', $columns) . ") VALUES ({$placeholders})";
            $stmt = $this->db->prepare($sql);
        }

        return $stmt->execute($values);
    }

    public function deleteById($id) {
        $sql = 'DELETE FROM `' . $this->table . '` WHERE `' . $this->pk . '` = :id';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    private function getClassName($classname) {
        return substr($classname, strrpos($classname, '\\') + 1);
    }
}
