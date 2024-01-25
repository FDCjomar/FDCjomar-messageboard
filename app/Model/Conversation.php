<?php
App::uses('AppModel', 'Model');

class Conversation Extends AppModel {

    public $name = 'Conversation';

    public $belongsTo = array(
        'User1' => array(
            'className' => 'User',
            'foreignKey' => 'user1_id'
        ),
        'User2' => array(
            'className' => 'User',
            'foreignKey' => 'user2_id'
        )
    );

    public $hasMany = array(
        'Message' => array(
            'className' => 'Message',
            'foreignKey' => 'conversation_id',
            'dependent' => true // This option determines whether associated messages should be deleted when the conversation is deleted.
        )
    );
}