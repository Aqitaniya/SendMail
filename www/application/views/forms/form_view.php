	<?php	$attributes = array('class' => 'form-horizontal', 'id' => 'mail_form');
		echo form_open('write/mail/out',$attributes);
			echo '<div class="form-group">';
				$attributes = array(
							  'class' => 'col-sm-2 control-label'
							  );
				echo form_label($role,'', $attributes);
				echo '<div class="col-sm-10">';
					$data = array(
					  'name'        => 'mail_email',
					  'type'		=> 'email',
					  'id'          => 'inputEmail3',
					  'class'		=> 'form-control',
					  'placeholder' => 'введите е-меил получателя',
					  'value'		=> set_value('mail_email')
					);
					echo form_input($data);
					echo form_error('mail_email');
				echo '</div>';
			echo '</div>';
			echo '<div class="form-group">';
				$attributes = array(
							  'class' => 'col-sm-2 control-label'
							  );
				echo form_label('Тема письма','', $attributes);
				echo '<div class="col-sm-10">';
					$data = array(
					  'name'        => 'mail_theme',
					  'type'		=> 'text',
					  'class'		=> 'form-control',
					  'value'		=> set_value('mail_theme')
					);
					echo form_input($data);
					echo form_error('mail_theme');
				echo '</div>';
			echo '</div>';
			echo '<div class="form-group">';
				$attributes = array(
							  'class' => 'col-sm-2 control-label',
							  );
				echo form_label('Текст письма','', $attributes);
				echo '<div class="col-sm-10">';
					$data = array(
								  'name'  => 'mail_text',
								  'class' => 'form-control',
								  'rows'  => '3',
								  'value' => set_value('mail_text')
							      );
					echo form_textarea($data);
					echo form_error('mail_text');
				echo '</div>';
			echo '</div>';
			echo '<div class="form-group col-sm-offset-2 col-sm-10" id="form_buttons">';
				$data = array(
						'id'        => 'main_page', 
					    'value'     => 'Отменить',
					    'type'		=> 'button'
					    );
				echo form_input($data,'');
				if(empty($type_form))
					echo form_submit('mail_send', 'Отправить');
			echo '</div>';	
		echo form_close();
?>