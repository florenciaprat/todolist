<?php

function getTasks(){
    $db = new PDO('mysql:host=localhost;'.'dbname=db_tasks2021;charset=utf8' , 'root', '');
    $sentencia = $db->prepare("SELECT * FROM tareas");
    $sentencia-> execute();
    $tareas = $sentencia->fetchAll(PDO::FETCH_OBJ);
    return $tareas;
    }

    function insertTask($titulo,$descripcion,$prioridad,$finalizado){//son nombres de variables puede ir cualquier nombre pero abajo lo llamo igual
        $db = new PDO('mysql:host=localhost;'.'dbname=db_tasks2021;charset=utf8' , 'root', '');
        $sentencia=$db->prepare("INSERT INTO tareas(titulo, descripcion, prioridad, finalizado)VALUES(?,?,?,?)"); //lo del principio son los nombres de las columnas de la tabla de la bbdd
        $sentencia-> execute(array($titulo,$descripcion,$prioridad,$finalizado)); //aca lo llamo igual
    
    
    }
    function deleteTaskFromDB($id){
        $db = new PDO('mysql:host=localhost;'.'dbname=db_tasks2021;charset=utf8' , 'root', '');
        $sentencia=$db->prepare("DELETE FROM tareas WHERE id_tarea=?");
        $sentencia-> execute(array($id)); 
        

    }
    function updateTaskFromDB($id){
        $db = new PDO('mysql:host=localhost;'.'dbname=db_tasks2021;charset=utf8' , 'root', '');
        $sentencia=$db->prepare("UPDATE tareas SET finalizado=1 WHERE id_tarea=?");
        $sentencia-> execute(array($id));
    }
    function getTask($id){
        $db = new PDO('mysql:host=localhost;'.'dbname=db_tasks2021;charset=utf8' , 'root', '');
        $sentencia = $db->prepare("SELECT * FROM tareas WHERE id_tarea= ?");
        $sentencia-> execute(Array($id));
        $tarea = $sentencia->fetch(PDO::FETCH_OBJ);//me va a traer uno solo por eso hago un fetch
        return $tarea;
    }

