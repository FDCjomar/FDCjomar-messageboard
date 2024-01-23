<d<div class="row">
    <div class="col-md-8">
        <div class="users form content">
        <div id="validation-errors-container" class="error-message" style="color: red;"></div>

        <div class="users form">
           
            <div class="header">
                <h1>Registration</h1>
            </div>
            <?php
            echo $this->Form->create('User', array('id' => 'register-form'));
            
          
            echo $this->Form->input('name', array('label' => 'Name', 'class' => 'form-control', 'error' => false, 'required' => false));
            echo $this->Form->input('email', array('label' => 'Email', 'class' => 'form-control', 'error' => false, 'required' => false));
            echo $this->Form->input('password', array('label' => 'Password', 'type' => 'password', 'class' => 'form-control', 'error' => false, 'required' => false));
            echo $this->Form->input('password_confirmation', array('label' => 'Confirm Password', 'type' => 'password', 'class' => 'form-control', 'error' => false, 'required' => false));
            echo $this->Form->button(__('Submit'), array('class' => 'btn btn-primary', 'id' => 'submit-btn'));
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#register-form').submit(function(event) {
            event.preventDefault();
            console.log('submitted');
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#validation-errors-container').html('').hide();
                        window.location.href = '../pages/thankYou';
                    } else if (response.status === 'error') {
                        $('#validation-errors-container').html('').hide();

                        $.each(response.errors, function(field, errors) {
                            var errorMessage = '<ul>';
                            $.each(errors, function(index, error) {
                                errorMessage += '<li>' + error + '</li>';
                            });
                            errorMessage += '</ul>';
                            $('#validation-errors-container').append(errorMessage).show();
                        });
                    }
                }
            });
        });
    });
</script>