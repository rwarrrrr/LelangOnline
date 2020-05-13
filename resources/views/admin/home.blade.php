
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>PAGE ADMIN </h1>
            <!-- session disini berfungsi untuk mengambil data session di controller yang di PUT  -->
            <p>Hallo Masyarakat Jelata, {{Session::get('nama_lengkap')}}. Apakabar?</p>
            <a href="{{url('admin/register')}}" class="btn btn-md btn-warning">Register</a>            

            <h2>* Username kamu : {{Session::get('username')}}</h2>
            <h2>* Status Login : {{Session::get('login')}}</h2>
            <!-- ini buat logout  -->
            <a href="{{ url('logout') }}" class="btn btn-primary btn-lg">Logout</a>
            <a href="{{url('admin/pemenang')}}">History</a>
            
            <!-- ini buat ngelink ke form tambah data -->
            <a href="{{url('admin/tambah/barang')}}">tambah</a>

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
                    <td>{{$row->nama_barang}}</td>
                    <td>{{$row->tgl}}</td>
                    <td>{{$row->harga_awal}}</td>
                    <td>
                        <a href="{{url('admin'.$row->id_barang)}}">detail</a>
                        <a href="{{url('admin/edit/barang/'.$row->id_barang)}}">edit</a>
                        <form action="{{url('admin/delete'.$row->id_barang)}}" method="post">
                            @csrf
                            <!-- ini buat jalanin method delete -->
                            @method('DELETE')
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
