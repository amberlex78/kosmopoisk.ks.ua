<?php defined('SYSPATH') or die('No direct script access.') ?>

<?php echo Form::open(Request::current(), array('class' => 'form-horizontal')) ?>
	<fieldset class="both">
		<legend><?php echo __('contacts.title_send') ?></legend>
		<?php
			echo App_Formtb::input('your_name', $post['your_name'],
				array('class' => 'input-xlarge'),
				array('label' => 'contacts.your_name', 'mark' => true, 'errors' => $errors, 'help_inline' => true)
			);
			echo App_Formtb::input('your_email', $post['your_email'],
				array('class' => 'input-xlarge'),
				array('label' => 'contacts.your_email', 'help' => 'contacts.your_email_h', 'mark' => true, 'errors' => $errors, 'help_inline' => true)
			);
			echo App_Formtb::textarea('your_message', $post['your_message'],
				array('class' => 'span6', 'id' => 'your_message', 'rows' => 5),
				array('label' => 'contacts.your_message', 'mark' => true, 'errors' => $errors)
			);
		?>
		<div class="control-group<?php if (isset($errors['captcha'])) echo ' error' ?>">
			<label class="control-label"><?php echo __('app.caption.captcha') ?> <span class="mark">*</span></label>
			<div class="controls">
				<span id="kaptcha" class="captcha-refresh"><?php echo $captcha ?></span>
				<?php echo Form::input('captcha', null, array('id' => 'kaptchaCode', 'class' => 'span1')) ?>
				<?php if (isset($errors['captcha'])): ?>
					<p class="help-block"><?php echo $errors['captcha'] ?></p>
				<?php endif ?>

			</div>
		</div>
		<div class="controls">
			<button class="btn btn-primary" type="submit"><?php echo __('contacts.send_message') ?></button>
		</div>
	</fieldset>
<?php echo Form::close() ?>
