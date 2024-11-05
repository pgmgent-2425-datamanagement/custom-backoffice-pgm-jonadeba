<?php

namespace App\Controllers;

use App\Models\Computer;

class ComputerController {

    // List all computers
    public function index() {
        $computers = Computer::all();
        return $this->respond($computers);
    }

    // Retrieve a specific computer by ID
    public function show(int $id) {
        $computer = Computer::find($id);
        if ($computer) {
            return $this->respond($computer);
        } else {
            return $this->respond(['error' => 'Computer not found'], 404);
        }
    }

    // Create a new computer entry
    public function store(array $data) {
        // Validate $data here if needed
        $computer = new Computer();
        foreach ($data as $key => $value) {
            $computer->{$key} = $value;
        }
        $success = $computer->save();
        
        if ($success) {
            return $this->respond(['success' => 'Computer created successfully'], 201);
        } else {
            return $this->respond(['error' => 'Failed to create computer'], 500);
        }
    }

    // Update an existing computer entry
    public function update(int $id, array $data) {
        $computer = Computer::find($id);
        if ($computer) {
            foreach ($data as $key => $value) {
                $computer->{$key} = $value;
            }
            $success = $computer->save();
            
            if ($success) {
                return $this->respond(['success' => 'Computer updated successfully']);
            } else {
                return $this->respond(['error' => 'Failed to update computer'], 500);
            }
        } else {
            return $this->respond(['error' => 'Computer not found'], 404);
        }
    }

    // Delete a computer by ID
    public function destroy(int $id) {
        $success = Computer::destroy($id);
        
        if ($success) {
            return $this->respond(['success' => 'Computer deleted successfully']);
        } else {
            return $this->respond(['error' => 'Failed to delete computer'], 500);
        }
    }

    // Helper function to format responses
    private function respond($data, int $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        // Removed exit to allow further processing if necessary
    }
}
