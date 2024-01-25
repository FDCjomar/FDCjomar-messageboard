<div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                  
                <li class="nav-item">
                       <?= $this->Html->link('Change Email', array('controller' => 'Users', 'action' => 'changeEmail'), array('class' => 'nav-link')) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('Change Password', array('controller' => 'Users', 'action' => 'changePassword'), array('class' => 'nav-link')) ?>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <?php if (isset($response['errors'])): ?>
                <div class="alert alert-danger">
                    <strong>Error!</strong>
                    <ul>
                        <?php foreach ($response['errors'] as $field => $error): ?>
                            <li><?php echo $error[0]; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Change Email</h1>
            </div>
            <div class="container col-md-5 mt-5">
                <?php echo $this->Form->create('User'); ?>
                <?php echo $this->Form->input('newEmail', array('label' => 'New Email', 'class' => 'form-control', 'required' => false, 'error' => false)); ?>
                <?php echo $this->Form->submit('Change Email', array('class' => 'btn btn-primary mt-3')); ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </main>
    </div>
</div>