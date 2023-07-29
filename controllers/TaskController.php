<?php

class TaskController extends Controller 
{
    private $mainTpl = "main";
    private $createTpl = "create-task";
    private $editTpl = "edit-task";
    private $tasksPerPage = 3;

    public function __construct() {
        $this->model = new TaskModel();
        $this->view = new View();
        $this->utils = new Utils();
    }

    public function index() 
    {
        $allTasks = $this->model->getCountTasks();

        if ($allTasks > 0) {
            $totalPages = ceil($allTasks / $this->tasksPerPage);
            [ $leftLimit, $rightLimit ] = $this->utils->getLimits($allTasks, $totalPages, $this->tasksPerPage);
            [ $sortBy, $sortDirect ] = $this->utils->getSortParams();

            $this->pageData['title'] = "Задачи";
            $this->pageData['tasksOnPage'] = $this->model->getLimitTasks($leftLimit, $rightLimit, $sortBy, $sortDirect);
            $this->pageData['pagination'] = $this->utils->drawPagerButtons($allTasks, $this->tasksPerPage);
        } else {
            $this->pageData['message'] = "Список пуст. Добавьте первую задачу.";
        }
        $this->view->render($this->mainTpl, $this->pageData);
    }

    public function create()
    {
        $this->pageData['title'] = "Новая задача";
        $this->view->render($this->createTpl, $this->pageData);        
    }

    public function store() 
    {
        if (!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['task'])) {

            $fullName = strip_tags(trim($_POST['full_name']));
            $email = strip_tags(trim($_POST['email']));
            $task = strip_tags(trim($_POST['task']));
            $createdAt = time();

            if($this->model->saveTask($fullName, $email, $task, $createdAt)) {
                header("Location: /task?orderby=created_at&sortDirect=DESC");
            }
        }        
    }

    public function edit()
    {
        if(!isset($_SESSION['auth']) || !$_SESSION['auth']['is_admin']) {
            header("Location: /");
        }
        $task = $this->model->getOneTask($_GET['id']);
        $this->pageData['title'] = "Редактирование";
        $this->pageData['task'] = $task;
        $this->view->render($this->editTpl, $this->pageData);         
    }

    public function update() 
    {
        if(!isset($_SESSION['auth']) || !$_SESSION['auth']['is_admin']) {
            header("Location: /");
        }        
        if (empty($_POST['task'])) {
            $this->pageData['error'] = "Не все поля заполнены!";  
            $this->view->render($this->editTpl, $this->pageData);         
        } else {
            $task = strip_tags(trim($_POST['task']));
            $status = $_POST['status'] == 'on' ? 1 : 0;
            $id = strip_tags(trim($_GET['id']));

            $this->model->updateTask($task, $status, $id);
            header("Location: /task?orderby=created_at&sortDirect=DESC");           
        }   
    }
}
