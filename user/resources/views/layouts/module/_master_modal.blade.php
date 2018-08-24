<div class="modal fade" id="@yield("modal-id")" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog @yield("modal-dialog-class")">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@yield("modal-title")</h4>
            </div>
            <div class="modal-body">
                @yield("modal-form")
            </div>
            <div class="modal-footer">
                @yield("modal-footer-action")
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
