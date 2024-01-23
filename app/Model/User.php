<?php

App::uses('AppModel', 'Model');

class User extends AppModel {
    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Name is required',
                'required' => true,
                'allowEmpty' => false,
                'on' => 'create'
            ),
            'between' => array(
                'rule' => array('between', 5, 20),
                'message' => 'Name must be between 5 and 20 characters'
            ),
        ),
        'email' => array(
            'rule' => array('email'),
            'message' => 'Invalid email format',
            'required' => true,
            'allowEmpty' => false,
            'on' => 'create'
        ),
        'email' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter your email address.',
                'allowEmpty' => false,
                'required' => true,
            ),
            'email' => array(
                'rule' => 'isUnique',
                'message' => 'This email has already been taken',
                'on' => 'create'
            ),
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a password.',
                'allowEmpty' => false,
                'required' => true,
                'on' => 'create'
            ),
        ),
        'password_confirmation' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please confirm your password.',
                'allowEmpty' => false,
                'required' => true,
                'on' => 'create'
            ),
            'custom' => array(
                'rule' => array('comparePasswords'),
                'message' => 'Passwords do not match.',
            ),
        ),
       
       
    );

    public function beforeSave($options = array()) {
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
        }
        return true;
    }

    public function comparePasswords($check) {
        $password = reset($check);
        return $password === $this->data['User']['password'];
    }

    
}