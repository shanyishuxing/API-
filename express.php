<html>
<meta charset="UTF-8">
<div id="shipping_detail">
</div>

<?php
//快递查询接口，需要对/yuantong/ 快递公司做替换， 替换快递单号	YT4049056560901   
	$data=file_get_contents("https://biz.trace.ickd.cn/yuantong/YT4049056560901");   
	//echo "var data='",$data,"'";
?>
<script type="text/javascript"src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script language="javascript">   
    $(function(){
      var dataObj=<?=$data?>;//转换为json对象
       var html='<tr>';
        html+='<th>物流状态：</th>';
        html+='<td>';           
    if(dataObj.status>0){                   
          html+='<table width="520px" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse; border-spacing: 0pt;">';
          html+='<tr>';                   
          html+='<td width="163" style="background-color:#e6f9fa;border:1px solid #75c2ef;font-size:14px;font-weight:bold;height:20px;text-indent:15px;">';                   
          html+='时间';                   
          html+='</td>';                   
          html+='<td width="354" style="background-color:#e6f9fa;border:1px solid #75c2ef;font-size:14px;font-weight:bold;height:20px;text-indent:15px;">';                   
          html+='地点和跟踪进度';                   
          html+='</td>';                   
          html+='</tr>';                   
          //输出data的子对象变量                   
          $.each(dataObj.data,function(idx,item){                           
              html+='<tr>';                           
              html+='<td width="163" style="border:1px solid #dddddd;font-size: 12px;line-height:22px;padding:3px 5px;">';                           
              html+=item.time;// 每条数据的时间                           
              html+='</td>';                           
              html+='<td width="354" style="border:1px solid #dddddd;font-size: 12px;line-height:22px;padding:3px 5px;">';                           
              html+=item.context;// 每条数据的状态                         
              html+='</td>';                         
           	html+='</tr>';                 
           });                   
          html+='</table>';           
    }else{
		//查询不到                   
		html+='<span style="color:#f00">Sorry！ '+dataObj.message+'</span>';         
 	}     
        html+='</td></tr>';           
        $("#shipping_detail").append(html);
});
</script>
</html>