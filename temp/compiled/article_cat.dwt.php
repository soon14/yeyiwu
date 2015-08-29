<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>
</head>
<body>
<div class="body_user ">
<?php echo $this->fetch('library/page_header.lbi'); ?>
</div>
<div class="content">
<div class="contentBody">
<div class="block_s">

 <div id="ur_here">
  <?php echo $this->fetch('library/ur_here.lbi'); ?>
 </div>

<div class="blank"></div>
  <div class="help_left">
  <?php echo $this->fetch('library/left_help.lbi'); ?>
   
  </div>
  
  
  <div class="help_right_out">
   <div class="help_right">
   <div class="help_right_title " >
  <p style="float:none; font-size:16px;"><?php echo $this->_var['lang']['article_list']; ?></p>
    </div>
    <div class="blank"></div>
     <div class="blank"></div>
      
    <div class="boxCenterList">
          <form action="<?php echo $this->_var['search_url']; ?>" name="search_form" method="post" class="article_search">
        <input name="keywords" type="text" id="requirement" value="<?php echo $this->_var['search_value']; ?>" class="inputBg" />
        <input name="id" type="hidden" value="<?php echo $this->_var['cat_id']; ?>" />
        <input name="cur_url" id="cur_url" type="hidden" value="" />
        <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="bnt_blue_1" />
      </form>
      <div class="blank"></div>
      <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <tr>
        <th bgcolor="#ffffff"><?php echo $this->_var['lang']['article_title']; ?></th>
          <th bgcolor="#ffffff"><?php echo $this->_var['lang']['article_author']; ?></th>
          <th bgcolor="#ffffff"><?php echo $this->_var['lang']['article_add_time']; ?></th>
        </tr>
      <?php $_from = $this->_var['artciles_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
      <tr>
        <td bgcolor="#ffffff"><a href="<?php echo $this->_var['article']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['article']['title']); ?>" class="f6"><?php echo $this->_var['article']['short_title']; ?></a></td>
          <td bgcolor="#ffffff"><?php echo $this->_var['article']['author']; ?></td>
          <td bgcolor="#ffffff" align="center"><?php echo $this->_var['article']['add_time']; ?></td>
        </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </table>
    </div>
    <div class="blank5"></div>
    <div class="article">
  <?php echo $this->fetch('library/pages.lbi'); ?>
  </div>
  
  </div>
  
  </div>  
  

</div>
</div>
</div>
<div class="blank5"></div>
<div class="flow">
<div class="footer">
<div class="footerBody">
<Div class="block_s">

<?php echo $this->fetch('library/page_footer.lbi'); ?>
</Div>
</div>
</div>
</div>
</body>
<script type="text/javascript">
document.getElementById('cur_url').value = window.location.href;
</script>
</html>
