// Toggle dropdown sidebar menu
document.querySelectorAll('#sidebar .dropdown-toggle').forEach(toggle => {
  toggle.addEventListener('click', e => {
    e.preventDefault();
    const parentLi = toggle.parentElement;
    parentLi.classList.toggle('open');
  });
});

// Navigasi konten dinamis
const sidebarItems = document.querySelectorAll('#sidebar li[data-section]');
const sections = document.querySelectorAll('.content-section');

sidebarItems.forEach(item => {
  item.addEventListener('click', e => {
    e.preventDefault();
    // Hapus class active dari semua sidebar item
    sidebarItems.forEach(i => i.classList.remove('active'));
    item.classList.add('active');

    // Tutup semua submenu dropdown kecuali yang mengandung item terpilih (optional)
    document.querySelectorAll('#sidebar li.dropdown').forEach(drop => {
      if (!drop.contains(item)) drop.classList.remove('open');
    });

    // Tampilkan section sesuai data-section
    const sectionId = item.getAttribute('data-section');
    sections.forEach(sec => {
      sec.classList.toggle('active', sec.id === sectionId);
    });
  });
});

// Logout button
document.getElementById('logout-btn').addEventListener('click', () => {
  alert("Anda telah logout.");
  location.href = "../index.html";
});

const laporanTbody = document.getElementById('laporan-tbody');

const laporanData = [
  { no: 1, sekolah: 'SMP Negeri 1 Jakarta', deskripsi: 'Dana belum diterima', status: 'Menunggu Verifikasi' },
  { no: 2, sekolah: 'SMA Negeri 3 Bandung', deskripsi: 'Jumlah dana kurang', status: 'Ditindaklanjuti' },
  { no: 3, sekolah: 'SMP Negeri 5 Surabaya', deskripsi: 'Bukti transfer tidak sesuai', status: 'Selesai' }
];

function renderLaporan() {
  laporanTbody.innerHTML = laporanData.map(item => {
    let statusClass = '';
    if (item.status.toLowerCase().includes('menunggu')) statusClass = 'status-menunggu';
    else if (item.status.toLowerCase().includes('ditindaklanjuti')) statusClass = 'status-ditindaklanjuti';
    else if (item.status.toLowerCase().includes('selesai')) statusClass = 'status-selesai';

    return `
      <tr>
        <td>${item.no}</td>
        <td>${item.sekolah}</td>
        <td>${item.deskripsi}</td>
        <td class="${statusClass}">${item.status}</td>
      </tr>
    `;
  }).join('');
}

renderLaporan();

const ctx = document.getElementById('pencairanChart').getContext('2d');
const pencairanChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ['Sudah Cair', 'Dalam Proses', 'Belum Cair'],
    datasets: [{
      label: 'Status Pencairan Dana',
      data: [70, 20, 10],
      backgroundColor: [
        'rgba(54, 162, 235, 0.7)',   // Biru muda (Sudah Cair)
        'rgba(255, 206, 86, 0.7)',   // Kuning (Dalam Proses)
        'rgba(255, 99, 132, 0.7)'    // Merah muda (Belum Cair)
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(255, 99, 132, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'bottom',
        labels: {
          font: {
            size: 14
          }
        }
      },
      tooltip: {
        enabled: true,
        callbacks: {
          label: function(context) {
            let label = context.label || '';
            let value = context.parsed || 0;
            return label + ': ' + value + '%';
          }
        }
      }
    }
  }
});

// Data dummy sekolah
let sekolahData = [
  { id: 1, nama: "SMA Negeri 1", npsn: "1234567890", alamat: "Jl. Merdeka No.1" },
  { id: 2, nama: "SMP Negeri 2", npsn: "0987654321", alamat: "Jl. Sudirman No.2" }
];

// Referensi elemen
const tbodySekolah = document.querySelector("#kelola-sekolah tbody");
const btnTambah = document.getElementById("btnTambahSekolah");
const modal = document.getElementById("modalSekolah");
const closeModalBtn = modal.querySelector(".close");
const modalTitle = document.getElementById("modalTitle");
const formSekolah = document.getElementById("formSekolah");
const inputNama = document.getElementById("namaSekolah");
const inputNPSN = document.getElementById("npsnSekolah");
const inputAlamat = document.getElementById("alamatSekolah");
const searchInput = document.getElementById("searchSekolah");
const btnSearch = document.getElementById("btnSearch");

let editMode = false;
let editId = null;

// Render data ke tabel (opsional filter)
function renderTable(filter = "") {
  let dataFiltered = sekolahData.filter(item => 
    item.nama.toLowerCase().includes(filter.toLowerCase()) ||
    item.npsn.includes(filter) ||
    item.alamat.toLowerCase().includes(filter.toLowerCase())
  );

  tbodySekolah.innerHTML = dataFiltered.map((item, index) => `
    <tr>
      <td>${index + 1}</td>
      <td>${item.nama}</td>
      <td>${item.npsn}</td>
      <td>${item.alamat}</td>
      <td>
        <button class="btn-aksi btn-edit" data-id="${item.id}"><i class="fas fa-edit"></i></button>
        <button class="btn-aksi btn-delete" data-id="${item.id}"><i class="fas fa-trash"></i></button>
      </td>
    </tr>
  `).join("");

  addEventListeners();
}

