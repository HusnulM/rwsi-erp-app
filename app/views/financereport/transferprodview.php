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
                                <a href="<?= BASEURL; ?>/financereport/transferprod" type="button" class="btn btn-primary">Back</a>
							</ul>
                        </div>
                        <div class="body">                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable-Default" style="width:170%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <!--<th>Movement No</th>-->
                                                <!--<th>Item</th>-->
                                                <!--<th>Movement Type</th>-->
                                                <th>Movement Date</th>
                                                <th>Material</th>
                                                <th>Description</th>
                                                <!--<th>Note</th>-->
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Unit Price</th>
                                                <th>Total Amount</th>
                                                <!--<th>Reference</th>-->
                                                <th>Warehouse From</th>
                                                <th>Warehouse Dest</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size:12px;">
                                            <?php $no = 0; ?>
                                            <?php foreach ($data['podata'] as $prdata) : ?>
                                                <?php $no++; ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <!--<td><?= $prdata['grnum']; ?></td>-->
                                                    <!--<td><?= $prdata['gritem']; ?></td>-->
                                                    <!--<td>-->
                                                    <!--    <?php if($prdata['movement'] === "211") : ?>-->
                                                    <!--        <?= $prdata['movement']; ?> - Transfer other-->
                                                    <!--    <?php elseif($prdata['movement'] === "201"): ?>-->
                                                    <!--        <?= $prdata['movement']; ?> - Transfer to reservation-->
                                                    <!--    <?php endif; ?>-->
                                                    <!--</td>-->
                                                    <td><?= $prdata['movementdate']; ?></td>
                                                    <td><?= $prdata['material']; ?></td>
                                                    <td><?= $prdata['matdesc']; ?></td>
                                                    <!--<td><?= $prdata['note']; ?></td>-->
                                                    <td style="text-align:right;">
                                                        <?= number_format($prdata['quantity'], 0, ',', '.'); ?>
                                                    </td>
                                                    <td><?= $prdata['unit']; ?></td>
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
                                                    
                                                    <td>
                                                        <?= $prdata['warehouse']. " - " . $prdata['whsfrom'];?>
                                                    </td>
                                                    <td>
                                                        <?= $prdata['warehouseto']. " - " . $prdata['whsdest'];?>
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
                var strdate = "<?= $data['strdate']; ?>";
                var enddate = "<?= $data['enddate']; ?>";
                window.open(base_url+"/financereport/transferprodtexport/"+strdate+"/"+enddate, '_blank');
            });
        });
    </script>