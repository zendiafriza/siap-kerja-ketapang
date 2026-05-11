// Dynamic Data Generator for Siap Lulus Ketapang
// Generates realistic Ketapang-specific jobs, students, schools, LPK programs

const KETAPANG_DATA = {
  kecamatan: ['Muara Pawan', 'Delta Pawan', 'Benua Kayong', 'Jelmaga', 'Sungai Laur'],
  sekolah: [
    {nama: 'SMKN 1 Ketapang', kec: 'Muara Pawan', siswa: 680, jurusan: ['ATP', 'TKR', 'Akuntansi', 'TKJ'], rating: 4.8},
    {nama: 'SMKN 2 Ketapang', kec: 'Delta Pawan', siswa: 540, jurusan: ['TKJ', 'Teknik Mesin', 'Elektro'], rating: 4.5},
    {nama: 'SMK Kesehatan Mulia', kec: 'Muara Pawan', siswa: 320, jurusan: ['Keperawatan', 'Farmasi'], rating: 4.2},
    {nama: 'SMK PGRI Ketapang', kec: 'Benua Kayong', siswa: 410, jurusan: ['ATP', 'Mekanisasi'], rating: 4.3},
    {nama: 'SMAN 1 Ketapang', kec: 'Delta Pawan', siswa: 720, jurusan: ['IPA', 'IPS'], rating: 4.7},
    // Add more...
  ],
  perusahaan: [
    {nama: 'Cargill Ketapang Mill', sektor: 'Sawit', kec: 'Muara Pawan', lowongan: 120, verified: true},
    {nama: 'Puskesmas Muara Pawan', sektor: 'Kesehatan', kec: 'Muara Pawan', lowongan: 45, verified: true},
    {nama: 'BUMDes Sejahtera Delta', sektor: 'Admin', kec: 'Delta Pawan', lowongan: 28, verified: true},
    {nama: 'CV Maju Bersama Teknik', sektor: 'Teknik', kec: 'Benua Kayong', lowongan: 35, verified: false},
    {nama: 'Koperasi Perempuan Karya', sektor: 'UMKM', kec: 'Delta Pawan', lowongan: 22, verified: true},
  ],
  lpk: [
    {nama: 'LPK Sawit & Mekanisasi Cargill', durasi: '3 bulan', jurusan: ['ATP', 'TKR'], kapasitas: 40, serapan: 87},
    {nama: 'BLK Digital & Admin Desa', durasi: '2 bulan', jurusan: ['TKJ', 'IPS'], kapasitas: 30, serapan: 75},
    {nama: 'LPK Caregiver Komunitas', durasi: '4 bulan', jurusan: ['Keperawatan'], kapasitas: 25, serapan: 68},
    {nama: 'Bootcamp UMKM Koperasi', durasi: '6 minggu', jurusan: ['Semua'], kapasitas: 15, serapan: 62},
  ]
};

