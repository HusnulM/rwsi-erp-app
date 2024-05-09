    <section class="content">
        <div class="container-fluid">
            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 id="title">
                                Approve Reservation <?= $data['resnum']; ?>
                            </h2> 

                            <ul class="header-dropdown m-r--5">  
                                <a href="<?= BASEURL; ?>/approvereservation" class="btn bg-teal waves-effect">
                                    <i class="material-icons">backspace</i> <span>BACK</span>
                                </a>
                                <a href="<?= BASEURL; ?>/approvereservation/approve/<?= $data['resnum']; ?>" class="btn bg-green" id="btn-approve">
                                    <i class="material-icons">done_all</i> <span>APPROVE</span>
                                </a>
							</ul>
                        </div>
                        <div class="body">
                            <b>
                                <div class="row clearfix">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="note">Note</label>
                                                <input type="text" name="note" id="note" class="form-control" placeholder="Note" value="<?= $data['head']['note']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="resdate">Reservation Date</label>
                                                <input type="date" name="resdate" id="resdate" class="datepicker form-control" value="<?= $data['head']['resdate']; ?>" readonly>
                                            </div>
                                        </div>    
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="fromwhsname">From Warehouse</label>
                                                <input type="text" name="fromwhsname" id="fromwhsname" class="form-control" value="<?= $data['head']['fromwhsname']; ?>" readonly>
                                            </div>
                                        </div>    
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="towhs">To Warehouse</label>
                                                <input type="text" name="towhsname" id="towhsname" class="form-control" value="<?= $data['head']['towhsname']; ?>" readonly>
                                            </div>
                                        </div>    
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="requestor">Requestor</label>
                                                <input type="text" class="form-control" name="requestor" id="requestor" value="<?= $data['head']['requestor']; ?>" readonly>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </b>
                        </div>
                    </div>

                    <div class="card">
                        <!-- PR Item -->
                        <div class="header">
                            <h2>
                                Reservation Item
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Material</th>
                                                    <th>Material Description</th>
                                                    <th>Quantity</th>
                                                    <th>Unit</th>
                                                    <th>Remark</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl-resitem-body" class="mainbodynpo">
                                                
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
    </section>

    <script>
        $(function(){
            

            var reservationitems = <?= json_encode($data['item']); ?>;
            console.log(reservationitems);
            setReservationItem();
            function setReservationItem(){
                var count = 0;
                for(var i = 0; i < reservationitems.length; i++){
                    count = count+1;
                    html = '';
                    html = `
                        <tr counter="`+ count +`" id="tr`+ count +`">
                            <td class="nurut"> 
                                `+ count +`
                                <input type="hidden" name="itm_no[]" value="`+ count +`" />
                            </td>
                            <td> 
                                <input type="text" name="itm_material[]" counter="`+count+`" id="material`+count+`" class="form-control materialCode" style="width:150px;" required="true" value="`+ reservationitems[i].material +`" readonly/>
                            </td>
                            <td> 
                                <input type="text" name="itm_matdesc[]" counter="`+count+`" id="matdesc`+count+`" class="form-control" style="width:300px;" value="`+ reservationitems[i].matdesc +`" readonly/>
                            </td>
                            <td> 
                                <input type="text" name="itm_qty[]" counter="`+count+`" id="poqty`+count+`"  class="form-control inputNumber" style="width:100px; text-align:right;" required="true" value="`+ reservationitems[i].quantity +`" readonly/>
                            </td>
                            <td> 
                                <input type="text" name="itm_unit[]" counter="`+count+`" id="unit`+count+`" class="form-control" style="width:80px;" required="true" value="`+ reservationitems[i].unit +`" readonly/>
                            </td>
                            <td> 
                                <input type="text" name="itm_remark[]" class="form-control" style="width:200px;" counter="`+count+`" value="`+ reservationitems[i].remark +`" readonly/>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm removePO hideComponent" counter="`+count+`" data-resnum="`+ reservationitems[i].resnum +`" data-resitem="`+ reservationitems[i].resitem +`">Remove</button>
                            </td>
                        </tr>
                    `;
                    $('#tbl-resitem-body').append(html);
                    renumberRows();

                    $('.removePO').on('click', function(e){
                        e.preventDefault();
                        $(this).closest("tr").remove();
                        var data = $(this).data();
                        console.log(data);
                        // renumberRows();
                        $.ajax({
                            url: base_url+'/approvereservation/deleteitem/'+data.resnum+'/'+data.resitem,
                            type: 'GET',
                            dataType: 'json',
                            cache:false,
                            success: function(result){
                            }
                        }).done(function(result){
                            console.log(result)
                            if(result.msgtype === '1'){
                                renumberRows();
                            }
                        }); 
                    })
                }
            }

            function renumberRows() {
                $(".mainbodynpo > tr").each(function(i, v) {
                    $(this).find(".nurut").text(i + 1);
                });
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
        })
    </script>