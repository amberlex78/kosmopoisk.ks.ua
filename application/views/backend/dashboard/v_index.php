<?php defined('SYSPATH') or die('No direct script access.') ?>

<h4 class="text-success">Привет, <?php echo $user->username ?> :)</h4>
<hr>
<h5>Обновления CMS:</h5>
<p><span class="label label-info">[2021.06.02]</span> Перенес панель с меню вправо. При добавлении статьи удобнее видеть редактор текста посредине экрана.</p>
<p><span class="label label-info">[2012.10.30]</span> При добавлении (редактировании) статьи появилась вкладка "Другое", туда перенесены теги статьи и добавлено поле для ссылки на первоисточник статьи, если такавой есть</p>
<p><span class="label label-info">[2012.10.25]</span> Добавил миниатюры изображений при выводе списка статей в админке</p>
<p><span class="label label-important">[2012.10.23]</span> Исправлена опечатка при выводе месяца "Октября"</p>


<br/>
<table class="table table-bordered">
	<tr>
		<td class="span3">Ваш браузер</td>
		<td><?php echo $info['user_agent'] ?></td>
	</tr>
	<tr>
		<td>Ваш IP</td>
		<td><?php echo $info['user_ip'] ?></td>
	</tr>
	<tr>
		<td>Предпочитаемые языки для отображения WEB-страниц</td>
		<td>
			<?php
				foreach ($info['user_lang'] as $k => $v)
					echo $k . ' => ' . $v . '<br/>';
			?>
		</td>
	</tr>
	<tr>
		<td>Версия PHP</td>
		<td><?php echo $info['phpversion'] ?></td>
	</tr>
</table>

<span class="label label-info"><?php echo 'Последний раз авторизовались: ' . date('d.m.Y - H:i', $user->last_login) ?></span>