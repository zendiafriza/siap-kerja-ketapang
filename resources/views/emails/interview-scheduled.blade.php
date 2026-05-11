<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Interview — Siap Kerja Ketapang</title>
</head>
<body style="margin:0; padding:0; background:#f1f5f9; font-family:'Segoe UI', Arial, sans-serif;">
    <div style="max-width:600px; margin:40px auto; background:#fff; border-radius:24px; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,0.1);">

        <!-- HEADER -->
        <div style="background:linear-gradient(135deg,#06182C 0%,#0A2240 100%); padding:48px 40px; text-align:center; position:relative;">
            <div style="display:inline-flex; align-items:center; gap:12px; margin-bottom:24px;">
                <div style="width:44px; height:44px; background:#00B37E; clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%); display:inline-block;"></div>
                <span style="font-size:20px; font-weight:800; color:#fff;">Siap Kerja Ketapang</span>
            </div>
            <div style="font-size:48px; margin-bottom:16px;">🎉</div>
            <h1 style="color:#fff; font-size:28px; font-weight:800; margin:0 0 8px 0; line-height:1.2;">Selamat! Anda Dipanggil</h1>
            <h1 style="color:#00D49A; font-size:28px; font-weight:800; margin:0; line-height:1.2; font-style:italic;">Interview</h1>
        </div>

        <!-- BODY -->
        <div style="padding:40px;">
            <p style="color:#475569; font-size:16px; line-height:1.8; margin:0 0 32px 0;">
                Halo <strong style="color:#0f172a;">{{ $application->user->name }}</strong>,<br><br>
                Kabar gembira! Lamaran Anda untuk posisi <strong style="color:#00B37E;">{{ $application->job->title }}</strong>
                di <strong>{{ $application->job->company }}</strong> telah berhasil lolos seleksi awal.
                Tim rekrutmen mengundang Anda untuk mengikuti sesi wawancara.
            </p>

            <!-- INTERVIEW DETAILS CARD -->
            <div style="background:#f8fafc; border-radius:20px; border:1px solid #e2e8f0; padding:32px; margin-bottom:32px;">
                <h2 style="margin:0 0 24px 0; font-size:18px; font-weight:800; color:#0f172a; display:flex; align-items:center; gap:10px;">
                    📅 Detail Jadwal Interview
                </h2>

                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="padding:12px 0; border-bottom:1px solid #e2e8f0; color:#64748b; font-size:14px; font-weight:600; width:40%;">Posisi</td>
                        <td style="padding:12px 0; border-bottom:1px solid #e2e8f0; color:#0f172a; font-size:14px; font-weight:800;">{{ $application->job->title }}</td>
                    </tr>
                    <tr>
                        <td style="padding:12px 0; border-bottom:1px solid #e2e8f0; color:#64748b; font-size:14px; font-weight:600;">Perusahaan</td>
                        <td style="padding:12px 0; border-bottom:1px solid #e2e8f0; color:#0f172a; font-size:14px; font-weight:800;">{{ $application->job->company }}</td>
                    </tr>
                    <tr>
                        <td style="padding:12px 0; border-bottom:1px solid #e2e8f0; color:#64748b; font-size:14px; font-weight:600;">Tanggal</td>
                        <td style="padding:12px 0; border-bottom:1px solid #e2e8f0; color:#0f172a; font-size:14px; font-weight:800;">
                            {{ \Carbon\Carbon::parse($application->interview_date)->translatedFormat('l, d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:12px 0; border-bottom:1px solid #e2e8f0; color:#64748b; font-size:14px; font-weight:600;">Waktu</td>
                        <td style="padding:12px 0; border-bottom:1px solid #e2e8f0; color:#0f172a; font-size:14px; font-weight:800;">
                            {{ \Carbon\Carbon::parse($application->interview_time)->format('H:i') }} WIB
                        </td>
                    </tr>
                    @if($application->interview_location)
                    <tr>
                        <td style="padding:12px 0; border-bottom:1px solid #e2e8f0; color:#64748b; font-size:14px; font-weight:600;">Lokasi</td>
                        <td style="padding:12px 0; border-bottom:1px solid #e2e8f0; color:#0f172a; font-size:14px; font-weight:800;">{{ $application->interview_location }}</td>
                    </tr>
                    @endif
                    @if($application->interview_note)
                    <tr>
                        <td style="padding:12px 0; color:#64748b; font-size:14px; font-weight:600; vertical-align:top;">Catatan</td>
                        <td style="padding:12px 0; color:#475569; font-size:14px; line-height:1.6;">{{ $application->interview_note }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <!-- TIPS -->
            <div style="background:linear-gradient(135deg,#ecfdf5,#f0fdf4); border-radius:20px; border:1px solid #dcfce7; padding:24px; margin-bottom:32px;">
                <h3 style="margin:0 0 16px 0; font-size:15px; font-weight:800; color:#166534;">💡 Tips Persiapan Interview</h3>
                <ul style="margin:0; padding:0 0 0 20px; color:#15803d; font-size:13px; line-height:2;">
                    <li>Datang 10–15 menit lebih awal</li>
                    <li>Bawa dokumen pendukung (CV, ijazah, KTP)</li>
                    <li>Kenakan pakaian formal dan rapi</li>
                    <li>Pelajari profil perusahaan sebelum interview</li>
                    <li>Siapkan jawaban untuk pertanyaan umum HR</li>
                </ul>
            </div>

            <!-- CTA -->
            <div style="text-align:center;">
                <a href="{{ url('/dashboard/lamaran') }}"
                   style="display:inline-block; background:linear-gradient(135deg,#00B37E,#059669); color:#fff; padding:16px 40px; border-radius:16px; font-size:16px; font-weight:800; text-decoration:none; box-shadow:0 8px 20px rgba(0,179,126,0.3);">
                    Lihat Detail di Dashboard →
                </a>
            </div>
        </div>

        <!-- FOOTER -->
        <div style="background:#f8fafc; border-top:1px solid #e2e8f0; padding:24px 40px; text-align:center;">
            <p style="margin:0 0 8px 0; font-size:13px; font-weight:700; color:#0f172a;">Siap Kerja Ketapang</p>
            <p style="margin:0; font-size:12px; color:#94a3b8;">Platform Karier & Belajar — Ketapang, Kalimantan Barat</p>
            <p style="margin:8px 0 0 0; font-size:11px; color:#cbd5e1;">Email ini dikirim otomatis. Jangan balas email ini.</p>
        </div>
    </div>
</body>
</html>
