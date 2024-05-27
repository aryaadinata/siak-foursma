            <table id="example1" class="table table-bordered table-striped loadtable">
                <thead>
                    <tr>
                        <th class="no-sorting">No</th>
                        <th>NIS</th>
                        <th>NISN</th>
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
                            <td class="tengah"><?= $row["nis"] ?></td>
                            <td class="tengah"><?= $row["nisn"] ?></td>
                            <td class="tengah"><?= $row["nik"] ?></td>
                            <td><?= $row["nama"] ?></td>
                            <td class="tengah"><?= $row["nama_kelas"] ?></td>
                            <td class="tengah"><?= $row["tahun_masuk"] ?></td>
                            <td class="tengah">
                                <a href="<?= base_url() ?>/Admin/biodatasiswa/<?= $row["nis"] ?>" type="button" title="Edit" class="btn btn-flat btn-info btn-xs">detail</a>
                                <button type="button" title="Hapus" class="btn btn-flat btn-danger btn-xs" onclick="hapus('<?= $row['nis'] ?>')">hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

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