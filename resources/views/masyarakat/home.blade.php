<link rel="stylesheet" type="text/css" href="{{asset('index.css')}}">
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>PAGE MASYARAKAT </h1>
            <!-- session disini berfungsi untuk mengambil data session di controller yang di PUT  -->
            <p>Hallo Masyarakat Jelata, {{Session::get('nama_lengkap')}}. Apakabar?</p>

            <h2>* Username kamu : {{Session::get('username')}}</h2>
            <h2>* Status Login : {{Session::get('login')}}</h2>
            <!-- ini buat logout  -->
            <a href="{{ url('logout') }}" class="btn btn-primary btn-lg">Logout</a>
            <a href="{{url('masyarakat/history/lelang')}}">History</a>
            <a href="{{url('masyarakat/pemenang')}}">Pemenang</a>

            <table>
                <tr>
                    <th>Id Barang</th>
                    <th>Nama Barang</th>
                    <th>Tanggal</th>
                    <th>Harga Awal</th>
                    <th>Aksi</th>
                </tr>

                @foreach($barang as $row)
                <tr>
                    <td>{{$row->id_barang}}</td>
                    <td>{{$row->barang->nama_barang}}</td>
                    <td>{{$row->barang->tgl}}</td>
                    <td>{{$row->barang->harga_awal}}</td>
                    <td>
                        <a href="{{url('masyarakat/detail/penawaran/'.$row->id_lelang)}}">detail penawaran</a>
                    </td>
                </tr>
                @endforeach
                

            </table>

        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
