<?php
class Project {
    private $id;
    private $name;
    private $clientName;
    private $startDate;
    private $endDate;
    private $tasks = [];

    public function __construct($id, $name, $clientName, DateTime $startDate, DateTime $endDate = null) {
        $this->id = $id;
        $this->name = $name;
        $this->clientName = $clientName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getId() {
        return $this->id;
    }

    public function addTask(Task $task) {
        $this->tasks[] = $task;
    }

    public function getProgress() {
        $totalTasks = count($this->tasks);
        if ($totalTasks == 0) {
            return 0;
        }
        $completedTasks = 0;
        foreach ($this->tasks as $task) {
            if ($task->isCompleted()) {
                $completedTasks++;
            }
        }
        return ($completedTasks / $totalTasks) * 100;
    }

    public function getTasks() {
        return $this->tasks;
    }

    public function getName() {
        return $this->name;
    }

    public function getClientName() {
        return $this->clientName;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }
}
?>