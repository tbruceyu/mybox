<?=form_open('index/do_login/', array('id' => 'login_form')) ?>
    <p>
    	<?
    		$user_input_data = array('name'=>'username','class'=>'easyui-validatebox', 'data-options'=>"required:true");
    		if ($this->input->cookie('username')) {
    			$user_input_data['value'] = $this->input->cookie('username');
    		}
    	?>
        Username:
        <?=form_input($user_input_data) ?>
    </p>
    <p>
        Password:
        <?=form_password(array('name'=>'password','class'=>'easyui-validatebox', 'data-options'=>"required:true")) ?>
    </p>
    <p><?=form_submit(array('name'=>'submit', 'value'=>'login')) ?>&nbsp;
<?=form_close()?>
