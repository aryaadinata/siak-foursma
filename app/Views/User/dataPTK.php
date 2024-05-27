<table id="example1" class="table table-bordered table-striped loadtable">
    <thead>
        <tr>
            <th class="no-sorting">No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($ptk as $row) :
            $no++;
        ?>
            <tr>
                <td class="tengah"><?= $no ?></td>
                <td class="tengah"><?= $row["username"] ?></td>
                <td class="tengah"><?= $row["nama"] ?></td>
                <td class="tengah"><?php if ($row["level"] == 1) echo "PTK" ?></td>
                <td class="tengah">
                    <a href="<?= base_url() ?>/lihatguru/<?= $row["username"] ?>" type="button" title="Edit" class="btn btn-flat btn-info btn-xs">detail</a>
                    <button type="button" title="Hapus" class="btn btn-flat btn-danger btn-xs" onclick="hapus('<?= $row['username'] ?>')">hapus</button>
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
                url: "<?= site_url('Ptk/formtambahguru') ?>",
                dataType: "json",
                beforeSend: function() {
                    $(".tomboltambah").attr("disabled", "disable");
                    $(".tomboltambah").html('<i class="fas fa-spin fa-spinner"></i> Loading...</a>');
                },
                success: function(response) {
                    $(".tomboltambah").removeAttr("disabled");
                    $(".tomboltambah").html('<i class="fas fa-plus"></i> Tambah</a>');
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambahguru').modal('show');
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