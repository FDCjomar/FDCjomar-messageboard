<section>
    <div class="container">
        <div class="col-md-8">
            <div class="row">
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
            </div>
        <div class="row">
            
            <div class="col-md-6">
            <?php $imageUrl = $this->Html->webroot('img/default-pic.png'); ?>
            
            <?php if(isset($user['User']['image_path'])): ?>
            
            <?php echo $this->Html->image('uploads/' . $user['User']['image_path'], array('alt' => 'Profile Image', 'width' => '180', 'height' => '180')); ?>
            <?php else: ?>

            <?php $imageUrl = $this->Html->webroot('img/default-pic.png'); ?>
            <?php echo $this->Html->image('../../' . $imageUrl, array('alt' => 'Profile Image', 'width' => '180', 'height' => '180')); ?>
            <?php endif; ?>
            </div>
            <?= $this->Form->create('User', array('role' => 'form', 'type' => 'file', 'class' => 'col-md-6')); ?>
            <div class="column user-data">
                <?= $this->Form->label('profile_img_file', 'Profile Picture', array('class' => 'form-label')) ?>
                <?= $this->Form->file('profile_img_file', array('class' => 'form-control-file')) ?>
            </div>
            
        </div>
        <div class="row">
            <fieldset class="col-md-8">
                <?= $this->Form->input('name', array('label' => 'Name', 'class' => 'form-control', 'value' => $user['User']['name'], 'error' => false, 'required' => false)) ?>
                <?= $this->Form->input('birthdate', array('label' => 'Birthdate', 'type' => 'text', 'id' => 'birthdate', 'class' => 'form-control datepicker', 'value' => $user['User']['birthdate'], 'error' => false, 'required' => false)) ?>
                <?= $this->Form->label('gender', 'Gender', array('class' => 'form-check-label')) ?>
                <?= $this->Form->radio('gender', array('M' => 'Male', 'F' => 'Female'), array('default' => isset($user['User']['gender']) ? $user['User']['gender'] : null,'class' => 'form-check-input', 'error' => false, 'required' => false)) ?>
                <?= $this->Form->label('hubby', 'Hubby', array('class' => 'form-label')) ?>
                <?= $this->Form->textarea('hubby', array('rows' => '5', 'cols' => '50', 'class' => 'form-control', 'value' => $user['User']['hubby'], 'error' => false, 'required' => false)) ?>
            </fieldset>
        </div>
        <div class="row">
            <div class="button mt-3">
                <?= $this->Form->end(array('class' => 'btn btn-primary'), array('class' => 'btn btn-primary')) ?>
            </div>
        </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd', 
            changeMonth: true,
            changeYear: true,
            yearRange: '1900:' + new Date().getFullYear() 
        });
    });
</script>