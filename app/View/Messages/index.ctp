<div class="container">
    <div class="jumbotron text-center">
        <h1 class="display-4">Message List</h1>
    </div>
    <div class="row mb-3 ">
        <div class="col">
        <?php echo $this->Html->link('New Message', array('controller' => 'Messages', 'action' => 'compose'), array('class' => 'btn btn-primary')); ?>
        </div>
        <div class="col">
        <form id="search-form">
            <input type="text" id="search-query" name="query" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
        </div>
    </div>
    <!-- <?= debug($conversations) ?> -->
   <div id="message-list">
   <?php foreach($conversations as $recipients): ?>
    <div class="row border-black p-3 bg-white m-3">
        <div class="col-md-3 border-dark">
            <div class="row">
                <div class="col-md-12 border">
                <?php if(isset($recipients['User2']['image_path'])): ?>
            
                <?php echo $this->Html->image('uploads/' . $recipients['User2']['image_path'], array('alt' => 'Profile Image', 'width' => '100', 'height' => '100')); ?>
                <?php else: ?>

                <?php $imageUrl = $this->Html->webroot('img/default-pic.png'); ?>
                <?php echo $this->Html->image('../../' . $imageUrl, array('alt' => 'Profile Image', 'width' => '100', 'height' => '100')); ?>
                <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <p><?= $recipients['User2']['name'] ?></p>
            </div>
            
        </div>
        <div class="col-md-7 border-dark">
            <p><?= $recipients['Message']['0']['content'] ?></p>
            <p class="text-muted"><?= $recipients['Message']['0']['created'] ?></p>
        </div>
        <div class="col-md-2">
            <a href="" class="delete-button" data-conversation-id="<?= $recipients['ConversationsUser1']['id']?>">Delete</a>
        </div>
        
    </div>
    <?php endforeach; ?>
   </div>
   

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('.delete-button').on('click', function(e) {
        e.preventDefault();
        let id = $(this).data('conversation-id');
        let deleteButton = $(this);

        $.ajax({
            url: '/messageboard/messages/delete/' + id,
            type: 'post', 
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                console.log(jsonResponse.status);
                // console.log(response);
                 if (jsonResponse.status == 'success') {
                    deleteButton.closest('.row').fadeOut(500, function() {
                        $(this).remove();
                    });
                   
                }
            },
            error: function(response) {
                console.error(response);
            }
        });
    });


    //Search functionality
    $('#search-form').on('submit', function(e){
        var query = $('#search-query').val(); 
        console.log(query);
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->Html->url(array('controller' => 'Messages', 'action' => 'search')); ?>',
            data: { query: query }, // Send the query data
            success: function(response) {
                // $('#message-list').html(response); // Replace the message list with search results
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Handle errors
                console.log('failed responnse');
            }
        });
    })
});

</script>