<?php

class TaskController extends Controller 
{
    private $pageTpl = "/views/pages/main.tpl.php";
    private $createTaskTpl = "/views/pages/create-task.tpl.php";
    private $editTaskTpl = "/views/pages/edit-task.tpl.php";
    private $tasksPerPage = 3;

    public function __construct() {
        $this->model = new TaskModel();
        $this->view = new View();
        $this->utils = new Utils();
    }

    public function index() 
    {
        $allTasks = $this->model->getCountTasks();

        // pagination
        $totalPages = ceil($allTasks / $this->tasksPerPage);
        $this->makeTaskPager($allTasks, $totalPages);
        $pagination = $this->utils->drawPager($allTasks, $this->tasksPerPage);
    
        // rendering
        $this->pageData['pagination'] = $pagination;
        $this->pageData['title'] = "Задачи";
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function makeTaskPager($allTasks, $totalPages)
    {
        if (!isset($_GET['page']) || intval($_GET['page']) == 0 || intval($_GET['page']) == 1 || intval($_GET['page']) < 0) {
            $pageNumber = 1;
            $leftLimit = 0;
            $rightLimit = $this->tasksPerPage;
        } elseif (intval($_GET['page']) > $totalPages || intval($_GET['page']) == $totalPages) {
            $pageNumber = $totalPages;
            $leftLimit = $this->tasksPerPage * ($pageNumber - 1);
            $rightLimit = $allTasks;
        } else {
            $pageNumber = intval($_GET['page']);
            $leftLimit = $this->tasksPerPage * ($pageNumber - 1);   
            $rightLimit = $this->tasksPerPage;      
        }

        if (isset($_GET['orderby']) && $this->checkGetParamToSort($_GET['orderby'])) {
            $orderBy = $_GET['orderby'];            
        } else {
            $orderBy = 'created_at';             
        }

        $_SESSION['boolean'] = !isset($_SESSION['boolean']) ? true : !$_SESSION['boolean'] ;
        $sortDirect = $_SESSION['boolean'] ? 'DESC' : 'ASC';        
        $this->pageData['tasksOnPage'] = $this->model->getLimitTasks($leftLimit, $rightLimit, $orderBy, $sortDirect);
    }

    private function checkGetParamToSort($param) 
    {
        $sortGetParams = [
            'full_name' => 1,
            'email' => 1,
            'status' => 1
        ];
        return isset($sortGetParams[$param]);
    }

    public function create()
    {
        $this->pageData['title'] = "Новая задача";
        $this->view->render($this->createTaskTpl, $this->pageData);        
    }

    public function store() 
    {
        if (!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['task'])) {

            $fullName = strip_tags(trim($_POST['full_name']));
            $email = strip_tags(trim($_POST['email']));
            $task = strip_tags(trim($_POST['task']));
            $createdAt = time();

            unset($_SESSION['boolean']);
            if($this->model->saveTask($fullName, $email, $task, $createdAt)) {
                header("Location: /");
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
        $this->view->render($this->editTaskTpl, $this->pageData);         
    }


    public function update() 
    {
        if(!isset($_SESSION['auth']) || !$_SESSION['auth']['is_admin']) {
            header("Location: /");
        }        
        if (empty($_POST['task'])) {
            $this->pageData['error'] = "Не все поля заполнены!";  
            $this->view->render($this->editTaskTpl, $this->pageData);         
        } else {
            $task = strip_tags(trim($_POST['task']));
            $status = $_POST['status'] == 'on' ? 1 : 0;
            $id = strip_tags(trim($_GET['id']));

            unset($_SESSION['boolean']);
            $this->model->updateTask($task, $status, $id);
            header("Location: /");            
        }   
    }
}