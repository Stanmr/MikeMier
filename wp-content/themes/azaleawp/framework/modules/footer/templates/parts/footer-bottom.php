<div class="eltdf-footer-bottom-holder <?php echo esc_attr($footer_bottom_skin_class); ?>">
	<div class="eltdf-footer-bottom-inner <?php echo esc_attr($footer_bottom_grid_class); ?> ">
		<div class="eltdf-grid-row <?php echo esc_attr($footer_bottom_classes); ?>">
			<?php for($i = 1; $i <= $footer_bottom_columns; $i++) { ?>
				<div class="eltdf-grid-col-<?php echo esc_attr(12 / $footer_bottom_columns); ?>">
					<?php
					if(is_active_sidebar('footer_bottom_column_'.$i)) {
						dynamic_sidebar('footer_bottom_column_'.$i);
					}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>