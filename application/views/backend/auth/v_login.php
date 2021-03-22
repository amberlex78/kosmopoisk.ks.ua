<?php defined('SYSPATH') or die('No direct script access.') ?>

<?php echo Form::open(Request::current(), array('class'=>'form-horizontal')) ?>
	<div class="modal">
		<div class="modal-header">
			<h2><?php echo __('users.authorization') ?></h2>
		</div>
		<div class="modal-body">
			<?php
				echo App_Formtb::input('username', NULL,
					array('class' => 'input-medium', 'placeholder' => 'Email'),
					array('label' => 'users.email')
				);
				echo App_Formtb::input('password', NULL,
					array('class' => 'input-medium', 'type' => 'password', 'placeholder' => 'Password'),
					array('label' => 'users.password')
				);
			?>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn"><?php echo __('users.sign_in') ?></button>
		</div>
	</div>
<?php echo Form::close() ?>
