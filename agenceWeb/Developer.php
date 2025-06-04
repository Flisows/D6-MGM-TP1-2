<?php
class Developer {
    private $id;
    private $name;
    private $skills;
    private $assignedTasks = [];

    public function __construct($id, $name, array $skills) {
        $this->id = $id;
        $this->name = $name;
        $this->skills = $skills;
    }

    public function assignTask(Task $task) {
        $this->assignedTasks[] = $task;
    }

    public function getWorkload() {
        return count($this->assignedTasks);
    }

    public function getName() {
        return $this->name;
    }
}
?>