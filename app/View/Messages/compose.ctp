<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
<section>
    <h1>New Message</h1>
    <?php echo $this->Form->create('Message', array('url' => array('controller' => 'messages', 'action' => 'send'), 'class' => 'form-horizontal')); ?>
    <div class="form-group">
        <div class="col-sm-10">
                 <?php echo $this->Form->input('Recipient', array('name' => 'data[Message][Recipient]', 'id' => 'autocomplete-input', 'type' => 'text')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $this->Form->label('content', 'Message Content', array('class' => 'col-sm-4 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $this->Form->textarea('content', array('class' => 'form-control', 'rows' => '5')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php echo $this->Form->end('Send Message', array('class' => 'btn btn-primary')); ?>
        </div>
    </div>
<?php echo $this->Form->end(); ?>

</section>
<script>
   $(document).ready(function() {
    var data = <?php echo $data; ?>;
    $('#autocomplete-input').select2({
        placeholder: 'Type to search...',
        data: data,
      
    });
});

</script>