class DataManager {
  static generateJobs(count = 50) {
    const sectors = {
      sawit: {posisi: ['Operator Kebun', 'Mandor Panen', 'Teknisi Pupuk', 'Monitoring RSPO'], gaji: '1.8M-3M', skills: ['ATP', 'K3', 'RSPO']},
      kesehatan: {posisi: ['Asisten Bidan', 'Kader Posyandu', 'Perawat Komunitas'], gaji: '1.5M-2.5M', skills: ['Keperawatan', 'P3K']},
      tik: {posisi: ['Admin SIPADES', 'Operator Drone Agri', 'Media BUMDes'], gaji: '1.4M-2.2M', skills: ['TKJ', 'SIPADES', 'Excel']},
      teknik: {posisi: ['Mekanik Traktor', 'Teknisi Pabrik CPO', 'K3 Lapangan'], gaji: '2M-3.5M', skills: ['TKR', 'Mesin']},
      admin: {posisi: ['Bendahara BUMDes', 'Staf Dana Desa'], gaji: '1.3M-2M', skills: ['Akuntansi', 'Admin Desa']},
      umkm: {posisi: ['Pengolahan Hasil', 'Pemasaran Digital'], gaji: 'Negosiasi', skills: ['Produksi', 'Marketplace']}
    };

    return Array.from({length: count}, (_, i) => {
      const sectorKeys = Object.keys(sectors);
      const sector = sectorKeys[Math.floor(Math.random() * sectorKeys.length)];
      const kec = KETAPANG_DATA.kecamatan[Math.floor(Math.random() * KETAPANG_DATA.kecamatan.length)];
      const perusahaans = KETAPANG_DATA.perusahaan.filter(p => p.sektor === sector || !p.sektor);
      const perusahaan = perusahaans.length ? perusahaans[0].nama : 'Perusahaan Lokal';

      return {
        id: 'job_' + Date.now() + '_' + i,
        title: sectors[sector].posisi[Math.floor(Math.random() * sectors[sector].posisi.length)],
        company: perusahaan,
        sektor: sector,
        kecamatan: kec,
        gaji: sectors[sector].gaji,
        tipe: ['Magang', 'Full-time', 'Part-time'][Math.floor(Math.random() * 3)],
        matchScore: Math.floor(Math.random() * 35) + 65,
        views: Math.floor(Math.random() * 200) + 20,
        pelamar: Math.floor(Math.random() * 25) + 2,
        deadline: new Date(Date.now() + Math.random() * 30 * 24 * 60 * 60 * 1000).toLocaleDateString('id-ID'),
        deskripsi: `Posisi ${sectors[sector].posisi[0]} di ${kec}. ${sectors[sector].skills.join(', ')}. ${Math.floor(Math.random() * 100) + 50}% kandidat terbaik.`,
        tags: sectors[sector].skills.slice(0, Math.floor(Math.random() * 3) + 1),
        featured: Math.random() > 0.7
      };
    });
  }

  static generateStudents(count = 100) {
    const jurusan = ['ATP', 'TKJ', 'TKR', 'Keperawatan', 'Akuntansi', 'IPA', 'IPS'];
    const names = ['Aldi Ramadan', 'Sari Dewi', 'Budi Santoso', 'Fitri Nurhayati', 'Rudi Hartono', 'Nanda Rahayu', 'Fahri Hidayat'];

    return Array.from({length: count}, (_, i) => ({
      id: 'student_' + Date.now() + '_' + i,
      nama: names[Math.floor(Math.random() * names.length)] + ' ' + (i + 1),
      jurusan: jurusan[Math.floor(Math.random() * jurusan.length)],
      sekolah: KETAPANG_DATA.sekolah[Math.floor(Math.random() * KETAPANG_DATA.sekolah.length)].nama,
      kecamatan: KETAPANG_DATA.kecamatan[Math.floor(Math.random() * 5)],
      matchScore: Math.floor(Math.random() * 40) + 60,
      lamaran: Math.floor(Math.random() * 5),
      skills: [jurusan[Math.floor(Math.random() * jurusan.length)], 'K3', 'RSPO'][Math.floor(Math.random() * 3)],
      foto: `https://ui-avatars.com/api/?name=${encodeURIComponent(names[Math.floor(Math.random() * names.length)])}&background=1B8C6E&color=fff&size=128&bold=true`
    }));
  }

  static getAllJobs() {
    if (!localStorage.jobs) {
      const jobs = this.generateJobs(300);
      localStorage.setItem('jobs', JSON.stringify(jobs));
    }
    return JSON.parse(localStorage.getItem('jobs') || '[]');
  }

  static getJobsByFilter(filters = {}) {
    let jobs = this.getAllJobs();
    if (filters.sektor) jobs = jobs.filter(j => j.sektor === filters.sektor);
    if (filters.kecamatan) jobs = jobs.filter(j => j.kecamatan === filters.kecamatan);
    if (filters.minMatch) jobs = jobs.filter(j => j.matchScore >= filters.minMatch);
    if (filters.tipe) jobs = jobs.filter(j => j.tipe === filters.tipe);
    return jobs.slice(0, 50); // Limit results
  }
}

// Export for global use
window.DataManager = DataManager;
window.KETAPANG_DATA = KETAPANG_DATA;

