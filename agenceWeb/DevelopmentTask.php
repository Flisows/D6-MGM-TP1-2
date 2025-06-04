<?php
require_once 'Task.php';
require_once 'Billable.php';

class DevelopmentTask extends Task implements Billable {
    private $estimatedHours;

    public function __construct($id, $title, Developer $assignedTo, $estimatedHours) {
        parent::__construct($id, $title, $assignedTo);
        $this->estimatedHours = $estimatedHours;
    }

    public function calculateAmount(): float {
        return $this->estimatedHours * 50;
    }
}
?>