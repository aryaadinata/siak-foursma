<table id="example2" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="no-sorting"><input class="" type="checkbox" id="checkAll2"></th>
            <th>No</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Tahun Lulus</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($siswa as $row) :
            $no++;
        ?>
            <tr>
                <th><input type="checkbox" value="<?= $row["nisn"] ?> " class="checkItem2"></th>
                <td><?= $no ?></td>
                <td><?= $row["nisn"] ?></td>
                <td><?= $row["nama_siswa"] ?></td>
                <td><?= $row["nama_kelas"] ?></td>
                <td><?= $row["tahun"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $('#checkAll2').click(function() {
        $('.checkItem2').prop('checked', this.checked);
    });
</script>

<script>
    $(function() {
        $("#example2").DataTable({
            //"responsive": true,
            "scrollX": true,
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