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
                                        <label for="wosid">WOS ID</label>
                                        <input type="text" name="wosid" id="wosid" class="form-control" required autocomplete="off"/>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-sm-12 col-xm-12">
                                        <br>
                                        <button class="btn bg-blue form-control" type="button" id="btn-search-part">
                                            <i class="material-icons">format_list_bulleted</i> <span>PILIH WOS</span>
                                        </button>
                                    </div>                                  

                                </div>
                                <div class="row hideComponent">
                                    <div class="col-lg-12 col-md-6 col-sm-12 col-xm-12">
                                        <table class="table table-stripped" style="margin-bottom:0px;">
                                            <thead>
                                                <th>PART NUMBER</th>
                                                <th>CUSTOMER</th>
                                                <th>WP NUMBER</th>
                                                <th>LOT NUMBER</th>
                                                <th>QUANTITY</th>
                                                <th>START DATE</th>
                                                <th>END DATE</th>
                                            </thead>
                                            <tbody id="tbl-wos-data">                                        
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                        <button type="button" class="btn btn-primary form-control" id="btn-scan-wos" style="margin-top:10px;">SCAN WOS</button>

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

        <div class="modal fade" id="modalScanWOS" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div id="wosinput" width="600px" height="600px"></div>
            </div>
            </div>
        </div>

            <div class="modal fade" id="wosModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-xs" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="vendorModalLabel">Pilih WOS ID</h4>
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
                                        <button type="button" class="btn btn-primary form-control" id="btn-display-wos" style="margin-top:10px;">DISPLAY WOS</button>
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
                                                    <th>WOS ID</th>
                                                    <th>Part Number</th>
                                                    <th>Customer</th>
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

            $('.wosItem, .hideComponent').hide();

            document.getElementById("wosid").focus();

            $('#btn-scan-wos').on('click', function(){
                $('#modalScanWOS').modal('show');
                scanWOSQR()
            });

            $('#btn-scan-qr').on('click', function(){
                $('#modalScanQRCode').modal('show');
                initialCamera()
            });

            $('#wosid').keydown(function(e){
                var reffid = '';
                reffid = this.value;
                if(e.keyCode == 13) {
                    readWOSData(reffid);
                }
            });

            function readWOSData(reffid){
                $('#tbl-wos-data').html('');
                    $.ajax({
                        url: base_url+'/wos/getwosdata/'+reffid,
                        type: 'GET',
                        dataType: 'json',
                        cache:false,
                        success: function(result){

                        }
                    }).done(function(result){
                        console.log(result)
                        if (result) {
                            $('.hideComponent').show();
                            $('#tbl-wos-data').append(`
                                        <tr>
                                            <td>` + result.partnumber + `</td>
                                            <td>` + result.customer + `</td>
                                            <td>` + result.wpnumber + `</td>
                                            <td>` + result.lotng + `</td>
                                            <td style="text-align:center;">` + result.quantity + `</td>
                                            <td>` + result.stardate + `</td>
                                            <td>` + result.enddate + `</td>
                                        </tr>
                                    `);
                        } else {
                            showErrorMessage('Data not found')
                        }
                        $('#wosid').val('')
                        $('#wosid').val(result.id)
                    })
            }

            async function scanWOSQR() {
                var devices = await Html5Qrcode.getCameras();
                const html5QrCode = new Html5Qrcode("wosinput");
                const qrCodeSuccessCallback = message => {
                    // $('#qrcode').val(message);
                    readWOSData(message);
                    html5QrCode.stop().then(ignore => {
                        // document.getElementById("reffid").focus();
                        $('#modalScanWOS').modal('hide');
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
                $('#wosModal').modal('show');
            });

            $('#btn-display-wos').on('click', function(){
                var strdate = $('#strdate').val();
                var enddate = $('#enddate').val();
                loadwosdata(strdate,enddate);
            })

            // loaddatapart();
            function loadwosdata(_strdate, _enddate){
                $('#list-wos').dataTable({
                    "ajax": base_url+'/wos/getwosdatabydate/'+_strdate+'/'+_enddate,
                    "columns": [
                        { "data": "id" },
                        { "data": "partnumber" },
                        { "data": "customer" },
                        {"defaultContent": "<button class='btn btn-primary btn-xs'>Pilih</button>"}
                    ],
                    "bDestroy": true,
                    "paging":   true,
                    "searching":   true
                });

                $('#list-wos tbody').on( 'click', 'button', function () {
                    var table = $('#list-wos').DataTable();
                    selected_data = [];
                    selected_data = table.row($(this).closest('tr')).data();
                    
                    $('#tbl-wos-data').html('');
                    console.log(selected_data);
                    $('#wosid').val(selected_data.id);
                    // $('#partnumber').val(selected_data.partnumber);
                    $('#wosModal').modal('hide');

                    $('.hideComponent').show();
                    $('#tbl-wos-data').append(`
                        <tr>
                            <td>` + selected_data.partnumber + `</td>
                            <td>` + selected_data.customer + `</td>
                            <td>` + selected_data.wpnumber + `</td>
                            <td>` + selected_data.lotng + `</td>
                            <td style="text-align:center;">` + selected_data.quantity + `</td>
                            <td>` + selected_data.stardate + `</td>
                            <td>` + selected_data.enddate + `</td>
                        </tr>
                    `);
                } );
            }

            $('#form-submit-data').on('submit', function(event){
                event.preventDefault();
                
                var formData = new FormData(this);
                console.log($(this).serialize())
                    $.ajax({
                        url:base_url+'/wos/savelabel',
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
                        };

                        $('#wosid').val('');
                        $('#qrcode').val('');

                        setTimeout(function() { 
                            $('#wosid').focus();
                        }, 1000);
                    })
            })

            function showSuccessMessage(message) {
                swal({title: "Success!", text: message, type: "success"},
                    function(){ 
                        // window.location.href = base_url+'/wos';
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