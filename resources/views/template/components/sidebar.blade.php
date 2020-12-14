<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-bold">Peminjaman Alat</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="/home" class="nav-link">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-header">Master data</li>

                <li class="nav-item">
                    <a href="{{ route('student.index') }}" class="nav-link">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <p>
                            Master Mahasiswa
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('tool.index') }}" class="nav-link">
                        <i class="fa fa-wrench" aria-hidden="true"></i>
                        <p>
                            Master Alat
                        </p>
                    </a>
                </li>

                <li class="nav-header">Pengaturan alat</li>
                <li class="nav-item">
                    <a href="{{ route('arragement.index') }}" class="nav-link">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <p>
                            Pengaturan alat
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('arragement.barcode') }}" class="nav-link">
                        <i class="fa fa-barcode" aria-hidden="true"></i>
                        <p>
                            Kode batang alat
                        </p>
                    </a>
                </li>

                <li class="nav-header">Peminjaman</li>
                <li class="nav-item">
                    <a href="{{ route('peminjaman.index') }}" class="nav-link">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        <p>
                            Peminjaman alat
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('peminjam.data') }}" class="nav-link">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <p>
                            Data peminjam
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('riwayat.peminjam') }}" class="nav-link">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <p>
                            Riwayat peminjaman
                        </p>
                    </a>
                </li>

                <li class="nav-header">Laporan</li>
                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}" class="nav-link">
                        <i class="fa fa-file" aria-hidden="true"></i>
                        <p>
                            Laporan peminjaman
                        </p>
                    </a>
                </li>
            {{-- BATAS --}}
            <ul>
        </nav>
    </div>
</aside>