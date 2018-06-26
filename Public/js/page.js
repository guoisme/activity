 function pageArea(page_cur,page_total_num){
    	var page_str='';
            if (page_cur>page_total_num){page_cur=page_total_num;}
            if (page_cur<1){ page_cur = 1;} //当前页小于1   
            var next="<li><a href='#' onclick='activity({$sid},"+(parseInt(page_cur)+1)+")'>下一页</a></li>";
            var pre="<li><a href='#' onclick='activity({$sid},"+(parseInt(page_cur)-1)+")'>上一页</a></li>";
            var first="<li><a href='#' onclick='activity({$sid},1)'>首页</a></li>";
            var last="<li><a href='#' onclick='activity({$sid},"+page_total_num+")'>尾页</a></li>";
            if(page_cur==1){
              page_str+=next+last; 
            }else if(page_cur>= page_total_num){
              page_str+=first+pre;
            }else{
              page_str+=first+next+pre+last;
            }
            if(page_total_num==1){page_str='';} 
            // $("#page").html(page_str);
            return page_str;
}