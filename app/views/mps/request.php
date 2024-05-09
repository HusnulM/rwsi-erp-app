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
                            <!-- <ul class="header-dropdown m-r--5">                                
							    <a href="<?= BASEURL; ?>/mps/project" class="btn btn-danger waves-effect pull-right">Cancel</a>
							</ul> -->
                        </div>
                        <div class="body">
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Periode</th>
                                                <th>Part Number</th>
                                                <th>Quantity</th>
                                                <th>Customer</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl-mpp-body">
                                            <?php $i = 0; foreach($data['mppdata'] as $row): ?>
                                                <?php  
                                                    $i = $i + 1; 
                                                ?>
                                                <tr>
                                                    <td style="text-align:right;"><?= $i; ?></td>
                                                    <td><?= Helpers::getMonthName($row['periode']); ?></td>
                                                    <td><?= $row['partnumber']; ?></td>
                                                    <td style="text-align:right;"><?= $row['totalqty']; ?></td>
                                                    <td><?= $row['customer']; ?></td>
                                                    <td style="text-align:center;">
                                                        <a href="<?= BASEURL; ?>/mpp/detail/<?= $row['bomid']; ?>/<?= $row['periode']; ?>" class="btn btn-primary btn-sm">
                                                            DETAILS
                                                        </a>
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
        </div>

        <div class="modal fade" id="partModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="partModalTitle">Pilih Part Number</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-responsive" id="list-part" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Part Number</th>
                                        <th>Description</th>
                                        <th>Customer</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">
                            TUTUP
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            $('.btnSelectPart').on('click', function(){
                $('#partModal').modal('show');
            });

            // $('#tahun').on('change', function(){
            //     var _tahun = this.value;
            //     var _bulan = $('#bulan').val();

            //     _bulan = (_bulan * 1) - 1.
            //     $('#tbl-mpp-body').html('');
            //     getDaysInMonth(_bulan,_tahun)
            // });

            // $('#bulan').on('change', function(){
            //     var _bulan = this.value;
            //     var _tahun = $('#tahun').val();

            //     _bulan = (_bulan * 1) - 1.
            //     $('#tbl-mpp-body').html('');
            //     getDaysInMonth(_bulan,_tahun)
            // });

            function getDaysInMonth(month, year) {
                var date = new Date(year, month, 1);
                var days = [];
                var irows = 0;
                while (date.getMonth() == month) {
                    if(new Date(date).toLocaleString('en-us', {weekday: 'long'}) === "Saturday" || new Date(date).toLocaleString('en-us', {weekday: 'long'}) === "Sunday"){

                    }else{
                        irows += 1;
                        days.push(convertDate(new Date(date)));
                        setMpsItem(irows, convertDate(new Date(date)));
                    }
                    date.setDate(date.getDate() + 1);
                }
                return days;
            }

            function convertDate(date) {
                var yyyy = date.getFullYear().toString();
                var mm = (date.getMonth()+1).toString();
                var dd  = date.getDate().toString();

                var mmChars = mm.split('');
                var ddChars = dd.split('');

                return yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);
            }

            // console.log(getDaysInMonth('7','2021'))
            

            function setMpsItem(irows, idate){
                $('#tbl-mpp-body').append(`
                    <tr>
                        <td>`+irows+`</td>
                        <td>
                            <input type="date" name="mppdate[]" class="form-control" value="`+ idate +`" readonly>
                        </td>
                        <td>
                            <input type="number" name="quantity[]" class="form-control" value="0" style="text-align:right;">
                        </td>
                    </tr>
                `);
            }

            loaddatapart();
            function loaddatapart(){
                $('#list-part').dataTable({
                    "ajax": base_url+'/quotation/partlist',
                    "columns": [
                        { "data": "partnumber" },
                        { "data": "partname" },
                        { "data": "customer" },
                        {"defaultContent": "<button class='btn btn-blue btn-xs'><i class='material-icons'>add_box</i></button>"}
                    ],
                    "bDestroy": true,
                    "paging":   true,
                    "searching":   true
                });

                $('#list-part tbody').on( 'click', 'button', function () {
                    var table = $('#list-part').DataTable();
                    selected_data = [];
                    selected_data = table.row($(this).closest('tr')).data();
                    
                    console.log(selected_data);
                    $('#bomid').val(selected_data.bomid);
                    $('#partnumber').val(selected_data.partnumber);
                    $('#customerid').val(selected_data.cust_id);
                    $('#customer').val(selected_data.customer);
                    $('#partModal').modal('hide');
                } );
            }
        });
    </script>