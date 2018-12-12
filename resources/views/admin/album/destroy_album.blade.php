<div id="destroy_album_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @lang("default.destroy")
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-horizontal" id="form_destroy">
                    {{--<form class="form-horizontal" role="form" >--}}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <h3>@lang('message.delete')?</h3>
                            </div>
                            <input  type="text" id="delete_album" style="display:none" readonly="true" >
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" id="btn-album-destroy">
                                <span class="glyphicon glyphicon-trash"> </span> @lang('default.destroy')
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                            </button>
                        </div>
                    {{--</form>--}}
                </div>
            </div>
        </div>
    </div>
</div>

