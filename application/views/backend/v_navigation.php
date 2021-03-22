<div class="accordion" id="accordion2">
	<?php foreach ($blocks as $block => $name): ?>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_<?php echo $block ?>">
					<strong><?php echo (isset($name['icon']) ? '<i class="icon-' . $name['icon'] . '"></i> ' : '') . __($name['heading']) ?></strong>
				</a>
			</div>
			<div id="collapse_<?php echo $block ?>" class="accordion-body collapse<?php if ($curr_module == $block) echo ' in' ?>">
				<div class="accordion-inner">
					<ul class="nav nav-list">
						<?php foreach ($name['menu'] as $menu): ?>
							<li <?php if ($curr_controller == $menu['controller'] AND $curr_action == $menu['action']) echo ' class="active"' ?>>
								<?php echo Html::anchor(ADMIN . '/' . $menu['controller'] . '/' . $menu['action'], (isset($menu['icon']) ? '<i class="icon-' . $menu['icon'] . '"></i> ' : '') . __($menu['title'])) ?>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>

