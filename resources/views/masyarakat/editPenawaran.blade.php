
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
                    <td>{{$row->id_barang}}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
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
                    <td>{{$row->lelang->harga_akhir}}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{$row->barang->deskripsi_barang}}</td>
                </tr>
            </table>
            <form action="{{url('masyarakat/penawaran'.$row->id_history)}}" method="post">
                @csrf
                <input type="text" name="penawaran_harga" placeholder="Penawaran Anda" value="{{old('penawaran_harga',$row->penawaran_harga)}}">
                <input type="hidden" name="id_lelang" value="{{$row->id_lelang}}">
                <button type="submit">Kirim</button>
            </form>
                @endforeach



        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
