<?php
App::uses('AppController', 'Controller');
App::uses('CakeText', 'Utility');
class ProfilesController extends AppController {

    public $uses = array('User'); 

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
        $this->Auth->deny('index');
        
    }
    public function index(){
        $authUser = $this->Auth->user();
        $user = $this->User->find('first', array(
                'conditions' => array('User.email' => $authUser['email'])
            ));

        $this->set('profile', $user);
    }

    public function edit(){
        $authUser = $this->Auth->user();
        $user = $this->User->find('first', array(
                'conditions' => array('User.id' => $authUser['id'])
            ));

            $this->set('user', $user);
        if ($this->request->is(array('post', 'put'))) {
            $originalValidationRules = $this->User->validate;

            $this->User->validate = [
                'name' => [
                    'notBlank' => [
                        'rule' => 'notBlank',
                        'message' => 'Name is required',
                        'required' => true,
                        'allowEmpty' => false,
                    ],
                    'between' => [
                        'rule' => ['between', 5, 20],
                        'message' => 'Name must be between 5 and 20 characters'
                    ],
                ],
                'birthdate' => [
                    'notBlank' => [
                        'rule' => 'notBlank',
                        'message' => 'Birthdate is required',
                        'required' => true,
                        'allowEmpty' => false,
                    ],
                ],
                'gender' => [
                    'notBlank' => [
                        'rule' => 'notBlank',
                        'message' => 'Gender is required',
                        'required' => true,
                        'allowEmpty' => false,
                    ],
                ],
                'hubby' => [
                    'notBlank' => [
                        'rule' => 'notBlank',
                        'message' => 'Hubby is required',
                        'required' => true,
                        'allowEmpty' => false,
                    ],
                ],
            ];
            
            $this->User->set($this->request->data);
            $this->User->id = $authUser['id'];
            
        if ($this->User->validates()) {
            if (!empty($this->request->data['User']['profile_img_file']['tmp_name'])) {
                $file = $this->request->data['User']['profile_img_file'];
                $fileName = CakeText::uuid() . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
                $uploadPath = WWW_ROOT . 'img/uploads' . DS . $fileName;

                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    $this->User->id = $authUser['id'];
                    $this->User->saveField('image_path', $fileName);
                    $this->User->validate = $originalValidationRules;
                    $response = array('status' => 'success', 'message' => 'Successfully updated profile');
                }
            } 
            if ($this->User->save($this->request->data, array('validate' => false))) {
                $this->User->validate = $originalValidationRules;
               
                $response = array('status' => 'success', 'message' => 'Successfully updated profile');
            }
            $this->redirect(['controller' => 'Profiles', 'action' => 'index']);
        } else {
            $response = array('status' => 'error', 'errors' => $this->User->validationErrors);
        }

        $this->set('response', $response);
        }

    }

  
}