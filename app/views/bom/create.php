<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
        <form id="form-pr-data" enctype="multipart/form-data">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?= $data['menu']; ?>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="partnumb">Part Number</label>
                                        <input type="text" name="partnumb" id="partnumb" class="form-control" placeholder="Part Number" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="partname">Part Name</label>
                                        <input type="text" name="partname" id="partname" class="form-control" placeholder="Part Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 divCustomer">
                                <div class="form-group">
                                    <label for="custid">Customer</label>
                                    <select name="custid" class="form-control" id="custid" required>
                                        <option value="0">Pilih Customer</option>
                                        <?php foreach($data['cust'] as $cust) : ?>
                                            <option value="<?= $cust['cust_id']; ?>"><?= $cust['cust_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="customer">Customer Name</label>
                                        <input type="text" name="customer" id="customer" class="form-control" placeholder="Customer" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="qtycct">Quantity CCT</label>
                                        <input type="number" name="qtycct" id="qtycct" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="reference">Reference</label>
                                        <input type="text" name="reference" id="reference" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="bom_version">BOM Version</label>
                                        <input type="number" name="bom_version" id="bom_version" class="form-control" value="1" required>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>
                            Components
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Component</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-pr-body" class="mainbodynpo">

                                    </tbody>
                                </table>
                                <ul class="pull-right">    
                                    <button type="button" id="btn-dlg-add-item" class="btn bg-blue">
                                        <i class="material-icons">playlist_add</i> <span>ADD COMPONENT</span>
                                    </button>
                                    <a href="<?= BASEURL; ?>/bom" class="btn bg-red">
                                        <i class="material-icons">highlight_off</i> <span>CANCEL</span>
                                    </a>
                                    <button type="submit" class="btn bg-blue" id="btn-post">
                                        <i class="material-icons">save</i> <span>SAVE</span>
                                    </button>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>

        <div class="modal fade" id="barangModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="barangModal">Pilih Material</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-responsive" id="list-barang" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Material</th>
                                        <th>Description</th>
                                        <th>Part Name</th>
                                        <th>Part Number</th>
                                        <th>Unit</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
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
    

    <script src="<?= BASEURL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });
        });
        
        $(function(){
            let detail_order_beli = [];
            var kodebrg           = '';
            var namabrg           = '';
            var action            = '';
            var imgupload         = [];
            var count = 0;

            $('#custid').on('change', function(){
                var custid = $('#custid option:selected').text();
                $('#customer').val(custid);
            });

            loaddatabarang();
            function loaddatabarang(){
                // $('#list-barang').dataTable({
                //     "ajax": base_url+'/barang/listbarang',
                //     "columns": [
                //         { "data": "material" },
                //         { "data": "matdesc" },
                //         { "data": "partname" },
                //         { "data": "partnumber" },
                //         { "data": "matunit" },
                //         {"defaultContent": "<button class='btn btn-primary btn-xs'>Pilih</button>"}
                //     ],
                //     "bDestroy": true,
                //     "paging":   true,
                //     "searching":   true
                // });
                
                $('#list-barang').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': base_url+'/bom/listmaterial'
                    },
                    'columns': [
                        { data: 'material' },
                        { data: 'matdesc' },
                        { data: 'partname' },
                        { data: 'partnumber' },
                        { data: 'matunit' },
                        {"defaultContent": "<button class='btn btn-primary btn-xs'>Pilih</button>"}
                    ],
                    'bDestroy': true
                });

                $('#list-barang tbody').on( 'click', 'button', function () {
                    var table = $('#list-barang').DataTable();
                    selected_data = [];
                    selected_data = table.row($(this).closest('tr')).data();
                    count = count+1;
                    html = '';
                    html = `
                        <tr counter="`+ count +`" id="tr`+ count +`">
                            <td class="nurut"> 
                                `+ count +`
                                <input type="hidden" name="itm_no[]" value="`+ count +`" />
                            </td>
                            <td> 
                                <input type="text" name="itm_material[]" counter="`+count+`" id="material`+count+`" class="form-control materialCode" style="width:150px;" required="true" value="`+ selected_data.material +`" readonly/>
                            </td>
                            <td> 
                                <input type="text" name="itm_matdesc[]" counter="`+count+`" id="matdesc`+count+`" class="form-control" style="width:300px;" value="`+ selected_data.matdesc +`" readonly/>
                            </td>
                            <td> 
                                <input type="text" name="itm_qty[]" counter="`+count+`" id="compqty`+count+`"  class="form-control inputNumber" style="width:100px; text-align:right;" required="true" autocomplete="off"/>
                            </td>
                            <td> 
                                <input type="text" name="itm_unit[]" counter="`+count+`" id="unit`+count+`" class="form-control" style="width:80px;" required="true" value="`+ selected_data.matunit +`" readonly/>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm removePO hideComponent" counter="`+count+`">Remove</button>
                            </td>
                        </tr>
                    `;
                    $('#tbl-pr-body').append(html);
                    renumberRows();

                    $("#compqty"+count).keydown(function(event){
                        if(event.keyCode == 190) {
                            event.preventDefault();
                            showErrorMessage("Untuk decimal separator gunakan ( , )")
                            return false;
                        }
                    });

                    $('.removePO').on('click', function(e){
                        e.preventDefault();
                        $(this).closest("tr").remove();
                        renumberRows();
                    })

                    $('.materialCode').on('change', function(){
                        var xcounter = $(this).attr('counter');
                        var kodebrg  = $('#material'+xcounter).val();

                        getMaterialbyKode(kodebrg, function(d){
                            console.log(d)
                            $('#matdesc'+xcounter).val(d.matdesc);
                            $('#unit'+xcounter).val(d.matunit);
                        });
                    })

                    $('.inputNumber').on('change', function(){
                        this.value = formatRupiah(this.value, '');
                    })
                } );
            }

            function renumberRows() {
                $(".mainbodynpo > tr").each(function(i, v) {
                    $(this).find(".nurut").text(i + 1);
                });
            }

            $('#btn-dlg-add-item').on('click', function(){
                $('#barangModal').modal('show')
            })

            $('#btn-pilih-barang').on('click', function(){
                $('#barangModal').modal('show')
            });

            $('#add-new-item').on('click', function(){
                $('#largeModalLabel').html('Add New Item')
                $('#largeModal').modal('show');
                $('#btn-add-item').html('Add Item');
                action = 'add';
            })

            $('#form-pr-data').on('submit', function(event){
                event.preventDefault();
                
                var formData = new FormData(this);
                console.log($(this).serialize())
                    $.ajax({
                        url:base_url+'/bom/save',
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
                    }).done(function(result){
                        if(result.msgtype === "1"){
                            showSuccessMessage(result.message);
                            $("#btn-post").attr("disabled", false);
                        }else if(result.msgtype === "2"){
                            showErrorMessage(JSON.stringify(result))            
                            $("#btn-post").attr("disabled", false);  
                        }
                    })
            })

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

            function showBasicMessage() {
                swal({title:"Loading...", text:"Mohon Menunggu", showConfirmButton: false});
            }

            function showSuccessMessage(message) {
                // swal("Success", message, "success");
                swal({title: "Success!", text: message, type: "success"},
                    function(){ 
                        window.location.href = base_url+'/bom';
                    }
                );
            }

            function showErrorMessage(message){
                swal("", message, "error");
            }
        })

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }        
    </script>