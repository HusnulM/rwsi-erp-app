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
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="prlist"></table>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Reservation</th>
                                            <th>Reservation Date</th>
                                            <th>Note</th>
                                            <th>From Warehouse</th>
                                            <th>To Warehouse</th>
                                            <th>Requestor</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0; ?>
                                        <?php foreach ($data['rsdata'] as $pr) : ?>
                                            <?php $no++; ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $pr['resnum']; ?></td>
                                                <td><?= $pr['resdate']; ?></td>
                                                <td><?= $pr['note']; ?></td>
                                                <td><?= $pr['fromwhsname']; ?></td>
                                                <td><?= $pr['towhsname']; ?></td>
                                                <td><?= $pr['requestor']; ?></td>
                                                <td>
                                                    <a href="<?= BASEURL; ?>/approvereservation/detail/<?= $pr['resnum']; ?>" type="button" class="btn btn-success">Detail</a>
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