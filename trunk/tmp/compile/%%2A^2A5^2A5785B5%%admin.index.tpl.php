<?php /* Smarty version 2.6.25, created on 2013-12-06 11:26:27
         compiled from default/views/admin.index.tpl */ ?>
            <h2>Welcome <?php echo $this->_tpl_vars['backendUser']['full_name']; ?>
</h2>
            <p id="page-intro">What would you like to do?</p>
            
            <ul class="shortcut-buttons-set">
               <!--  
                <li><a class="shortcut-button" href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/new-registration-user"><span>
                    <img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/add_user_48.png" alt="icon" /><br />
                    New Register User
                </span></a></li>
                
                -->  
                <li><a class="shortcut-button" href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/manage-user"><span>
                    <img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/group_48.png" alt="icon" /><br />
                    Manage User 
                </span></a></li>
                
				<li><a class="shortcut-button" href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/manage-content"><span>
                    <img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/paper_content_pencil_48.png" alt="icon" /><br />
                    Content Manager
                </span></a></li>
                
               
                
            </ul><!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->