// Buka modal tambah/edit
function openModal(edit = false, data = null) {
  modal.classList.remove("hidden");
  editMode = edit;

  if(edit && data) {
    modalTitle.textContent = "Edit Sekolah";
    inputNama.value = data.nama;
    inputNPSN.value = data.npsn;
    inputAlamat.value = data.alamat;
    editId = data.id;
  } else {
    modalTitle.textContent = "Tambah Sekolah";
    formSekolah.reset();
    editId = null;
  }
}

// Tutup modal
function closeModal() {
  modal.classList.add("hidden");
}

// Tambah / Edit submit
formSekolah.addEventListener("submit", e => {
  e.preventDefault();

  const nama = inputNama.value.trim();
  const npsn = inputNPSN.value.trim();
  const alamat = inputAlamat.value.trim();

  if(!nama || !npsn || !alamat) {
    alert("Semua field harus diisi!");
    return;
  }

  if(editMode) {
    // Update data
    const index = sekolahData.findIndex(item => item.id === editId);
    if(index !== -1) {
      sekolahData[index] = { id: editId, nama, npsn, alamat };
      alert("Data berhasil diupdate!");
    }
  } else {
    // Tambah data baru
    const newId = sekolahData.length ? Math.max(...sekolahData.map(d => d.id)) + 1 : 1;
    sekolahData.push({ id: newId, nama, npsn, alamat });
    alert("Data berhasil ditambahkan!");
  }

  renderTable();
  closeModal();
});

// Close modal tombol silang
closeModalBtn.addEventListener("click", closeModal);

// Tombol tambah sekolah klik
btnTambah.addEventListener("click", () => openModal(false));

// Validasi input NPSN hanya angka
inputNPSN.addEventListener("input", () => {
  inputNPSN.value = inputNPSN.value.replace(/[^0-9]/g, '');
});

// Event click tombol edit dan hapus
function addEventListeners() {
  document.querySelectorAll(".btn-edit").forEach(btn => {
    btn.onclick = () => {
      const id = parseInt(btn.getAttribute("data-id"));
      const sekolah = sekolahData.find(item => item.id === id);
      if(sekolah) openModal(true, sekolah);
    };
  });

  document.querySelectorAll(".btn-delete").forEach(btn => {
    btn.onclick = () => {
      const id = parseInt(btn.getAttribute("data-id"));
      if(confirm("Yakin ingin menghapus sekolah ini?")) {
        sekolahData = sekolahData.filter(item => item.id !== id);
        renderTable();
      }
    };
  });
}

// Fungsi pencarian
function searchSekolah() {
  const filter = searchInput.value.trim();
let dataFiltered = sekolahData.filter(item => 
  item.nama.toLowerCase().includes(filter.toLowerCase()) ||
  item.npsn.includes(filter) ||
  item.alamat.toLowerCase().includes(filter.toLowerCase())
);

  renderTable(filter);
}

btnSearch.addEventListener("click", searchSekolah);

// Render awal
renderTable();

const headerTitle = document.querySelector('header h1');

sidebarItems.forEach(item => {
  item.addEventListener('click', e => {
    e.preventDefault();
    sidebarItems.forEach(i => i.classList.remove('active'));
    item.classList.add('active');

    // Toggle sections
    const sectionId = item.getAttribute('data-section');
    sections.forEach(sec => {
      sec.classList.toggle('active', sec.id === sectionId);
    });

    // Ganti judul header sesuai section
    switch (sectionId) {
      case 'dashboard':
        headerTitle.style.display = 'block';
        headerTitle.textContent = 'Dashboard Pemerintah';
        break;
      case 'kelola-sekolah':
        headerTitle.style.display = 'block';
        headerTitle.textContent = 'Kelola Sekolah';
        break;
      case 'upload-penerima':
        headerTitle.style.display = 'block';
        headerTitle.textContent = 'Upload Data Penerima';
        break;
      case 'kelola-pencairan':
        headerTitle.style.display = 'block';
        headerTitle.textContent = 'Kelola Pencairan';
        break;
      case 'laporan-siswa':
        headerTitle.style.display = 'block';
        headerTitle.textContent = 'Laporan Siswa';
        break;
      case 'tindak-lanjut':
        headerTitle.style.display = 'block';
        headerTitle.textContent = 'Tindak Lanjut';
        break;
      case 'transparansi':
        headerTitle.style.display = 'block';
        headerTitle.textContent = 'Transparansi';
        break;
      default:
        headerTitle.style.display = 'none';
    }
  });
});

