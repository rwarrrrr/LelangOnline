
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
            <a href="{{url('admin/home')}}">home</a>
            <table>
                @foreach($barangDetail as $row)
                <tr>
                    <th>Id Barang</th>
                    <td>{{$row->id_barang}}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
                    <td>{{$row->nama_barang}}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{$row->tgl}}</td>
                </tr>
                <tr>
                    <th>Harga Awal</th>
                    <td>{{$row->harga_awal}}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{$row->deskripsi_barang}}</td>
                </tr>
                @endforeach

            </table>

        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
