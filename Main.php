<?php


class Main {

    private EmployeeRoster $roster;
    private int $size;

    public function start() {
        $this->clear();
        echo "Welcome to the Employee Roster System\n";
        
        // Set up the roster size
        $this->size = (int)readline("Enter the size of the roster: ");
        if ($this->size < 1) {
            echo "Invalid roster size. Please try again.\n";
            $this->start();
            return;
        }
        
        // Initialize the roster
        $this->roster = new EmployeeRoster($this->size);
        $this->entrance();
    }

    public function entrance() {
        $this->clear();
        echo "*** EMPLOYEE ROSTER MENU ***\n";
        echo "[1] Add Employee\n";
        echo "[2] Delete Employee\n";
        echo "[3] View Roster\n";
        echo "[0] Exit\n";

        $choice = (int)readline("Select an option: ");
        
        switch ($choice) {
            case 1:
                $this->addMenu();
                break;
            case 2:
                $this->deleteMenu();
                break;
            case 3:
                $this->viewMenu();
                break;
            case 0:
                echo "Exiting...\n";
                exit;
            default:
                echo "Invalid option. Please try again.\n";
                $this->entrance();
        }
    }

    public function addMenu() {
        $name = readline("Enter employee's name: ");
        $address = readline("Enter employee's address: ");
        $age = (int)readline("Enter employee's age: ");
        $companyName = readline("Enter employee's company name: ");
        
        echo "[1] Commission Employee\n";
        echo "[2] Hourly Employee\n";
        echo "[3] Piece Worker\n";
        
        $type = (int)readline("Select employee type: ");
        
        switch ($type) {
            case 1:
                $regularSalary = (float)readline("Enter regular salary: ");
                $itemsSold = (int)readline("Enter number of items sold: ");
                $commissionRate = (float)readline("Enter commission rate (%): ");
                $employee = new CommissionEmployee($name, $address, $age, $companyName, $regularSalary, $itemsSold, $commissionRate);
                break;
            case 2:
                $hoursWorked = (float)readline("Enter hours worked: ");
                $rate = (float)readline("Enter hourly rate: ");
                $employee = new HourlyEmployee($name, $address, $age, $companyName, $hoursWorked, $rate);
                break;
            case 3:
                $numberItems = (int)readline("Enter number of items produced: ");
                $wagePerItem = (float)readline("Enter wage per item: ");
                $employee = new PieceWorker($name, $address, $age, $companyName, $numberItems, $wagePerItem);
                break;
            default:
                echo "Invalid input. Please try again.\n";
                $this->addMenu();
                return;
        }

        $this->roster->add($employee);
        $this->repeat();
    }

    public function repeat() {
        $c = readline("Add another employee? (y/n): ");
        if (strtolower($c) == 'y') {
            $this->addMenu();
        } else {
            $this->entrance();
        }
    }

    public function deleteMenu() {
        $this->roster->display();
        $index = (int)readline("Enter the employee number to delete: ");
        $this->roster->remove($index);
        readline("Press \"Enter\" to return to the menu...");
        $this->entrance();
    }

    public function viewMenu() {
        $this->clear();
        echo "[1] Display All Employees\n";
        echo "[2] Display Commission Employees\n";
        echo "[3] Display Hourly Employees\n";
        echo "[4] Display Piece Workers\n";
        echo "[0] Return to Main Menu\n";

        $choice = (int)readline("Select an option: ");

        switch ($choice) {
            case 1:
                $this->roster->displayAll();
                break;
            case 2:
                $this->roster->displayCommissionEmployees();
                break;
            case 3:
                $this->roster->displayHourlyEmployees();
                break;
            case 4:
                $this->roster->displayPieceWorkers();
                break;
            case 0:
                $this->entrance();
                return;
            default:
                echo "Invalid input.\n";
        }
        
        readline("Press \"Enter\" to return to the view menu...");
        $this->viewMenu();
    }

    public function clear() {
        system('clear'); // or 'cls' on Windows
    }
}

// Run the application
$entry = new Main();
$entry->start();
