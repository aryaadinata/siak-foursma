<div class="col-lg-12">
    <div class="card">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Data Siswa</h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a href="" class="nav-link tomboltambah bg-primary btn btn-flat" style="color:aliceblue"><i class="fas fa-plus"></i> Tambah</a></li>
                <li class="nav-item"><a href="/Admin/viewimport" class="nav-link bg-info btn btn-flat" style="color:aliceblue"><i class="fas fa-download"></i> Import</a></li>
            </ul>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped loadtable">
                <thead>
                    <tr>
                        <th class="no-sorting">No</th>
                        <th>NISN</th>
                        <th>NIS</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Tahun Masuk</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;
                    foreach ($siswa as $row) :
                        $no++;
                    ?>
                        <tr>
                            <td class="tengah"><?= $no ?></td>
                            <td class="tengah"><?= $row["nisn"] ?></td>
                            <td class="tengah"><?= $row["nis"] ?></td>
                            <td class="tengah"><?= $row["nik"] ?></td>
                            <td><?= $row["nama"] ?></td>
                            <td class="tengah"><?= $row["nama_kelas"] ?></td>
                            <td class="tengah"><?= $row["tahun_masuk"] ?></td>
                            <td class="tengah">
                                <button type="button" title="Edit" class="btn btn-flat btn-info btn-xs" onclick="detail('<?= $row['nisn'] ?>')">detail</button>
                                <button type="button" title="Hapus" class="btn btn-flat btn-danger btn-xs" onclick="hapus('<?= $row['nisn'] ?>')">hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<script>
    $(document).ready(function() {
        $('.tomboltambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= site_url('Admin/formtambahsiswa') ?>",
                dataType: "json",
                beforeSend: function() {
                    $(".tomboltambah").attr("disabled", "disable");
                    $(".tomboltambah").html('<i class="fas fa-spin fa-spinner"></i> Loading...</a>');
                },
                success: function(response) {
                    $(".tomboltambah").removeAttr("disabled");
                    $(".tomboltambah").html('<i class="fas fa-plus"></i> Tambah</a>');
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambahsiswa').modal('show');
                }

            });
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            scrollX: true,
        });
    });
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                } // Menghilangkan pengurutan pada kolom pertama (No)
            ],
            "initComplete": function() {
                $('.no-sorting').removeClass('sorting sorting_asc sorting_desc');
            }
            //            "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>