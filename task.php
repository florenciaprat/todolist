<?php
function showHome(){
    $html= '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <base href ="'.BASE_URL.'"/>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <title>To do list app</title>
        
    </head>
        <body>
            <h1>Tareas 2022</h1>
            <ul> ';

            $tasks = getTasks();
            
            foreach($tasks as $tarea){
                if($tarea->finalizado==1){//forma fea de subrayar
                    $html.= '<li> <div class="card-body"><strike>'.$tarea->titulo.': '.$tarea->descripcion.'-'.'<a class="btn btn-danger" href="deleteTask/'.$tarea->id_tarea.'">Borrar </a> - <a class="btn btn-success" href="updateTask/'.$tarea->id_tarea.'">Done</a>'.'</strike> </div></li>';
                }else{
                    $html.= '<li> <div class="card-body"> <a href="viewTask/'.$tarea->id_tarea.'">'.$tarea->titulo.'</a>: '.$tarea->descripcion.'-'.'<a class="btn btn-danger" href="deleteTask/'.$tarea->id_tarea.'">Borrar </a> - <a href="updateTask/'.$tarea->id_tarea.'">Done</a>'.' </div> </li>';
                }
            }

            $html.= '  </ul>
            <h3> CREAR TAREA </h3>
            <form action="createTask" method="post">
                <input type="text" name="title" id="tittle">
                <input type="text" name="description" id="description">
                <input type="text" name="priority" id="priority">
                <input type="checkbox" name="done" id="done">
                <input type="submit" class="btn btn-info" value="Guardar">

            </form>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

        </body>
    </html> ';
    echo $html;
}

function createTask(){
    if(!isset($_POST['done'])){
        $done = 0;
    }else{
        $done=1;
    }
    //agarramos lo del formulario por post por eso entre[] los nombre de los input de arriba
    insertTask($_POST['title'],$_POST['description'],$_POST['priority'],$done);
    header("Location: home");//esto me carga la home con la nueva tarea añadida
}

function deleteTask($id){
    deleteTaskFromDB($id);
    header("Location: ".BASE_URL."home"); //redirecciona de otra forma, se olvida en donde estaba parado, agarra la url base


}

function updateTask($id){
    updateTaskFromDB($id);
    header("Location: ".BASE_URL."home");

}
function viewTask($id){
    $tarea=getTask($id);
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <base href ="'.BASE_URL.'"/>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <title>To do list app</title>
        
    </head>
        <body>
            <h1> Titulo: '.$tarea->titulo.'</h1>
            <h2>Descripcion: '.$tarea->descripcion.'</h2>
            <h2>Prioridad: '.$tarea->prioridad.'</h2>
            <h2>Finalizado: '.$tarea->finalizado.'</h2>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

        </body>
</html> ';

}
