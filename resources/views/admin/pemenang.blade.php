
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>PAGE PETUGAS </h1>
            <!-- session disini berfungsi untuk mengambil data session di controller yang di PUT  -->
            <p>Hallo Masyarakat Jelata, {{Session::get('nama_lengkap')}}. Apakabar?</p>

            <h2>* Username kamu : {{Session::get('username')}}</h2>
            <h2>* Status Login : {{Session::get('login')}}</h2>
            <!-- ini buat logout  -->
            <a href="{{ url('logout') }}" class="btn btn-primary btn-lg">Logout</a>
            <a href="{{url('admin/home')}}">Home</a>
            
            <!-- ini buat ngelink ke form tambah data -->
            <table>
                <tr>
                    <th>Id lelang</th>
                    <th>Nama Barang</th>
                    <th>Tanggal</th>
                    <th>Harga Akhir</th>
                    <th>Nama Masyarakat</th>
                    <th>Nama Petugas</th>
                    <th>Status</th>
                </tr>
                @foreach($lelang as $row)
                <tr>
                    <td>{{$row->id_lelang}}</td>
                    <td>{{$row->barang->nama_barang}}</td>
                    <td>{{$row->tgl_lelang}}</td>
                    <td>{{$row->harga_akhir}}</td>
                    <td>{{$row->masyarakat->nama_lengkap}}</td>
                    <td>{{$row->petugas->nama_petugas}}</td>
                    <td>{{$row->status}}</td>
                </tr>
                @endforeach

            </table>

        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
