<?php

class UserController extends Controller 
{
    private $loginTpl = 'login';

    public function __construct() 
    {
        $this->model = new UserModel();
        $this->view = new View();
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

    public function logout() 
    {
        session_destroy();
        header("Location: /");
    }
}