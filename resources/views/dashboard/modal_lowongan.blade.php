<!-- Modal Buat Lowongan -->
<div id="modal-lowongan" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: white; padding: 30px; border-radius: 16px; width: 500px; max-width: 90%;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0; font-family: 'Nunito', sans-serif;">Buat Lowongan Baru</h3>
            <button onclick="document.getElementById('modal-lowongan').style.display='none'" style="background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
        </div>
        <form action="{{ route('perusahaan.store_lowongan') }}" method="POST" style="font-family: 'Nunito', sans-serif;">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px;">Judul Lowongan</label>
                <input type="text" name="title" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box;">
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px;">Lokasi</label>
                    <select name="location" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box;">
                        <option value="Delta Pawan">Delta Pawan</option>
                        <option value="Muara Pawan">Muara Pawan</option>
                        <option value="Air Upas">Air Upas</option>
                        <option value="Manis Mata">Manis Mata</option>
                        <option value="Marau">Marau</option>
                        <option value="Jelai Hulu">Jelai Hulu</option>
                        <option value="Kendawangan">Kendawangan</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px;">Tipe Pekerjaan</label>
                    <select name="type" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box;">
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Magang">Magang</option>
                    </select>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px;">Sektor</label>
                    <select name="sector" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box;">
                        <option value="Pertanian">Pertanian</option>
                        <option value="Teknologi">Teknologi</option>
                        <option value="Manufaktur">Manufaktur</option>
                        <option value="Jasa">Jasa</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px;">Batas Waktu</label>
                    <input type="date" name="deadline" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box;">
                </div>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px;">Nominal Gaji</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input type="text" name="salary" placeholder="Contoh: 5.000.000" style="flex: 1; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box;">
                    <label style="font-size: 12px; color: #64748b; cursor: pointer; display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" name="hide_salary" value="1"> Sembunyikan Gaji
                    </label>
                </div>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px;">Deskripsi Pekerjaan</label>
                <textarea name="description" rows="4" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box;"></textarea>
            </div>
            <button type="submit" style="width: 100%; background: #10b981; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer;">Terbitkan Lowongan</button>
        </form>
    </div>
</div>
