    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" id="div-po-item">
                        <!-- PO Item -->
                        <div class="header">
                            <h2>
                                <?= $data['menu']; ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">                                
                                <a href="<?= BASEURL; ?>/wip" class="btn bg-blue">
                                   <i class="material-icons">backspace</i> BACK
                                </a>
                            </ul>
                        </div>
                        <div class="body">               
                            <div class="row clearfix">
                                <div class="col-lg-3">
                                    <label for="fromdate">Tanggal</label>
                                    <input type="date" name="fromdate" id="fromdate" class="form-control"  required/>
                                </div>
                                <div class="col-lg-3">
                                    <label for="fromdate">-</label>
                                    <input type="date" name="todate" id="todate" class="form-control"  required/>
                                </div>
                                <div class="col-lg-2">
                                    <br>
                                    <button class="btn bg-green waves-effect" id="btn-display">
                                        <i class="material-icons">search</i> <span>Tampilkan Data</span>
                                    </button>
                                </div>
                            </div>                 
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="tbl-wip" style="width:101%; font-size: smaller;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Process</th>
                                            <th>Area-IN        </th>
                                            <th>Area-OUT       </th>
                                            <th>Process       </th>
                                            <th>Partnumber</th>
                                            <th>Customer</th>
                                            <th>WP No</th>
                                            <th>LOT No</th>
                                            <th style="width:100px;">Period</th>
                                            <th>Jam</th>
                                            <th style="text-align:right;">Quantity</th>
                                            <th>Operator</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-body">
                                            
                                    </tbody>
                                </table>
                            </div>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="<?= BASEURL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        $(function(){
            
            $('#btn-display').on('click', function(){
                let strdate = $('#fromdate').val();
                let enddate = $('#todate').val();   
                showdata(strdate, enddate);
            })
            
            function showdata(strdate, enddate){
                var t = $('#tbl-wip').DataTable({
                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    // scrollY:        "350px",
                    // scrollX:        true,
                    // scrollCollapse: true,
                    pageLength: 50,
                    lengthMenu: [50, 100, 200, 500],
                    // "paging": false,
                    "ajax": base_url+'/wip/getdetailwip/'+strdate+'/'+enddate,
                    "columns": [
                        { "data": null,"sortable": false, width: '30px',
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }  
                        },
                        { "data": "wiptype", "sortable": true, width: '20px' },
                        { "data": "area1", "sortable": true, width: '150px' },
                        { "data": "area2", "sortable": true, width: '150px' },
                        { "data": "proses", "sortable": true, width: '150px' },
                        { "data": "partnumber", "sortable": true, width: '50px' },
                        { "data": "customer", "sortable": true, width: '190px' },
                        { "data": "wpnumber", "sortable": true, width: '40px' },
                        { "data": "lotng", "sortable": true, width: '40px' },
                        { "data": "periode", "sortable": true, width: '60px' },
                        { "data": "jam", "sortable": true, width: '40px' },
                        { "data": "qty", className: "text-right", "sortable": true, width: '10px' },
                        { "data": "operator", "sortable": true, width: '80px' }
                    ],
                    // "columns": [
                    //     { "data": null,"sortable": false, 
                    //         render: function (data, type, row, meta) {
                    //             return meta.row + meta.settings._iDisplayStart + 1;
                    //         }  
                    //     },
                    //     { "data": "wiptype", "sortable": false },
                    //     { "data": "area1", "sortable": false  },
                    //     { "data": "area2", "sortable": false  },
                    //     { "data": "partnumber", "sortable": false },
                    //     { "data": "customer", "sortable": false },
                    //     { "data": "wpnumber", "sortable": false },
                    //     { "data": "periode", "sortable": false },
                    //     { "data": "jam", "sortable": false },
                    //     { "data": "qty", className: "text-right", "sortable": false },
                    //     { "data": "operator", "sortable": false }
                    // ],
                    "bDestroy": true,
                    "responsive": true,
                    "autoWidth": true
                });

                t.on( 'order.dt search.dt', function () {
                    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                            cell.innerHTML = i+1;
                    } );
                } ).draw();
            }
        })
    </script>