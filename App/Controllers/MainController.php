<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Task;

class MainController extends Controller
    {
        public function index()
        {
            $this->view->generate('viewTasks.php', 'layout.php', $this->auth);
        }

        public function getTasks()
        {
            $task = new Task();
            $sorts = ['username', 'email', 'state'];
            $sort = in_array($_GET['sort'], $sorts) ? $_GET['sort'] : 'id';
            $order = $_GET['order'] === 'asc' ? 'asc' : 'desc';
            $resonce = [
                'total' => $task->count(),
                'rows' => $task->get($_GET['offset'] ?? 0, $_GET['limit'] ?? 3, $sort, $order)
            ];
            echo json_encode($resonce);
        }

        public function editTask(int $id)
        {
            if (!$this->auth->isLoggedIn()) {
                die(json_encode(['error' => 'Permission denied']));
            }
            if (!strlen($_POST['description'])) {
                die(json_encode(['error' => 'Description cannot be empty']));
            }

            $task = new Task();
            $task->find($id);

            if ($task->getId()) {
                $task->description = htmlspecialchars($_POST['description']);
                $task->state = $_POST['state'];
                $task->is_edit = $_POST['is_edit'];
                $task->update(get_object_vars($task));
            } else {
                die(json_encode(['error' => 'Task not found']));
            }
            
        }

        public function addTask()
        {
            $newTask = new Task();

            if (!strlen($_POST['username'])) {
                die(json_encode(['error' => 'Username cannot be empty']));
            }
            if (!strlen($_POST['email'])) {
                die(json_encode(['error' => 'Email cannot be empty']));
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                die(json_encode(['error' => 'Wrong email']));
            }
            if (!strlen($_POST['description'])) {
                die(json_encode(['error' => 'Description cannot be empty']));
            }

            $newTask->username = $_POST['username'];
            $newTask->email = $_POST['email'];
            $newTask->description = htmlspecialchars($_POST['description']);
            $newTask->insert(get_object_vars($newTask));
        }

        public function login()
        {
            try {
                $this->auth->loginWithUsername($_POST['username'], $_POST['password']);
            }
            catch (\Delight\Auth\UnknownUsernameException  $e) {
                die(json_encode(['error' => 'Wrong username or password']));
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {
                die(json_encode(['error' => 'Wrong username or password']));
            }
        }
        public function logout()
        {
            $this->auth->logOut();
            header('Location: /');
        }

    }
?>