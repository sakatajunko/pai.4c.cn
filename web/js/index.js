//分享
function share(){
    wx.ready(function(){
        var link = 'http://zt.4c.cn/2016/12/huijin/api.php?act=html&sharetid=',
            title = '@4c.cn 汇锦步行街夜色如歌•灯光节，爱疯7免费抽！',
            imgurl = 'http://zt.4c.cn/2016/12/huijin/views/images/fx.jpg',
            desc = '@4c.cn 活动主题：汇锦步行街夜色如歌•灯光节。';
        wx.onMenuShareTimeline({
            title: title,
            link: link,
            imgUrl: imgurl,
            success: function(){
            },
            cancel: function(){
            }
        });
        wx.onMenuShareAppMessage({
            title: title,
            desc: desc,
            link: link,
            imgUrl: imgurl,
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function(){
            },
            cancel: function(){
            }
        });
        wx.onMenuShareQQ({
            title: title,
            desc: desc,
            link: link,
            imgUrl: imgurl,
            success: function(){
            },
            cancel: function(){
            }
        });
    })
}
$(document).ready(function() {
  jQuery.jqtab = function(tabtit,tab_conbox,shijian) {
    $(tab_conbox).find("li.tab_con").hide();
    $(tabtit).find("li:first").addClass("thistab").show(); 
    $(tab_conbox).find("li:first").show();
  
    $(tabtit).find("li").bind(shijian,function(){
      $(this).addClass("thistab").siblings("li").removeClass("thistab"); 
      var activeindex = $(tabtit).find("li").index(this);
      $(tab_conbox).children().eq(activeindex).show().siblings().hide();
      return false;
    });
  
  };
  /*调用方法如下：*/
  $.jqtab("#tabs","#tab_conbox","click"); 
});
$(function() {  
    FastClick.attach(document.body);
}); 
//筛选
$('#sentiment .arrange .right a').on('click',function(){
    $(this).addClass('selected').find('span').addClass('choose-selected');
    $('.pop,.classify').fadeIn();
})
$('.pop').on('click',function(){
    $('#sentiment .arrange .right a').removeClass('selected').find('span').removeClass('choose-selected');
    $('.pop,.classify').fadeOut();
})
//返回上一级
$('.back').on('click',function(){
    window.history.back();
})

var reg = /^([\u4e00-\u9fa5]){2,7}$/;
var re = /^1[34578]\d{9}$/;
//报名
$('#apply .form a').on('click',function(){
    var _self = $(this);
    var name = $('#apply .form input[type=text]').val();
    var tel = $('#apply .form input[type=tel]').val();
    if(!reg.test(name)){
        alert('姓名为2-7个汉字！');
        return false;
    }
    if(!re.test(tel)){
        alert('请填写正确的手机号码！');
        return false;
    }    
    if(_self.attr('submiting')){
        return false;
    }
    _self.attr('submiting',true);
    $.ajax({
        url: './submit',
        type: 'post',
        dataType: 'json',
        data: {
            name: name,
            contact:tel
        },
    })
    .done(function(d) {
        if(d.status){
            alert(d.msg);      
            $('#apply .form input[type=text]').val('');
            $('#apply .form input[type=tel]').val('');           
        }else{
            alert(d.msg);
        }
    })
    .fail(function() {
        alert('网络错误！')
    })
    .always(function() {
         _self.attr('submiting',false);
    });
})

//筛选
var cid = 0;
var sid = 0;
$('#sentiment .classify li').on('click',function(){
    $(this).find('a').addClass('selected');
    $(this).siblings('li').find('a').removeClass('selected');
    getSentiment();
})
//排列
$('#sentiment .arrange .left a').on('click',function(){
    $(this).addClass('selected').siblings('a').removeClass('selected');
    getSentiment();
})
function getSentiment(){
    var cid = $('#sentiment .classify div.cid a.selected').attr('cid') || 0;
    var sid = $('#sentiment .classify div.sid a.selected').attr('sid') || 0;
    var data;
    var obj = $('.arrange .left a.selected').attr('hot');
    if(obj == 'hot'){
        // data = {
        //     cid: cid,
        //     sid:sid,
        //     hot:'hot'
        // }
        data = 'hot=hot';
    }
    if(obj == 'new'){
        // data = {
        //     cid: cid,
        //     sid:sid,
        //     new:'new'
        // }
        data = 'new=new';
    }
    // $.ajax({
    //     url: './sentiment',
    //     type: 'post',
    //     dataType: 'json',
    //     data: data,
    // })
    window.location.href="./sentiment?cid="+cid+"&sid="+sid+"&"+data;
}