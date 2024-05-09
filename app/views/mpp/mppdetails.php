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
							    <a href="<?= BASEURL; ?>/mpp/request" class="btn btn-danger waves-effect pull-right">Cancel</a>
							</ul>
                        </div>
                        <div class="body">
                            <form action="<?= BASEURL; ?>/mpp/save" method="POST">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table">
                                            <!-- <tr>
                                                <td>Assy NO</td>
                                                <td>:</td>
                                                <td><?= $data['mppheader']['assyno']; ?></td>
                                            </tr> -->
                                            <tr>
                                                <td>Part Number</td>
                                                <td>:</td>
                                                <td><?= $data['mppheader']['partnumber']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Periode</td>
                                                <td>:</td>
                                                <td><?= Helpers::getMonthName($data['mppheader']['periode']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Customer</td>
                                                <td>:</td>
                                                <td><?= $data['mppheader']['customer']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total Quantity</td>
                                                <td>:</td>
                                                <td><?= $data['mppheader']['totalqty']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Date</th>
                                                        <th>Quantity</th>
                                                        <th>WP</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl-mpp-body">
                                                    <?php $wp = 0; $i = 0; 
                                                    foreach($data['mppitems'] as $row): ?>
                                                        <?php  
                                                            $i = $i + 1; 

                                                            if($row['quantity'] > 0){
                                                                $wp = $wp + 1;
                                                            }
                                                        ?>

                                                        <tr>
                                                            <td style="text-align:right;"><?= $i; ?></td>
                                                            <td><?= $row['tanggal']; ?></td>
                                                            <td style="text-align:right;"><?= $row['quantity']; ?></td>
                                                            <td>
                                                                <?php 
                                                                if($row['quantity'] > 0){
                                                                    echo "WP" . $wp;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td style="text-align:center; width:100px;">
                                                                <?php if($row['rsnum'] == null || $row['rsnum'] == '') : ?>
                                                                    <?php if($row['quantity'] > 0) : ?>
                                                                    <button type="button" class="btn btn-primary btn-sm btnReqeustpart" data-bomid="<?= $data['mppheader']['bomid']; ?>" data-quantity="<?= $row['quantity']; ?>" data-tanggal="<?= $row['tanggal']; ?>" data-periode="<?= $row['periode']; ?>">
                                                                        REQUEST PART
                                                                    </button>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    PART REQUESTED
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="partModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <form id="form-post-data" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="partModalTitle">Request Material</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix">
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="note">Note</label>
                                            <input type="text" name="note" id="note" class="form-control" placeholder="Note">
                                            <input type="hidden" name="bomid" id="_bomid">
                                            <input type="hidden" name="periode" id="_periode">
                                            <input type="hidden" name="tanggal" id="_tanggal">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="reference">Reference</label>
                                            <input type="text" name="reference" id="reference" class="form-control" placeholder="Reference" value="<?= $data['mppheader']['assyno']; ?>">
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="resdate">Reservation Date</label>
                                            <input type="date" name="resdate" id="resdate" class="datepicker form-control" value="<?= date('Y-m-d'); ?>">
                                        </div>
                                    </div>    
                                </div>
        
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="fromwhs">From Warehouse</label>
                                            <select class="form-control show-tick" name="fromwhs" id="fromwhs">
                                                <?php foreach($data['whs'] as $out) : ?>
                                                    <option value="<?= $out['gudang']; ?>"><?= $out['deskripsi']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>    
                                </div>
        
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="towhs">To Warehouse</label>
                                            <select class="form-control show-tick" name="towhs" id="towhs">
                                                <option value="">Select Warehose</option>
                                                <?php foreach($data['whs'] as $out) : ?>
                                                    <option value="<?= $out['gudang']; ?>"><?= $out['deskripsi']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>    
                                </div>
        
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="requestor">Requestor</label>
                                            <input type="text" class="form-control" name="requestor" id="requestor" value="<?= $_SESSION['usr_erp']['name']; ?>">
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Reservation Item
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kode Material</th>
                                                            <th>Material Description</th>
                                                            <th>Quantity</th>
                                                            <th>Unit</th>
                                                            <th>Remark</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbl-reservation-body" class="mainbodynpo">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-blue pull-right" id="btn-post" style="margin-left:5px;">
                                <i class="material-icons">save</i> <span>SAVE</span>
                            </button>
                            <button type="button" class="btn bg-red" data-dismiss="modal">
                            <i class="material-icons">close</i> <span>CLOSE</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="<?= BASEURL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            var SelectedBomid  = "<?= $data['bomid']; ?>";
            var SelectedPeriod = "<?= $data['period']; ?>";

            $('.btnReqeustpart').on('click', function(){
                var _data = $(this).data();
                console.log(_data);
                $('#_bomid').val(_data.bomid);
                $('#_periode').val(_data.periode);
                $('#_tanggal').val(_data.tanggal);

                $('#tbl-reservation-body').html('');
                $('#partModal').modal('show');
                $.ajax({
                    url: base_url+'/mpp/calculatePartReqeuest/'+_data.bomid+'/'+_data.quantity+'/'+_data.periode,
                    type: 'GET',
                    dataType: 'json',
                    cache:false,
                    success: function(result){
                        
                    },
                    error: function(err){
                        console.log(err)
                    }
                }).done(function(result){
                    console.log(result);
                    var count = 0;
                    var quantity = 0;
                    for(var i = 0; i < result.length; i++){

                        quantity = result[i].Total;
                        quantity = quantity.toString().replace('.00','');
                        count += 1;
                        $('#tbl-reservation-body').append(`
                            <tr counter="`+ count +`" id="tr`+ count +`">
                                <td class="nurut"> 
                                    `+ count +`
                                    <input type="hidden" name="itm_no[]" value="`+ count +`" />
                                </td>
                                <td> 
                                    <input type="text" name="itm_material[]" counter="`+count+`" id="material`+count+`" class="form-control materialCode" style="width:150px;" required="true" value="`+ result[i].component +`" readonly/>
                                </td>
                                <td> 
                                    <input type="text" name="itm_matdesc[]" counter="`+count+`" id="matdesc`+count+`" class="form-control" style="width:300px;" value="`+ result[i].matdesc +`" readonly/>
                                </td>
                                <td> 
                                    <input type="text" name="itm_qty[]" counter="`+count+`" id="poqty`+count+`"  class="form-control inputNumber" style="width:100px; text-align:right;" required="true" value="`+ quantity +`" readonly/>
                                </td>
                                <td> 
                                    <input type="text" name="itm_unit[]" counter="`+count+`" id="unit`+count+`" class="form-control" style="width:80px;" required="true" value="`+ result[i].unit +`" readonly/>
                                </td>
                                <td> 
                                    <input type="text" name="itm_remark[]" class="form-control" style="width:200px;" counter="`+count+`" id="poprice`+count+`"/>
                                </td>
                            </tr>
                        `);
                    }
                });
            });

            $('#form-post-data').on('submit', function(event){
                event.preventDefault();
                $("#btn-post").attr("disabled", true);
                var formData = new FormData(this);
                console.log($(this).serialize())
                    $.ajax({
                    url:base_url+'/mpp/createReservation',
                    method:'post',
                    data:formData,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function(){
                        // $('#btn-save').attr('disabled','disabled');
                    },
                    success:function(data)
                    {
                        console.log(data);
                    },
                    error:function(err){
                        showErrorMessage(JSON.stringify(err))
                    }
                }).done(function(data){
                        // showSuccessMessage('Reservation Created '+ data)
                    if(data.msg === "success"){
                        showSuccessMessage('Reservation Created '+ data.docnum['nextnumb'])
                    }else{
                        showErrorMessage(JSON.stringify(data.msg))                            
                    }
                })
            });

            function showBasicMessage() {
                swal({title:"Loading...", text:"Mohon Menunggu", showConfirmButton: false});
            }

            function showSuccessMessage(message) {
                // swal("Success", message, "success");
                swal({title: "Success!", text: message, type: "success"},
                    function(){ 
                        window.location.href = base_url+'/mpp/detail/'+SelectedBomid+'/'+SelectedPeriod;
                        // $('#tbl-reservation-body').html('');
                        // $('#partModal').modal('hide');
                    }
                );
            }

            function showErrorMessage(message){
                swal("Error", message, "error");
            }
        });
    </script>