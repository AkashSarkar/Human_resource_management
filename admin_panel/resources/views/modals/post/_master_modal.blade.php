<div class="modal fade" id="@yield("modal-id")" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">@yield("modal-title")</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @yield("modal-form")
            </div>
            <div class="modal-footer">
                @yield("modal-footer-action")
            </div>
        </div>
    </div>
</div>