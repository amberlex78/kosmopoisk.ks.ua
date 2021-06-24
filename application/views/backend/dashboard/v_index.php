<?php defined('SYSPATH') or die('No direct script access.') ?>

<h4 class="text-success">Привет, <?php echo $user->username ?> :)</h4>

<span class="label label-info label-large"><?php echo 'Последний раз авторизовались: ' . date('d.m.Y - H:i', $user->last_login) ?></span>

<hr>
<h5>Обновления на сайте «Херсон – Космопоиск»</h5>
<p><span class="label label-info">[2021.06.24]</span> В админке для добавления или редактирования статьи поля: "Теги" и "Первоисточник" теперь заполняются под "Полный текст статьи". Вкладка "Другое", где они раньше находились - убрана, т.к. в этом случае нужно совершать меньше движений при заполнении, ну и не забывать их заполнять, если требуется</p>
<p><?php echo HTML::image('uploads/images/tags-link.png', array('class' => 'img-rounded', 'style' => 'width: 870px')) ?></p>
<hr>
<p><span class="label label-info">[2021.06.24]</span> Если авторизованы - можно редактировать статью прямо с сайта нажав на значок <i class="icon-edit"></i> который будет виден перед названием статьи</p>
<p><?php echo HTML::image('uploads/images/edit_article.png', array('class' => 'img-rounded', 'style' => 'width: 870px')) ?></p>
<hr>
<p><span class="label label-info">[2021.06.24]</span> Внизу сайта на главной показывается <a href="https://kosmopoisk.ks.ua#tags" target="_blank">список тегов</a></p>
<p><?php echo HTML::image('uploads/images/tags.png', array('class' => 'img-rounded', 'style' => 'width: 870px')) ?></p>
<hr>
<p><span class="label label-info">[2021.06.22]</span> Если авторизованы, на сайте в меню будет кнопка '+ Добавить статью' для удобного пользования и меньших телодвижений.<br>Так же кнопка 'В админку'</p>
<p><?php echo HTML::image('uploads/images/add_article.png', array('class' => 'img-rounded', 'style' => 'width: 870px')) ?></p>
<hr>
<p><span class="label label-info">[2021.06.02]</span> В админке перенес панель с меню вправо. Теперь при добавлении или редактировании статьи редактор текста получается почти посредине экрана, что удобнее.</p>
<p><?php echo HTML::image('uploads/images/panel.png', array('class' => 'img-rounded', 'style' => 'width: 870px')) ?></p>
<hr>
<p><span class="label label-info">[2012.10.30]</span> При добавлении (редактировании) статьи появилась вкладка "Другое", туда перенесены теги статьи и добавлено поле для ссылки на первоисточник статьи, если такавой есть</p>
<hr>
<p><span class="label label-info">[2012.10.25]</span> Добавил миниатюры изображений при выводе списка статей в админке</p>
<hr>
<p><span class="label label-info">[2012.10.23]</span> Исправлена опечатка при выводе месяца "Октября"</p>


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
