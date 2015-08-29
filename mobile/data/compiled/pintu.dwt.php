
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<meta name="Generator" content="ECSHOP v2.7.3" /> 
<title>拼图游戏</title> 
<script src="js/jweixin.js"></script>
<!--script src="js/wechat.js"></script-->
<script>
  wx.config({
    debug: true,
    appId: 'wx34c3bde7297cf24a',
    timestamp: '<?php echo '<?='; ?>
$timestamp<?php echo '?>'; ?>
',
    nonceStr: '<?php echo '<?='; ?>
$nonceStr<?php echo '?>'; ?>
',
    signature: '<?php echo '<?='; ?>
$signature<?php echo '?>'; ?>
',
    jsApiList: [
      'checkJsApi',
      'onMenuShareTimeline',
      'onMenuShareAppMessage',
      'onMenuShareQQ',
      'onMenuShareWeibo',
      'hideMenuItems',
      'showMenuItems',
      'hideAllNonBaseMenuItem',
      'showAllNonBaseMenuItem',
      'translateVoice',
      'startRecord',
      'stopRecord',
      'onRecordEnd',
      'playVoice',
      'pauseVoice',
      'stopVoice',
      'uploadVoice',
      'downloadVoice',
      'chooseImage',
      'previewImage',
      'uploadImage',
      'downloadImage',
      'getNetworkType',
      'openLocation',
      'getLocation',
      'hideOptionMenu',
      'showOptionMenu',
      'closeWindow',
      'scanQRCode',
      'chooseWXPay',
      'openProductSpecificView',
      'addCard',
      'chooseCard',
      'openCard'
      ]
  });
  wx.ready(function () {
    var shareData = {
      title: '互动拼图',
      desc: '拼图游戏',
      link: 'http://www.baidu.com',
      imgUrl: 'http://www.jialun168.net/mobile/images/libg.png'
    };
    wx.onMenuShareAppMessage(shareData);
    wx.onMenuShareTimeline(shareData);
  });
  wx.error(function (res) {
    alert(res.errMsg);
  });
</script>
<style> 
    body{ 
        font-size:9pt; 

    } 
table{ 
border-collapse: collapse; 
} 
input{ 
    width:7rem; 
height:3rem;
line-height:3rem;
    text-align: center;
    vertical-align: middle;
margin:0;
padding:0;
} 
div{
     text-align: center;
    vertical-align: middle;
    color:#000;
    font-weight: 700;
    font-size: 3.5rem;
height:5rem;
line-height:5rem;
}
button{
    border: 1px solid rgb(48, 230, 245);
  width: 18rem;
  height: 5rem;
  background-color: rgb(0, 187, 255);
  color: #fff;
font-size: 3.5rem;
border-radius:1rem;
}


.div1{
float: left;
height: 5rem;
line-height: 5rem;
background-color: rgb(0, 187, 255);
width: 18rem;
position:relative;
font-size: 3.5rem;
border-radius:1rem;
  cursor: pointer;
margin-left: 34%;
}
.div2{
width: 18rem;
font-size:3.5rem;
font-weight:800;
height: 5rem;
line-height: 5rem;
  color: #fff;

}
.inputstyle{
    width: 144px;
    height: 41px;
    cursor: pointer;
    font-size: 30px;
    outline: medium none;
    position: absolute;
    filter:alpha(opacity=0);
    -moz-opacity:0;
    opacity:0; 
    left:0px;
    top: 0px;
    width: 18rem;
}

</style> 
</head> 
<body> 
<div>
<input type="text" id="lines" value='3'/ style="display:none;"><input type="text" id="cols" value='3'/style="display:none;"><button id="start"> 开 始 </button>
</div>

<table id="board" border=1 cellspacing=0 cellpadding=0> 
        <tr><td></td><td></td><td></td></tr> 
        <tr><td></td><td></td><td></td></tr> 
