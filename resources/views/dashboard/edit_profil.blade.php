@extends('layouts.app')

@section('isi')
<div style="max-width: 600px; margin: 40px auto; padding: 20px;">
    <div style="background: #fff; border-radius: 20px; padding: 30px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <h2 style="margin-bottom: 25px; color: #0f172a;">⚙️ Pengaturan Profil</h2>

        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 12px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; font-weight: 600;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 20px;">
                <label style="display:block; margin-bottom:8px; font-weight:700; color: #475569;">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $user->name }}" style="width:100%; padding:12px; border-radius:10px; border:1px solid #cbd5e1;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display:block; margin-bottom:8px; font-weight:700; color: #475569;">Sekolah</label>
                <input type="text" name="sekolah" value="{{ $user->sekolah }}" style="width:100%; padding:12px; border-radius:10px; border:1px solid #cbd5e1;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display:block; margin-bottom:8px; font-weight:700; color: #475569;">Jurusan</label>
                <input type="text" name="jurusan" value="{{ $user->jurusan }}" style="width:100%; padding:12px; border-radius:10px; border:1px solid #cbd5e1;">
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" style="flex: 1; background:#10b981; color:#fff; padding:14px; border:none; border-radius:12px; font-weight:800; cursor:pointer;">
                    Simpan Perubahan
                </button>
                <a href="{{ url()->previous() }}" style="flex: 1; text-align: center; background:#f1f5f9; color:#475569; padding:14px; border-radius:12px; font-weight:800; text-decoration: none;">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection