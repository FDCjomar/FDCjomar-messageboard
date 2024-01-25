<d<div class="row">
    <div class="col-md-8">
        <div class="users form content">
        <?php if ($this->Session->check('Message.auth')): ?>
            <div class="alert alert-danger">
                <?php echo $this->Session->flash('auth'); ?>
            </div>
        <?php endif; ?>
           
            <div class="header">
                <h1>Login</h1>
            </div>
            <?php
            echo $this->Form->create('User', array('id' => 'register-form'));
            echo $this->Form->input('email', array('label' => 'Email', 'class' => 'form-control', 'error' => false, 'required' => false));
            echo $this->Form->input('password', array('label' => 'Password', 'type' => 'password', 'class' => 'form-control', 'error' => false, 'required' => false));
            echo $this->Form->button(__('Submit'), array('class' => 'btn btn-primary', 'id' => 'submit-btn'));
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>