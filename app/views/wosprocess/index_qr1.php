    <div class="content" style="margin-top:60px;">
        <div class="container-fluid">
            <div id="msg-alert">
                <?php
                Flasher::msgInfo();
                ?>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <!--<label for="reffid">SCAN / INPUT WOS REFF ID</label>-->
                                    <!--<input type="text" name="reffid" id="reffid" class="form-control" autocomplete="off" required/>-->
                                    <div class="col-lg-12">
                                        <label for="reffid">SCAN / INPUT WOS REFF ID</label>
                                        <input type="text" name="reffid" id="reffid" class="form-control" autocomplete="off" required />
                                    </div>
                                    <div class="col-lg-12 hideComponent" id="idprocess">
                                    </div>
                                    <hr>
                                    <!--<div class="col-lg-12 hideComponent">-->
                                    <button type="button" class="btn btn-primary hideComponent" id="btn-process-wos">PROCESS WOS</button>
                                    <button type="button" class="btn btn-primary" id="btn-scan-mesin">SCANN REFFID MESIN</button>
                                    <!--</div> -->
                                </div>
                                <div class="col-lg-3">
                                    <div id="inside" width="600px" height="600px"></div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="col-lg-12 text-center mb-0" style="margin-bottom:0px;">
                                        <h4 style="margin-bottom:0px;" id="areaName"></h4>
                                        <hr style="margin-bottom:0px;">
                                    </div>
                                    <div class="col-lg-12 mb-0" style="margin-bottom:0px;">
                                        <table class="table table-stripped hideComponent" style="margin-bottom:0px;">
                                            <thead>
                                                <th>PART NUMBER</th>
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
                            </div>
                            <div class="row hideComponent">
                                <div class="col-lg-12">
                                    <img alt="WOS-IMAGE" class="img-fluid wos-image" width="100%;">
                                    <img alt="PART-IMAGE" class="img-fluid part-image" width="100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalScanReffidMesin" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">SCAN REFFID MESIN / MEJA</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <input type="text" name="reffidmesin" id="reffidmesin" class="form-control">
                    </div>
                    <br>
                    <div id="reader" width="600px" height="600px"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= BASEURL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?= BASEURL; ?>/assets/js/html5-qrcode.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
        //     initialCamera("reader")
        // });
        
        initialCamera("reader")

        function initialCamera(idElement) {
            let html5QrcodeScanner = new Html5QrcodeScanner(
                idElement, {
                    fps: 10,
                    qrbox: 250
                });

            function onScanSuccess(qrCodeMessage) {
                html5QrcodeScanner.clear();
                if (idElement == "reader") {
                    refidOnClicked(qrCodeMessage);
                } else if (idElement == "inside") {
                    insideOnClicked(qrCodeMessage)
                }
            }
            html5QrcodeScanner.render(onScanSuccess);
            // const html5QrCode = new Html5Qrcode(idElement);
            // html5QrCode.stop().then(ignore => {}).catch(err => {});
            // const qrCodeSuccessCallback = message => {
            //     if (idElement == "reader") {
            //         refidOnClicked(message);
            //     } else if (idElement == "inside") {
            //         insideOnClicked(message)
            //     }
            // }
            // const config = {
            //     fps: 10,
            //     qrbox: 250
            // };
            // html5QrCode.start({
            //     facingMode: "user"
            // }, config, qrCodeSuccessCallback);
        }

        function refidOnClicked(reffidmesin) {
            $('.hideComponent').hide();
            $.ajax({
                url: base_url + '/meja/getmejabyreffid/' + reffidmesin,
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function(result) {

                }
            }).done(function(data) {
                console.log(data)
                if (data) {
                    // $('.hideComponent').show();
                    localStorage.setItem("reffidmesin", JSON.stringify(data));
                    readProcessMesin(data.reffid);
                    $('#modalScanReffidMesin').modal('hide');
                    document.getElementById("reffid").focus();
                    $('#areaName').html(data.deskripsi);
                    $('#reffidmesin').val('');
                    initialCamera("inside");
                } else {
                    showErrorMessage2('REFF ID not found');
                    $('#reffidmesin').val('');
                    initialCamera("reader");
                }
            })
        }

        function insideOnClicked(reffid) {
            $('.hideComponent').hide();
            wosdata = [];
            $.ajax({
                url: base_url + '/wos/getwoslastposition/' + reffid,
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function(result) {}
            }).done(function(result) {
                if (result) {
                    if (result.namameja.includes('CHECKER') || result.namameja.includes('checker')) {
                        selectedReffidMesin = localStorage.getItem("reffidmesin");
                        var currentMesin = JSON.parse(selectedReffidMesin);
                        currentMesin.deskripsi.toUpperCase();
                        if (currentMesin.deskripsi.includes('PACKING')) {
                            readwosdata(reffid)
                        } else {
                            showErrorMessage('WOS already processed in Checker Area');
                            $('#reffid').val('');
                            document.getElementById("reffid").focus();
                        }
                    } else {
                        readwosdata(reffid)
                    }
                } else {
                    readwosdata(reffid)
                }
                initialCamera("inside")
            });
        }
        
        $(document).ready(function() {
            var selectedReffidMesin;

            selectedReffidMesin = localStorage.getItem("reffidmesin");
            var selectedWOS = '';

            var wosdata = [];
            console.log(selectedReffidMesin)
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            scannReffidMesin();

            $('#btn-scan-mesin').on('click', function() {
                scannReffidMesin();
                initialCamera("reader");
            });

            function scannReffidMesin() {
                $("#modalScanReffidMesin").modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
                setTimeout(function() {
                    $('#reffidmesin').focus();
                }, 1000);
                wosdata = [];
                $('.hideComponent').hide();
            };

            $('#reffidmesin').keydown(function(event) {
                if (event.keyCode == 13) {
                    $('.hideComponent').hide();
                    $.ajax({
                        url: base_url + '/meja/getmejabyreffid/' + this.value,
                        type: 'GET',
                        dataType: 'json',
                        cache: false,
                        success: function(result) {

                        }
                    }).done(function(data) {
                        console.log(data)
                        if (data) {
                            // $('.hideComponent').show();
                            localStorage.setItem("reffidmesin", JSON.stringify(data));
                            readProcessMesin(data.reffid);
                            $('#modalScanReffidMesin').modal('hide');
                            document.getElementById("reffid").focus();
                            $('#areaName').html(data.deskripsi);
                            $('#reffidmesin').val('');
                            initialCamera("inside");
                        } else {
                            showErrorMessage2('REFF ID not found');
                            $('#reffidmesin').val('');
                        }
                    })
                }
            });

            function readProcessMesin(_reffidmesin) {
                $('#idprocess').html('');
                $.ajax({
                    url: base_url + '/meja/listmejaprocesbyreffid/' + _reffidmesin,
                    type: 'GET',
                    dataType: 'json',
                    cache: false,
                    success: function(result) {

                    }
                }).done(function(result) {
                    console.log(result)
                    var listitem = '';
                    listitem += `<label for="process">Process</label>`;
                    listitem += `<select name="process" id="selectedprocess" class="form-control selProc" value="" required>`;
                    listitem += `<option class="form-control" value="0">---Pilih Proses---</option>`;
                    for (var i = 0; i < result.length; i++) {
                        listitem += `<option class="form-control" value="` + result[i].idproses + `">` + result[i].proses + `</option>`;
                    };
                    listitem += `</select>`;
                    $("#idprocess").append(listitem);
                });
            }


            $('.hideComponent, .sidebar').hide();
            document.getElementById("reffid").focus();

            $('#reffid').keydown(function(e) {
                if (e.keyCode == 13) {
                    $('.hideComponent').hide();
                    var reffid = this.value;
                    wosdata = [];
                    $.ajax({
                        url: base_url + '/wos/getwoslastposition/' + reffid,
                        type: 'GET',
                        dataType: 'json',
                        cache: false,
                        success: function(result) {}
                    }).done(function(result) {
                        console.log(result)
                        if (result) {
                            if (result.namameja.includes('CHECKER') || result.namameja.includes('checker')) {
                                selectedReffidMesin = localStorage.getItem("reffidmesin");
                                var currentMesin = JSON.parse(selectedReffidMesin);
                                currentMesin.deskripsi.toUpperCase();
                                if (currentMesin.deskripsi.includes('PACKING')) {
                                    readwosdata(reffid)
                                } else {
                                    showErrorMessage('WOS already processed in Checker Area');
                                    $('#reffid').val('');
                                    document.getElementById("reffid").focus();
                                }
                            } else {
                                readwosdata(reffid)
                            }
                        } else {
                            readwosdata(reffid)
                        }
                    });
                }
            });

            $('#btn-process-wos').on('click', function() {
                processWos();
            })
        });
        
        function readProcessMesin(_reffidmesin) {
            $('#idprocess').html('');
            $.ajax({
                url: base_url + '/meja/listmejaprocesbyreffid/' + _reffidmesin,
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function(result) {

                }
            }).done(function(result) {
                console.log(result)
                var listitem = '';
                listitem += `<label for="process">Process</label>`;
                listitem += `<select name="process" id="selectedprocess" class="form-control selProc" value="" required>`;
                listitem += `<option class="form-control" value="0">---Pilih Proses---</option>`;
                for (var i = 0; i < result.length; i++) {
                    listitem += `<option class="form-control" value="` + result[i].idproses + `">` + result[i].proses + `</option>`;
                };
                listitem += `</select>`;
                $("#idprocess").append(listitem);
            });
        }

        function readwosdata(reffid) {
            $('.hideComponent').hide();
            $('#tbl-wos-data').html('');

            selectedReffidMesin = localStorage.getItem("reffidmesin");
            wosdata = [];
            $.ajax({
                url: base_url + '/wos/getwosdata/' + reffid,
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function(result) {

                }
            }).done(function(result) {
                // console.log(result)
                if (result) {
                    $('.hideComponent').show();
                    $('#tbl-wos-data').append(`
                                <tr>
                                    <td>` + result.partnumber + `</td>
                                    <td>` + result.wpnumber + `</td>
                                    <td>` + result.lotng + `</td>
                                    <td><b>` + result.quantity + `</b></td>
                                    <td>` + result.stardate + `</td>
                                    <td>` + result.enddate + `</td>
                                </tr>
                            `);

                    $(".wos-image").attr("src", result.imagelink);
                    loadpartimage(result.partnumber);
                    selectedWOS = reffid;

                    selectedReffidMesin = localStorage.getItem("reffidmesin");
                    console.log(selectedReffidMesin)
                    var currentMesin = JSON.parse(selectedReffidMesin);

                    var wosinput = {};
                    wosinput.wosid = result.id;
                    wosinput.wosrfid = selectedWOS;
                    wosinput.reffidmesin = currentMesin.reffid;
                    wosinput.area = currentMesin.nomeja;
                    wosinput.areaname = currentMesin.deskripsi;
                    wosdata.push(wosinput);
                    // console.log(wosdata)
                } else {
                    showErrorMessage('WOS not found');
                }
                $('#reffid').val('');
                document.getElementById("reffid").focus();
            });
        }

        function loadpartimage(partnumber) {
            $.ajax({
                url: base_url + '/wosimage/partimage/data?partnumber=' + partnumber,
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function(result) {

                }
            }).done(function(res) {
                // console.log(res)
                $(".part-image").attr("src", res.imagelink);
            })
        }

        function processWos() {
            var wosinput = {};
            wosinput.process = $('#selectedprocess').val();
            wosdata.push(wosinput);
            console.log(wosinput);
            var postdata = {
                'items': wosdata
            }
            console.log(postdata);
            $.ajax({
                url: base_url + '/wosprocess/processwos',
                method: 'post',
                data: postdata,
                dataType: 'JSON',
                cache: false,
                beforeSend: function() {
                    $('#btn-save').attr('disabled', 'disabled');
                },
                success: function(data) {
                    console.log(data);
                },
                error: function(err) {
                    showErrorMessage(JSON.stringify(err))
                    console.log(err)
                }
            }).done(function(result) {
                if (result.msgtype === "1") {
                    showSuccessMessage(result.message);
                    $("#btn-save").attr("disabled", false);
                } else if (result.msgtype === "2") {
                    showErrorMessage(result.message)
                    $("#btn-save").attr("disabled", false);
                } else if (result.msgtype === "3") {
                    var t = document.getElementById("selectedprocess");
                    var selectedText = t.options[t.selectedIndex].text;
                    showErrorMessage(result.message + ' (' + selectedText + ')')
                    $("#btn-save").attr("disabled", false);
                }
            })
        }

        function showSuccessMessage(message) {
            swal({
                    title: "Success!",
                    text: message,
                    type: "success"
                },
                function() {
                    window.location.href = base_url + '/wosprocess';
                }
            );
        }
        // document.getElementById("reffid").focus();    
        function showErrorMessage(message) {
            // swal("", message, "warning");
            swal({
                    title: "",
                    text: message,
                    type: "warning"
                },
                function() {
                    setTimeout(function() {
                        $('#reffid').focus();
                    }, 1000);
                }
            );
        }

        function showErrorMessage2(message) {
            // swal("", message, "warning");
            swal({
                    title: "",
                    text: message,
                    type: "warning"
                },
                function() {
                    setTimeout(function() {
                        document.getElementById("reffidmesin").focus();
                    }, 1000);
                }
            );
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: 250
                });

            function onScanSuccess(qrCodeMessage) {
                html5QrcodeScanner.clear();
                $("#reffidmesin").val(qrCodeMessage);
                var reffidmesin = qrCodeMessage;
                $('.hideComponent').hide();
                $.ajax({
                    url: base_url + '/meja/getmejabyreffid/' + reffidmesin,
                    type: 'GET',
                    dataType: 'json',
                    cache: false,
                    success: function(result) {

                    }
                }).done(function(data) {
                    console.log(data)
                    if (data) {
                        // $('.hideComponent').show();
                        localStorage.setItem("reffidmesin", JSON.stringify(data));
                        readProcessMesin(data.reffid);
                        $('#modalScanReffidMesin').modal('hide');
                        document.getElementById("reffid").focus();
                        $('#areaName').html(data.deskripsi);
                        $('#reffidmesin').val('');
                    } else {
                        showErrorMessage2('REFF ID not found');
                        $('#reffidmesin').val('');
                    }
                })
            }
            html5QrcodeScanner.render(onScanSuccess);

        }
        });
    </script>