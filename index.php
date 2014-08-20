<?php
// include __DIR__ . "/vendor/autoload.php";


include __DIR__ . "/src/Http/Request.php";
$query = $db = include __DIR__ . "/app/db.php";
include __DIR__."/app/models/Task.php";

use Phpcourses\Http\Request;
$request = new Request();

if ($request->getRoute() == "list") {
    todoList($request, $db);
}

if ($request->getRoute() == "delete") {
    todoDelete($request,$db);
}

if ($request->getRoute() == "add") {
    todoAdd($request, $db);
}

if ($request->getRoute() == "save") {
    todoSaveToDb($request,$db);
}
if ($request->getRoute() == "show") {
    todoShow($request,$db);
}
if ($request->getRoute() == "update") {
    todoUpdate($request,$db);
}

function todoList($request,$db)
{
    $pageTitle = "ToDo List";
    $query = $db->query('SELECT id, title, resolved, createdAt from tasks');
    $query->setFetchMode(PDO::FETCH_CLASS, 'Task');

    include __DIR__."/app/views/list.php";
}

function todoDelete($request,$db)
{  
    // $query = $db->query('DELETE FROM tasks');
    $id = $request->getParam("id");
    $query = $db->prepare("DELETE FROM tasks WHERE id= :id");
    $query->execute(array(
        "id"=> $id
        ));

    header("Location: /");
}

function todoAdd($request, $db)
{
    // get from $_POST
    $title;
    $data;
    include __DIR__."/app/views/add.php";
}

function todoSaveToDb($request, $db)
    {
        echo var_dump($_POST);
        //  index to db
        // header();
        $query = $db->prepare("INSERT INTO tasks ( title, resolved, createdAt ) 
        values ( :title, :resolved, :date)");
            $query->execute(array(
                "title" => $request->getPost("title", ""),
                "resolved" => ($request->getPost("resolved", false)) ? 1: 0,
                "date" => date("Y-m-d H:i:s")
            ));
    header("Location: http://todo.my/index.php?r=list");
    }


function todoShow($request, $db)
{   
    $id = $request->getParam("id");
    $query = $db->prepare('SELECT id, title, resolved, createdAt FROM tasks WHERE id= :id');
    
    $query->execute(array(
        "id"=> $id
        ));

    $query->setFetchMode(PDO::FETCH_CLASS, 'Task');
    
    $task = $query->fetch();

    include __DIR__."/app/views/show.php";
}

function todoUpdate($request, $db)
{
    $id = $request->getParam("id");

    $query = $db->prepare('SELECT id, title, resolved, createdAt FROM tasks WHERE id= :id');
    
    $query->execute(array(
        "id"=> $id
        ));
   
    $query->setFetchMode(PDO::FETCH_CLASS, 'Task');
    $task = $query->fetch();

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
        $query = $db->prepare("UPDATE tasks
            SET
                title = :title,
                resolved = :resolved,
                createdAt = :createdAt
            WHERE id = :id");

        $query->execute(array(
            "title" => $request->getPost("title", ""),
            "resolved" => ($request->getPost("resolved", false)) ? 1: 0,
            "createdAt" => date("Y-m-d H:i:s"),
            "id" => $id
        ));
        header("Location: /?r=show&id=".$task['id']);
        }
    
    
    include __DIR__ . "/app/views/update.php";
}

function todoResolve()
{

}


// $filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
// if (php_sapi_name() === 'cli-server' && is_file($filename)) {
//     return false;
// }

// $app = require __DIR__.'/src/app.php';
// $app->run();
