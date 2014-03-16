<script id="articleTpl" type="text/template">
    <%_.each(datas, function(item) {%>
        <section class="artsection">
        <div class="col-xs-10">
            <div class="row artnav">
                <a href="{{URL::to('/art')}}/<%=item.id%>" class="article_title">
                    <span class="tnav"><%=item.title%></span>
                </a>
            </div>
            <div class="row nav-point">
                <a href="{{URL::to('/art')}}/<%=item.id%>" class="artileparam btn btn-default btn-xs">
                    <span id="rpoints<%=item.id%>"><%=item.points%></span>分
                </a>
                <a href="{{URL::to('/art')}}/<%=item.id%>" class="artileparam btn btn-default btn-xs">
                        <%=item.comments%>评论
                </a>
            </div>
            <div class="row">
                <a href="{{URL::to('/art')}}/<%=item.id%>">
                    <img class="" src="{{URL::to('/')}}/<%=item.imgpath%>" style="width: 100%;">
                </a>
            </div>
            <div class="row artshare">
                <a href="javascript:void(0)" onclick="sinaweibo('<%=item.title%>','{{URL::to('/art')}}/<%=item.id%>','{{URL::to('/')}}/<%=item.imgpath%>');return false;" class="btn btn-danger" title="分享到新浪微博" target="_blank" >
                    分享到新浪微博
                </a>
                <a href="javascript:void(0)" onclick="postToWb('<%=item.title%>','{{URL::to('/art')}}<%=item.id%>'','{{URL::to('/')}}/<%=item.imgpath%>');return false;" class="btn btn-primary"  title="分享到腾讯微博" target="_blank" >
                    分享到腾讯微博
                </a>
            </div>
        </div>
        <div class="col-xs-2">
            <div class="row">
                <ul class="vertical-vote">
                    <% if (typeof(item.state) != "undefined") { %>
                        <li><a class="up" href="javascript:openLoginModal();" title="赞">赞</a></li>
                    <li><a class="down" href="javascript:openLoginModal();" title="踩">踩</a></li>
                    <% }else { %>
                        <% if(item.state == 1) {%>
                            <li><a class="up up_c artup" id="up<%=item.id%>" art="<%=item.id%>" href="javascript:void(0);" title="赞">赞</a></li>
                    <li><a class="down artdown" id="down<%=item.id%>" art="<%=item.id%>" href="javascript:void(0);" title="踩">踩</a></li>
                        <% }else { %>
                            <li><a class="up artup" id="up<%=item.id%>" art="<%=item.id%>" href="javascript:void(0);" title="赞">赞</a></li>
                    <li><a class="down down_c artdown" id="down<%=item.id%>" art="<%=item.id%>" href="javascript:void(0);" title="踩">踩</a></li>
                        <% } %>
                    <% } %>    
                    </ul>
            </div>
        </div>
    </section>
    <%});%>
</script>