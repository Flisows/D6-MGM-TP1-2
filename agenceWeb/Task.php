<?php
abstract class Task {
    protected $id;
    protected $title;
    protected $assignedTo;
    protected $isCompleted;

    public function __construct($id, $title, Developer $assignedTo) {
        $this->id = $id;
        $this->title = $title;
        $this->assignedTo = $assignedTo;
        $this->isCompleted = false;
    }

    public function completeTask() {
        if ($this->isCompleted) {
            throw new TaskAlreadyCompletedException("La tâche est déjà complétée.");
        }
        $this->isCompleted = true;
    }

    public function isCompleted() {
        return $this->isCompleted;
    }

    public function getAssignedTo() {
        return $this->assignedTo;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }
}

class TaskAlreadyCompletedException extends Exception {
    public function __construct($message = "La tâche est déjà complétée.", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
?>