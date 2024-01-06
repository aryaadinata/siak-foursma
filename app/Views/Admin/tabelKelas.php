<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Tingkat</th>
            <th>Jurusan</th>
            <th>Wali Kelas</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($kelas as $row) :
            $no++;
        ?>
            <tr>
                <td class="tengah"><?= $no ?></td>
                <td class="tengah"><?= $row["nama_kelas"] ?></td>
                <td class="tengah"><?= $row["tingkat"] ?></td>
                <td class="tengah"><?= $row["nama_jurusan"] ?></td>
                <td><?= $row["nama_ptk"] ?></td>
                <td class="tengah">
                    <a type="button" class="btn btn-info btn-xs" onclick="siswa('<?= $row['id_kelas'] ?>')">anggota</a>
                    <a type="button" class="btn btn-warning btn-xs" onclick="edit('<?= $row['id_kelas'] ?>')">edit</i></a>
                    <a type="button" class="btn btn-danger btn-xs" onclick="hapus('<?= $row['id_kelas'] ?>')">hapus</i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
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