<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        const table = $('#table').DataTable({
            searching: false,
            order: [
                [0, 'desc']
            ],
            data: [],
            columns: [{
                    data: 'kode'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'harga_beli'
                },
                {
                    data: 'laba'
                },
                {
                    data: 'supplier'
                },
                {
                    data: 'jenis'
                },
            ]
        });

        getData(); // Load data pertama kali

        $('.btn-get-data').click(function() {
            getData();
        });

        function getData() {
            $.ajax({
                url: '/kategori-items/2/items'
                method: 'GET',
                dataType: 'json',
                success: function(res) {
                    const items = res.master_items;
                    table.clear().rows.add(items).draw();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert("Gagal memuat data");
                }
            });
        }
    });
</script>
