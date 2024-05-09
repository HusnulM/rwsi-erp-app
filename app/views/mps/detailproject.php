    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="msg-alert">
                        <?php
                            Flasher::msgInfo();
                        ?>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= $data['menu']; ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">                                
							    <a href="<?= BASEURL; ?>/mps/project" class="btn btn-danger waves-effect pull-right">Cancel</a>
							</ul>
                        </div>
                        <div class="body">
                            <form action="<?= BASEURL; ?>/mps/updatempsproject" method="POST">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="namampsproject">Nama MPS Project</label>
                                        <input type="text" name="namampsproject" class="form-control" required value="<?= $data['project']['namaproject']; ?>" readonly>
                                        <input type="hidden" name="idproject" value="<?= $data['project']['idproject']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <!-- <th>No</th> -->
                                                        <th>ID Activity</th>
                                                        <th>Activity</th>
                                                        <th>Planning Date</th>
                                                        <th>Actual Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0; ?>
                                                    <?php foreach ($data['activity'] as $row) : ?>
                                                        <?php $no++; ?>
                                                        <tr>
                                                            <td>
                                                                <?= $row['mps_activity']; ?>
                                                                <input type="hidden" name="idprocess[]" class="form-control" value="<?= $row['id']; ?>" readonly style="width:450px;">

                                                                <input type="hidden" name="idactivity[]" class="form-control" value="<?= $row['mps_activity']; ?>" readonly style="width:50px;">
                                                            </td>
                                                            <td>
                                                                <?= $row['activity_name']; ?>
                                                                <input type="hidden" name="activity[]" class="form-control" value="<?= $row['activity_name']; ?>" readonly style="width:450px;">
                                                            </td>
                                                            <td>
                                                                <input type="date" name="plandate[]" class="form-control" style="width:155px;" value="<?= $row['plan_date']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="date" name="actdate[]" class="form-control" style="width:155px;" value="<?= $row['act_date']; ?>">
                                                            </td>
                                                            <td style="text-align:center;">
                                                                <button type="button" class="btn btn-default btn-sm btn-view-files" data-activityid="<?= $row['id']; ?>" data-mpsproject="<?= $row['mpsproject']; ?>" data-mpsactivity="<?= $row['mps_activity']; ?>">
                                                                    <i class="material-icons">pageview</i> <span>VIEW FILE</span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn bg-blue pull-right">
                                            <i class="material-icons">save</i> <span>SAVE</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade bd-example-modal-md" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="infoAttachmentModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="infoAttachmentModalText">Lampiran Informasi : <b id="infoName"></b> </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">                    
                            <table class="table table-bordered table-striped table-hover table-sm">
                                <thead>
                                    <th>Filename</th>
                                    <th>Tanggal Upload</th>
                                    <th>Upload By</th>
                                    <th>
        
                                    </th>
                                </thead>
                                <tbody id="tbl-attachment-body">
        
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <form id="form-upload-additional-doc" action="" enctype="multipart/form-data">
                            <div class="col-lg-12">
                                <label for="information">UPLOAD FILE</label>
                                <input type="file" name="efile[]" class="form-control fileInput" multiple>
                                <small class="form-text text-muted">
                                    Accepted file format is JPG, PNG, DOCX, PDF, XLSX | Max Size 2 MB
                                </small>
                                <br>
                                <input type="hidden" name="mpsactid" id="mpsactid">
                                <input type="hidden" name="mpsproject" id="mpsproject">
                                <input type="hidden" name="mpsactivity" id="mpsactivity">

                                <button type="submit" class="btn btn-primary">Upload Document</button>
                            </div>  
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div> 
    </section>
    
    <script src="<?= BASEURL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
<script>
    $(function(){
        $('.fileInput').change(function() {
            var val = $(this).val().toLowerCase(),
                regex = new RegExp("(.*?)\.(jpg|png|pdf|doc|docx|xlsx)$");

            if (!(regex.test(val))) {
                $(this).val('');
                showErrorMessage('Please select correct file format');
            }else{
                var MAX_FILE_SIZE = 2 * 1024 * 1024; // 1 MB
                fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    this.setCustomValidity("File must not exceed 2 MB!");
                    this.reportValidity();
                } else {
                    this.setCustomValidity("");
                }
            }
        });

        $('.btn-view-files').on('click', function(){
            var _data = $(this).data()
            console.log(_data);
            // home/infoattachments/{id}

            $('#tbl-attachment-body').html('');
            $('#mpsactid').val(_data.activityid)
            $('#mpsproject').val(_data.mpsproject)
            $('#mpsactivity').val(_data.mpsactivity)
            $.ajax({
                url: base_url+'/mps/attachments/'+_data.activityid+'/'+_data.mpsproject,
                // data: oinfo,
                type: 'GET',
                dataType: 'json',
                cache:false,
                success: function(result){
                    console.log(result)
                },
                error: function(err){
                    console.log(err)
                }
            }).done(function(data){
                console.log(data)
                
                var attachments = data;
                for(var i = 0; i < attachments.length; i++){
                    $('#tbl-attachment-body').append(`
                    <tr>
                        <td>`+ attachments[i].efilename +`</td>
                        <td>`+ attachments[i].createdon +`</td>
                        <td>`+ attachments[i].createdby +`</td>
                        <td style='text-align:center;'>
                            <a href="<?= BASEURL; ?>/images/mps/`+attachments[i].efilename+`" target="_blank" class="btn bg-blue btn-view form-control" 
                                style="width:120px;margin-top:5px;" data-infoid="1" data-status="3">
                                    <i class="material-icons">pageview</i> <span>VIEW FILE</span>
                            </a>
                        </td>
                    </tr>
                    `);
                }

                $('#infoAttachmentModal').modal('show');
                // showSuccessMessage('Informasi Berhasil di update');
            }); 
        });

        $('#form-upload-additional-doc').on('submit', function(event){
            event.preventDefault();
                
            var formData = new FormData(this);
            $.ajax({
                url:base_url+'/mps/saveattachments',
                method:'post',
                data:formData,
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    showBasicMessage();
                },
                success:function(data)
                {
                    console.log(data);
                },
                error:function(err){
                    alert(JSON.stringify(err))
                }
            }).done(function(data){
                showSuccessMessage('Document Berhasil diupload');
            });
        });

        function showBasicMessage() {
            swal({title:"Loading...", text:"Mohon Menunggu", showConfirmButton: false});
        }

        function showSuccessMessage(message) {
            swal({title: "Success!", text: message, type: "success"},
                function(){ 
                    // window.location.href = base_url;
                    window.location.reload();
                }
            );
        }
        
        function showErrorMessage(message) {
            swal({title: "", text: message, type: "warning"});
        }
    });
</script>