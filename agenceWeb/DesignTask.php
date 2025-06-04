<?php
require_once 'Task.php';

class DesignTask extends Task {
    private $toolUsed;

    public function __construct($id, $title, Developer $assignedTo, $toolUsed) {
        parent::__construct($id, $title, $assignedTo);
        $this->toolUsed = $toolUsed;
    }
}
?>