<?php

class EmployeeRoster {
    private array $employees;
    private int $maxSize;

    public function __construct(int $size) {
        $this->employees = [];
        $this->maxSize = $size;
    }

    public function add(Employee $employee) {
        if (count($this->employees) < $this->maxSize) {
            $this->employees[] = $employee;
            echo "Employee added successfully.\n";
        } else {
            echo "Roster is full. Cannot add more employees.\n";
        }
    }

    public function remove(int $index) {
        if (isset($this->employees[$index])) {
            unset($this->employees[$index]);
            $this->employees = array_values($this->employees); // Re-index array after deletion
            echo "Employee removed successfully.\n";
        } else {
            echo "Invalid employee number.\n";
        }
    }

    public function displayAll() {
        echo "\n--- All Employees ---\n";
        if (empty($this->employees)) {
            echo "No employees in the roster.\n";
            return;
        }
        foreach ($this->employees as $index => $employee) {
            echo ($index + 1) . ". " . $employee->getDetails() . "\n";
        }
    }

    public function displayCommissionEmployees() {
        echo "\n--- Commission Employees ---\n";
        $found = false;
        foreach ($this->employees as $employee) {
            if ($employee instanceof CommissionEmployee) {
                echo $employee->getDetails() . "\n";
                $found = true;
            }
        }
        if (!$found) {
            echo "No commission employees in the roster.\n";
        }
    }

    public function displayHourlyEmployees() {
        echo "\n--- Hourly Employees ---\n";
        $found = false;
        foreach ($this->employees as $employee) {
            if ($employee instanceof HourlyEmployee) {
                echo $employee->getDetails() . "\n";
                $found = true;
            }
        }
        if (!$found) {
            echo "No hourly employees in the roster.\n";
        }
    }

    public function displayPieceWorkers() {
        echo "\n--- Piece Workers ---\n";
        $found = false;
        foreach ($this->employees as $employee) {
            if ($employee instanceof PieceWorker) {
                echo $employee->getDetails() . "\n";
                $found = true;
            }
        }
        if (!$found) {
            echo "No piece workers in the roster.\n";
        }
    }
}
