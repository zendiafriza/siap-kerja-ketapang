<!-- Modal Profil Kandidat -->
<div id="modal-profil-kandidat" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: white; padding: 30px; border-radius: 16px; width: 450px; max-width: 90%; position: relative;">
        <button onclick="document.getElementById('modal-profil-kandidat').style.display='none'" style="position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 24px; color: #94a3b8; cursor: pointer;">&times;</button>
        
        <div style="text-align: center; margin-bottom: 24px;">
            <div id="modal-kandidat-inisial" style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981, #3b82f6); border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: bold; margin: 0 auto 16px auto;">
                --
            </div>
            <h2 id="modal-kandidat-nama" style="margin: 0 0 4px 0; color: #0f172a; font-size: 22px; font-family: 'Nunito', sans-serif;">Nama Kandidat</h2>
            <p id="modal-kandidat-jurusan" style="margin: 0; color: #64748b; font-size: 14px; font-family: 'Nunito', sans-serif;">Jurusan Umum</p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px; font-family: 'Nunito', sans-serif;">
            <div style="background: #f8fafc; padding: 16px; border-radius: 12px; text-align: center; border: 1px solid #e2e8f0;">
                <div style="font-size: 12px; color: #64748b; font-weight: bold; margin-bottom: 4px;">MATCH SCORE</div>
                <div id="modal-kandidat-match" style="font-size: 28px; font-weight: 900; color: #10b981;">0%</div>
                <div style="font-size: 10px; color: #10b981;">Cocok dgn Lowongan</div>
            </div>
            <div style="background: #f8fafc; padding: 16px; border-radius: 12px; text-align: center; border: 1px solid #e2e8f0;">
                <div style="font-size: 12px; color: #64748b; font-weight: bold; margin-bottom: 4px;">PENGALAMAN</div>
                <div id="modal-kandidat-xp" style="font-size: 28px; font-weight: 900; color: #f59e0b;">0</div>
                <div style="font-size: 10px; color: #f59e0b;">Total XP</div>
            </div>
        </div>

        <div style="margin-bottom: 24px; font-family: 'Nunito', sans-serif;">
            <div style="font-size: 12px; font-weight: bold; color: #64748b; margin-bottom: 12px;">KEAHLIAN TERKAIT</div>
            <div id="modal-kandidat-skills" style="display: flex; flex-wrap: wrap; gap: 8px;">
                <!-- Skills will be injected here -->
            </div>
        </div>

        <div style="display: flex; gap: 12px; font-family: 'Nunito', sans-serif;">
            <button onclick="tolakKandidat()" style="flex: 1; background: white; border: 1px solid #fee2e2; color: #ef4444; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='white'">
                ❌ Tolak
            </button>
            <button onclick="alert('Fitur Unduh CV sedang dikembangkan.')" style="flex: 1; background: white; border: 1px solid #cbd5e1; color: #475569; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                📄 CV
            </button>
            <button onclick="terimaKandidat()" style="flex: 1.5; background: #10b981; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#10b981'">
                ✉️ Wawancara
            </button>
        </div>
    </div>
</div>

<script>
    let currentKandidatCardId = null;

    function openKandidatModal(nama, jurusan, matchScore, xp, cardId = null) {
        currentKandidatCardId = cardId;
        
        // Set basic info
        document.getElementById('modal-kandidat-nama').innerText = nama;
        document.getElementById('modal-kandidat-jurusan').innerText = jurusan || 'Pencari Kerja';
        document.getElementById('modal-kandidat-match').innerText = matchScore + '%';
        document.getElementById('modal-kandidat-xp').innerText = xp + ' XP';
        
        // Generate inisial
        const inisial = nama.substring(0, 2).toUpperCase();
        document.getElementById('modal-kandidat-inisial').innerText = inisial;

        // Generate dummy skills based on jurusan/match score
        const skillsContainer = document.getElementById('modal-kandidat-skills');
        skillsContainer.innerHTML = ''; // clear existing
        
        const possibleSkills = [
            'Disiplin Kerja', 'Kerja Tim', 'Komunikasi', 'Pemecahan Masalah',
            'Sertifikasi Dasar', 'K3 Lingkungan', 'Operator Alat', 'Pengolahan Data',
            'Ketekunan', 'Manajemen Waktu'
        ];
        
        // Pick 3-4 random skills to make it look realistic
        const numSkills = Math.floor(Math.random() * 2) + 3; 
        const shuffled = possibleSkills.sort(() => 0.5 - Math.random());
        const selectedSkills = shuffled.slice(0, numSkills);
        
        selectedSkills.forEach(skill => {
            const span = document.createElement('span');
            span.innerText = skill;
            span.style.background = '#e0f2fe';
            span.style.color = '#0284c7';
            span.style.padding = '4px 12px';
            span.style.borderRadius = '20px';
            span.style.fontSize = '12px';
            span.style.fontWeight = 'bold';
            skillsContainer.appendChild(span);
        });

        // Tampilkan modal
        document.getElementById('modal-profil-kandidat').style.display = 'flex';
    }

    function tolakKandidat() {
        const nama = document.getElementById('modal-kandidat-nama').innerText;
        alert(`Kandidat ${nama} telah ditolak dan akan dihapus dari daftar Anda.`);
        document.getElementById('modal-profil-kandidat').style.display = 'none';
        
        // Hide the card from the UI
        if (currentKandidatCardId) {
            const card = document.getElementById(currentKandidatCardId);
            if (card) {
                card.style.display = 'none';
            }
        }
    }

    function terimaKandidat() {
        const nama = document.getElementById('modal-kandidat-nama').innerText;
        alert(`Undangan wawancara berhasil dikirimkan ke ${nama}.`);
        document.getElementById('modal-profil-kandidat').style.display = 'none';
        
        // Optionally update UI for accepted candidate
        if (currentKandidatCardId) {
            const card = document.getElementById(currentKandidatCardId);
            if (card) {
                card.style.border = '2px solid #10b981';
                card.style.background = '#ecfdf5';
            }
        }
    }
</script>
