<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

    public $name = 'User';

    public $hasMany = array(
        'SentMessages' => array(
            'className' => 'Message',
            'foreignKey' => 'sender_id'
        ),
        'ConversationsUser1' => array(
            'className' => 'Conversation',
            'foreignKey' => 'user1_id'
        ),
        'ConversationsUser2' => array(
            'className' => 'Conversation',
            'foreignKey' => 'user2_id'
        )
    );

    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Name is required',
                'required' => true,
                'allowEmpty' => false,
                'on' => 'register'
            ),
            'between' => array(
                'rule' => array('between', 5, 20),
                'message' => 'Name must be between 5 and 20 characters'
            ),
        ),
        'email' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter your email address.',
                'allowEmpty' => false,
                'required' => true,
            ),
            'email' => array(
                'rule' => array('email', true),
                'message' => 'Please enter a valid email address.',
                'allowEmpty' => false,
                'required' => true,
            ),
            'isUnique' => array(
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
        'newPassword' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a new password.',
                'allowEmpty' => false,
                'required' => true,
                'on' => 'create'
            ),
        ),
        'newPassword_confirmation' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please confirm your new password.',
                'allowEmpty' => false,
                'required' => true,
                'on' => 'create'
            ),
            'custom' => array(
                'rule' => array('compareNewPasswords'),
                'message' => 'New Passwords do not match.',
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
        return $password === $this->data[$this->alias]['password'];
    }
 
    public function compareNewPasswords($check) {
        $password = reset($check);
        return $password === $this->data[$this->alias]['newPassword'];
    }
 
 

    public function isValidMimeType($check, $allowedMimeTypes) {
        $file = current($check);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
    
        return in_array($mime, $allowedMimeTypes);
    }
    
}