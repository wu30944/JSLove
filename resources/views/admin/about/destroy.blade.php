<div id="destroy_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@lang('default.delete')</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group hidden">
                        <label class="control-label col-sm-2 " for="delete_id">id:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="delete_id" disabled>
                        </div>
                    </div>
                </form>
                <div class="deleteContent">
                    @lang('message.delete') <span class="dname"></span> ? <span
                            class="hidden did"></span>
                </div>
                <div class="modal-footer">
                    <p class="error text-center alert alert-danger hidden"></p>

                    <button type="button" class="btn btn-danger delete" id="btn_delete">
                        <span class='glyphicon glyphicon-trash'></span> @lang('default.delete')
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>