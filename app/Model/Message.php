<?php

App::uses('AppModel', 'Model');


class Message extends AppModel {
    public $name = 'Message';

    public $belongsTo = array(
        'Conversation' => array(
            'className' => 'Conversation',
            'foreignKey' => 'conversation_id'
        ),
        'Sender' => array(
            'className' => 'User',
            'foreignKey' => 'sender_id'
        )
    );

}