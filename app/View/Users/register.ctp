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
            echo $this->Form->input('email', array('label' => 'Email', 'class' => 'form-control', 'error' => false, 'required' => false , 'type' => 'text'));
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
        document.getElementById('register-form').addEventListener('submit', function(event) {
        event.preventDefault();
        console.log('submitted');

        var formData = new FormData(this);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', this.getAttribute('action'));
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        document.getElementById('validation-errors-container').innerHTML = '';
                        document.getElementById('validation-errors-container').style.display = 'none';
                        window.location.href = '../pages/thankYou';
                    } else if (response.status === 'error') {
                        document.getElementById('validation-errors-container').innerHTML = '';
                        document.getElementById('validation-errors-container').style.display = 'none';

                        Object.keys(response.errors).forEach(function(field) {
                            var errors = response.errors[field];
                            var errorMessage = '<ul>';
                            errors.forEach(function(error) {
                                errorMessage += '<li>' + error + '</li>';
                            });
                            errorMessage += '</ul>';
                            document.getElementById('validation-errors-container').innerHTML += errorMessage;
                            document.getElementById('validation-errors-container').style.display = 'block';
                        });
                    }
                }
            }
        };
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(new URLSearchParams(formData).toString());
    });

    });
</script>