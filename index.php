<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Monitoring Polusi Udara di Indonesia">
    <meta name="author" content="Nama Anda atau Organisasi">
    <title>SISTEM MONITORING POLUSI UDARA</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
    .title-label, .location-label {
        font-weight: bold;
        color: #007bff; /* Warna biru untuk label */
    }
    #pollutionTitle {
        font-weight: bold;
        font-family: 'Nunito', sans-serif;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        font-size: 28px;
    }
    #locationInfo {
        font-family: 'Nunito', sans-serif;
        color: #6c757d;
        font-size: 18px;
        margin-bottom: 10px;
    }
    #locationInfo a {
        color: #007bff;
        text-decoration: none;
    }
    #locationInfo a:hover {
        text-decoration: underline;
    }
    .alert-level {
        color: #dc3545;
        font-weight: bold;
    }
    #lastUpdated {
        font-family: 'Nunito', sans-serif;
        color: #6c757d;
        font-size: 16px;
        margin-top: 10px;
        text-align: right;
    }
    .table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }
    .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    .table th {
        background-color: #4e73df; /* Warna biru gelap untuk header tabel */
        color: white;
    }
    .table td {
        background-color: #f8f9fc; /* Warna latar belakang terang untuk sel */
    }
    .table tbody tr:nth-child(odd) {
        background-color: #eaf1f9; /* Warna zebra striping untuk baris */
    }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Custom Topbar for Monitoring and Location -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background-color: #007bff; font-family: 'Arial', sans-serif;">
                    <div class="container-fluid">
                        <h1 class="h4 mb-0" style="font-size: 24px; color: black;">Monitoring Polusi Udara</h1>
                        <div class="navbar-text ml-auto">
                            Lokasi: Kota Makassar, Jl. Andi Pangeran Pettarani
                            <a href="https://www.google.com/maps/search/?api=1&query=Jl.+Andi+Pangeran+Pettarani,+Makassar" target="_blank" class="ml-2 btn btn-light btn-sm" style="color: black;">Lihat Peta</a>
                        </div>
                    </div>
                </nav>
                <!-- End of Custom Topbar -->
                <!-- Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <!-- Menampilkan data polusi udara -->
                    <!-- Tabel Informasi Polusi Udara -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Informasi Polusi Udara</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Tingkat Polusi Udara</th>
                                                <th>Indeks Kualitas Udara</th>
                                                <th>Polutan Utama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Sedang</td>
                                                <td>65 AQI US</td>
                                                <td>PM2.5</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Grafik Gabungan Polusi Udara -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik Gabungan Polusi Udara</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="combinedPollutionChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Polutan Yang Terdeteksi dan Rekomendasi Kesehatan -->
                    <div class="row">
                        <!-- Polutan Yang Terdeteksi -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Polutan Yang Terdeteksi</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">PM 2.5 <span class="float-right">24.3µg/m³</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 24.3%"
                                            aria-valuenow="24.3" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">PM10 <span class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">O3 <span class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">NO2 <span class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">SO2 <span class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Rekomendasi Kesehatan -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Rekomendasi Kesehatan</h6>
                                </div>
                                <div class="card-body">
                                    <p>Menjaga kesehatan di tengah tingkat polusi yang tinggi sangat penting. Berikut beberapa tips yang bisa Anda ikuti:</p>
                                    <ul>
                                        <li>Menggunakan masker saat berada di luar ruangan.</li>
                                        <li>Menggunakan pembersih udara di dalam ruangan.</li>
                                        <li>Menghindari aktivitas luar ruangan saat tingkat polusi tinggi.</li>
                                        <li>Menjaga ventilasi udara yang baik di dalam rumah atau kantor.</li>
                                    </ul>
                                    <p>Ikuti rekomendasi ini untuk membantu mengurangi risiko kesehatan akibat polusi udara.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Peta Interaktif -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Peta Interaktif</h6>
                                </div>
                                <div class="card-body">
                                    <div id="airQualityMap" style="height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Hak Cipta &copy; Nama Website Anda 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Data untuk grafik harian
        var dailyData = {
            label: 'Tingkat PM2.5 Harian',
            data: [20, 30, 40, 30, 20, 10, 50],
            type: 'line', // Tipe grafik line untuk data harian
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 2,
            fill: false
        };

        // Data untuk grafik bulanan
        var monthlyData = {
            label: 'Tingkat PM10 Bulanan',
            data: [30, 20, 50, 20, 10],
            type: 'bar', // Tipe grafik bar untuk data bulanan
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        };

        // Gabungan data
        var combinedData = {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli"],
            datasets: [dailyData, monthlyData]
        };

        // Opsi grafik
        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            responsive: true
        };

        // Inisialisasi grafik gabungan
        var ctxCombined = document.getElementById('combinedPollutionChart').getContext('2d');
        var combinedPollutionChart = new Chart(ctxCombined, {
            type: 'bar', // Tipe dasar grafik
            data: combinedData,
            options: options
        });

        // Peta Interaktif
        var map = L.map('airQualityMap').setView([-5.1682097, 119.4284983], 16); // Koordinat dan zoom level diperbarui
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);
        // Tambahkan marker untuk lokasi pengukuran
        var marker = L.marker([-5.1682097, 119.4284983]).addTo(map); // Koordinat marker diperbarui
        marker.bindPopup("<b>Kualitas Udara Kota Makassar</b><br>PM2.5: Tinggi").openPopup();
    </script>
</body>

</html>