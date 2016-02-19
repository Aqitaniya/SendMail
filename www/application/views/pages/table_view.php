				<div  id="buttons">
					<button id="write_mail">Написать письмо</button>
					<button id="delete_mails">Удалить выбранные письма</button>
				</div>
				<div id="mails" class="bs-example">
					<?php echo $table; ?>
					<div id="pagination"><?php echo $this->pagination->create_links();?></div>
				</div>
				