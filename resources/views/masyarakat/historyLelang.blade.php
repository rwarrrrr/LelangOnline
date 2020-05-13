
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
            <a href="{{url('masyarakat/home')}}">Home</a>
            
            <!-- ini buat ngelink ke form tambah data -->
            <table>
                <tr>
                    <th>Id History</th>
                    <th>Id Lelang</th>
                    <th>Nama Barang</th>
                    <th>Penawaran Harga</th>
                    <th>Aksi</th>
                </tr>
                @foreach($history as $row)
                <tr>
                    <td>{{$row->id_history}}</td>
                    <td>{{$row->id_lelang}}</td>
                    <td>{{$row->barang->nama_barang}}</td>
                    <td>{{$row->penawaran_harga}}</td>
                    <td>
                        <a href="{{url('masyarakat/edit/penawaran/'.$row->id_history)}}">edit</a>
                        <form action="{{url('masyarakat/delete/'.$row->id_history)}}" method="post">
                            @csrf
                            <button type="submit">delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </table>

        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
