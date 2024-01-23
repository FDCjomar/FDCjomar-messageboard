<section class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <?php $imageUrl = $this->Html->webroot('img/default-pic.png'); ?>
            
            <?php echo $this->Html->image('../../' . $imageUrl, array('alt' => 'Example Image', 'width' => '180', 'height' => '180')); ?>
        </div>
        <div class="col-md-9">
            <div class="header-page"><h1 class="display-4">User Profile</h1></div>

            <div class="row">
                <div class="col-md-6">
                    <p class="profile-name h3">Jomar Godinez</p>
                    <p class="gender"><span>Gender: </span> July 13, 1995</p>
                    <p class="joined"><span>Joined: </span> August 13, 2014 9am</p>
                    <p class="last-login"><span>Last Login: </span> August 14, 2014 11am</p>
                </div>
                
            </div>
           
        </div>
    </div>
    <div class="row">
    <div class="col-md-9">
            <div class="hubby">
                <p class="hubby-header h4">Hobby</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde iste quam, quia veritatis illo impedit porro possimus iusto esse quae.</p>
            </div>
    </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <?= $this->Html->link('Edit Profile', array('controller' => 'Profiles', 'action' => 'edit'), array('class' => 'btn btn-primary')); ?>
        </div>
     </div>

</section>