<?php
require_once 'functions.php';
require_once "TaskModel.php";


    $pdo = require 'init.php';

    $title= get_and_sanitize_post('title');
    $description= get_and_sanitize_post('description');
    $status= get_and_sanitize_post('status');
    $due_datetime= get_and_sanitize_post('due_datetime');

    
    $errors = []; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        add_json_error($title, "The Title field cannot be empty.", "missing_Title",$errors);
        add_json_error($status, "A status must be selected.", "missing_Status",$errors);
        add_json_error($due_datetime, "A due date is required.", "missing_DueTime",$errors);

        if (count($errors) > 0) {

            header('Content-Type: application/json');
            http_response_code(400); // 400 Bad Request is the correct status for validation failure
            
            echo json_encode([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $errors // Output the collected errors array
            ]);
            exit;
        }

    // 4. VALIDATION SUCCEEDED: DELEGATE TO MODEL AND HANDLE RESPONSE
        try {
            // Call the database model function
            $new_task = createTask($pdo, $title, $description, $status, $due_datetime);

            // --- SUCCESS: SEND 201 JSON RESPONSE ---
            header('Content-Type: application/json');
            http_response_code(201); // 201 Created
            echo json_encode([
                'success' => true,
                'message' => 'Task created successfully.',
                'task'    => $new_task
            ]);
            exit;

        } catch (\Exception $e) {
            // --- DB ERROR: SEND 500 JSON RESPONSE ---
            http_response_code(500); 
            error_log($e->getMessage()); 
            
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Internal Server Error: Could not create task.'
            ]);
            exit;
        }

    }

?>