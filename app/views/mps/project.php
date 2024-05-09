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
							    <a href="<?= BASEURL; ?>/mps/createproject" class="btn btn-success waves-effect pull-right">Create MPS Project</a>
							</ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="prlist"></table>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Project</th>
                                            <th>Nama Project</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0; ?>
                                        <?php foreach ($data['project'] as $row) : ?>
                                            <?php $no++; ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $row['idproject']; ?></td>
                                                <td><?= $row['namaproject']; ?></td>
                                                <td>
                                                    <?php if($row['status'] === "1") : ?>
                                                        Open
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $row['createdon']; ?></td>
                                                <td style="text-align:center;">
                                                    <a href="<?= BASEURL; ?>/mps/detailproject/<?= $row['idproject']; ?>" type="button" class="btn btn-success">Detail</a>

                                                    <a href="<?= BASEURL; ?>/mps/deleteproject/<?= $row['idproject']; ?>" type="button" class="btn btn-danger">Delete</a>

                                                    <a href="<?= BASEURL; ?>/mps/closeproject/<?= $row['idproject']; ?>" type="button" class="btn btn-primary">Close Project</a>
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