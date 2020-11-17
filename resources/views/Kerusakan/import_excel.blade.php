<!-- Modal Import Excel -->

<div class="modal fade" id="modal-import-excel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Import Excel Kerusakan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-excel-kerusakan" class="form" action="{{ route("kerusakan.excel.import") }}" method="POST"  enctype="multipart/form-data">
          <div class="custom-file mb-3">
              <input type="hidden" name="id_gedung">
              <input type="file" id="file-upload" class="custom-file-input" name="excel_kerusakan_file">
              <label class="custom-file-label" for="customFile">Upload File</label>
          </div>
          
          <a class="btn btn-secondary mb-3" href="{{ route('kerusakan.excel.export', ['id_gedung' => $id_gedung]) }}">
            <span class="icon text-white-100">
                Export Excel
            </span> 
          </a>
          <span style="font-size: small; color: red;">*note : xlsx | max : 10MB</span>
        </form>
      </div>
      <div class="modal-footer">
        <div style="color: red;">
          <span class="u-alert"></span>
        </div>
        <button class="btn btn-success" id="btn-submit-excel-kerusakan-import" type="button">Upload</button>
      </div>
    </div>
  </div>
</div>


@push('scripts')
<script>
  $(function () {
    $(".btn-show-form-kerusakan").click(function(e){
      e.preventDefault();
      openFormUploadUsulan($(this).attr("id-gedung"));
    });
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    $("#form-excel-kerusakan").submit(function(e){
      e.preventDefault();
      let url = $(this).attr("action");
      let formData = new FormData(this);
      if(formData.get('excel_kerusakan_file') == ""){
        showErrorAlert("File tidak boleh koosng");
        return;
      }
      submitUploadUsulan(url, formData, {
        onUploading: onUploading,
        inUploading: inUploading,
        onUploaded: onUploaded
      });
    });
    $("#btn-submit-excel-kerusakan-import").click(function(){
      $("#form-excel-kerusakan").submit();
    });
    function openFormUploadUsulan(id_gedung){
      let modal_elm = $("#modal-import-excel");
      $("[name='id_gedung']", modal_elm).val(id_gedung);
      $("[name='excel_kerusakan_file']", modal_elm).val("");
      $($("[name='excel_kerusakan_file']", modal_elm)[0]).siblings(".custom-file-label")
          .addClass("selected").html("Pilih excel");
      showErrorAlert("");
      $(modal_elm).modal("show");
    }
    function onUploading(){
      showErrorAlert("");
      $('[data-dismiss]', $("#modal-import-excel")).hide();
      $("#btn-submit-excel-kerusakan-import").attr("disabled", "disabled");
      $("#btn-submit-excel-kerusakan-import").removeClass("btn-primary");
      $("#btn-submit-excel-kerusakan-import").addClass("btn-light");
      $("#btn-submit-excel-kerusakan-import").html("uploading");
    }
    function inUploading(progress){
      $("#btn-submit-excel-kerusakan-import").html(Math.round(progress)+"% uploading");
    }
    function onUploaded(status, message, data, redirect_to = null){
      if(status == 'success'){
        let new_param = '';
        if(redirect_to !== null){
          // if(location.href.search("\\?") == -1) new_param += "?";
          // else new_param += "&";
          // new_param += "upload_usulan_final_success";
          location.href = redirect_to;
          return;
        }
      }else{
        showErrorAlert("File gagal diupload. ");
      }
      $('[data-dismiss]', $("#modal-import-excel")).show();
      $("#btn-submit-excel-kerusakan-import").removeAttr("disabled");
      $("#btn-submit-excel-kerusakan-import").addClass("btn-primary");
      $("#btn-submit-excel-kerusakan-import").removeClass("btn-light");
      $("#btn-submit-excel-kerusakan-import").html("Upload");
    }
    function showErrorAlert(message){
      let modal_elm = $("#modal-import-excel");
      $(".u-alert", modal_elm).html(message);
    }
    function submitUploadUsulan(url, formData, eventHandler = {}){
      let onUploading = function(){};
      let inUploading = function(){};
      let onUploaded = function(){};
      if(eventHandler['onUploading'] !== undefined) onUploading = eventHandler['onUploading'];
      if(eventHandler['inUploading'] !== undefined) inUploading = eventHandler['inUploading'];
      if(eventHandler['onUploaded'] !== undefined) onUploaded = eventHandler['onUploaded'];
      onUploading();
      $.ajax({
        url: url,
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
          if(response.status == 200)
            onUploaded('success', 'success', response.redirect_to);
          else onUploaded('error', response.message);
        },
        error: function(jqXHR, textStatus, errorThrown){
            onUploaded('error', errorThrown);
        },
        xhr: function() {
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
              var percentComplete = (evt.loaded / evt.total) * 100;
              inUploading(percentComplete);
            }
          }, false);
          return xhr;
        },
      });
    }
  });
</script>
@endpush