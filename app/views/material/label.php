<section class="content">
        <div class="container-fluid">   
            <div id="msg-alert">
                <?php
                    Flasher::msgInfo();
                ?>
            </div>
            <!-- id="form-input-data" -->
            <!-- action="<?= BASEURL; ?>/wos/savewos" -->
            <form id="form-submit-data" method="POST">         
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <?= $data['menu']; ?>
                                </h2>

                                <ul class="header-dropdown m-r--5">          
                                    
                                </ul>
                            </div>
                            <div class="body">
                                <div class="row">                                
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                        <label for="material">MATERIAL</label>
                                        <input type="text" name="material" id="material" class="form-control" required autocomplete="off"/>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xm-12">
                                        <br>
                                        <button class="btn bg-blue form-control" type="button" id="btn-search-part">
                                            <i class="material-icons">format_list_bulleted</i> <span>PILIH MATERIAL</span>
                                        </button>
                                    </div>  
                                </div>

                                <div class="row">                                
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                        <label for="vendor">VENDOR</label>
                                        <input type="hidden" name="vendor" id="vendor"> 
                                        <input type="text" name="namavendor" id="namavendor" class="form-control" required autocomplete="off"/>
                                    </div>
                                    <!-- <div class="col-lg-3 col-md-6 col-sm-12 col-xm-12">
                                        <br>
                                        <button class="btn bg-blue form-control" type="button" id="btn-search-vendor">
                                            <i class="material-icons">format_list_bulleted</i> <span>PILIH VENDOR</span>
                                        </button>
                                    </div>   -->
                                </div>
                                
                                <div class="row">                                
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                        <label for="grdate">TANGGAL KEDATANGAN</label>
                                        <input type="date" name="grdate" id="grdate" class="form-control" required autocomplete="off"/>
                                        <input type="hidden" name="grnum" id="grnum">
                                        <input type="hidden" name="gritem" id="gritem">
                                        <input type="hidden" name="gryear" id="gryear">
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                        <label for="lotnumber">LOT NUMBER</label>
                                        <input type="text" name="lotnumber" id="lotnumber" class="form-control" required autocomplete="off"/>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                        <button type="button" class="btn btn-primary form-control" id="btn-scan-qr" style="margin-top:10px;">SCAN / INPUT QR</button>

                                        <input type="text" name="qrcode" id="qrcode" class="form-control" required style="margin-top:10px;" autocomplete="off"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                        <button type="submit" class="btn bg-red waves-effect pull-right" id="btn-cancel" style="margin-left:10px;">
                                            <i class="material-icons">cancel</i> <span>CANCEL</span>
                                        </button>
                                        <button type="submit" class="btn bg-green waves-effect pull-right" id="btn-save">
                                            <i class="material-icons">save</i> <span>SAVE</span>
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="modalScanQRCode" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div id="reader" width="600px" height="600px"></div>
            </div>
            </div>
        </div>

            

            <div class="modal fade" id="materialModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="ModalMaterial">Pilih Material</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                        <input type="date" id="strdate" class="form-control" value="<?= date('Y-m-d'); ?>">
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                        <input type="date" id="enddate" class="form-control" value="<?= date('Y-m-d'); ?>">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xm-12">
                                        <button type="button" class="btn btn-primary form-control" id="btn-display-material" style="margin-top:10px;">DISPLAY MATERIAL</button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="table-responsive">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xm-12">
                                        <table class="table table-responsive" id="list-wos" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Receipt Number</th>
                                                    <th>Material</th>
                                                    <th>Dekripsi</th>
                                                    <th>Vendor</th>
                                                    <th>Nama Vendor</th>
                                                    <th>Tanggal Kedatangan</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>        
    </section>

    <script src="<?= BASEURL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?= BASEURL; ?>/assets/js/html5-qrcode.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });

            document.getElementById("material").focus();

            $('#btn-scan-qr').on('click', function(){
                $('#modalScanQRCode').modal('show');
                initialCamera()
            });

            async function initialCamera() {
                var devices = await Html5Qrcode.getCameras();
                const html5QrCode = new Html5Qrcode("reader");
                const qrCodeSuccessCallback = message => {
                    $('#qrcode').val(message);
                    html5QrCode.stop().then(ignore => {
                        // document.getElementById("reffid").focus();
                        $('#modalScanQRCode').modal('hide');
                        html5QrCode.clear();
                    }).catch(err => {});
                    
                }
                const qrErrorCallback = error => {}
                const config = {
                    fps: 10,
                    qrbox: 250
                };

                html5QrCode.start({
                    deviceId: {
                        exact: (devices.length > 1) ? devices[devices.length - 1].id : devices[0].id
                    }
                }, config, qrCodeSuccessCallback, qrErrorCallback);
            }            

            function isExist(newEntry){
                return Array.from($('tr[id*=output_newrow]'))
                        .some(element => ($('td:nth(0) input[type="text"]',$(element)).html()===newEntry));
            }

            $('#btn-search-part').on('click', function(){
                $('#materialModal').modal('show');
            });

            $('#btn-display-material').on('click', function(){
                var strdate = $('#strdate').val();
                var enddate = $('#enddate').val();
                loadgrdata(strdate,enddate);
            })

            // loaddatapart();
            function loadgrdata(_strdate, _enddate){
                $('#list-wos').dataTable({
                    "ajax": base_url+'/movement/getGrdata/'+_strdate+'/'+_enddate,
                    "columns": [
                        { "data": "grnum" },
                        { "data": "material" },
                        { "data": "matdesc" },
                        { "data": "vendor" },
                        { "data": "namavendor" },
                        { "data": "movementdate" },
                        {"defaultContent": "<button class='btn btn-primary btn-sm btnAdd'>Pilih</button>"},
                        {"defaultContent": "<button class='btn btn-success btn-sm btnClose'>Close</button>"}
                    ],
                    "bDestroy": true,
                    "paging":   true,
                    "searching":   true
                });

                $('#list-wos tbody').on( 'click', '.btnAdd', function () {
                    var table = $('#list-wos').DataTable();
                    selected_data = [];
                    selected_data = table.row($(this).closest('tr')).data();
                    
                    $('#tbl-wos-data').html('');
                    console.log(selected_data);
                    $('#material').val(selected_data.material);
                    $('#vendor').val(selected_data.vendor);
                    $('#namavendor').val(selected_data.namavendor);
                    $('#grdate').val(selected_data.movementdate);
                    $('#grnum').val(selected_data.grnum);
                    $('#gritem').val(selected_data.gritem);
                    $('#gryear').val(selected_data.year);
                    $('#materialModal').modal('hide');
                } );

                $('#list-wos tbody').on( 'click', '.btnClose', function () {
                    var table = $('#list-wos').DataTable();
                    selected_data = [];
                    selected_data = table.row($(this).closest('tr')).data();
                    console.log(selected_data);

                    $.ajax({
                        url: base_url+'/material/closegr/'+selected_data.grnum+'/'+selected_data.year+'/'+selected_data.gritem,
                        type: 'GET',
                        dataType: 'json',
                        cache:false,
                        success: function(result){
                        }
                    }).done(function(result){
                        console.log(result)
                        if(result.msgtype === "1"){
                            showSuccessMessage(result.message);
                            $('#materialModal').modal('hide');
                        }else if(result.msgtype === "2"){
                            showErrorMessage(result.message)  
                        };
                    });
                } );
            }

            $('#form-submit-data').on('submit', function(event){
                event.preventDefault();
                
                var formData = new FormData(this);
                console.log($(this).serialize())
                    $.ajax({
                        url:base_url+'/material/savelabel',
                        method:'post',
                        data:formData,
                        dataType:'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend:function(){
                            $('#btn-save').attr('disabled','disabled');
                        },
                        success:function(data)
                        {
                        	console.log(data);
                        },
                        error:function(err){
                            showErrorMessage(JSON.stringify(err))
                        }
                    }).done(function(result){
                        if(result.msgtype === "1"){
                            showSuccessMessage(result.message);
                            $("#btn-save").attr("disabled", false);
                        }else if(result.msgtype === "2"){
                            showErrorMessage(result.message)            
                            $("#btn-save").attr("disabled", false);  
                            $('#qrcode').val('');
                        };

                        // $('#material').val('');
                        

                        setTimeout(function() { 
                            $('#material').focus();
                        }, 1000);
                    })
            })

            function showSuccessMessage(message) {
                swal({title: "Success!", text: message, type: "success"},
                    function(){ 
                        window.location.href = base_url+'/material/label';
                    }
                );
            }

            function showErrorMessage(message){
                swal("", message, "warning");
            }

            function showErrorMessage2(message, id){
                // swal("", message, "warning");
                swal({title: "", text: message, type: "warning"},
                    function(){ 
                        // alert($('#'+id).val())
                    }
                );
            }
        })
    </script>