// Data simulasi status dan detail pencairan
const statusDana = 'Sedang Diproses'; // Contoh status: 'Belum Dicairkan', 'Sedang Diproses', 'Sudah Cair'
const detail = {
  nominal: 'Rp 1.200.000',
  tanggalPengajuan: '5 Juni 2025',
  tanggalPencairan: '-', // Bisa '-' kalau belum cair
  statusPencairan: statusDana,
  metode: 'Bank BRI',
  referensi: 'TRX1234567890'
};

const navLinks = document.querySelectorAll('.menu-nav a[data-section]');
const contentSections = document.querySelectorAll('.content-section');
const statusTextEl = document.getElementById('status-text');
const laporBtn = document.getElementById('lapor-btn');
const laporanText = document.getElementById('laporan-text');
const laporMsg = document.getElementById('lapor-msg');

// Progress bar status 3 tahap
const stepBelum = document.getElementById('step-belum');
const stepProses = document.getElementById('step-proses');
const stepSudah = document.getElementById('step-sudah');

// Reset semua step ke non-aktif (abu-abu)
[stepBelum, stepProses, stepSudah].forEach(step => step.classList.remove('active'));

// Update status progress dan highlight sesuai statusDana
const status = statusDana.toLowerCase();

if (status === 'belum dicairkan') {
  stepBelum.classList.add('active');
  stepProses.classList.add('inactive-step');
  stepSudah.classList.add('inactive-step');
} else if (status === 'sedang diproses' || status === 'dalam proses') {
  stepProses.classList.add('active', 'highlight-step'); // yang diperbesar dan bold
  stepBelum.classList.add('inactive-step');
  stepSudah.classList.add('inactive-step');
} else if (status === 'sudah cair') {
  stepSudah.classList.add('active');
  stepBelum.classList.add('inactive-step');
  stepProses.classList.add('inactive-step');
}

// Tampilkan status teks
statusTextEl.textContent = statusDana;

// Isi detail pencairan (semua kolom)
document.getElementById('nominal-terima').textContent = detail.nominal;
document.getElementById('tanggal-pengajuan').textContent = detail.tanggalPengajuan;
document.getElementById('tanggal-cair').textContent = detail.tanggalPencairan;
document.getElementById('status-pencairan').textContent = detail.statusPencairan;
document.getElementById('metode-transfer').textContent = detail.metode;
document.getElementById('nomor-ref').textContent = detail.referensi;

// Navigasi klik menu header
navLinks.forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    navLinks.forEach(l => l.classList.remove('active'));
    link.classList.add('active');
    const target = link.dataset.section;
    contentSections.forEach(section => {
      section.classList.toggle('active', section.id === target);
    });
  });
});

// Kirim laporan ketidaksesuaian
laporBtn.addEventListener('click', () => {
  const laporan = laporanText.value.trim();
  const file = buktiUpload.files[0];

  if (!laporan) {
    laporMsg.textContent = 'Mohon isi laporan ketidaksesuaian.';
    laporMsg.classList.remove('hidden', 'success');
    return;
  }

  if (!file) {
    laporMsg.textContent = 'Mohon upload bukti pendukung.';
    laporMsg.classList.remove('hidden', 'success');
    return;
  }

  laporMsg.textContent = 'Laporan berhasil dikirim. Terima kasih.';
  laporMsg.classList.remove('hidden');
  laporMsg.classList.add('success');
  laporanText.value = '';
  buktiUpload.value = ''; // reset input file
});


// Fungsi logout (contoh)
function logout() {
  alert("Anda telah logout.");
  location.href = "../index.html";
}

const riwayatTable = document.getElementById('riwayat-table');
const kelasDropdown = document.getElementById('kelas-dropdown');

const riwayatData = {
  X: [
    { periode: 'Semester 1', status: 'Sudah Cair', nominal: 'Rp 1.000.000', tanggal: '10 Juli 2023' },
    { periode: 'Semester 2', status: 'Sudah Cair', nominal: 'Rp 1.000.000', tanggal: '15 Januari 2024' }
  ],
  XI: [
    { periode: 'Semester 1', status: 'Sudah Cair', nominal: 'Rp 1.200.000', tanggal: '12 Juli 2024' },
    { periode: 'Semester 2', status: 'Sedang Diproses', nominal: 'Rp 1.200.000', tanggal: '-' }
  ],
  XII: [
    { periode: 'Semester 1', status: 'Belum Dicairkan', nominal: 'Rp 1.200.000', tanggal: '-' },
    { periode: 'Semester 2', status: 'Belum Dicairkan', nominal: 'Rp 1.200.000', tanggal: '-' }
  ]
};

function updateRiwayat(kelas) {
  const data = riwayatData[kelas];
  riwayatTable.innerHTML = data.map(row => `
    <tr>
      <td>${row.periode}</td>
      <td>${row.status}</td>
      <td>${row.nominal}</td>
      <td>${row.tanggal}</td>
    </tr>
  `).join('');
}

kelasDropdown.addEventListener('change', () => {
  updateRiwayat(kelasDropdown.value);
});

// Inisialisasi awal
updateRiwayat(kelasDropdown.value);

// Pastikan sudah include Chart.js di header (bisa via CDN)
// <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

// Data dan opsi chart
const ctx = document.getElementById('statusChart').getContext('2d');
const statusChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ['Sudah Cair', 'Dalam Proses', 'Belum Cair'],
    datasets: [{
      data: [70, 20, 10],
      backgroundColor: ['#28a745', '#ffc107', '#dc3545'], // hijau, kuning, merah
      hoverOffset: 30
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: false }
    },
    onClick: (evt, elements) => {
      if (elements.length > 0) {
        const index = elements[0].index;
        const label = statusChart.data.labels[index];
        const value = statusChart.data.datasets[0].data[index];
        alert(`${label}: ${value}%`);
      }
    }
  }
});
