
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
            
                @foreach($barangDetail as $row)
            <table>
                <tr>
                    <th>Id Barang</th>
                    <!-- ini buat ngambil data id barang -->
                    <td>{{$row->id_barang}}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
                    <!-- nah kalo ini ngambil nama barang dari tabel barang, tulisan ->barang-> ini diambil dari nama function relasi yg ada di model -->
                    <td>{{$row->barang->nama_barang}}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{$row->barang->tgl}}</td>
                </tr>
                <tr>
                    <th>Harga Awal</th>
                    <td>{{$row->barang->harga_awal}}</td>
                </tr>
                <tr>
                    <th>Harga Akhir</th>
                    <td>{{$row->harga_akhir}}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{$row->barang->deskripsi_barang}}</td>
                </tr>
            </table>
            <!-- nah ini buat passing data ke link si Id_lelang-nya  diambil dari data pas di looping -->
            <form action="{{url('masyarakat/penawaran/'.$row->id_lelang)}}" method="post">
                @csrf
                <input type="text" name="penawaran_harga" placeholder="Penawaran Anda"> 
                <!-- ini buat ngambil id barang tapi disembunyiin -->
                <input type="hidden" name="id_barang" value="{{$row->id_barang}}">
                <button type="submit">Kirim</button>
            </form>
                @endforeach



        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
