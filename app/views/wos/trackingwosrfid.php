<section class="content">
        <div class="container-fluid">   
            <div id="msg-alert">
                <?php
                    Flasher::msgInfo();
                ?>
            </div>

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
                                    <div class="col-lg-8 col-md-12 col-sm-12 col-xm-12">
                                        <label for="qrcode">SCAN / INPUT RFID NUMBER</label>
                                        <input type="text" name="qrcode" id="qrcode" class="form-control" required autocomplete="off"/>

                                    </div>

                                    <div class="col-lg-4 col-md-12 col-sm-12 col-xm-12">
                                        <button type="button" class="btn btn-primary form-control" id="btn-scan-qr" style="margin-top:25px;">SCAN QR</button>
                                    </div>
                                </div>
                                <div class="row hideComponent">
                                    <div class="col-lg-12 col-md-6 col-sm-12 col-xm-12">
                                        <div class="table-responsive">
                                            <table class="table table-stripped" style="margin-bottom:0px;">
                                                <thead>
                                                    <th>WOS ID</th>
                                                    <th>PART NUMBER</th>
                                                    <th>CUSTOMER</th>
                                                    <th>WP NUMBER</th>
                                                    <th>LOT NUMBER</th>
                                                    <th>QUANTITY</th>
                                                    <th>CREATED DATE</th>
                                                </thead>
                                                <tbody id="tbl-wos-data">                                        
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row hideComponent">
                                    <div class="col-lg-12 col-md-6 col-sm-12 col-xm-12">
                                        <label for="">Process History</label>
                                        <table class="table table table-bordered table-striped" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Process ID</th>
                                                    <th>Area</th>
                                                    <th>Process</th>
                                                    <th>Operator</th>
                                                    <th>Tanggal Process</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl-wos-tracking">
                                            </tbody>
                                        </table>
                                        
                                        <button type="button" class="btn btn-primary form-control" id="btn-print-tracking">PRINT</button>
                                    </div>
                                </div>
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
            
            var woslabel = '';

            $('.wosItem, .hideComponent').hide();

            document.getElementById("qrcode").focus();

            $('#btn-scan-qr').on('click', function(){
                $('#modalScanQRCode').modal('show');
                initialCamera()
            });
            
            $('#btn-print-tracking').on('click', function(){
                if(woslabel !== ''){
                    window.open(base_url+"/wos/printwostracking/"+woslabel, '_blank');
                }
            });

            $('#qrcode').keydown(function(e){
                var _qrcode = '';
                _qrcode = this.value;
                if(e.keyCode == 13) {
                    woslabel = _qrcode;
                    readQrCodeData(_qrcode);
                }
            });

            function readQrCodeData(_qrcode){
                $('#tbl-wos-tracking').html('');
                $('#tbl-wos-data').html('');
                    $.ajax({
                        url: base_url+'/wos/getwosdatabyrfid/'+_qrcode,
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
                                    <td>` + result.id + `</td>
                                    <td>` + result.partnumber + `</td>
                                    <td>` + result.customer + `</td>
                                    <td>` + result.wpnumber + `</td>
                                    <td>` + result.lotng + `</td>
                                    <td style="text-align:center;">` + result.quantity + `</td>
                                    <td>` + result.createdon + `</td>
                                </tr>
                            `);

                            readWosHistory(result.id,result.bomid);
                        } else {
                            showErrorMessage('Data not found');
                            $('#qrcode').val('');
                            $('#hideComponent').hide();
                            setTimeout(function() { 
                                $('#qrcode').focus();
                            }, 1000);
                        }
                        $('#qrcode').val('');
                    })
            }

            function readWosHistory(_wosid,_bomid){
                $.ajax({
                    url: base_url+'/reports/getwostracking/'+_wosid+'/'+_bomid,
                    type: 'GET',
                    dataType: 'json',
                    cache:false,
                    success: function(result){
                        
                    }
                }).done(function(result){
                    console.log(result)
                    $('#wosTrackingModal').modal('show');
                    var icount = 0;
                    // for(var i = 0; i < result.length; i++){
                    //     icount = icount + 1;
                    //     $('#tbl-wos-tracking').append(`
                    //         <tr>
                    //             <td style="text-align:right;">`+result[i].processid+`</td>
                    //             <td>`+result[i].partnumber+`</td>
                    //             <td>`+result[i].nmmeja+`</td>
                    //             <td>`+result[i].process+`</td>
                    //             <td>`+result[i].operator+`</td>
                    //             <td>`+result[i].createdon+`</td>
                    //             <td>`+result[i].customer+`</td>
                    //         </tr>
                    //     `);
                    // }
                    for(var i = 0; i < result.length; i++){
                        icount = icount + 1;
                        $('#tbl-wos-tracking').append(`
                            <tr>
                                <td style="text-align:right;">`+result[i].processid+`</td>
                                <td>`+result[i].nmmeja+`</td>
                                <td>`+result[i].process+`</td>
                                <td>`+result[i].operator+`</td>
                                <td>`+result[i].createdon+`</td>
                            </tr>
                        `);
                    }
                });
            }

            async function initialCamera() {
                var devices = await Html5Qrcode.getCameras();
                const html5QrCode = new Html5Qrcode("reader");
                const qrCodeSuccessCallback = message => {
                    readQrCodeData(message);
                    html5QrCode.stop().then(ignore => {
                        $('#modalScanQRCode').modal('hide');
                        setTimeout(function() { 
                                $('#qrcode').focus();
                            }, 1000);
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

            function showSuccessMessage(message) {
                swal({title: "Success!", text: message, type: "success"},
                    function(){ 
                        // window.location.href = base_url+'/wos';
                    }
                );
            }

            function showErrorMessage(message){
                swal({title: "", text: message, type: "warning"},
                    function(){ 
                        setTimeout(function() { 
                            $('#qrcode').focus();
                        }, 1000);
                    }
                );
            }

            function showErrorMessage2(message, id){
                // swal("", message, "warning");
                swal({title: "", text: message, type: "warning"},
                    function(){ 
                        setTimeout(function() { 
                            $('#qrcode').focus();
                        }, 1000);
                    }
                );
            }
        })
    </script>