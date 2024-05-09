    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" id="div-po-item">
                        <div class="header">
                            <h2>
                                <?= $data['menu']; ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">                                
							<a href="<?= BASEURL; ?>/reports/wostracking" type="button" class="btn btn-primary">Back</a>
							</ul>
                        </div>
                        <div class="body">                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>WOS ID</th>
                                                <th>Customer</th>
                                                <th>Part Number</th>
                                                <th>Quantity</th>
                                                <th>WP Number</th>
                                                <th>Circuit</th>
                                                <th>Lot Number</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0; ?>
                                            <?php foreach ($data['wosdata'] as $prdata) : ?>
                                                <?php $no++; ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $prdata['id']; ?></td>
                                                    <td><?= $prdata['customer']; ?></td>
                                                    <td><?= $prdata['partnumber']; ?></td>
                                                    <td style="text-align:right;"><?= $prdata['quantity']; ?></td>
                                                    <td><?= $prdata['wpnumber']; ?></td>
                                                    <td><?= $prdata['circuitno']; ?></td>
                                                    <td><?= $prdata['lotng']; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btnViewTracking" data-wosid="<?= $prdata['id']; ?>" data-bomid="<?= $prdata['bomid']; ?>">View Tracking</button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="wosTrackingModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">WOS Process History</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table table-bordered table-striped" id="tbl-wos-process" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Process ID</th>
                                        <th>Part Number</th>
                                        <th>Area</th>
                                        <th>Process</th>
                                        <th>Operator</th>
                                        <th>Tanggal Process</th>
                                        <th>Customer</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-wos-tracking">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(function(){

            function format ( d, results ) {
                // console.log(results)
                var html = '';
                html = `<table class="table table table-bordered table-striped" style="padding-left:50px;width:100%;">
                       <thead>
                            <th>QR Label</th>
                            <th>Material</th>
                            <th>Vendor</th>
                            <th>Tgl Kedatangan</th>
                            <th>Lot Number</th>
                       </thead>
                       <tbody>`;
                for(var i = 0; i < results.length; i++){
                    
                    html +=`
                       <tr style="background-color:#2196f3;color:white;">
                            <td> `+ results[i].qrlabel +` </td>                            
                            <td> `+ results[i].material +` </td>
                            <td> `+ results[i].namavendor +` </td>
                            <td> `+ results[i].grdate +` </td>
                            <td> `+ results[i].lotnumber +` </td>
                       </tr>
                       `;
                }

                html +=`</tbody>
                        </table>`;
                return html;
            }  

            function displayProcess(wosid, bomid){
                $('#tbl-wos-process').DataTable().destroy();
                $('#tbl-wos-process').DataTable().clear();
                // $('#tbl-wos-process tbody').empty();

                $('#wosTrackingModal').modal('show');
                var table = $('#tbl-wos-process').DataTable( {
                    "ajax": base_url+'/reports/getwostrackingprocess/'+wosid+'/'+bomid,
                    "columns": [
                        {
                            "className":      'details-control',
                            "orderable":      false,
                            "data":           null,
                            "defaultContent": ''
                        },
                        { "data": "processid"},
                        { "data": "partnumber" },
                        { "data": "nmmeja" },
                        { "data": "process" },
                        { "data": "operator"},
                        { "data": "createdon"},
                        { "data": "customer"}
                    ],
                    "order": [[1, 'asc']],
                    "bDestroy": true,
                    "searching": true,
                } );

                $('#tbl-wos-process tbody').off('click');

                $('#tbl-wos-process tbody').on('click', 'td.details-control', function () {
                    
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);

                    // selected_data = [];
                    // selected_data = table.row($(this).closest('tr')).data();
                    // console.log(selected_data)
                    console.log(row.data());
                    
                    var d = row.data();
                    $.ajax({
                        url: base_url+'/reports/trackingmaterialbyprocess/'+d.transid,
                        type: 'GET',
                        dataType: 'json',
                        cache:false,
                        success: function(result){
                        }
                    }).done(function(data){
                        console.log(data)
                        if(data){
                            if ( row.child.isShown() ) {
                                row.child.hide();
                                tr.removeClass('shown');
                            }
                            else {
                                row.child( format(row.data(), data) ).show();
                                tr.addClass('shown');
                            }
                        }
                    });
                } );
            }

            $('.btnViewTracking').on('click', function(){
                var data = $(this).data();
                console.log(data)

                if ($.fn.DataTable.isDataTable('#tbl-wos-process')) {
                    $('#tbl-wos-process').DataTable().destroy();
                }
                $('#tbl-wos-process tbody').empty();
                displayProcess(data.wosid,data.bomid);
                // $('#tbl-wos-tracking').html('');

                // $.ajax({
                //     url: base_url+'/reports/getwostracking/'+data.wosid+'/'+data.bomid,
                //     type: 'GET',
                //     dataType: 'json',
                //     cache:false,
                //     success: function(result){
                        
                //     }
                // }).done(function(result){
                //     console.log(result)
                //     $('#wosTrackingModal').modal('show');
                //     var icount = 0;
                //     for(var i = 0; i < result.length; i++){
                //         icount = icount + 1;
                //         $('#tbl-wos-tracking').append(`
                //             <tr>
                //                 <td style="text-align:right;">`+result[i].processid+`</td>
                //                 <td>`+result[i].partnumber+`</td>
                //                 <td>`+result[i].nmmeja+`</td>
                //                 <td>`+result[i].process+`</td>
                //                 <td>`+result[i].operator+`</td>
                //                 <td>`+result[i].createdon+`</td>
                //                 <td>`+result[i].customer+`</td>
                //             </tr>
                //         `);
                //     }
                // });
            });
        })
    </script>