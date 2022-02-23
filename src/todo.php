<?php
    session_start();

    function displayList(){
        if(isset($_SESSION['lists'])){    
            foreach($_SESSION['lists'] as $key=>$value){
                echo '
                <form action="" method = "POST">
                    <li>    
                        <input type="checkbox" class="check" data-id='.$key.'>
                        <label>'.$value.'</label><input type="text">
                        <button class="edit" data-option="uncompleted" data-id="'.$key.'">Edit</button>
                        <button class="delete" data-option="uncompleted" data-id = "'.$key.'">Delete</button>
                    </li>
                </form>';
            } 
        }
    }
    function displayCompleted(){
        if(isset($_SESSION['completed'])){    
            foreach($_SESSION['completed'] as $key=>$value){
                echo '
                <form action="" method = "POST">
                    <li>    
                        <input type="checkbox" class="uncheck" data-id='.$key.' checked>
                        <label>'.$value.'</label><input type="text">
                        <button class="edit" data-option = "completed" data-id="'.$key.'">Edit</button>
                        <button class="delete" data-option = "completed" data-id = "'.$key.'">Delete</button>
                    </li>
                </form>';
            } 
        }
    }

?>
<html>
    <head>
        <title>TODO List</title>
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h2>TODO LIST</h2>
            <h3>Add Item</h3>
            <p>
                <input id="newtask" type="text">
                <button id="add" name="add">Add</button>
            </p>
    
            <h3>Todo</h3>
            <ul id="incomplete-tasks">
                <?php displayList(); ?>
            </ul>
    
            <h3>Completed</h3>
            <ul id="completed-tasks">
                <?php displayCompleted(); ?>
            </ul>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="script.js"></script>
    </body>
</html>