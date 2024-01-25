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
        
        $conversations = $this->User->ConversationsUser1->find('all', array(
            'conditions' => array('ConversationsUser1.user1_id' => $authUser),
            'contain' => array(
                'User2' => array(
                    'fields' => array('name') // Specify the fields you want to retrieve
                )
            ),
                'order' => array('ConversationsUser1.created' => 'DESC')
        ));

        $this->set('conversations', $conversations);
    
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
        $this->autoRender = false;
        if($this->request->is('post')){
            $userAuth = $this->Auth->user('id');
            debug($this->request->data);

        }
    }

}