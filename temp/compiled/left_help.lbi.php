
<?php if ($this->_var['helps']): ?>
<div class="sideMenu" style="margin:0 auto">
<?php $_from = $this->_var['helps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'help_cat');$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['help_cat']):
        $this->_foreach['cat']['iteration']++;
?>
			<h2 <?php if ($this->_var['key'] == $this->_var['cat_id']): ?> class="on"<?php else: ?>class=''<?php endif; ?>><em></em><a  href='<?php echo $this->_var['help_cat']['cat_id']; ?>' title="<?php echo $this->_var['help_cat']['cat_name']; ?>"><?php echo $this->_var['help_cat']['cat_name']; ?></a></h2>
			<ul <?php if ($this->_var['key'] == $this->_var['cat_id']): ?>style="display:block"<?php else: ?>style="display:none"<?php endif; ?>>
            <?php $_from = $this->_var['help_cat']['article']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
				<li><a <?php if ($this->_var['id'] == $this->_var['item']['article_id']): ?> class="sell" <?php endif; ?> href="<?php echo $this->_var['item']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['item']['title']); ?>"> <?php echo $this->_var['item']['short_title']; ?></a></li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		

		</div>
<?php endif; ?>
		<script type="text/javascript">
			jQuery(".sideMenu").slide({
				titCell:"h2", //鼠标触发对象
				targetCell:"ul", //与titCell一一对应，第n个titCell控制第n个targetCell的显示隐藏
				effect:"slideDown", //targetCell下拉效果
				defaultIndex:0,//默认是否执行效果（默认true）
				delayTime:300,//鼠标从.sideMen移走后返回默认状态（默认false）
				trigger:"click"
				});
		</script>
        