<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
        $this->Auth->deny('logout');
        
    }

  
    public function login(){
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid email or password, try again.'), 'default', array(), 'auth');
            }
        }
    }

    public function register(){
        if ($this->request->is('post')) {
            // debug($this->request->data);
            $this->User->create();
            if ($this->request->data['User']['password'] !== $this->request->data['User']['password_confirmation']) {
                $this->User->invalidate('password_confirmation', 'Passwords do not match.');
            }

            if ($this->User->save($this->request->data)) {
                // debug($this->User->validationErrors);
                $credentials = array(
                    'email' => $this->request->data['User']['email'],
                    'password' => $this->request->data['User']['password']
                );
    
                // Log in the user
                $this->Auth->login($credentials);
    
                $response = array('status' => 'success', 'message' => 'Successfully Register');  
            } else {
                $response = array('status' => 'error', 'errors' => $this->User->validationErrors);
            }

            echo json_encode($response);
            exit();
        }
    }

    public function logout(){
        $this->redirect($this->Auth->logout());
    }


}