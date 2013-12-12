<?php /* Smarty version 2.6.25, created on 2013-12-08 19:27:10
         compiled from default/views/index.index.tpl */ ?>
 <div class="content white pb25">
            <div class="container tiles_hub">
                <div id="slider" class="flexslider_small sixteen columns alpha">
                    <ul class="slides">
                    <?php $_from = $this->_tpl_vars['images']['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['images'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['images']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['item']):
        $this->_foreach['images']['iteration']++;
?> 
                    
                        <li><img src="<?php if ($this->_tpl_vars['item']): ?><?php echo $this->_tpl_vars['BASE_URL']; ?>
<?php echo $this->_tpl_vars['item']; ?>
<?php endif; ?>" alt="" title="" /></li>
<!--                         <li><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
front/images/home/3.jpg" alt="" title="" /></li> -->
<!--                         <li><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
front/images/home/2.jpg" alt="" title="" /></li> -->
<!--                         <li><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
front/images/home/4.jpg" alt="" title="" /></li> -->
<!--                         <li><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
front/images/home/5.jpg" alt="" title="" /></li> -->
<!--                         <li><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
front/images/home/6.jpg" alt="" title="" /></li> -->
                   <?php endforeach; endif; unset($_from); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="band mb25" id="welcome">
            <div class="container">
                <hr>
                <h3 class="sectionhead welcome"><?php echo $this->_tpl_vars['news']['title']; ?>
</h3>
                <div class="sixteen columns">
        <?php echo $this->_tpl_vars['news']['full_text']; ?>

        </div>
        </div>
        </div>
     
        