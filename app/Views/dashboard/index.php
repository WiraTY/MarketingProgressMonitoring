<?= $this->extend('template/template') ?>
<?= $this->Section('content'); ?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title mb-0"><?= $title ?></h1>
            <hr class="mb-4">
            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <div class="row g-4 mb-4">
                <div class="app-card app-card-chart h-100 shadow-sm">
                    <div class="app-card-header p-3 border-0">
                        <h4 class="app-card-title text-center">Total Pengiriman Email</h4>
                    </div><!--//app-card-header-->
                    <div class="app-card-body p-4">
                        <div class="chart-container">
                            <canvas id="chart"></canvas>
                        </div>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
                <div class="app-card app-card-chart h-100 shadow-sm">
                    <div class="app-card-header p-3 border-0">
                        <h4 class="app-card-title text-center">Negara Tujuan</h4>
                    </div><!--//app-card-header-->
                    <div class="app-card-body p-4">
                        <div class="chart-container">
                            <canvas id="pie-chart"></canvas>
                        </div>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js">
</script>

<script>
    const members = <?php echo json_encode(array_column($memberEmails, 'nama_member')); ?>;
    const emails = <?php echo json_encode(array_column($memberEmails, 'kirim_emails_count')); ?>;
    const ctx = document.getElementById("chart").getContext('2d');
    const dataExists = members.length > 0 && emails.length > 0;

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: members,
            datasets: [{
                label: 'Jumlah Kirim Email  ',
                backgroundColor: 'rgba(92, 179, 119, 1)',
                borderColor: 'rgb(21, 163, 98)',
                data: emails,
                fontColor: 'black',
                fontSize: 14,
            }]
        },
        options: {
            responsive: true,
            scales: {
                xAxes: [{
                    barPercentage: 0.75, // Atur lebar bar sesuai kebutuhan
                    categoryPercentage: 1.0, // Atur jarak antar bar sesuai kebutuhan
                    ticks: {
                        autoSkip: false,
                        beginAtZero: true,
                        fontColor: 'black',
                        fontSize: 13,
                        // maxRotation: 90,
                        // minRotation: 90,
                    },
                    offset: true, // Aktifkan opsi offset agar data lebih leluasa dalam penempatan
                    maxBarThickness: 200, // Atur ketebalan maksimum bar agar chart dapat di-scroll
                    scrollbar: {
                        enabled: true, // Aktifkan scrollbar untuk mengatasi lebih dari 30 data
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1,
                        fontColor: 'black', // Menampilkan label bilangan bulat saja (tanpa desimal)
                        fontSize: 13,
                    }
                }]
            }
        },
    });

    // if (!dataExists) {
    //     myChart.destroy();
    //     ctx.font = "14px Arial";
    //     ctx.fillStyle = "black";
    //     ctx.textAlign = "center";
    //     ctx.fillText("Tidak ada data yang tersedia.", ctx.canvas.width / 2, ctx.canvas.height / 2);
    // }
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js" integrity="sha256-IMCPPZxtLvdt9tam8RJ8ABMzn+Mq3SQiInbDmMYwjDg=" crossorigin="anonymous"></script>
<script>
    const negara = <?php echo json_encode(array_column($kirimEmails, 'negara_perusahaan')); ?>;
    const total = <?php echo json_encode(array_column($kirimEmails, 'total_negara')); ?>;

    function darkenColor(color, amount) {
        let r = parseInt(color.slice(1, 3), 16);
        let g = parseInt(color.slice(3, 5), 16);
        let b = parseInt(color.slice(5, 7), 16);

        // "Mendarken" warna dengan menggeser nilai RGB ke arah minimum (0) menggunakan amount
        r = Math.round(r * (1 - amount));
        g = Math.round(g * (1 - amount));
        b = Math.round(b * (1 - amount));

        const newColor = `#${r.toString(16).padStart(2, '0')}${g.toString(16).padStart(2, '0')}${b.toString(16).padStart(2, '0')}`;
        return newColor;
    }

    function getRandomColor() {
        const minBrightness = 150; // Atur nilai minimal kecerahan warna (0-255)

        let r, g, b;
        do {
            r = Math.floor(Math.random() * 256);
            g = Math.floor(Math.random() * 256);
            b = Math.floor(Math.random() * 256);
        } while ((r + g + b) / 3 < minBrightness); // Periksa rata-rata kecerahan warna

        const randomColor = `#${r.toString(16).padStart(2, '0')}${g.toString(16).padStart(2, '0')}${b.toString(16).padStart(2, '0')}`;
        return randomColor;
    }

    // Generate random colors for each country
    const colors = [];
    const borderColors = [];
    for (let i = 0; i < negara.length; i++) {
        const randomColor = getRandomColor();
        colors.push(randomColor);

        // Lighten the color by 30% to get the borderColor
        const borderColor = darkenColor(randomColor, 0.3);
        borderColors.push(borderColor);
    }

    const totalAngka = total.map(val => parseInt(val, 10));
    const totalSum = totalAngka.reduce((acc, val) => acc + val, 0);

    const ctx2 = document.getElementById("pie-chart").getContext('2d');

    // Hitung persentase untuk setiap data
    const persentaseData = total.map(value => ((value / totalSum) * 100).toFixed(1));
    // Buat array label baru yang menggabungkan label negara dengan persentase
    const labeledData = negara.map((label, index) => `${label}\n(${persentaseData[index]}%)`);

    const myPieChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: labeledData, // Gunakan array label yang baru dibuat
            datasets: [{
                label: 'Jumlah Kirim Email',
                backgroundColor: colors,
                borderColor: "transparent",
                data: total,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            aspectRatio: 0.5,
            scales: {
                xAxes: [{
                    barPercentage: 0.75, // Atur lebar bar sesuai kebutuhan
                    categoryPercentage: 1.0, // Atur jarak antar bar sesuai kebutuhan
                    ticks: {
                        autoSkip: false,
                        beginAtZero: true,
                        fontColor: 'black',
                        fontSize: 13,
                    },
                    offset: true, // Aktifkan opsi offset agar data lebih leluasa dalam penempatan
                    maxBarThickness: 200, // Atur ketebalan maksimum bar agar chart dapat di-scroll
                    scrollbar: {
                        enabled: true, // Aktifkan scrollbar untuk mengatasi lebih dari 30 data
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1,
                        fontColor: 'black', // Menampilkan label bilangan bulat saja (tanpa desimal)
                        fontSize: 13,
                    }
                }]
            },
            plugins: {
                tooltip: {
                    enabled: true
                },
                datalabels: {
                    display: true,
                    color: 'black',
                    textAlign: 'center',
                    font: {
                        size: 12,
                    },
                    formatter: (value, context) => {
                        if (totalSum !== 0) {
                            let label = `${context.chart.data.labels[context.dataIndex]}`;
                            return label;
                        } else {
                            return `${context.chart.data.labels[context.dataIndex]} (0%)`;
                        }
                    },
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    if (!dataExists) {
        // Hapus chart sebelumnya (jika ada)
        myPieChart.destroy();
        // Tampilkan pesan jika tidak ada data yang tersedia
        ctx2.font = "14px Arial";
        ctx2.fillStyle = "black";
        ctx2.textAlign = "center";
        ctx2.fillText("Tidak ada data yang tersedia.", ctx2.canvas.width / 2, ctx2.canvas.height / 2);
    }
</script>

<?= $this->endSection('content'); ?>