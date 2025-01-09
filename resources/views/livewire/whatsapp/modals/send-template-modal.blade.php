<div class="modal fade" id="modal_send_template" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalSendTemplateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content bg-primary">
        <div class="modal-header">
          <h5 class="modal-title" id="modalSendTemplateLabel">Send Template</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="send_template_form">
            @csrf
            <input type="hidden" name="send_template_id" id="send_template_id">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" id="detail_template_body"></div>
                </div>
                <div class="row">
                    <div class="col-12" id="sendTemplateForm"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
      </div>
    </div>
</div>
