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
                                    <label for="reffid">SCAN / INPUT REFF ID</label>
                                    <input type="text" name="reffid" id="reffid" class="form-control" autocomplete="off" required />
                                </div>
                                <div class="col-md-3">
                                    <div id="reader" width="600px" height="600px"></div>
                                </div>
                                <div class="col-lg-9 hideComponent">
                                    <table class="table table-stripped">
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
                            <div class="row hideComponent">
                                <div class="col-lg-12">
                                    <img alt="WOS-IMAGE" class="img-fluid wos-image" width="100%;">
                                </div>
                                <div class="col-lg-12">
                                    <img alt="PART-IMAGE1" class="img-fluid part-image" width="100%;">
                                </div>
                                <div class="col-lg-12">
                                    <img alt="PART-IMAGE2" class="img-fluid part-image-product" width="100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= BASEURL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?= BASEURL; ?>/assets/js/html5-qrcode.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            initialCamera();
        });

        async function initialCamera() {
            // let html5QrcodeScanner = new Html5QrcodeScanner(
            //     "reader", {
            //         fps: 10,
            //         qrbox: 250
            //     });

            // function onScanSuccess(qrCodeMessage) {
            //     html5QrcodeScanner.clear();
            //     refidOnClicked(qrCodeMessage);
            // }

            // html5QrcodeScanner.render(onScanSuccess);

            // This method will trigger user permissions
            // var cameraId;
            // var thisDevices;
            var devices = await Html5Qrcode.getCameras();
            const html5QrCode = new Html5Qrcode("reader");
            const qrCodeSuccessCallback = message => {
                refidOnClicked(message);
                html5QrCode.stop().then(ignore => {}).catch(err => {});
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

        function refidOnClicked(reffid) {
            $('.hideComponent, .sidebar').hide();
            document.getElementById("reffid").focus();
            $('#tbl-wos-data').html('');

            $.ajax({
                url: base_url + '/wos/getwosdata/' + reffid,
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function(result) {}
            }).done(function(result) {
                console.log(result)
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
                    initialCamera();
                } else {
                    showErrorMessage('Data not found')
                    initialCamera();
                }
                $('#reffid').val('');
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            $('.hideComponent, .sidebar').hide();
            document.getElementById("reffid").focus();

            $('#reffid').keydown(function(e) {
                if (event.keyCode == 13) {
                    $('.hideComponent').hide();
                    $('#tbl-wos-data').html('');
                    var reffid = this.value;
                    $.ajax({
                        url: base_url + '/wos/getwosdata/' + reffid,
                        type: 'GET',
                        dataType: 'json',
                        cache: false,
                        success: function(result) {}
                    }).done(function(result) {
                        console.log(result)
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
                        } else {
                            showErrorMessage('Data not found')
                        }
                        $('#reffid').val('');
                    });
                }
            });

            defauldatetime();

            function defauldatetime() {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!
                var yyyy = today.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd
                }
                if (mm < 10) {
                    mm = '0' + mm
                }

                today = yyyy + '-' + mm + '-' + dd;
                $('#strdate,#enddate').attr("min", today);

            }

            $('#btn-search-part').on('click', function() {
                $('#partModal').modal('show');
            });

            loaddatapart();

            function loaddatapart() {
                $('#list-part').dataTable({
                    "ajax": base_url + '/quotation/partlist',
                    "columns": [{
                            "data": "partnumber"
                        },
                        {
                            "data": "partname"
                        },
                        {
                            "data": "customer"
                        },
                        {
                            "defaultContent": "<button class='btn btn-primary btn-xs'>Pilih</button>"
                        }
                    ],
                    "bDestroy": true,
                    "paging": true,
                    "searching": true
                });

                $('#list-part tbody').on('click', 'button', function() {
                    var table = $('#list-part').DataTable();
                    selected_data = [];
                    selected_data = table.row($(this).closest('tr')).data();

                    console.log(selected_data);
                    $('#bomid').val(selected_data.bomid);
                    $('#partnumber').val(selected_data.partnumber);
                    $('#partModal').modal('hide');
                });
            }

            $('#form-input-data').on('submit', function(event) {
                event.preventDefault();

                var formData = new FormData(this);
                console.log($(this).serialize())
                $.ajax({
                    url: base_url + '/wos/save',
                    method: 'post',
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btn-save').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(err) {
                        showErrorMessage(JSON.stringify(err))
                    }
                }).done(function(result) {
                    if (result.msgtype === "1") {
                        showSuccessMessage(result.message);
                        $("#btn-save").attr("disabled", false);
                    } else if (result.msgtype === "2") {
                        showErrorMessage(JSON.stringify(result))
                        $("#btn-save").attr("disabled", false);
                    }
                })
            })

            function showSuccessMessage(message) {
                swal({
                        title: "Success!",
                        text: message,
                        type: "success"
                    },
                    function() {
                        window.location.href = base_url + '/wos';
                    }
                );
            }

            function showErrorMessage(message) {
                swal("", message, "warning");
            }
        })
    </script>
    <script>
        function loadpartimage(partnumber) {
            $.ajax({
                url: base_url + '/wosimage/partimage/data?partnumber=' + partnumber,
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function(result) {}
            }).done(function(res) {
                console.log(res)
                $(".part-image").attr("src", res.imagelink);
                $(".part-image-product").attr("src", res.productimg);
            })
        }

        function showErrorMessage(message) {
            swal("", message, "warning");
        }
    </script>