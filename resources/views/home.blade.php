@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Jumlah Customer</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="custom_datalabels_bar" data-colors='["--vz-primary", "--vz-secondary"]' class="apex-charts" dir="ltr"></div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <div class="container">
            <h2>Daftar User</h2>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
    function getChartColorsArray(t) {
        if (null !== document.getElementById(t)) {
            t = document.getElementById(t).getAttribute("data-colors");
            return (t = JSON.parse(t)).map(function(t) {
                var e = t.replace(" ", "");
                return -1 === e.indexOf(",") ? getComputedStyle(document.documentElement).getPropertyValue(e) || e : 2 == (t = t.split(",")).length ? "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(t[0]) + "," + t[1] + ")" : e
            });
        }
    }

    function updateChart() {
        fetch('/user-stats')
            .then(response => response.json())
            .then(data => {
                chart.updateSeries([{
                    name: 'Customers',
                    data: [data.new_customers, data.loyal_customers]
                }]);
            })
            .catch(error => console.error('Error fetching user stats:', error));
    }


    document.addEventListener("DOMContentLoaded", function() {
        var chartColors = getChartColorsArray("custom_datalabels_bar");

        fetch('/user-stats')
            .then(response => response.json())
            .then(data => {
                var options = {
                    series: [{
                        name: 'Customers',
                        data: [data.new_customers, data.loyal_customers]
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    colors: chartColors,
                    xaxis: {
                        categories: ['NEW CUSTOMER', 'LOYAL CUSTOMER']
                    },
                    grid: {
                        borderColor: "#f1f1f1"
                    },
                    title: {
                        text: 'Customer Status',
                        align: 'center',
                        style: {
                            fontWeight: 500
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#custom_datalabels_bar"), options);
                chart.render();
            })
            .catch(error => console.error('Error fetching user stats:', error));
    });

    $(document).ready(function() {
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("users.data") }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'status', name: 'status' },
                { 
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false,
                    render: function(data, type, row) {
                        var buttons = '<button class="btn btn-danger btn-sm delete-btn" data-id="' + row.id + '">Delete</button> ';
                        if (row.status === 'NEW CUSTOMER') {
                            buttons += '<button class="btn btn-primary btn-sm loyal-btn" data-id="' + row.id + '">Set Loyal</button>';
                        }
                        return buttons;
                    }
                }
            ]
        });
    
        $('#users-table').on('click', '.delete-btn', function() {
            var userId = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                $.ajax({
                    url: '/users/' + userId,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(result) {
                        if (result.success) {
                            // Refresh DataTable
                            table.ajax.reload();
                            updateChart()
                            alert('User berhasil dihapus');
                        } else {
                            alert('Gagal menghapus user');
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            }
        });

        $('#users-table').on('click', '.loyal-btn', function() {
            var userId = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin mengubah status user ini menjadi LOYAL CUSTOMER?')) {
                $.ajax({
                    url: '/users/' + userId + '/set-loyal',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(result) {
                        if (result.success) {
                            table.ajax.reload();
                            updateChart()
                            alert('Status user berhasil diubah menjadi LOYAL CUSTOMER');
                        } else {
                            alert('Gagal mengubah status user');
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            }
        });
    });

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

@endsection