</table> 
<br><br><br>
<img id='img'  src="<?php echo $this->_var['img_path']; ?>" style="height:auto;" /><br> 
<br><br><br>
<form name="zdy" id="zdy" action="pintu.php?act=upfile" method="post" enctype="multipart/form-data">
    <input type="text" id="filename" value="01.jpg" style="display:none;">
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">

    <div class="div1"><div class="div2">上传图片</div>
    <input type="file" name="file" class="inputstyle" onchange="selectImage(this);" id="image_zdy"   >
    </div>
    <input type="submit" value="确认" style="display:none;">
</form>
</body> 
</html> 
<script> 

 var image = '';
 function selectImage(file){
 if(!file.files || !file.files[0]){
return;
}
 var reader = new FileReader();
 reader.onload = function(evt){
 document.getElementById('img').src = evt.target.result;
 image = evt.target.result;
 
}

reader.readAsDataURL(file.files[0]);
//document.getElementById('filename').value="";
//uploadImage();
document.zdy.submit(); //自动提交表单
}
 function uploadImage(){

$.ajax({

type:'POST',

 url: 'images/pintu', 

 data: {image: image},

 async: false,

 dataType: 'json',

 success: function(data){

if(data.success){

alert('上传成功');

}else{

alert('上传失败');

}

},

 error: function(err){

alert('网络故障');

}

});

}

//ie7以下默认不缓存背景图像，造成延迟和闪烁，修正此bug. 
 
