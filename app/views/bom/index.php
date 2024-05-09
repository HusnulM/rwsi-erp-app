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
                            <ul class="header-dropdown m-r--5">                                
							<a href="<?= BASEURL; ?>/bom/create" class="btn btn-success waves-effect pull-right">Create BOM</a>
							</ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="prlist"></table>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" style="width:140%;">
                                    <thead>
                                        <tr>
                                            <th style="width:30px;">No</th>
                                            <th style="width:50px;">Part Number</th>
                                            <th style="width:100px;">Part Name</th>
                                            <th style="width:150px;">Customer</th>
                                            <th style="text-align:right;width:50px;">Qty CCT</th>
                                            <th style="width:60px;">Reference</th>
                                            <th style="width:200px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0; ?>
                                        <?php foreach ($data['bomdata'] as $out) : ?>
                                            <?php $no++; ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $out['partnumber']; ?></td>
                                                <td><?= $out['partname']; ?></td>
                                                <td><?= $out['customer']; ?></td>
                                                <td style="text-align:right;">
                                                    <?php if (strpos($out['qtycct'], '.00') !== false) {
                                                        echo number_format($out['qtycct'], 0, ',', '.');
                                                    }else{
                                                        echo number_format($out['qtycct'], 2, ',', '.');
                                                    } ?>   
                                                </td>
                                                <td><?= $out['reference']; ?></td>
                                                <td style="text-align:center;">
                                                    <a href="<?= BASEURL; ?>/bom/detail/<?= $out['bomid']; ?>" type="button" class="btn btn-success">Detail</a>
                                                    <a href="<?= BASEURL; ?>/bom/createnewversion/<?= $out['bomid']; ?>" type="button" class="btn btn-success">Create New Version</a>
                                                    <a href="<?= BASEURL; ?>/bom/calculate/<?= $out['bomid']; ?>" type="button" class="btn btn-primary">BOM Calculation</a>
                                                    <?php if($_SESSION['usr_erp']['userlevel'] == "SysAdmin") : ?>
                                                        <a href="<?= BASEURL; ?>/bom/delete/<?= $out['bomid']; ?>" type="button" class="btn btn-danger">Delete</a>
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
    </section>