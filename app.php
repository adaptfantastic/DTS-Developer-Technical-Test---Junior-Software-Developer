<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Creation Form</title>
</head>
<body>

    <h1>Create a New Task</h1>

    <form action="process_form.php" method="post">
        
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" ><br><br>

        <label for="description">Description (Optional):</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

        <label for="status">Status:</label><br>
        <select id="status" name="status" >
            <option value="" disabled selected>Select Status</option>
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
        </select><br><br>


        <label for="due_datetime">Due Date/Time:</label><br>
        <input 
        type="datetime-local" 
        id="due_datetime" 
        name="due_datetime" 
        ><br><br>

        <input type="submit" value="Create Task">
    </form>

</body>
</html>