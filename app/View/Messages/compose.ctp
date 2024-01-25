<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>


<section>
    <h1>New Message</h1>
    <?php echo $this->Form->create(array('url' => array('controller' => 'messages', 'action' => 'send'), 'class' => 'form-horizontal')); ?>
    <div class="form-group">
        <div class="col-sm-10">
        <?php echo $this->Form->input('recipient', array('id' => 'autocomplete-input', 'options' => $data, 'default' => '')); ?>
        </div>
    </div>
    <div class="form-group">
         <label for="content" class="col-sm-4 control-label">Message Content</label>
        <div class="col-sm-10">
            <?php echo $this->Form->textarea('content', array('class' => 'form-control', 'rows' => '5')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php echo $this->Form->end('Send Message', array('class' => 'btn btn-primary')); ?>
        </div>
    </div>
</section>
<script>
   $(document).ready(function() {

    $('#autocomplete-input').select2({
        placeholder: 'Type to search...'
        
    });
   $('#autocomplete-input').val('').trigger('change');
});

</script>