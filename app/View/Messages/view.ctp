<style>
  .card-text {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    cursor: pointer;
    padding: 10px;
  }

</style>
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
                    <div class="card-body">
                        <div class="card-text long-text"><?= $message['content'] ?></div>
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
                url: '<?php echo $this->Html->url(array('controller' => 'Messages', 'action' => 'reply', $conversations['Conversation']['id'])); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    var newMessage = '<div class="row border-black p-3 bg-white m-3">' +
                                '<div class="col-md-3 border-dark ' + (response.auth_id == response.Message.sender_id ? 'order-md-1' : '') + '">' +
                                    '<div class="row justify-content-center align-items-center">' +
                                        '<div class="col-md-12 border">' +
                                            '<img src="' + (response.Sender.image_path == 'default-pic.png' ? '../../img/' + response.Sender.image_path : 'uploads/' + response.Sender.image_path) + '" alt="Profile Image" class="img-fluid rounded-circle" width="100" height="100">' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="row justify-content-center mt-2">' +
                                        '<p>' + response.Sender.name + '</p>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-md-9 border-dark">' +
                                    '<div class="card-body">' +
                                        '<div class="card-text long-text">' + response.Message.content + '</div>' +
                                    '</div>' +
                                    '<div class="card-footer">' +
                                        '<small class="text-muted">' + response.Message.created + '</small>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';
                            $('#message-list').append(newMessage);
                            $('#replyForm')[0].reset();
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                }
            });
        });
        $(document).on('click', '.card-text', function(){
            $(this).css('white-space', $(this).css('white-space') === "normal" ? "nowrap" : "normal");
        });

    });
</script>

