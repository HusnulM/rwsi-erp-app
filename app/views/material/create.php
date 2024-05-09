    <section class="content">
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <form action="<?= BASEURL; ?>/material/save" method="POST">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= $data['menu']; ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <button type="submit" id="btn-save" class="btn bg-blue"  data-type="success">
                                    <i class="material-icons">save</i> <span>SAVE</span>
                                </button>

                                <a href="<?= BASEURL; ?>/material" type="button" id="btn-back" class="btn bg-red"  data-type="success">
                                    <i class="material-icons">highlight_off</i> <span>CANCEL</span>
                                </a>
                            </ul>
                        </div>
                        <div class="body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#basic_data_view" data-toggle="tab">
                                        <i class="material-icons">description</i> Basic Data
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#alt_uom_view" data-toggle="tab">
                                        <i class="material-icons">line_weight</i> Alternative UOM
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#purchasing_view" data-toggle="tab">
                                        <i class="material-icons">shopping_basket</i> Purchasing
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="basic_data_view">
                                    <div class="row clearfix">
                                    <br>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="kodebrg" id="kodebrg" class="form-control" placeholder="Kode Material">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="namabrg" id="namabrg" class="form-control" placeholder="Description" required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="partname" id="partname" class="form-control" placeholder="Part Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="partnumber" id="partnumber" class="form-control" placeholder="Part Number" required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Base UOM" required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="size" id="size" class="form-control" placeholder="Size">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="color" id="color" class="form-control" placeholder="Color">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="alt_uom_view">
                                    <div class="row clearfix">
                                        <br>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="inp_alt_uom_val" id="inp_alt_uom_val" class="form-control" placeholder="Convertion">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="inp_alt_uom" id="inp_alt_uom" class="form-control" placeholder="Alternative UOM">
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="inp_base_uom_val" id="inp_base_uom_val" class="form-control" placeholder="Convertion">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="inp_base_uom" id="inp_base_uom" class="form-control" placeholder="Base UOM" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <button type="button" id="btn-add-alt-uom" class="btn btn-primary btn-sm form-control">Add</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 table-responsive">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <th>Alt Convertion</th>
                                                    <th>Alt Uom</th>
                                                    <th>Base Uom Convertion</th>
                                                    <th>Base Uom</th>
                                                    <th></th>
                                                </thead>
                                                <tbody id="table-alt-uom-body">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="purchasing_view">
                                    <div class="row clearfix">
                                        <br>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="minstock">Minimum Stock</label>
                                                    <input type="text" name="inp_min_stock" id="inp_min_stock" class="form-control" placeholder="Minimum Stock">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="ounit">Unit</label>
                                                    <input type="text" name="inp_min_uom" id="inp_min_uom" class="form-control" placeholder="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="ounit">Order Unit</label>
                                                    <input type="text" name="inp_ounit" id="inp_ounit" class="form-control" placeholder="Order Unit">
                                                </div>
                                            </div>
                                        </div>

                                        <?php if($data['showprice']['rows'] > 0) : ?>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="stdprice">Standard Price IDR</label>
                                                        <input type="text" name="inp_stdprice" id="inp_stdprice" class="form-control" placeholder="Standard Price">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="stdpriceusd">Standard Price USD</label>
                                                        <input type="text" name="inp_stdpriceusd" id="inp_stdpriceusd" class="form-control" placeholder="Standard Price">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="stdpricejpy">Standard Price JPY</label>
                                                        <input type="text" name="inp_stdpricejpy" id="inp_stdpricejpy" class="form-control" placeholder="Standard Price JPY">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="topprice">Top Price</label>
                                                        <input type="text" name="inp_topprice" id="inp_topprice" class="form-control" placeholder="TOP Price">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="toppriceusd">Top Price USD</label>
                                                        <input type="text" name="inp_toppriceusd" id="inp_toppriceusd" class="form-control" placeholder="TOP Price USD">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="toppricejpy">Top Price JPY</label>
                                                        <input type="text" name="inp_toppricejpy" id="inp_toppricejpy" class="form-control" placeholder="TOP Price JPY">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <input type="hidden" name="inp_stdprice" id="inp_stdprice" value="0">
                                            <input type="hidden" name="inp_stdpriceusd" id="inp_stdpriceusd" value="0">
                                            <input type="hidden" name="inp_topprice" id="inp_topprice" value="0">
                                            <input type="hidden" name="inp_toppriceusd" id="inp_toppriceusd" value="0">
                                        <?php endif; ?>   
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
    </section>

    <script src="<?= BASEURL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        var alt_uom = [];
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });
        });

        $(function(){
                $("#inp_stdpriceusd").keydown(function(event){
                    if(event.keyCode == 190) {
                        event.preventDefault();
                        showErrorMessage("Untuk decimal separator gunakan ( , )")
                        return false;
                    }
                });

                var harga  = document.getElementById('inp_stdprice');

                harga.addEventListener('keyup', function(e){
                    harga.value = formatRupiah(this.value, '');
                });

                var harga2  = document.getElementById('inp_stdpriceusd');

                harga2.addEventListener('keyup', function(e){
                    harga2.value = formatRupiah(this.value, '');
                });
                
                var harga3  = document.getElementById('inp_topprice');

                harga3.addEventListener('keyup', function(e){
                    harga3.value = formatRupiah(this.value, '');
                });
                
                var harga4  = document.getElementById('inp_toppriceusd');

                harga4.addEventListener('keyup', function(e){
                    harga4.value = formatRupiah(this.value, '');
                });
                
                function showErrorMessage(message){
                    swal("", message, "error");
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

            $('#btn-add-alt-uom').on('click', function(){
                $('#table-alt-uom-body').html('');

                var input = {};

                input.altuom     = $('#inp_alt_uom').val();
                input.altuomval  = $('#inp_alt_uom_val').val();
                input.baseuom    = $('#inp_base_uom').val();
                input.baseuomval = $('#inp_base_uom_val').val();

                alt_uom.push(input);
                var count = 0;
                for(var i = 0; i < alt_uom.length; i++){
                    count=count+1;
                    $('#table-alt-uom-body').append(`
                    <tr counter="`+ count +`" id="tr`+ count +`">
                        <td>
                            <input type="text" class="form-control" name="altuomval[]" value="`+ alt_uom[i].altuomval +`">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="altuom[]" value="`+ alt_uom[i].altuom +`">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="baseuomval[]" value="`+ alt_uom[i].baseuomval +`">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="baseuom[]" value="`+ alt_uom[i].baseuom +`">
                        </td>     
                        <td>
                            <button type="button" class="btn btn-danger btn-sm removePO hideComponent" counter="`+count+`">Remove</button>
                        </td>                   
                    </tr>
                    `);

                    $('.removePO').on('click', function(e){
                        e.preventDefault();
                        $(this).closest("tr").remove();
                    })
                }

                $('#inp_alt_uom').val('');
                $('#inp_alt_uom_val').val('');
                $('#inp_base_uom_val').val('');
            })

            $('#satuan').on('change', function(){
                $('#inp_base_uom').val(this.value);
                $('#inp_min_uom').val(this.value);
            })
        })
    
    </script>