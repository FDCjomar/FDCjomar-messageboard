<section class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <?php if(isset($profile['User']['image_path'])): ?>
            
            <?php echo $this->Html->image('uploads/' . $profile['User']['image_path'], array('alt' => 'Profile Image', 'width' => '180', 'height' => '180')); ?>
            <?php else: ?>

            <?php $imageUrl = $this->Html->webroot('img/default-pic.png'); ?>
            <?php echo $this->Html->image('../../' . $imageUrl, array('alt' => 'Profile Image', 'width' => '180', 'height' => '180')); ?>
            <?php endif; ?>
        </div>
        <div class="col-md-9">
            <div class="header-page"><h1 class="display-4">User Profile</h1></div>

            <div class="row">
                <div class="col-md-6">
                    <p class="profile-name h3"><?= $profile['User']['name'] ?></p>
                    <p class="gender"><span>Gender: </span> <?= $profile['User']['gender'] == 'F' ? 'Female' : 'Male'; ?> </p>
                    <p class="joined"><span>Joined: </span> <?= $profile['User']['created'] ?></p>
                    <p class="last-login"><span>Last Login: </span> <?= $profile['User']['last_login_time'] ?></p>
                </div>
                
            </div>
           
        </div>
    </div>
    <div class="row">
    <div class="col-md-9">
            <div class="hubby">
                <p class="hubby-header h4">Hobby</p>
                <p><?= $profile['User']['hubby'] ?></p>
            </div>
    </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <?= $this->Html->link('Edit Profile', array('controller' => 'Profiles', 'action' => 'edit'), array('class' => 'btn btn-primary')); ?>
        </div>
     </div>

</section>