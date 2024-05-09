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
                            <form action="<?= BASEURL; ?>/mpp/save" method="POST">
                                <div class="row">
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
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="tahun">Part Number</label>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="partnumber" id="partnumber" class="form-control" autocomplete="off" required>
                                                <input type="hidden" name="bomid" id="bomid">
                                            </div>
                                            <span class="input-group-addon" style="padding-left: 0px;padding-top: 0px">
                                                <button type="button" class="btn bg-blue btn-sm btnSelectPart" style="margin-bottom:5px;" title="CHOOSE PART">
                                                <i class="material-icons">add_box</i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="tahun">Customer</label>
                                        <input type="text" name="customer" id="customer" class="form-control" readonly>
                                        <input type="hidden" name="customerid" id="customerid">
                                    </div>
                                    <!-- <div class="col-lg-3">
                                        <label for="assyno">Assy NO.</label>
                                        <input type="text" name="assyno" class="form-control" required>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Date</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl-mpp-body">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn bg-blue pull-left">
                                            <i class="material-icons">save</i> <span>SAVE</span>
                                        </button>
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

            $('#tahun').on('change', function(){
                var _tahun = this.value;
                var _bulan = $('#bulan').val();

                _bulan = (_bulan * 1) - 1.
                $('#tbl-mpp-body').html('');
                getDaysInMonth(_bulan,_tahun)
            });

            $('#bulan').on('change', function(){
                var _bulan = this.value;
                var _tahun = $('#tahun').val();

                _bulan = (_bulan * 1) - 1.
                $('#tbl-mpp-body').html('');
                getDaysInMonth(_bulan,_tahun)
            });

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
                            <input type="text" name="quantity[]" class="form-control" value="0" style="text-align:right;" autocomplete="off">
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