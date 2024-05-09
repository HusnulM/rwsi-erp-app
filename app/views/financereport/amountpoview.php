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
                                <a href="<?= BASEURL; ?>/financereport/poamount" type="button" class="btn btn-primary">Back</a>
							</ul>
                        </div>
                        <div class="body">                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable-Default" style="width:200%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Vendor</th>
                                                <th>PO No.</th>
                                                <th>PO Date</th>
                                                <th>Create Date</th>
                                                <th>Material</th>
                                                <th>Description</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Unit Price</th>
                                                <th>PPN</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size:12px;">
                                            <?php $no = 0; ?>
                                            <?php foreach ($data['podata'] as $prdata) : ?>
                                                <?php $no++; ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $prdata['namavendor']; ?></td>
                                                    <td><?= $prdata['ponum']; ?></td>
                                                    <td><?= $prdata['podat']; ?></td>
                                                    <td><?= $prdata['createdon']; ?></td>
                                                    <td><?= $prdata['material']; ?></td>
                                                    <td><?= $prdata['matdesc']; ?></td>
                                                    <td style="text-align:right;">
                                                        <?= number_format($prdata['quantity'], 0, ',', '.'); ?>
                                                    </td>
                                                    <td><?= $prdata['unit']; ?></td>
                                                    <td style="text-align:right;">
                                                        
                                                        <?php if (strpos($prdata['price'], '.00') !== false) {
                                                            echo number_format($prdata['price'], 0, ',', '.');
                                                        }else{
                                                            echo number_format($prdata['price'], 2, ',', '.');
                                                        } ?>
                                                    </td>
                                                    <td style="text-align:right;">
                                                        <?= number_format($prdata['ppn'], 0, ',', '.'); ?>%
                                                    </td>
                                                    <td style="text-align:right;">
                                                        <?= number_format($prdata['amount']+($prdata['amount']*($prdata['ppn']/100)), 0, ',', '.'); ?>
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
                window.open(base_url+"/financereport/poamountexport/"+strdate+"/"+enddate, '_blank');
            });
        });
    </script>