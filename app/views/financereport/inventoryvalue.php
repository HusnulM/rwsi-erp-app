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
                                <button id="btn-excel" type="button" class="btn btn-primary">Export to Excel</button>             
                                <a href="<?= BASEURL; ?>/financereport/debtamount" type="button" class="btn btn-primary">Back</a>
							</ul>
                        </div>
                        <div class="body">                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable-Default" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Material</th>
                                                <th>Description</th>
                                                <th>Part Name</th>
                                                <th>Part Number</th>
                                                <th>Warehouse</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Unit Price</th>
                                                <th>Total Value</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size:12px;">
                                            <?php $no = 0; ?>
                                            <?php foreach ($data['stock'] as $prdata) : ?>
                                                <?php $no++; ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $prdata['material']; ?></td>
                                                    <td><?= $prdata['matdesc']; ?></td>
                                                    <td><?= $prdata['partname']; ?></td>
                                                    <td><?= $prdata['partnumber']; ?></td>
                                                    <td><?= $prdata['warehouse']; ?> - <?= $prdata['deskripsi']; ?></td>
                                                    <td style="text-align:right;">
                                                        <?= number_format($prdata['quantity'], 0, ',', '.'); ?>
                                                    </td>
                                                    <td><?= $prdata['matunit']; ?></td>
                                                    <td style="text-align:right;">
                                                        <?php if($prdata['stdpriceusd'] > 0) : ?>
                                                            <?= number_format($data['kurs']['kurs']*$prdata['stdpriceusd'], 0, ',', '.'); ?>
                                                        <?php else: ?>
                                                            <?= number_format($prdata['stdprice'], 0, ',', '.'); ?>
                                                        <?php endif; ?>                                                        
                                                    </td>
                                                    <td style="text-align:right;">
                                                        <?php if($prdata['stdpriceusd'] > 0) : ?>
                                                            <?= number_format(round(($data['kurs']['kurs']*$prdata['stdpriceusd'])*$prdata['quantity'],0), 0, ',', '.'); ?>
                                                        <?php else: ?>
                                                            <?= number_format($prdata['stdprice']*$prdata['quantity'], 0, ',', '.'); ?>
                                                        <?php endif; ?>
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
    </section>

    <script>
        $(function(){
            $('.dataTable-Default').DataTable({
                responsive: true,
                pageLength: 50,
                lengthMenu: [50, 100, 200, 500]
            });

            $('#btn-excel').on('click', function(){
                window.open(base_url+"/financereport/expinventoryvalue", '_blank');
            });
        });
    </script>