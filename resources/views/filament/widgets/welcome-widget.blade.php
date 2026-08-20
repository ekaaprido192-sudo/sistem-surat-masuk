<x-filament-widgets::widget>
    <div style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border-radius: 16px; padding: 24px; color: #ffffff; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.2); border: 1px solid rgba(255, 255, 255, 0.08); position: relative; overflow: hidden;">
        
        <!-- Aksen Cahaya Latar Belakang -->
        <div style="position: absolute; top: -60px; right: -60px; width: 180px; height: 180px; background: radial-gradient(circle, rgba(217, 119, 6, 0.25) 0%, rgba(217, 119, 6, 0) 70%); border-radius: 50%; pointer-events: none;"></div>

        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 24px; position: relative; z-index: 1;">
            
            <!-- Bagian Kiri: Identitas Instansi & Sapaan -->
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="flex-shrink: 0; background: rgba(255, 255, 255, 0.98); padding: 8px; border-radius: 14px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); display: flex; align-items: center; justify-content: center; width: 78px; height: 78px;">
                    <img 
                        src="{{ asset('images/logo-bkad.png') }}" 
                        alt="Logo BKAD Kota Bogor" 
                        style="max-width: 100%; max-height: 100%; object-fit: contain; display: block;"
                    />
                </div>
                <div>
                    <div style="display: inline-flex; align-items: center; gap: 6px; background: rgba(217, 119, 6, 0.18); border: 1px solid rgba(217, 119, 6, 0.4); padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; color: #fbbf24; margin-bottom: 6px;">
                        <span style="width: 6px; height: 6px; background: #fbbf24; border-radius: 50%; display: inline-block;"></span>
                        Sistem Informasi Persuratan & Disposisi
                    </div>
                    <h1 style="font-size: 22px; font-weight: 800; margin: 0; color: #f8fafc; letter-spacing: -0.02em;">
                        Selamat Datang, {{ auth()->user()->name ?? 'Administrator' }} 👋
                    </h1>
                    <p style="font-size: 13px; color: #94a3b8; margin: 4px 0 0 0; font-weight: 500;">
                        Badan Keuangan dan Aset Daerah (BKAD) Pemerintah Kota Bogor
                    </p>
                </div>
            </div>

            <!-- Bagian Kanan: Panel Info Pengguna & Waktu -->
            <div style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 14px; padding: 14px 18px; font-size: 12px; min-width: 270px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <span style="color: #94a3b8;">Hak Akses / Role</span>
                    <span style="background: linear-gradient(135deg, #d97706, #b45309); color: #ffffff; padding: 3px 10px; border-radius: 6px; font-weight: 700; font-size: 11px; letter-spacing: 0.03em; box-shadow: 0 2px 6px rgba(217,119,6,0.3);">
                        {{ strtoupper(auth()->user()->role ?? 'ADMIN') }}
                    </span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <span style="color: #94a3b8;">Alamat Email</span>
                    <span style="color: #e2e8f0; font-weight: 500;">{{ auth()->user()->email ?? '-' }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 8px; border-top: 1px solid rgba(255, 255, 255, 0.08);">
                    <span style="color: #94a3b8;">Waktu Server</span>
                    <span style="color: #fbbf24; font-weight: 600;">📅 {{ now()->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>

        </div>
    </div>
</x-filament-widgets::widget>