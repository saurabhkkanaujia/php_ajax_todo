<?php
session_start();
// session_destroy();
    if (isset($_POST['input'])){
        if (isset($_SESSION['lists'])){
            array_push($_SESSION['lists'], $_POST['input']);
            echo json_encode($_SESSION['lists']);
        }
        else{
            $_SESSION['lists'] = array($_POST['input']);
            echo json_encode($_SESSION['lists']);
        }
    }

    if(isset($_POST['index'])){
        if ($_POST['option'] == 'uncompleted'){
            array_splice($_SESSION['lists'], $_POST['index'], 1);
            echo json_encode($_SESSION);
        }
        elseif ($_POST['option']=='completed'){
            array_splice($_SESSION['completed'], $_POST['index'], 1);
            echo json_encode($_SESSION);
        }
    }

    if(isset($_POST['editIndex'])){
        if ($_POST['option'] == 'uncompleted'){
            echo json_encode($_SESSION['lists']);
        }
        elseif ($_POST['option']=='completed'){
            echo json_encode($_SESSION['completed']);
        }
    }

    if(isset($_POST['updateIndex'])){
        if ($_POST['option'] == 'uncompleted'){
            $_SESSION['lists'][$_POST['updateIndex']] = $_POST['newList'];
            echo json_encode($_SESSION['lists']);
        }
        elseif ($_POST['option']=='completed'){
            $_SESSION['completed'][$_POST['updateIndex']] = $_POST['newList'];
            echo json_encode($_SESSION['completed']);
        }
        
        
    }

    if(isset($_POST['checkIndex'])){
        $toPushList = $_SESSION['lists'][$_POST['checkIndex']];
        array_splice($_SESSION['lists'], $_POST['checkIndex'], 1);
        if (isset($_SESSION['completed'])){
            array_push($_SESSION['completed'], $toPushList);
        }
        else{
            $_SESSION['completed'] = array($toPushList);
        }
        echo json_encode($_SESSION);
    }

    if(isset($_POST['uncheckIndex'])){
        $toPushList = $_SESSION['completed'][$_POST['uncheckIndex']];
        array_splice($_SESSION['completed'], $_POST['uncheckIndex'], 1);
        
        if (isset($_SESSION['lists'])){
            array_push($_SESSION['lists'], $toPushList);
        }
        else{
            $_SESSION['lists'] = array($toPushList);
        }
        echo json_encode($_SESSION);
    }

?>