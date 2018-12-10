<div class="box-header">
    <div class="box-tools">
        <div class="page">
            <!-------分页---------->
            <?php if($data['count'] > 5): ?>
                <ul class="pagination">
                    <?php if($data['page'] !=1): ?>
                        <li>
                            <a href="javascript:void(0)" onclick="page(<?php echo e($data['prev']); ?>)" ><span class="glyphicon glyphicon-chevron-left"></span></a>
                        </li>
                    <?php else: ?>
                        <li class="disabled">
                            <a href="javascript:void(0)"  disabled="false"><span class="glyphicon glyphicon-chevron-left"></span></a>
                        </li>
                    <?php endif; ?>
                    <?php $__currentLoopData = $data['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($v == $data['page']): ?>
                            <li class="active"><span><?php echo e($v); ?></span></li>
                        <?php else: ?>
                            <li >
                                <a href="javascript:void(0)" onclick="page(<?php echo e($v); ?>)"><?php echo e($v); ?></a>
                            </li>
                        <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <li>
                        <a href="javascript:void(0)" onclick="page(<?php echo e($data['next']); ?>)"><span class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>

                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-------分页---------->
<script>



    function page(page){
        //加载层
        
            
            
            
        
        // 发异步请求完成分页
//        var state = {test:"test"};
//        history.pushState(state, "test", pagination_url+"/"+page);
        var layer_id ;

        $.ajax({
            type: "GET",
            url: pagination_url+"/"+page,
            dataType: 'json',
            cache: false,
            data: { page: page,
                    _token: "<?php echo e(csrf_token()); ?>"},
            beforeSend: function () {
                layer_id = showLoadLayer();
                NProgress.start();
            },
            complete:function(){
                NProgress.done();
                closeLoadLayer(layer_id);
                ElementClassBind();
            },
            success: function(data) {

                if(data){
                    $('.page_content').html(data['page_content']);
                    $('.page').html(data['page']);
                    $('#current_page').val(page);
                }

                var state = {
                    title: "test",
                    url: pagination_url+"/"+page,
                    content: $('#pjax-container').html(),
                    selector: '#pjax-container',
                    prev: window.location.href,
                    time: (new Date()).getTime()
                };

                if(pagination_url+"/"+page != state.prev)
                    history.pushState(state, "test", pagination_url+"/"+page);
                history.replaceState(state, "test", pagination_url+"/"+page);

            },error:function(requestObject, error, errorThrown)
            {
                alert(errorThrown);
                
                
                    
                
                    
                

            }
        });

    }

    window.onpopstate = function(event) {

        var state = history.state; // 等价于
//        var state = event.state;
        if(state && state.content) $('#pjax-container').html(state.content);
    };


</script>