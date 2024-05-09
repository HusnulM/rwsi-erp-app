    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" id="div-po-item">
                        <!-- PO Item -->
                        <div class="header">
                            <h2>
                                Report Summary MPP Request
                            </h2>
                            <ul class="header-dropdown m-r--5">                                
                                <a href="<?= BASEURL; ?>/reports/stock" class="btn bg-blue">
                                   <i class="material-icons">backspace</i> BACK
                                </a>
                            </ul>
                        </div>
                        <div class="body">       
                            <div class="row">
                                <form id="form-filter">
                                    <div class="col-lg-3">
                                        <label for="bulan">Bulan</label>
                                        <select name="bulan" id="bulan" class="form-control" required>
                                            <option value="">--Pilih Bulan--</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="tahun">Tahun</label>
                                        <div class="form-line">
                                            <input type="text" name="tahun" id="tahun" class="form-control" value="<?= date('Y'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <br>
                                        <button type="submit" class="btn bg-blue">
                                            PREVIEW DATA
                                        </button>
                                        <!-- <button type="button" class="btn bg-blue">
                                            EXPORT to EXCEL
                                        </button> -->
                                    </div>
                                </form>
                            </div>                         
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-striped table-hover" style="width:100%;font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Part Number</th>
                                            <th>Customer</th>
                                            <th>Quantity</th>
                                            <th>Periode</th>
                                            <th></th>
                                        </tr>
                                    </thead>
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

            $('#form-filter').on('submit', function(event){
                event.preventDefault();
                var period = $('#bulan').val()+''+$('#tahun').val();
                loadData(period);
            });

            function format ( d, results ) {
                console.log(results)
                var html = '';
                html = `<table style="padding-left:50px;width:100%;">
                       <thead>
                            <th>Material</th>
                            <th>Description</th>
                            <th>Requirement Quantity</th>
                            <th>Reqeusted Quantity</th>
                            <th>Open Quantity</th>
                            <th>Unit</th>
                       </thead>
                       <tbody>`;
                for(var i = 0; i < results.length; i++){
                    var qty = '';
                    var qtyreq = '';
                    var openqty = 0;
                    qty = results[i].Total;
                    qty = qty.replaceAll('.00','');
                    qty = qty.replaceAll('.',',');

                    qtyreq = results[i].qtyreq;
                    qtyreq = qtyreq.replaceAll('.00','');
                    qtyreq = qtyreq.replaceAll('.',',');

                    openqty = results[i].Total - results[i].qtyreq;
                    html +=`
                       <tr style="background-color:green;color:white;">
                            <td> `+ results[i].component +` </td>
                            <td> `+ results[i].matdesc +` </td>
                            <td style="text-align:right;"> `+ formatRupiah(qty,'') +` </td>
                            <td style="text-align:right;"> `+ formatRupiah(qtyreq,'') +` </td>
                            <td style="text-align:right;background-color:yellow;color:black;"><h5> `+ formatRupiah(openqty,'') +`</h5> </td>
                            <td> `+ results[i].unit +` </td>
                       </tr>
                       `;
                }

                html +=`</tbody>
                        </table>`;
                return html;
            }   

            function formatRupiah(angka, prefix){
                var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
                split   		  = number_string.split(','),
                sisa     		  = split[0].length % 3,
                rupiah     		  = split[0].substr(0, sisa),
                ribuan     		  = split[0].substr(sisa).match(/\d{3}/gi);
            
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
            
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
            }

            var MyDate = new Date();
            var period = '';
            period = MyDate.getMonth()+1;
            period = period+''+MyDate.getFullYear();

            loadData(period);
            function loadData(period){
                var table = $('#example').DataTable( {
                    "ajax": base_url+"/mpp/summarydata/"+period,
                    "columns": [
                        {
                            "className":      'details-control',
                            "orderable":      false,
                            "data":           null,
                            "defaultContent": ''
                        },
                        { "data": "partnumber" },
                        { "data": "customer" },
                        { "data": "totalqty", "className" : "text-right",
                            render: function(data, type, row){
                                data = data.replaceAll('.00','');
                                data = data.replaceAll('.',',');
                                
                                return formatRupiah(data,'');
                            }
                        },
                        { "data": "periodname" },
                        { "data": "periodname" }
                    ],
                    columnDefs:[
                        {
                            render: function(data, type, row){

                                return '<a href="'+base_url+'/mpp/exportMpp/'+row.bomid+'/'+row.periode+'/'+row.totalqty+'" target="_blank" class="btn btn-sm btn-primary btn-block">Export Excel</a>';

                            },
                            targets: 5
                        }
                    ],
                    "order": [[1, 'asc']],
                    "pageLength": 50,
                    "lengthMenu": [50, 100, 200, 500],
                    "bDestroy": true,
                    "processing": true,
                    "serverSide": false,
                } );
                
            }
                $('#example tbody').on('click', 'td.details-control', function () {
                    var tabledata = $('#example').DataTable();
                    var tr = $(this).closest('tr');
                    var row = tabledata.row( tr );
                    var d = row.data();
                    $.ajax({
                        url: base_url+'/mpp/calculatePartReqeuest/'+d.bomid+'/'+d.totalqty+'/'+d.periode,
                        type: 'GET',
                        dataType: 'json',
                        cache:false,
                        success: function(result){
                        }
                    }).done(function(data){
                        if ( row.child.isShown() ) {
                            row.child.hide();
                            tr.removeClass('shown');
                        }
                        else {
                            row.child( format(row.data(), data) ).show();
                            tr.addClass('shown');
                        }
                    });
                } );
        })
    </script>