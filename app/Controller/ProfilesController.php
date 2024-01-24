<?php
App::uses('AppController', 'Controller');
App::uses('String', 'Utility');
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
                if ($this->User->save($this->request->data)) {
                    // ... your logic after saving
        
                    // Reset the validation rules to the original ones
                    $this->User->validate = $originalValidationRules;
                    $response = array('status' => 'success', 'message' => 'Successfully Register');
                }
            } else {
                // Validation failed, display errors
                $response = array('status' => 'error', 'errors' => $this->User->validationErrors);
            }
    
            $this->set('response', $response);
        }

    }

  
}