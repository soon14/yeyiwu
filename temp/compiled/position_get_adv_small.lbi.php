<div class="hd">
      <ul>
      <?php $_from = $this->_var['ad_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_0_25991700_1440421424');if (count($_from)):
    foreach ($_from AS $this->_var['child_0_25991700_1440421424']):
?>
        <li></li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>  
      </ul>
    </div>
    <div class="bd">
     <ul>
		<?php $_from = $this->_var['ad_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_0_26002500_1440421424');if (count($_from)):
    foreach ($_from AS $this->_var['child_0_26002500_1440421424']):
?>
            <li><a href="<?php echo $this->_var['child_0_26002500_1440421424']['ad_link']; ?>" target="_blank"><img src="data/afficheimg/<?php echo $this->_var['child_0_26002500_1440421424']['ad_code']; ?>" alt="" class="goodsimg" /></a></li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>                             	
    </ul>
    </div>
  </div>
