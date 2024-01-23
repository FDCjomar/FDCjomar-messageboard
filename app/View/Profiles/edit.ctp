<section>
    <div class="container">
        <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
            <?php $imageUrl = $this->Html->webroot('img/default-pic.png'); ?>
            
            <?php echo $this->Html->image('../../' . $imageUrl, array('alt' => 'Example Image', 'width' => '180', 'height' => '180')); ?>
            </div>
            <?= $this->Form->create('User', array('role' => 'form', 'type' => 'file', 'class' => 'col-md-6')); ?>
            <div class="column user-data">
                <?= $this->Form->label('profile_img_file', 'Profile Picture', array('class' => 'form-label')) ?>
                <?= $this->Form->file('profile_img_file', array('class' => 'form-control-file')) ?>
            </div>
        </div>
        <div class="row">
            <fieldset class="col-md-8">
                <?= $this->Form->input('name', array('label' => 'Name', 'class' => 'form-control')) ?>
                <?= $this->Form->input('birthdate', array('label' => 'Birthdate', 'type' => 'text', 'id' => 'birthdate', 'class' => 'form-control datepicker')) ?>
                <?= $this->Form->label('gender', 'Gender', array('class' => 'form-check-label')) ?>
                <?= $this->Form->radio('gender', array('M' => 'Male', 'F' => 'Female'), array('class' => 'form-check-input')) ?>
                <?= $this->Form->label('hobby', 'Hobby', array('class' => 'form-label')) ?>
                <?= $this->Form->textarea('hobby', array('rows' => '5', 'cols' => '50', 'class' => 'form-control')) ?>
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