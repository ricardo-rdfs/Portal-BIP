<?php /* Smarty version Smarty-3.0.7, created on 2011-12-21 18:03:07
         compiled from "/var/www/html/demo.cl/exeBIPdev/modules/blocklayered/blocklayered.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2053249034ef2498ba4c292-35281729%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c593a93ba8ec163b166a9a39b87528d7a8ec2c73' => 
    array (
      0 => '/var/www/html/demo.cl/exeBIPdev/modules/blocklayered/blocklayered.tpl',
      1 => 1324068664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2053249034ef2498ba4c292-35281729',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/demo.cl/exeBIPdev/tools/smarty/plugins/modifier.escape.php';
?>

<!-- Block layered navigation module -->
<?php if ($_smarty_tpl->getVariable('nbr_filterBlocks')->value!=0){?>
<script type="text/javascript">
current_friendly_url = '#<?php echo $_smarty_tpl->getVariable('current_friendly_url')->value;?>
';
</script>
<div id="layered_block_left" class="block">
	<h4><?php echo smartyTranslate(array('s'=>'Catalog','mod'=>'blocklayered'),$_smarty_tpl);?>
</h4>
	<div class="block_content">
		<form action="#" id="layered_form">
			<div>
				<?php if (isset($_smarty_tpl->getVariable('selected_filters',null,true,false)->value)&&$_smarty_tpl->getVariable('n_filters')->value>0){?>
				<div id="enabled_filters">
					<span class="layered_subtitle" style="float: none;"><?php echo smartyTranslate(array('s'=>'Enabled filters:','mod'=>'blocklayered'),$_smarty_tpl);?>
</span>
					<ul>
					<?php  $_smarty_tpl->tpl_vars['filter_values'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['filter_type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('selected_filters')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['filter_values']->key => $_smarty_tpl->tpl_vars['filter_values']->value){
 $_smarty_tpl->tpl_vars['filter_type']->value = $_smarty_tpl->tpl_vars['filter_values']->key;
?>
						<?php  $_smarty_tpl->tpl_vars['filter_value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['filter_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['filter_values']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['filter_value']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['filter_value']->key => $_smarty_tpl->tpl_vars['filter_value']->value){
 $_smarty_tpl->tpl_vars['filter_key']->value = $_smarty_tpl->tpl_vars['filter_value']->key;
 $_smarty_tpl->tpl_vars['filter_value']->index++;
 $_smarty_tpl->tpl_vars['filter_value']->first = $_smarty_tpl->tpl_vars['filter_value']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['f_values']['first'] = $_smarty_tpl->tpl_vars['filter_value']->first;
?>
							<?php  $_smarty_tpl->tpl_vars['filter'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('filters')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['filter']->key => $_smarty_tpl->tpl_vars['filter']->value){
?>
								<?php if ($_smarty_tpl->tpl_vars['filter']->value['type']==$_smarty_tpl->tpl_vars['filter_type']->value&&isset($_smarty_tpl->tpl_vars['filter']->value['values'])){?>
									<?php if (isset($_smarty_tpl->tpl_vars['filter']->value['slider'])&&$_smarty_tpl->getVariable('smarty')->value['foreach']['f_values']['first']){?>
										<li>
											<a href="#" rel="layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type'];?>
_slider" title="<?php echo smartyTranslate(array('s'=>'Cancel','mod'=>'blocklayered'),$_smarty_tpl);?>
">x</a>
											<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['filter']->value['name'],'html','UTF-8');?>
<?php echo smartyTranslate(array('s'=>':'),$_smarty_tpl);?>
 
											<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['filter']->value['values'][0],'html','UTF-8');?>
<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['filter']->value['unit'],'html','UTF-8');?>
 - 
											<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['filter']->value['values'][1],'html','UTF-8');?>
<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['filter']->value['unit'],'html','UTF-8');?>

										</li>
									<?php }else{ ?>
										<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id_value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['filter']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['id_value']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
											<?php if ($_smarty_tpl->tpl_vars['id_value']->value==$_smarty_tpl->tpl_vars['filter_key']->value&&!is_numeric($_smarty_tpl->tpl_vars['filter_value']->value)&&($_smarty_tpl->tpl_vars['filter']->value['type']=='id_attribute_group'||$_smarty_tpl->tpl_vars['filter']->value['type']=='id_feature')||$_smarty_tpl->tpl_vars['id_value']->value==$_smarty_tpl->tpl_vars['filter_value']->value&&$_smarty_tpl->tpl_vars['filter']->value['type']!='id_attribute_group'&&$_smarty_tpl->tpl_vars['filter']->value['type']!='id_feature'){?>
												<li>
													<a href="#" rel="layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type_lite'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Cancel','mod'=>'blocklayered'),$_smarty_tpl);?>
">x</a>
													<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['filter']->value['name'],'html','UTF-8');?>
<?php echo smartyTranslate(array('s'=>':'),$_smarty_tpl);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['name'],'html','UTF-8');?>

												</li>
											<?php }?>
										<?php }} ?>
									<?php }?>
								<?php }?>
							<?php }} ?>
						<?php }} ?>
					<?php }} ?>
					</ul>
				</div>
				<?php }?>
				<?php  $_smarty_tpl->tpl_vars['filter'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('filters')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['filter']->key => $_smarty_tpl->tpl_vars['filter']->value){
?>
					<?php if (isset($_smarty_tpl->tpl_vars['filter']->value['values'])){?>
						<?php if (isset($_smarty_tpl->tpl_vars['filter']->value['slider'])){?>
						<div class="layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type'];?>
" style="display: none;">
						<?php }else{ ?>
						<div>
						<?php }?>
						<span class="layered_subtitle"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['filter']->value['name'],'html','UTF-8');?>
</span>
						<span class="layered_close"><a href="#" rel="ul_layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type'];?>
_<?php echo $_smarty_tpl->tpl_vars['filter']->value['id_key'];?>
">v</a></span>
						<div class="clear"></div>
						<ul id="ul_layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type'];?>
_<?php echo $_smarty_tpl->tpl_vars['filter']->value['id_key'];?>
">
						<?php if (!isset($_smarty_tpl->tpl_vars['filter']->value['slider'])){?>
							<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id_value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['filter']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['id_value']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
								<li class="nomargin">
								<?php if (isset($_smarty_tpl->tpl_vars['filter']->value['is_color_group'])&&$_smarty_tpl->tpl_vars['filter']->value['is_color_group']){?>
									<input type="button" name="layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type_lite'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
" rel="<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['filter']->value['id_key'];?>
" id="layered_id_attribute_group_<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
" <?php if (!$_smarty_tpl->tpl_vars['value']->value['nbr']){?> value="X" disabled="disabled"<?php }?> style="background: <?php if (isset($_smarty_tpl->tpl_vars['value']->value['color'])){?><?php echo $_smarty_tpl->tpl_vars['value']->value['color'];?>
<?php }else{ ?>#CCC<?php }?>; margin-left: 0; width: 16px; height: 16px; padding:0; border: 1px solid <?php if (isset($_smarty_tpl->tpl_vars['value']->value['checked'])&&$_smarty_tpl->tpl_vars['value']->value['checked']){?>red<?php }else{ ?>#666<?php }?>;" />
									<?php if (isset($_smarty_tpl->tpl_vars['value']->value['checked'])&&$_smarty_tpl->tpl_vars['value']->value['checked']){?><input type="hidden" name="layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type_lite'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
" /><?php }?>
								<?php }else{ ?>
									<input type="checkbox" class="checkbox" name="layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type_lite'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
" id="layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type_lite'];?>
<?php if ($_smarty_tpl->tpl_vars['id_value']->value||$_smarty_tpl->tpl_vars['filter']->value['type']=='quantity'){?>_<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
<?php if ($_smarty_tpl->tpl_vars['filter']->value['id_key']){?>_<?php echo $_smarty_tpl->tpl_vars['filter']->value['id_key'];?>
<?php }?>"<?php if (isset($_smarty_tpl->tpl_vars['value']->value['checked'])){?> checked="checked"<?php }?><?php if (!$_smarty_tpl->tpl_vars['value']->value['nbr']){?> disabled="disabled"<?php }?> /> 
								<?php }?>
									<label for="layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type_lite'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
"<?php if (!$_smarty_tpl->tpl_vars['value']->value['nbr']){?> class="disabled"<?php }else{ ?><?php if (isset($_smarty_tpl->tpl_vars['filter']->value['is_color_group'])&&$_smarty_tpl->tpl_vars['filter']->value['is_color_group']){?> name="layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type_lite'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
" class="layered_color" rel="<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['filter']->value['id_key'];?>
"<?php }?><?php }?>>
										<?php if (!$_smarty_tpl->tpl_vars['value']->value['nbr']){?>
										<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['name'],'html','UTF-8');?>
<?php if ($_smarty_tpl->getVariable('layered_show_qties')->value){?><span> (0)</span><?php }?></a>
										<?php }else{ ?>
										<a href="<?php echo $_smarty_tpl->tpl_vars['value']->value['link'];?>
" rel="<?php echo $_smarty_tpl->tpl_vars['value']->value['rel'];?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['name'],'html','UTF-8');?>
<?php if ($_smarty_tpl->getVariable('layered_show_qties')->value){?><span> (<?php echo $_smarty_tpl->tpl_vars['value']->value['nbr'];?>
)</span><?php }?></a>
										<?php }?>
									</label>
								</li>
							<?php }} ?>
						<?php }else{ ?>
							<label for="<?php echo $_smarty_tpl->tpl_vars['filter']->value['type'];?>
"><?php echo smartyTranslate(array('s'=>'Range:','mod'=>'blocklayered'),$_smarty_tpl);?>
</label> <span id="layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type'];?>
_range"></span>
							<div style="margin: 6px 0 6px 6px; width: 93%;">
								<div style="margin-top:5px;" class="layered_slider" id="layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type'];?>
_slider"></div>
							</div>
							<script type="text/javascript">
							
								addSlider('<?php echo $_smarty_tpl->tpl_vars['filter']->value['type'];?>
',{
									range: true,
									min: <?php echo $_smarty_tpl->tpl_vars['filter']->value['min'];?>
,
									max: <?php echo $_smarty_tpl->tpl_vars['filter']->value['max'];?>
,
									values: [ <?php echo $_smarty_tpl->tpl_vars['filter']->value['values'][0];?>
, <?php echo $_smarty_tpl->tpl_vars['filter']->value['values'][1];?>
],
									slide: function( event, ui ) {
										$('#layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type'];?>
_range').html(ui.values[ 0 ] + '<?php echo $_smarty_tpl->tpl_vars['filter']->value['unit'];?>
' + ' - ' + ui.values[ 1 ] + '<?php echo $_smarty_tpl->tpl_vars['filter']->value['unit'];?>
');
									},
									stop: function () {
										reloadContent();
									}
								}, '<?php echo $_smarty_tpl->tpl_vars['filter']->value['unit'];?>
');
								$(document).ready(function()
								{
									$('.layered_<?php echo $_smarty_tpl->tpl_vars['filter']->value['type'];?>
').show();
								});
							
							</script>
						<?php }?>
						</ul>
					</div>
					<?php }?>
				<?php }} ?>
			</div>
			<input type="hidden" name="id_category_layered" value="<?php echo $_smarty_tpl->getVariable('id_category_layered')->value;?>
" />
			<?php  $_smarty_tpl->tpl_vars['filter'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('filters')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['filter']->key => $_smarty_tpl->tpl_vars['filter']->value){
?>
				<?php if ($_smarty_tpl->tpl_vars['filter']->value['type_lite']=='id_attribute_group'&&isset($_smarty_tpl->tpl_vars['filter']->value['is_color_group'])&&$_smarty_tpl->tpl_vars['filter']->value['is_color_group']){?>
					<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id_value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['filter']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['id_value']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
						<?php if (isset($_smarty_tpl->tpl_vars['value']->value['checked'])){?>
							<input type="hidden" name="layered_id_attribute_group_<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['id_value']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['filter']->value['id_key'];?>
" />
						<?php }?>
					<?php }} ?>
				<?php }?>
			<?php }} ?>
		</form>
	</div>
	<div id="layered_ajax_loader" style="display: none;">
		<p style="margin: 20px 0; text-align: center;"><img src="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
loader.gif" alt="" /><br /><?php echo smartyTranslate(array('s'=>'Loading...','mod'=>'blocklayered'),$_smarty_tpl);?>
</p>
	</div>
</div>
<?php }else{ ?>
<div id="layered_block_left" class="block">
	<div class="block_content">
		<form action="#" id="layered_form">
			<input type="hidden" name="id_category_layered" value="<?php echo $_smarty_tpl->getVariable('id_category_layered')->value;?>
" />
		</form>
	</div>
	<div id="layered_ajax_loader" style="display: none;">
		<p style="margin: 20px 0; text-align: center;"><img src="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
loader.gif" alt="" /><br /><?php echo smartyTranslate(array('s'=>'Loading...','mod'=>'blocklayered'),$_smarty_tpl);?>
</p>
	</div>
</div>
<?php }?>
<!-- /Block layered navigation module -->