try{ 
document.execCommand("BackgroundImageCache", false, true); 
}catch(e){alert(e)}; 
    //辅助函数 
    function $(id){return document.getElementById(id)}; 
    /************************************************* 
    * js拼图游戏 v1.6 
    * 作者 sunxing007 
    * 转载请注明来自http://blog.csdn.net/sunxing007 
    **************************************************/ 
    var PicGame = { 
            //行数 
            x: 3, 
            //列数 
            y: 3, 
            //图片源 
            img: $('img'), 
            //单元格高度 
            cellHeight: 0, 
            //单元格宽度 
            cellWidth: 0, 
            //本游戏最主要的对象：表格，每个td对应着一个可以移动的小格子 
            board: $('board'), 
            //初始函数 
            init: function(){ 
                        //确定拼图游戏的行数和列数 
                        this.x = $('lines').value>1?$('lines').value : 3; 
                        this.y = $('cols').value>1?$('cols').value : 3; 
                        //删除board原有的行 
                        while(this.board.rows.length>0){ 
                                this.board.deleteRow(0); 
                        } 
                        //按照行数和列数重新构造board 
                        for(var i=0; i<this.x; i++){ 
                                var tr = this.board.insertRow(-1); 
                                for(var j=0; j<this.y; j++){ 
                                        var td=tr.insertCell(-1); 
                                } 
                        } 
                        //计算单元格高度和宽度 
                        this.cellHeight = this.img.height/this.x; 
                        this.cellWidth = this.img.width/this.y; 
                        //获取所有的td 
                        var tds = this.board.getElementsByTagName('td'); 
                        //对每个td， 设置样式 
                     for(var i=0; i<tds.length-1; i++){ 
                             tds[i].style.width = this.cellWidth; 
                             tds[i].style.height = this.cellHeight; 
                             tds[i].style.background = "url(" + this.img.src + ")"; 
                             tds[i].style.border = "solid #ccc 1px"; 
                             var currLine = parseInt(i/this.y); 
                             var currCol = i%this.y; 
                             //这里最重要，计算每个单元格的背景图的位置，使他们看起来像一幅图像 
                             tds[i].style.backgroundPositionX = -this.cellWidth * currCol; 
                             tds[i].style.backgroundPositionY = -this.cellHeight * currLine; 
                     } 
                     /** begin: 打乱排序*******************/ 
                     /** 
                     *    打乱排序的算法是这样的：比如我当前是3*3布局， 
                     * 则我为每一个td产生一个目标位置，这些目标位置小于9且各不相同， 
                     * 然后把它们替换到那个地方。 
                     **/ 

                     //目标位置序列 
                     var index = []; 
                     index[0] = Math.floor(Math.random()*(this.x*this.y)); 
                     while(index.length<(this.x*this.y)){ 
                     var num = Math.floor(Math.random()*(this.x*this.y)); 
                     for(var i=0; i<index.length; i++){ 
                     if(index[i]==num){ 
                     break; 
                     } 
                     } 
                     if(i==index.length){ 
                     index[index.length] = num; 
                     } 
                     //window.status = index; 
                     } 
                     var cloneTds = []; 
                     //把每个td克隆， 然后依据目标位置序列index，替换到目标位置 
                     for(var i=0; i<tds.length; i++){ 
                     cloneTds.push(tds[i].cloneNode(true)); 
                     } 
                     for(var i=0; i<index.length; i++){ 
                     tds[i].parentNode.replaceChild(cloneTds[index[i]],tds[i]); 
                     } 
                     /** end: 打乱排序*********************/ 

                     //为每个td添加onclick事件。 
                     tds = this.board.getElementsByTagName('td'); 
                     for(var i=0; i<tds.length; i++){ 
                             tds[i].onclick = function(){ 
                             //被点击对象的坐标 
                         var row = this.parentNode.rowIndex; 
                         var col = this.cellIndex; 
                         //window.status = "row:" + row + " col:" + col; 
                         //空白方块的坐标 
                         var rowBlank = 0; 
                         var colBlank = 0; 
                         //reachable表示当前被点击的方块是否可移动 
                         var reachable = false; 
                         if(row+1<PicGame.x && PicGame.board.rows[row+1].cells[col].style.background == ''){ 
                         rowBlank = row + 1; 
                         colBlank = col; 
                         reachable = true; 
                         //window.status +=" reachable! rowBlank: " + rowBlank + " colBlank:" + colBlank; 
                         } 
                         else if(row-1>=0 && PicGame.board.rows[row-1].cells[col].style.background == ''){ 
                         rowBlank = row - 1; 
                         colBlank = col; 
                         reachable = true; 
                         //window.status +=" reachable! rowBlank: " + rowBlank + " colBlank:" + colBlank; 
                         } 
                         else if(col+1<PicGame.y && PicGame.board.rows[row].cells[col+1].style.background == ''){ 
                         rowBlank = row; 
                         colBlank = col + 1; 
                         reachable = true; 
                         //window.status +=" reachable! rowBlank: " + rowBlank + " colBlank:" + colBlank; 
                         } 
                         else if(col-1>=0 && PicGame.board.rows[row].cells[col-1].style.background == ''){ 
                         rowBlank = row; 
                         colBlank = col - 1; 
                         reachable = true; 
                         //window.status +=" reachable! rowBlank: " + rowBlank + " colBlank:" + colBlank; 
                         } 
                         else{ 
                         //window.status +=" unreachable!"; 
                         reachable = false; 
                         } 
                         //如果可移动，则把当前方块和空白方块交换 
                         if(reachable){ 
                         var tmpBlankNode = PicGame.board.rows[rowBlank].cells[colBlank].cloneNode(true); 
                         //需要注意的是克隆对象丢失了onclick方法，所以要补上 
                         tmpBlankNode.onclick = arguments.callee; 
                         var tmpCurrNode = PicGame.board.rows[row].cells[col].cloneNode(true); 
                         tmpCurrNode.onclick = arguments.callee; 
                         PicGame.board.rows[rowBlank].cells[colBlank].parentNode.replaceChild(tmpCurrNode,PicGame.board.rows[rowBlank].cells[colBlank]); 
                         PicGame.board.rows[row].cells[col].parentNode.replaceChild(tmpBlankNode, PicGame.board.rows[row].cells[col]); 
                         } 
                         } 
                     } 
            } 
    }; 
PicGame.init(); 
$('start').onclick = function(){ 
        PicGame.init(); 
} 
</script> 