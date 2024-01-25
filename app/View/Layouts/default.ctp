<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
		echo $this->Html->script('https://code.jquery.com/jquery-3.6.4.min.js');
		echo $this->Html->script('https://code.jquery.com/ui/1.12.1/jquery-ui.min.js');
		echo $this->Html->css('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
	?>
</head>
<style>
	body {
		background-color: #d4d2d2;
	}
</style>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Messageboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
	 
		<?php if ($this->Session->check('Auth.User')): ?>
			<li class="nav-item">
	  			<?= $this->Html->link('Message List', array('controller' => 'Messages', 'action' => 'index'), array('class' => 'nav-link')); ?>
        	</li>
			<li class="nav-item">
				<?= $this->Html->link('Account', array('controller' => 'Users', 'action' => 'changeEmail'), array('class' => 'nav-link')); ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link('Profile', array('controller' => 'Profiles', 'action' => 'index'), array('class' => 'nav-link')); ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'), array('class' => 'nav-link')); ?>
			</li>
		<?php else: ?>
				<li class="nav-item">
					<?= $this->Html->link('Login', array('controller' => 'Users', 'action' => 'login'), array('class' => 'nav-link')); ?>
				</li>
				<li class="nav-item">
					<?= $this->Html->link('Register', array('controller' => 'Users', 'action' => 'register'), array('class' => 'nav-link')); ?>
				</li>
		<?php endif; ?>
        
		
       
      </ul>
    </div>
  </div>
</nav>
	<div class="container mt-5">
		
			<?php echo $this->fetch('content'); ?>
	
	</div>
	
</body>
</html>
