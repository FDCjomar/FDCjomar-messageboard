<?php
App::uses('AppController', 'Controller');

class ProfilesController extends AppController {

    public $uses = array('User'); 

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
        $this->Auth->deny('index');
        
    }
    public function index(){

    }

    public function edit(){
        $authUser = $this->Auth->user();
       $user = $this->User->find('first', array(
            'conditions' => array('User.id' => $authUser['id'])
        ));

        if($user) {
            $this->set('user', $user);
        }
    }
}