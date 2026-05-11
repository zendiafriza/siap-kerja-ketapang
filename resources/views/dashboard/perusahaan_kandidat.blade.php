@extends('dashboard.index')

@section('konten_tengah')
<div style="font-family: 'Inter', 'Nunito', sans-serif; color: #1e293b;">
    
    <!-- HEADER & STATS -->
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 32px;">
        <div>
            <h2 style="margin: 0 0 4px 0; color: #0f172a; font-size: 24px; font-weight: 900; font-family: Georgia, serif;">Manajemen Kandidat</h2>
            <p style="margin: 0; color: #64748b; font-size: 14px;">Kelola pelamar, tinjau CV, dan tentukan jadwal interview.</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <div style="background: white; padding: 12px 20px; border-radius: 16px; border: 1px solid #e2e8f0; text-align: center; min-width: 120px;">
                <div style="font-size: 20px; font-weight: 900; color: #0f172a;">{{ $totalPelamar }}</div>
                <div style="font-size: 10px; font-weight: 800; color: #64748b; text-transform: uppercase;">Total Pelamar</div>
            </div>
            <div style="background: white; padding: 12px 20px; border-radius: 16px; border: 1px solid #e2e8f0; text-align: center; min-width: 120px; border-bottom: 4px solid #10b981;">
                <div style="font-size: 20px; font-weight: 900; color: #10b981;">{{ $interviewCount }}</div>
                <div style="font-size: 10px; font-weight: 800; color: #64748b; text-transform: uppercase;">Interview</div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #10b981; color: #065f46; padding: 16px; border-radius: 16px; margin-bottom: 24px; font-weight: 700; font-size: 14px;">
            ✨ {{ session('success') }}
        </div>
    @endif

    <!-- FILTER PER LOWONGAN -->
    <div style="background: white; padding: 20px; border-radius: 20px; border: 1px solid #e2e8f0; margin-bottom: 32px; display: flex; align-items: center; gap: 20px;">
        <div style="font-weight: 800; font-size: 14px; color: #0f172a;">Filter Lowongan:</div>
        <select id="job-filter" onchange="filterApplicants(this.value)" style="flex: 1; padding: 12px; border-radius: 12px; border: 1px solid #cbd5e1; font-size: 14px; outline: none; background: #f8fafc; font-weight: 600;">
            <option value="all">Semua Lowongan Aktif</option>
            @foreach($jobs as $job)
                <option value="{{ $job->id }}">{{ $job->title }} ({{ $job->applications_count ?? $applications->where('job_id', $job->id)->count() }} Pelamar)</option>
            @endforeach
        </select>
    </div>

    <!-- APPLICANTS LIST -->
    @if($applications->count() > 0)
        <div id="applicants-container" style="display: grid; grid-template-columns: 1fr; gap: 16px;">
            @foreach($applications as $app)
                <div class="applicant-card" data-job-id="{{ $app->job_id }}" style="background: white; border-radius: 24px; border: 1px solid #e2e8f0; padding: 24px; display: flex; align-items: center; justify-content: space-between; transition: 0.3s;" onmouseover="this.style.borderColor='#10b981'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.02)'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                    
                    <!-- LEFT: Profile Info -->
                    <div style="display: flex; align-items: center; gap: 20px; flex: 1;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 20px; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 900; font-family: Georgia, serif; flex-shrink: 0;">
                            {{ strtoupper(substr($app->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                                <h3 style="margin: 0; font-size: 17px; font-weight: 800; color: #0f172a;">{{ $app->user->name }}</h3>
                                <span style="background: #f1f5f9; color: #475569; font-size: 10px; font-weight: 800; padding: 4px 8px; border-radius: 6px; text-transform: uppercase;">{{ $app->job->title }}</span>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 4px; font-size: 13px; color: #64748b; font-weight: 600;">
                                @php
                                    $talentMeta = $app->user->profile_metadata ?? [];
                                    $firstEdu = !empty($talentMeta['pendidikan']) ? $talentMeta['pendidikan'][0] : null;
                                    $domisili = $talentMeta['domisili'] ?? 'Ketapang, Kalbar';
                                @endphp
                                
                                <div style="display: flex; align-items: center; gap: 8px; color: #1e293b;">
                                    <span>📧</span> {{ $app->user->email }}
                                </div>

                                @if($firstEdu)
                                    <div style="display: flex; align-items: center; gap: 8px; color: #4338ca;">
                                        <span>🎓</span>
                                        <span>Lulusan {{ $firstEdu['institusi'] ?? 'Institusi' }} ({{ $firstEdu['jurusan'] ?? 'Jurusan' }})</span>
                                    </div>
                                @endif

                                <div style="display: flex; align-items: center; gap: 8px; color: #64748b;">
                                    <span>📍</span>
                                    <span>Domisili: {{ $domisili }}</span>
                                </div>

                                <div style="display: flex; align-items: center; gap: 8px; margin-top: 4px; color: #94a3b8; font-size: 11px;">
                                    <span>📅</span> Melamar pada {{ $app->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MIDDLE: Status & CV -->
                    <div style="display: flex; align-items: center; gap: 24px; margin: 0 40px;">
                        <div style="text-align: right;">
                            <div style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 4px;">Status</div>
                            <div style="display: inline-block; padding: 6px 12px; border-radius: 10px; background: {{ $app->statusColor() }}20; color: {{ $app->statusColor() }}; font-size: 12px; font-weight: 800; border: 1px solid {{ $app->statusColor() }}40;">
                                {{ $app->statusLabel() }}
                            </div>
                        </div>

                        <div style="text-align: center;">
                            <div style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 4px;">CV/Resume</div>
                            @if($app->user->cv_path)
                                <a href="{{ route('perusahaan.aplikasi.cv', $app->id) }}" style="display: flex; align-items: center; gap: 6px; color: #0f172a; text-decoration: none; font-weight: 800; font-size: 13px; background: #f8fafc; padding: 8px 12px; border-radius: 10px; border: 1px solid #e2e8f0; transition: 0.2s;" onmouseover="this.style.background='#fff'; this.style.borderColor='#10b981'">
                                    <span>📄</span> Download
                                </a>
                            @else
                                <span style="font-size: 12px; color: #cbd5e1; font-weight: 700;">Tidak Ada CV</span>
                            @endif
                        </div>
                    </div>

                    <!-- RIGHT: Actions -->
                    <div style="display: flex; gap: 10px;">
                        <button onclick="openInterviewModal({{ $app->id }}, '{{ addslashes($app->user->name) }}', '{{ addslashes($app->job->title) }}')" style="background: #0f172a; color: white; border: none; padding: 12px 20px; border-radius: 14px; font-weight: 800; font-size: 13px; cursor: pointer; transition: 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                            Set Interview
                        </button>
                        
                        <div style="position: relative;">
                            <button onclick="toggleActionMenu({{ $app->id }})" style="background: white; border: 1px solid #e2e8f0; padding: 12px; border-radius: 14px; cursor: pointer; transition: 0.2s;">
                                ⚙️
                            </button>
                            <div id="action-menu-{{ $app->id }}" style="display: none; position: absolute; top: 100%; right: 0; margin-top: 8px; width: 200px; background: white; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.1); z-index: 100; overflow: hidden;">
                                <form action="{{ route('perusahaan.aplikasi.status', $app->id) }}" method="POST">
                                    @csrf
                                    <button name="status" value="review" style="width: 100%; text-align: left; padding: 12px 16px; border: none; background: none; font-size: 13px; font-weight: 700; color: #1e293b; cursor: pointer;" onmouseover="this.style.background='#f8fafc'">Mark as Reviewing</button>
                                    <button name="status" value="diterima" style="width: 100%; text-align: left; padding: 12px 16px; border: none; background: none; font-size: 13px; font-weight: 700; color: #10b981; cursor: pointer; border-top: 1px solid #f1f5f9;" onmouseover="this.style.background='#f0fdf4'">Terima Kandidat</button>
                                    <button name="status" value="ditolak" style="width: 100%; text-align: left; padding: 12px 16px; border: none; background: none; font-size: 13px; font-weight: 700; color: #ef4444; cursor: pointer; border-top: 1px solid #f1f5f9;" onmouseover="this.style.background='#fef2f2'">Tolak Kandidat</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="background: #fff; border-radius: 24px; padding: 60px; text-align: center; color: #64748b; border: 2px dashed #cbd5e1;">
            <div style="font-size: 56px; margin-bottom: 16px;">👥</div>
            <h2 style="color: #0f172a; margin-bottom: 8px; font-weight: 900;">Belum Ada Pelamar</h2>
            <p style="font-size: 14px;">Lowongan Anda belum menerima lamaran. Pastikan deskripsi lowongan sudah menarik.</p>
        </div>
    @endif

    <!-- TALENT DATABASE TABLE -->
    <div style="margin-top: 60px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <div>
                <h2 style="margin: 0 0 4px 0; color: #0f172a; font-size: 20px; font-weight: 900; font-family: Georgia, serif;">Database Seluruh Pencari Kerja</h2>
                <p style="margin: 0; color: #64748b; font-size: 13px;">Tinjau kelengkapan profil dari seluruh database kami.</p>
            </div>
        </div>

        <div style="background: white; border-radius: 24px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 16px 24px; font-size: 12px; font-weight: 800; color: #475569; text-transform: uppercase;">Nama Kandidat</th>
                        <th style="padding: 16px 24px; font-size: 12px; font-weight: 800; color: #475569; text-transform: uppercase; text-align: center;">Data Pribadi</th>
                        <th style="padding: 16px 24px; font-size: 12px; font-weight: 800; color: #475569; text-transform: uppercase; text-align: center;">Pengalaman</th>
                        <th style="padding: 16px 24px; font-size: 12px; font-weight: 800; color: #475569; text-transform: uppercase; text-align: center;">Pendidikan</th>
                        <th style="padding: 16px 24px; font-size: 12px; font-weight: 800; color: #475569; text-transform: uppercase; text-align: center;">Upload CV</th>
                        <th style="padding: 16px 24px; font-size: 12px; font-weight: 800; color: #475569; text-transform: uppercase; text-align: center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($talentPool as $talent)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: 0.2s;" onmouseover="this.style.background='#fcfdfd'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 16px 24px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 32px; height: 32px; background: #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 800; color: #475569;">
                                    {{ strtoupper(substr($talent->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-size: 14px; font-weight: 700; color: #0f172a;">{{ $talent->name }}</div>
                                    <div style="font-size: 11px; color: #94a3b8;">{{ $talent->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 16px 24px; text-align: center;">
                            @if($talent->hasPersonalData())
                                <span title="Lengkap" style="color: #10b981; font-size: 18px;">✅</span>
                            @else
                                <span title="Belum Lengkap" style="color: #cbd5e1; font-size: 18px;">⭕</span>
                            @endif
                        </td>
                        <td style="padding: 16px 24px; text-align: center;">
                            @if($talent->hasExperience())
                                <span title="Ada Pengalaman" style="color: #10b981; font-size: 18px;">✅</span>
                            @else
                                <span title="Belum Isi" style="color: #cbd5e1; font-size: 18px;">⭕</span>
                            @endif
                        </td>
                        <td style="padding: 16px 24px; text-align: center;">
                            @if($talent->hasEducation())
                                <span title="Ada Riwayat" style="color: #10b981; font-size: 18px;">✅</span>
                            @else
                                <span title="Belum Isi" style="color: #cbd5e1; font-size: 18px;">⭕</span>
                            @endif
                        </td>
                        <td style="padding: 16px 24px; text-align: center;">
                            @if($talent->hasCvUploaded())
                                <span title="Sudah Upload" style="color: #10b981; font-size: 18px;">✅</span>
                            @else
                                <span title="Belum Upload" style="color: #ef4444; font-size: 18px;">❌</span>
                            @endif
                        </td>
                        <td style="padding: 16px 24px; text-align: center;">
                            @php
                                $isComplete = $talent->hasPersonalData() && $talent->hasExperience() && $talent->hasEducation() && $talent->hasCvUploaded();
                            @endphp
                            @if($isComplete)
                                <span style="background: #ecfdf5; color: #059669; font-size: 10px; font-weight: 800; padding: 4px 10px; border-radius: 20px; text-transform: uppercase; border: 1px solid #dcfce7;">Siap Kerja</span>
                            @else
                                <span style="background: #fff7ed; color: #c2410c; font-size: 10px; font-weight: 800; padding: 4px 10px; border-radius: 20px; text-transform: uppercase; border: 1px solid #ffedd5;">Belum Siap</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- INTERVIEW MODAL -->
<div id="interview-modal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(8px); z-index: 1000; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; width: 100%; max-width: 500px; border-radius: 32px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
        <div style="background: #0f172a; padding: 32px; color: white;">
            <h3 style="margin: 0 0 8px 0; font-size: 20px; font-weight: 900; font-family: Georgia, serif;">Tentukan Jadwal Interview</h3>
            <p style="margin: 0; font-size: 13px; color: #94a3b8;">Undang <span id="modal-candidate-name" style="color: #10b981; font-weight: 800;"></span> untuk interview posisi <span id="modal-job-title" style="color: #fff; font-weight: 700;"></span>.</p>
        </div>
        <form id="interview-form" method="POST" style="padding: 32px;">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 800; color: #475569; margin-bottom: 8px; text-transform: uppercase;">Tanggal</label>
                    <input type="date" name="interview_date" required style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 14px; outline: none; background: #f8fafc;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 800; color: #475569; margin-bottom: 8px; text-transform: uppercase;">Jam</label>
                    <input type="time" name="interview_time" required style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 14px; outline: none; background: #f8fafc;">
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 12px; font-weight: 800; color: #475569; margin-bottom: 8px; text-transform: uppercase;">Lokasi / Link Meeting</label>
                <input type="text" name="interview_location" placeholder="Contoh: Kantor Ketapang Lt. 2 atau Link Zoom" style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 14px; outline: none; background: #f8fafc;">
            </div>

            <div style="margin-bottom: 32px;">
                <label style="display: block; font-size: 12px; font-weight: 800; color: #475569; margin-bottom: 8px; text-transform: uppercase;">Catatan Tambahan</label>
                <textarea name="interview_note" rows="3" placeholder="Pesan untuk kandidat (opsional)..." style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 14px; outline: none; background: #f8fafc; resize: none;"></textarea>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="button" onclick="closeInterviewModal()" style="flex: 1; padding: 14px; border-radius: 16px; border: 1px solid #e2e8f0; background: white; color: #475569; font-weight: 800; cursor: pointer;">Batal</button>
                <button type="submit" style="flex: 1.5; padding: 14px; border-radius: 16px; border: none; background: #10b981; color: white; font-weight: 800; cursor: pointer; box-shadow: 0 8px 16px rgba(16, 185, 129, 0.2);">Simpan & Kirim Email</button>
            </div>
        </form>
    </div>
</div>

<script>
    function filterApplicants(jobId) {
        const cards = document.querySelectorAll('.applicant-card');
        cards.forEach(card => {
            if (jobId === 'all' || card.dataset.jobId === jobId) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function toggleActionMenu(id) {
        const menu = document.getElementById(`action-menu-${id}`);
        const allMenus = document.querySelectorAll('[id^="action-menu-"]');
        allMenus.forEach(m => {
            if (m.id !== `action-menu-${id}`) m.style.display = 'none';
        });
        menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    }

    function openInterviewModal(appId, name, jobTitle) {
        const modal = document.getElementById('interview-modal');
        const form = document.getElementById('interview-form');
        document.getElementById('modal-candidate-name').innerText = name;
        document.getElementById('modal-job-title').innerText = jobTitle;
        form.action = `/dashboard/perusahaan/aplikasi/${appId}/interview`;
        modal.style.display = 'flex';
    }

    function closeInterviewModal() {
        document.getElementById('interview-modal').style.display = 'none';
    }

    // Close menus/modals on click outside
    window.onclick = function(event) {
        if (event.target.id === 'interview-modal') {
            closeInterviewModal();
        }
        if (!event.target.closest('[id^="action-menu-"]') && !event.target.closest('button')) {
            document.querySelectorAll('[id^="action-menu-"]').forEach(m => m.style.display = 'none');
        }
    }
</script>
@endsection
