<style>
        .input-group .form-line {
            display: inline-block;
            width: 100%;
            border-bottom: 1px solid #ddd;
            position: relative;
            margin-top: 8px;
        }

        .input-group .form-line + .input-group-addon {
            padding-right: 0;
            padding-left: 0;
        }
    </style>
    <section class="content">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <form action="<?= BASEURL; ?>/materialequivalent/save" method="POST">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= $data['menu']; ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <button type="submit" id="btn-save" class="btn bg-blue"  data-type="success">
                                    <i class="material-icons">save</i> <span>SAVE</span>
                                </button>
                                <a href="<?= BASEURL; ?>/materialequivalent/report" class="btn bg-green waves-effect">
                                    <i class="material-icons">view_headline</i> <span>Part Equivalent Report</span>
                                </a>
                                <!-- <a href="<?= BASEURL; ?>/materialequivalent" type="button" id="btn-back" class="btn bg-red"  data-type="success">
                                    <i class="material-icons">highlight_off</i> <span>CANCEL</span>
                                </a> -->
                            </ul>
                        </div>
                        <div class="body">
                            <div id="msg-alert">
                                <?php
                                    Flasher::msgInfo();
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xm-12">
                                    <label for="partnumber">PART NUMBER</label>
                                    <input type="text" name="partnumber" id="partnumber" class="form-control" value="<?= $data['mat']['material']; ?>" required readonly/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="drawingpn">Drawing PN</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" name="drawingpn" id="drawingpn" class="form-control" value="<?= $data['mat']['drawingpn']; ?>" />
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part1" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="orignpn">Maker / Origin PN</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" name="orignpn" id="orignpn" class="form-control" value="<?= $data['mat']['orignpn']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part2" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>                                    
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="eqpn1">EQ PN 1</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                        <input type="text" name="eqpn1" id="eqpn1" class="form-control" value="<?= $data['mat']['eq01']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part3" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="eqpn2">EQ PN 2</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                        <input type="text" name="eqpn2" id="eqpn2" class="form-control" value="<?= $data['mat']['eq02']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part4" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="eqpn3">EQ PN 3</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                        <input type="text" name="eqpn3" id="eqpn3" class="form-control" value="<?= $data['mat']['eq03']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part5" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="eqpn4">EQ PN 4</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                        <input type="text" name="eqpn4" id="eqpn4" class="form-control" value="<?= $data['mat']['eq04']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part6" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="eqpn5">EQ PN 5</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                        <input type="text" name="eqpn5" id="eqpn5" class="form-control" value="<?= $data['mat']['eq05']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part7" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="eqpn6">EQ PN 6</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                        <input type="text" name="eqpn6" id="eqpn6" class="form-control" value="<?= $data['mat']['eq06']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part8" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                    
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="eqpn7">EQ PN 7</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                        <input type="text" name="eqpn7" id="eqpn7" class="form-control" value="<?= $data['mat']['eq07']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part9" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="eqpn8">EQ PN 8</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                        <input type="text" name="eqpn8" id="eqpn8" class="form-control" value="<?= $data['mat']['eq08']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part10" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="eqpn9">EQ PN 9</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                        <input type="text" name="eqpn9" id="eqpn9" class="form-control" value="<?= $data['mat']['eq09']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part11" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="eqpn10">EQ PN 10</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                        <input type="text" name="eqpn10" id="eqpn10" class="form-control" value="<?= $data['mat']['eq10']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part12" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="eqpn11">EQ PN 11</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                        <input type="text" name="eqpn11" id="eqpn11" class="form-control" value="<?= $data['mat']['eq11']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part13" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xm-12">
                                    <label for="eqpn12">EQ PN 12</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                        <input type="text" name="eqpn12" id="eqpn12" class="form-control" value="<?= $data['mat']['eq12']; ?>"/>
                                        </div>
                                        <span class="input-group-addon">
                                            <button type="button" id="btn-part14" class="btn bg-blue btn-sm btnSelectPart">
                                                <i class="material-icons">format_list_bulleted</i>
                                                PILIH PART
                                            </button>
                                        </span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="barangModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="barangModalTitle">Pilih Material</h4>
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

            var kodebrg           = '';
            var selectedId        = '';

            $('.btnSelectPart').on('click', function(){
                $('#barangModal').modal('show');
                selectedId = this.id;
                if(selectedId === "btn-part1"){
                    document.getElementById("drawingpn").focus();
                }else if(selectedId === "btn-part2"){
                    document.getElementById("orignpn").focus();
                }else if(selectedId === "btn-part3"){
                    document.getElementById("eqpn1").focus();
                }else if(selectedId === "btn-part4"){
                    document.getElementById("eqpn2").focus();
                }else if(selectedId === "btn-part5"){
                    document.getElementById("eqpn3").focus();
                }else if(selectedId === "btn-part6"){
                    document.getElementById("eqpn4").focus();
                }else if(selectedId === "btn-part7"){
                    document.getElementById("eqpn5").focus();
                }else if(selectedId === "btn-part8"){
                    document.getElementById("eqpn6").focus();
                }else if(selectedId === "btn-part9"){
                    document.getElementById("eqpn7").focus();
                }else if(selectedId === "btn-part10"){
                    document.getElementById("eqpn8").focus();
                }else if(selectedId === "btn-part11"){
                    document.getElementById("eqpn9").focus();
                }else if(selectedId === "btn-part12"){
                    document.getElementById("eqpn10").focus();
                }else if(selectedId === "btn-part13"){
                    document.getElementById("eqpn11").focus();
                }else if(selectedId === "btn-part14"){
                    document.getElementById("eqpn12").focus();
                }
                // alert(this.id);
            });

            loaddatabarang();
            function loaddatabarang(){
                $('#list-barang').dataTable({
                    "ajax": base_url+'/barang/listbarang',
                    "columns": [
                        { "data": "material" },
                        { "data": "matdesc" },
                        { "data": "partname" },
                        { "data": "partnumber" },
                        { "data": "matunit" },
                        {"defaultContent": "<button class='btn btn-primary btn-xs'>Pilih</button>"}
                    ],
                    "bDestroy": true,
                    "paging":   true,
                    "searching":   true
                });

                $('#list-barang tbody').on( 'click', 'button', function () {
                    var table = $('#list-barang').DataTable();
                    selected_data = [];
                    selected_data = table.row($(this).closest('tr')).data();
                    
                    kodebrg = selected_data.material;
                    // $('#partnumber').val(selected_data.material);
                    if(selectedId === "btn-part1"){
                        $('#drawingpn').val(selected_data.material);
                    }else if(selectedId === "btn-part2"){
                        $('#orignpn').val(selected_data.material);
                    }else if(selectedId === "btn-part3"){
                        $('#eqpn1').val(selected_data.material);
                    }else if(selectedId === "btn-part4"){
                        $('#eqpn2').val(selected_data.material);
                    }else if(selectedId === "btn-part5"){
                        $('#eqpn3').val(selected_data.material);
                    }else if(selectedId === "btn-part6"){
                        $('#eqpn4').val(selected_data.material);
                    }else if(selectedId === "btn-part7"){
                        $('#eqpn5').val(selected_data.material);
                    }else if(selectedId === "btn-part8"){
                        $('#eqpn6').val(selected_data.material);
                    }else if(selectedId === "btn-part9"){
                        $('#eqpn7').val(selected_data.material);
                    }else if(selectedId === "btn-part10"){
                        $('#eqpn8').val(selected_data.material);
                    }else if(selectedId === "btn-part11"){
                        $('#eqpn9').val(selected_data.material);
                    }else if(selectedId === "btn-part12"){
                        $('#eqpn10').val(selected_data.material);
                    }else if(selectedId === "btn-part13"){
                        $('#eqpn11').val(selected_data.material);
                    }else if(selectedId === "btn-part14"){
                        $('#eqpn12').val(selected_data.material);
                    }
                    $('#barangModal').modal('hide');
                } );
            }
        });
    
    </script>