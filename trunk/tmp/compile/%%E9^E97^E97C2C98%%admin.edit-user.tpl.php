<?php /* Smarty version 2.6.25, created on 2013-12-05 18:57:30
         compiled from user/views/admin.edit-user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'l', 'user/views/admin.edit-user.tpl', 13, false),array('block', 'p', 'user/views/admin.edit-user.tpl', 80, false),array('modifier', 'count', 'user/views/admin.edit-user.tpl', 31, false),)), $this); ?>
<script type="text/javascript">

$().ready(function() {
    // validate signup form on keyup and submit
    $("input[type=password]").val('');
});
</script>
          
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit User<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
                    
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" class="default-tab"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Basic<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
                        <?php if (! $this->_tpl_vars['limit']): ?><li><a href="#tab2"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Detail<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li><?php endif; ?>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                
                    <form action="" method="post">
                    
                    <div class="tab-content" id="tab1">
                    
                        <!-- MESSAGE HERE -->
                        <?php if (count($this->_tpl_vars['userMessage']) > 0 && $this->_tpl_vars['userMessage']['success'] == true): ?>
                        <div class="notification success png_bg">
                            <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?php echo $this->_tpl_vars['userMessage']['message']; ?>

                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (count($this->_tpl_vars['userMessage']) > 0 && $this->_tpl_vars['userMessage']['success'] == false): ?>
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?php echo $this->_tpl_vars['userMessage']['message']; ?>

                            </div>
                        </div>
                        <?php endif; ?>
                        
                        
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
                                    <label><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Username<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><span class="red">*</span></label>
                                        <input class="text-input small-input" type="text"  name="data[username]" value="<?php echo $this->_tpl_vars['data']['username']; ?>
" /><?php if ($this->_tpl_vars['errors']['username']): ?><span class="input-notification error png_bg"><?php echo $this->_tpl_vars['errors']['username']; ?>
</span><?php endif; ?>
                                </p>
                                <p>
                                    <label><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><span class="red">*</span></label>
                                        <input class="text-input small-input" type="password"  name="data[password]" value="" /><?php if ($this->_tpl_vars['errors']['password']): ?><span class="input-notification error png_bg"><?php echo $this->_tpl_vars['errors']['password']; ?>
</span><?php endif; ?>
                                        <br /><small><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Between 6-20 characters<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></small>
                                </p>
                                <p>
                                    <label><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Repeat New Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><span class="red">*</span></label>
                                        <input class="text-input small-input" type="password" name="data[repeat_password]" value="<?php echo $this->_tpl_vars['data']['repeat_password']; ?>
" /><?php if ($this->_tpl_vars['errors']['repeat_password']): ?><span class="input-notification error png_bg"><?php echo $this->_tpl_vars['errors']['repeat_password']; ?>
</span><?php endif; ?>
                                </p>
                                <p>
                                    <label><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
                                        <input class="text-input small-input" type="text"  name="data[email]"  value="<?php echo $this->_tpl_vars['data']['email']; ?>
" /><?php if ($this->_tpl_vars['errors']['email']): ?><span class="input-notification error png_bg"><?php echo $this->_tpl_vars['errors']['email']; ?>
</span><?php endif; ?>
                                </p>
                                <p>
                                    <label><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>First Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><span class="red">*</span></label>
                                        <input class="text-input small-input" type="text"  name="data[first_name]"  value="<?php echo $this->_tpl_vars['data']['first_name']; ?>
" /><?php if ($this->_tpl_vars['errors']['first_name']): ?><span class="input-notification error png_bg"><?php echo $this->_tpl_vars['errors']['first_name']; ?>
</span><?php endif; ?>
                                </p>
                                
                                <p>
                                    <label><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><span class="red">*</span></label>
                                        <input class="text-input small-input" type="text"  name="data[last_name]"  value="<?php echo $this->_tpl_vars['data']['last_name']; ?>
" /><?php if ($this->_tpl_vars['errors']['last_name']): ?><span class="input-notification error png_bg"><?php echo $this->_tpl_vars['errors']['last_name']; ?>
</span><?php endif; ?>
                                </p>
                                
                                <?php $this->_tag_stack[] = array('p', array('module' => 'user','name' => 'change_group')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                                <p>
                                    <label><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><span class="red">*</span></label>              
                                    <select name="data[group_id]" class="small-input">
                                    <?php $_from = $this->_tpl_vars['allGroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['item']['group_id']; ?>
" <?php if ($this->_tpl_vars['data']['group_id'] == $this->_tpl_vars['item']['group_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                    </select> 
                                    <!-- <?php if (1 == $this->_tpl_vars['loggedGroupId']): ?>
                                    <br /><small>Each group has different <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
permission/admin/manager">permissions</a>.</small>
                                    <?php endif; ?> -->
                                </p>
                                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                
                                <p>
                                <br/>
                                    <input class="button" type="button" value="&laquo; <?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onclick="javascript:history.back();"/>
                                    <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                    </div>  <!-- End #tab1 --> 
                    
                    <div class="tab-content hidden" id="tab2">
                    
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                <p>
                                    <label><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enable user<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
                                    <input type="radio" name="data[enabled]" value="1" <?php if ($this->_tpl_vars['data']['enabled'] != '0'): ?>checked="checked"<?php endif; ?>/> <?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="data[enabled]" value="0" <?php if ($this->_tpl_vars['data']['enabled'] == '0'): ?>checked="checked"<?php endif; ?>/> <?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                </p>
                                
                                <p>
                                    <label><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
                                    <textarea class="text-input textarea" id="textarea" name="data[admin_note]" cols="79" rows="5"><?php echo $this->_tpl_vars['data']['admin_note']; ?>
</textarea>
                                </p>
                                
                                <p>
                                    <input class="button" type="button" value="&laquo; <?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onclick="javascript:history.back();"/>
                                    <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                    </div>      
                      
                  </form>
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
            
            <div class="clear"></div>