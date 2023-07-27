<?php

class UserController extends Controller 
{
    private $loginTpl = '/views/pages/login.tpl.php';
    private $registerTpl = '/views/pages/register.tpl.php';
    private $profileTpl = '/views/pages/profile.tpl.php';

    public function __construct() 
    {
        $this->model = new UserModel();
        $this->view = new View();
    }

    public function register() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->pageData['title'] = "Регистрация";
            $this->view->render($this->registerTpl, $this->pageData);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['login']) || empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_confirm'])) {
                $this->pageData['title'] = "Ошибка";
                $this->pageData['error'] = "Не все поля заполнены";
                $this->view->render($this->registerTpl, $this->pageData);
                return;
            }
            if ($_POST['password'] !== $_POST['password_confirm']) {
                $this->pageData['title'] = "Ошибка";
                $this->pageData['error'] = "Неверное подтверждение пароля";
                $this->view->render($this->registerTpl, $this->pageData);
                return;
            }
            $login = strip_tags(trim($_POST['login']));
            $fullName = strip_tags(trim($_POST['full_name']));
            $email = strip_tags(trim($_POST['email']));
            $password = strip_tags(trim($_POST['password']));
            $password = md5($password);

            if($this->model->saveAccount($login, $fullName, $email, $password)) {
                header("Location: /user/login");
            } else {
                $this->pageData['title'] = "Ошибка";
                $this->pageData['error'] = "Регистрация не удалась";
                $this->view->render($this->registerTpl, $this->pageData);                
            }
        }
    }

    public function login() 
    {
        if (!empty($_POST)) {
            if (empty($_POST['login']) || empty($_POST['password'])) {
                $this->pageData['title'] = "Ошибка";
                $this->pageData['error'] = "Не все поля заполнены";
                $this->view->render($this->loginTpl, $this->pageData);
                return;
            }
            $login = strip_tags(trim($_POST['login']));
            $password = strip_tags(trim($_POST['password']));
            $password = md5($password);

            $user = $this->model->checkUser($login, $password);

            if($user) {
                $_SESSION['auth'] = $user;
                header("Location: /");
            } else {
                $this->pageData['error'] = "Неправильный логин или пароль";
            } 
        }   
        $this->pageData['title'] = "Вход в личный кабинет";
        $this->view->render($this->loginTpl, $this->pageData);             
    }
       
    public function profile() 
    {
        if(!$_SESSION['auth']) {
            header("Location: /");
        }
        $user = $this->model->getUser($_SESSION['auth']['id']);

        $this->pageData['title'] = $user['full_name'];
        $this->pageData['user'] = $user;
        $this->view->render($this->profileTpl, $this->pageData);
    }

    public function logout() 
    {
        session_destroy();
        header("Location: /");
    }
}