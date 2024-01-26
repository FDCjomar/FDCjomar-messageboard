<?php

App::uses('AppController', 'controller');

class MessagesController extends AppController {

    public $components = array('Paginator');

    public function index(){
        $this->loadModel('User');
        $this->loadModel('Conversation');
        $this->loadModel('Message');
        $authUser = $this->Auth->user('id');
        // $conversations = $this->Conversation->find('all');
        
        $getUser = $this->User->findById($authUser);
        $conversations = $this->User->ConversationsUser1->find('all', array(
            'conditions' => array(
                'OR' => array(
                    array('ConversationsUser1.user1_id' => $authUser),
                    array('ConversationsUser1.user2_id' => $authUser)
                )
            ),
            'contain' => array(
                'User2' => array(
                    'fields' => array('name') // Specify the fields you want to retrieve
                )
            ),
            'order' => array('ConversationsUser1.created' => 'DESC')
        ));
        
        $this->set(array('conversations' => $conversations, 'authUserId' => $authUser));
    
    }

    public function delete($id) {
        $this->autoRender = false;
    
        if ($this->request->is('ajax')) {
            $this->loadModel('Conversation');
    
            if ($this->Conversation->delete($id)) {
                $response = array('status' => 'success', 'message' => 'Successfully deleted');
            } else {
                $response = array('status' => 'error', 'message' => 'Failed to delete');
            }
    
            echo json_encode($response);
            exit();
        }
    }

    public function getUserSuggestions($query = null) {
        $this->autoRender = false;
        $this->layout = 'ajax';
    
        $users = $this->User->find('all', array(
            'conditions' => array('User.name LIKE' => '%' . $query . '%'),
            'fields' => array('id', 'name'),
            'limit' => 10
        ));
    
        echo json_encode($users);
    }

    public function search(){

        $this->autoRender = false;
        if($this->request->is('ajax')){
            $query = $this->request->data['query'];

            $authUser = $this->Auth->user('id');
            debug($authUser);
        
            
            $response = array('status' => 'success', 'message' => 'successfully search: ');
        } else {
            $response = array('status' => 'erro', 'message' => 'failed search');

        }
        echo json_encode($response);
            exit();
    }

    public function compose(){
        $this->loadModel('User');
        $data = $this->User->find('list');
        // $formattedData = array();
        // foreach ($data as $id => $text) {
        //     $formattedData[] = array('id' => $id, 'text' => $text);
        // }
        $this->set('data', $data);
        
    }
    public function send(){
        $this->loadModel('Conversation');
        $this->loadModel('Message');
        $this->autoRender = false;
        if($this->request->is('post')){
            $userId = $this->Auth->user('id');

            $recipientId = $this->request->data['Message']['recipient'];
            $userConversation = array(
                'user1_id' => $userId,
                'user2_id' => $recipientId,
            );
            if($this->Conversation->save($userConversation)){
                $conversationId = $this->Conversation->getLastInsertID();

                $message = array(
                    'conversation_id' => $conversationId,
                    'sender_id' => $userId,
                    'content' => $this->request->data['Message']['content'], // Assuming 'content' is the message content
                    'created' => date('Y-m-d H:i:s') // Assuming 'created' field is automatically set
                );

                if ($this->Message->save($message)) {
                    $this->redirect(['action' => 'index']);

                } else {
                    die('Failed save message');
                }

            } else {
                die('Failed to save');
            }

        }
    }

    public function view($id){

        
        $this->loadModel('User');
        $this->loadModel('Conversation');
        $this->loadModel('Message');
        $this->Conversation->Behaviors->load('Containable');
        $conversations = $this->Conversation->find('first', array(
            'conditions' => array('Conversation.id' => $id),
            'contain' => array(
                'Message' => array(
                    'order' => array('Message.created' => 'ASC') 
                )
            )
        ));
        $senderIds = array_unique(array_column($conversations['Message'], 'sender_id'));
        $sendersData = $this->User->find('all', array(
            'conditions' => array('User.id' => $senderIds),
            'fields' => array('User.id', 'User.name', 'User.image_path') 
        ));
        
        $senders = [];
        foreach ($sendersData as $sender) {
            $senders[$sender['User']['id']] = [
                'name' => $sender['User']['name'],
                'image_path' => $sender['User']['image_path']
            ];
        }
        
        foreach ($conversations['Message'] as &$message) {
            if (isset($senders[$message['sender_id']])) {
                $message['sender_name'] = $senders[$message['sender_id']]['name'];
                $message['sender_image_path'] = $senders[$message['sender_id']]['image_path'];
                $message['auth_id'] = $userId = $this->Auth->user('id');
                if($message['sender_image_path'] == null){
                    $message['sender_image_path'] = $message['sender_image_path'] = 'default-pic.png'; 
                }
            } else {
                $message['sender_name'] = 'Unknown'; 
                $message['sender_image_path'] = 'default-pic.png'; 
            }
        }
        
        
        $this->set('conversations', $conversations);
    }

    public function reply($conversation_id){

        $this->loadModel('Message');
        $this->autoRender = false;

        if($this->request->isAjax()){
            $this->Message->create();

            $reply = array(
                'conversation_id' => $conversation_id,
                'sender_id' => $this->Auth->user('id'),
                'content' => $this->request->data['Message']['content']
            );
            if($this->Message->save($reply)){
                $newReply = $this->Message->findById($this->Message->id);
                $newReply['auth_id'] = $this->Auth->user('id');
                if($newReply['Sender']['image_path'] == null){
                    $newReply['Sender']['image_path'] =  'default-pic.png'; 
                }
                $response = array('status' => 'success', 'message' => 'Successfully sent');
            } else {
                $response = array('status' => 'error', 'message' => 'Failed to send');
            }
            echo json_encode($newReply);
            exit();
        }

    }

    

}