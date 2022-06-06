<?php
//Custom Controls
if (class_exists('WP_Customize_Control')) {
	//Category Chooser
	class pixanews_WP_Customize_Category_Control extends WP_Customize_Control {
		/**
		 * Render the control's content.
		 */
		public function render_content() {
			$dropdown = wp_dropdown_categories(
				array(
					'name'              => '_customize-dropdown-categories-' . $this->id,
					'echo'              => 0,
					'show_option_none'  => __( 'All', 'pixanews' ),
					'option_none_value' => '0',
					'selected'          => $this->value(),
				)
			);
	
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
	
			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				esc_html($this->label),
				$dropdown
			);
		}
	}
	
	//Radio Image Picker
	class pixanews_Image_Radio_Control extends WP_Customize_Control {
		
		public $li_class = "";
	
		public function render_content() {
	
			if (empty($this->choices))
				return;
				
	
			$name = '_customize-radio-' . $this->id;
			?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
			<ul class="controls" id='pixanews-img-container'>
				<?php
				foreach ($this->choices as $value => $label) :
					$class = ($this->value() == $value) ? 'pixanews-radio-img-selected pixanews-radio-img-img' : 'pixanews-radio-img-img';
					?>
					<li style="display: inline-block;" class="<?php echo esc_html($this->input_attrs['class']); ?>">
						<label>
							<input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php
														  $this->link();
														  checked($this->value(), $value);
														  ?> />
							<img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class); ?>' />
						</label>
					</li>
					<?php
				endforeach;
				?>
			</ul>
			<?php
		}
	}
	
	class pixanews_infobox_control extends WP_Customize_Control {
		public $type = 'infobox';
		public function render_content(){
			?>
			<div class="infobox">
				<span class="customize-control-title infobox_label"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo wp_kses_post($this->description); ?></p>
			</div>
			<?php
		}
	}
	
	class pixanews_Custom_Notice_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'pixanews_custom_notice';
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$allowed_html = array(
				'a' => array(
					'href' => array(),
					'title' => array(),
					'class' => array(),
					'target' => array(),
				),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				'i' => array(
					'class' => array()
				),
				'span' => array(
					'class' => array(),
				),
				'code' => array(),
			);
		?>
			<div class="simple-notice-custom-control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses( $this->description, $allowed_html ); ?></span>
				<?php } ?>
			</div>
		<?php
		}
	}
	
	
}