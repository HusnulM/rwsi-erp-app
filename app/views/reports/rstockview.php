<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" id="div-po-item">
                        <!-- PO Item -->
                        <div class="header">
                            <h2>
                                Report Material Stock
                            </h2>
                            <ul class="header-dropdown m-r--5">       
                                <button id="btn-excel" type="button" class="btn btn-primary bg-blue">
                                    <i class="material-icons">file_download</i> Export to Excel
                                </button>
                                <a href="<?= BASEURL; ?>/reports/stock" class="btn bg-blue">
                                   <i class="material-icons">backspace</i> BACK
                                </a>
                            </ul>
                        </div>
                        <div class="body">                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable-Default">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Material</th>
                                                <th>Description</th>
                                                <th>Part Name</th>
                                                <th>Part Number</th>
                                                <th>Warehouse</th>
                                                <th style="text-align:right;">Quantity</th>
                                                <th>Base Uom</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl-body">
                                            <?php $no = 0; ?>
                                            <?php foreach ($data['stock'] as $stock) : ?>
                                                <?php $no++; ?>
                                                <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $stock['material']; ?></td>
                                        <td><?= $stock['matdesc']; ?></td>
                                        <td><?= $stock['partname']; ?></td>
                                        <td><?= $stock['partnumber']; ?></td>
                                        <td><?= $stock['warehouse']; ?> - <?= $stock['deskripsi']; ?></td>
                                        <td style="text-align:right;">
                                            <?php if (strpos($stock['quantity'], '.00') !== false) {
                                                echo number_format($stock['quantity'], 0, ',', '.');;
                                            }else{
                                                echo number_format($stock['quantity'], 2, ',', '.');;
                                            } ?>
                                        </td>
                                        <td><?= $stock['matunit']; ?></td>
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
    </section>
    
    <script src="<?= BASEURL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        $(function(){
            $('.dataTable-Default').DataTable({
                responsive: true,
                pageLength: 50,
                lengthMenu: [50, 100, 200, 500]
            });
            
            $('#btn-excel').on('click', function(){
                var material  = "<?= $data['material']; ?>";
                var warehouse = "<?= $data['warehouse']; ?>";
                window.open(base_url+"/reports/exportstock/"+material+"/"+warehouse, '_blank');
            });
        })
    </script>