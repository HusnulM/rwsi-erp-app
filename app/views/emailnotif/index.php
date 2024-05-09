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
							    <button type="button" class="btn btn-success waves-effect pull-right" id="btn-add-email">Add New Email Recipient</button>
							</ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width:50px;">No</th>
                                            <th>Email Address</th>
                                            <th>Name</th>
                                            <th style="width:120px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0; ?>
                                        <?php foreach($data['rdata'] as $out) : ?>
                                            <?php $no++; ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $out['email']; ?></td>
                                                <td><?= $out['name']; ?></td>
                                                <td>
                                                    <a href="<?= BASEURL; ?>/emailnotif/delete/<?= $out['email']; ?>" type="button" class="btn btn-danger">Delete</a>
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

        <div class="modal fade" id="modalAddEmail" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <form action="<?= BASEURL; ?>/emailnotif/save" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalAddEmailTitle">Add Email Recipient</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th></th>
                                </thead>
                                <tbody id="tbl-data-body">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right">
                                            <button type="button" class="btn btn-success btnAddEmail">ADD</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            <button type="submit" class="btn btn-primary">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        $(function(){
            $('#btn-add-email').on('click', function(){
                $('#modalAddEmail').modal('show');
            });

            $('.btnAddEmail').on('click', function(){
                $('#tbl-data-body').append(`
                    <tr>
                        <td>
                            <input type="email" name="email[]" class="form-control" required autocomplete="off">
                        </td>
                        <td>
                            <input type="text" name="name[]" class="form-control" required autocomplete="off">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm btnRemove">
                                REMOVE
                            </button>
                        </td>
                    </tr>
                `);

                $('.btnRemove').on('click', function(e){
                    e.preventDefault();
                    $(this).closest("tr").remove();
                });
            });
        });
    </script>