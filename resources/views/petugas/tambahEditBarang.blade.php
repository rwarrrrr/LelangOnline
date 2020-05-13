
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Tambah Barang</h1>
            <hr>
            <!-- ini buat cek doang -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ini buat register -->
            <!-- yg penting mah di tag input name sama id harus sama di controller atau field di tabel / DB  -->
            <form action="{{ url('petugas',@$barang->id_barang) }}" method="post">
                @csrf
                <!-- nah ini buat pengecekan kalo $barang ada datanya maka ngejalanin method patch -->
                @if(!empty($barang))
                    @method('PATCH')
                @endif
                <div class="form-group">
                    <label for="nama_barang">Name:</label>
                    <!-- ini contoh old  -->
                    <input type="text"  class="form-control" id="nama_barang" name="nama_barang" value="{{old('nama_barang',@$barang->nama_barang)}}">
                </div>            
                <div class="form-group">
                    <label for="harga_awal">Harga Awal:</label>
                    <input type="text"  class="form-control" id="harga_awal" name="harga_awal" value="{{old('harga_awal',@$barang->harga_awal)}}">
                </div>                
                <div class="form-group">
                    <label for="deskripsi_barang">Deskripsi:</label>
                    <input type="text" class="form-control" id="deskripsi_barang" name="deskripsi_barang" value="{{old('deskripsi_barang',@$barang->deskripsi_barang)}}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    <button type="reset" class="btn btn-md btn-danger">Cancel</button>
                </div>
            </form>
        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
