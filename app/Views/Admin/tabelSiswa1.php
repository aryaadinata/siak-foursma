<table id="example1" class="table table-bordered table-striped loadtable1">
    <thead>
        <tr>
            <th class="no-sorting"><input type="checkbox" id="checkAll1"></th>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($siswa as $row) :
            $no++;
        ?>
            <tr>
                <th><input type="checkbox" value="<?= $row["nis"] ?> " class="checkItem1"></th>
                <td><?= $no ?></td>
                <td><?= $row["nis"] ?></td>
                <td><?= $row["nama"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $('#checkAll1').click(function() {
        $('.checkItem1').prop('checked', this.checked);
    });
</script>

<script>
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
    });
</script>