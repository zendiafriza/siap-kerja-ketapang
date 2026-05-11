<style>
    /* Sembunyikan semua section secara default */
    .sec { display: none !important; }
    /* Hanya tampilkan section yang memiliki class active */
    .sec.active { display: block !important; }
    
    /* Indikator menu aktif di navbar */
    .tbn.active { 
        color: #fff !important; 
        border-bottom: 3px solid #fff; 
        opacity: 1;
    }
</style>

<script>
    function showSec(targetId) {
        // Normalisasi ID agar fleksibel (bisa dipanggil dengan 'lms' atau 'sec-lms')
        let sectionId = targetId.startsWith('sec-') ? targetId : 'sec-' + targetId;
        let btnId = targetId.startsWith('sec-') ? targetId.replace('sec-', 'tn-') : 'tn-' + targetId;

        const targetElement = document.getElementById(sectionId);
        
        if (targetElement) {
            // 1. Sembunyikan semua section dengan menghapus class active
            document.querySelectorAll('.sec').forEach(section => {
                section.classList.remove('active');
            });

            // 2. Tampilkan section yang dipilih
            targetElement.classList.add('active');

            // 3. Reset warna semua tombol navigasi
            document.querySelectorAll('.tbn').forEach(btn => {
                btn.classList.remove('active');
            });

            // 4. Nyalakan tombol navigasi yang sesuai
            const activeBtn = document.getElementById(btnId);
            if (activeBtn) {
                activeBtn.classList.add('active');
            }

            // 5. Kembali ke posisi atas halaman
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            console.error("Elemen tidak ditemukan: " + sectionId);
        }
    }

    // Jalankan pengecekan saat halaman selesai dimuat
    document.addEventListener("DOMContentLoaded", function() {
        // Jika tidak ada yang aktif, aktifkan menu kerja
        if (!document.querySelector('.sec.active')) {
            showSec('sec-kerja');
        }
    });
</script>