<div class="container">
    <div class="jumbotron text-center">
        <h1 class="display-4">Message Details</h1>
    </div>
    <div class="row mb-3 ">
        <div class="col">
    <?php echo $this->Form->create(null, array('id' => 'replyForm')); ?>
    <div class="form-group">
        <div class="col-sm-10">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
        <?php echo $this->Form->hidden('conversation_id', array('value' => $conversations['Conversation']['id'])); ?>
            <?php echo $this->Form->textarea('content', array('class' => 'form-control', 'rows' => '5', 'cols' => '5')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 mt-4">
            <?php echo $this->Form->end('Reply Message', array('class' => 'btn btn-primary')); ?>
        </div>
    </div>
   <div id="message-list">
    <?php if(isset($conversations['Message'])): ?>
        <?php foreach($conversations['Message'] as $message): ?>
            <div class="row border-black p-3 bg-white m-3">
                <div class="col-md-3 border-dark <?= $message['auth_id'] == $message['sender_id'] ? 'order-md-1' : '' ?>">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-12 border">
                            <?php if ($message['sender_image_path'] == 'default-pic.png'): ?>
                                <?php echo $this->Html->image('../img/' . $message['sender_image_path'], array('alt' => 'Profile Image', 'class' => 'img-fluid rounded-circle', 'width' => '100', 'height' => '100')); ?>
                            <?php else: ?>
                                <?php echo $this->Html->image('uploads/' . $message['sender_image_path'], array('alt' => 'Profile Image', 'class' => 'img-fluid rounded-circle', 'width' => '100', 'height' => '100')); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <p><?= $message['sender_name'] ?></p>
                    </div>
                </div>
                <div class="col-md-9 border-dark">
                    <div class="card-body">a
                        <p class="card-text"><?= $message['content'] ?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><?= $message['created'] ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
        $('#replyForm').submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();
             // AJAX request
             $.ajax({
                url: '<?php echo $this->Html->url(array('controller' => 'Messages', 'action' => 'send')); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // Handle success response
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                }
            });
        });
    });
</script>

