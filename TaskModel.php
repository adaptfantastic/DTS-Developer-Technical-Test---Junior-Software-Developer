<?php
// TaskModel.php

function createTask($pdo, $title, $description, $status, $due_datetime) {
    try {
        // --- INSERT TASK ---
        $sql = "INSERT INTO tasks (title, description, status, due_datetime, created_at) 
                VALUES (?, ?, ?, ?, NOW())";

        $stmt = $pdo->prepare($sql);
        $params = [$title, $description, $status, $due_datetime];
        $stmt->execute($params);

        $task_id = $pdo->lastInsertId();
        
        // --- FETCH AND RETURN ---
        $stmt = $pdo->prepare("SELECT id, title, description, status, due_datetime, created_at FROM tasks WHERE id = ?");
        $stmt->execute([$task_id]);
        
        // Return the created task data array
        return $stmt->fetch(); 

    } catch (\PDOException $e) {
        // Throw an exception so the calling controller can catch it and send a 500 error
        throw new \Exception("Database error during task creation: " . $e->getMessage());
    }
}

?>