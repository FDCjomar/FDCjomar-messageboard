<?php

App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
class UsersController extends AppController {

    public $components = array('Session');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout', 'index');
        $this->Auth->deny('logout');
        
    }

    public function beforeSave($options = array()) {
        if (!empty($this->data[$this->alias]['last_login_time'])) {
            // Convert last_login_time to Manila time before saving
            $utcDateTime = new DateTime($this->data[$this->alias]['last_login_time'], new DateTimeZone('UTC'));
            $manilaTimezone = new DateTimeZone('Asia/Manila');
            $utcDateTime->setTimezone($manilaTimezone);
            $this->data[$this->alias]['last_login_time'] = $utcDateTime->format('Y-m-d H:i:s');
        }
        return true;
    }


    

  
    public function login(){
      
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
               // Successfully logged in
            $user = $this->Auth->user();
            
            // Update last_login_time
            $this->User->id = $user['id'];
            CakeTime::timezone('Asia/Manila');
            // Get the current date and time in Manila time for today
            
            
            $this->User->saveField('last_login_time',CakeTime::format('Y-m-d H:i:s', 'now', true));

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
                $this->User->id = $this->User->getLastInsertID();
                CakeTime::timezone('Asia/Manila');
                $this->User->saveField('last_login_time', CakeTime::format('Y-m-d H:i:s', 'now', true));
    
                $credentials = array(
                    'email' => $this->request->data['User']['email'],
                    'password' => $this->request->data['User']['password']
                );
                $this->Auth->login($credentials);
                
                
                $response = array('status' => 'success', 'message' => 'Successfully Register');  
            } else {
                $response = array('status' => 'error', 'errors' => $this->User->validationErrors);
            }

            echo json_encode($response);
            exit();
        }
    }

    public function changeEmail() {
       $this->Session->setFlash(null);

    if ($this->request->is('post')) {
        $this->User->set($this->request->data);
        if ($this->User->validates(array('fieldList' => array('email')))) {
            $userId = $this->Auth->user('id'); 
            $this->User->id = $userId; 
            $this->User->saveField('email', $this->request->data['User']['email']);
            
        } else {
            $this->set('errors', $this->User->validationErrors);
        }
    }
    }

    public function changePassword(){
      
        if($this->request->is('post', 'put')){
            $this->User->set($this->request->data);
            if($this->User->validates(array('fieldList' => array('newPassword', 'newPassword_confirmation')))){
               
            } else {
                debug($this->User->validationErrors);
                debug($this->request->data);

            }
        }
        
    }

    public function logout(){
        $this->redirect($this->Auth->logout());
    }


}