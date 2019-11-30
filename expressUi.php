<html>
<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- 屏幕宽度=设备宽度，初始比例=1,不可缩放,最大放大，最小缩放-->
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no,maximum-scale=1" />
	<style>
			/*----------------------------------------------------------*/
			.track-list{margin: 20px; padding-left: 5px; position: relative;}
			.list-left{
				display: inline-block;
				text-align: center;
				padding-top:20px;
				padding-bottom:20px;
				padding-right: 10px;
				border-right:1px solid #CDCDCD;
			}
			.node-icon{
				position: absolute; 
				left: 45px; 
				width: 30px; 
				height: 70px; 
				/*background: url(icon-dian@3x.png)  16px 33px no-repeat;*/
				background-size: 8px 8px;
			}
			.icon-bag-transport{
				position: absolute; 
				left: -15px; 
				top: 20px; 
				width: 31px; 
				height: 31px; 
				/*background: url(icon-yunshuzhong@3x.png)  0px 0px no-repeat;*/
				background-size: 30px 30px;
				background-color: #fff;
			}
			.icon-bag-get{
				position: absolute; 
				left: -15px; 
				top: 20px; 
				width: 31px; 
				height: 31px; 
				/*background:url(icon-yilanjian@3x.png)  0px 0px no-repeat;*/
				background-size: 30px 30px;
				background-color: #fff;
			}
			.icon-bag-send{
				position: absolute; 
				left: -15px; 
				top: 20px; 
				width: 31px; 
				height: 31px; 
				/*background:url(icon-yifahuo@3x.png)  0px 0px no-repeat;*/
				background-size: 30px 30px;
				background-color: #fff;
			}
			.rel-div{
				position: relative;
			}
			.txt{
				margin-left:25px;
				display: inline-block; 
				vertical-align: middle;
				display: flex;
				flex-direction:column;
			    justify-content: center;
			}
			.txt-title{
				font-size:15px;
				font-family:PingFangSC-Regular;
				font-weight:400;
				color:rgba(154,154,154,1);
				line-height: 27px;
			}
			.txt-body{
				font-size:13px;
				font-family:PingFangSC-Regular;
				font-weight:400;
				color:rgba(154,154,154,1);
			}
			.list-main{
				display: flex;
				/*justify-content: space-around;*/
			}
			.list-left-top{
				width: 100px;
				font-size:12px;
				font-family:PingFangSC-Regular;
				font-weight:400;
				color:rgba(154,154,154,1);
			}
			.list-left-bottom{
				font-size:12px;
				font-family:PingFangSC-Regular;
				font-weight:400;
				color:rgba(154,154,154,1);
			}
			.track-rcol{
				display: flex;
				justify-content: center;
			}
		</style>
</head>
<body>
<div id="track-rcol" class="track-rcol">
</div>

<?php
	if(!isset($_GET['number'])||$_GET['number']==null){
		echo "<h1>请在网页后面输入快递单号</h1>";
		header('Refresh:2;url=express.php?number=');
		exit;
	}	
	//快递查询接口，需要对/yuantong/ 快递公司做替换， 替换快递单号	YT4049056560901   
	$data=file_get_contents("https://biz.trace.ickd.cn/auto/".trim($_GET['number']));
	//反转倒序,解析成数组，并反转，再输出json
	$data=json_decode($data,true);	
	$data['data']=array_reverse($data['data']);
	$data=json_encode($data);	
?>
<script type="text/javascript"src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script language="javascript">	  
    $(function(){
      var dataObj=<?=$data?>;//转换为json对象
       var html='<div class="track-list"><div class="list-main">';
	   html+='<div class="list-left"><div class="list-left-top">时间</div></div><div class="rel-div"><i class="icon-bag-transport"></i></div><div class="txt"><div class="txt-title">运输状态</div></div></div>';
    if(dataObj.status>0){                   
                    
          //输出data的子对象变量                   
          $.each(dataObj.data,function(idx,item){                           
              		html+='<div class="list-main">';
					html+='<div class="list-left">';
					html+='<div class="list-left-top">';
					html+=item.time;// 每条数据的时间
						html+='</div>';
						//html+='<div class="list-left-bottom">13:48</div>';
					html+='</div>';
					html+='<div><i class="node-icon"></i></div>';
					html+='<div class="txt">';
					html+='<div class="txt-body"><hr>';
					html+=item.context;
					html+='</div></div></div>';                
           });		
		   
                  
    }else{
		//查询不到                   
		html+='<span style="color:#f00">Sorry！ '+dataObj.message+'</span>';         
 	}     
        html+='</div>';          
        $("#track-rcol").append(html);
});
</script>
</body>
</html>