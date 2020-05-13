
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Lelang</h1>
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
                    

            <form action="{{ url('petugas/lelang',@$lelang->id_lelang) }}" method="post">
                @csrf

                @if(!empty($lelang))
                    @method('PATCH')
                @endif
                
                <div class="form-group">
                    <!-- ini simpen aja name di select -->
                    <select class="" name="id_barang" id="id_barang"><br>
                            <option value="">-- Pilih Barang -- </option>
                    @foreach($barang as $row)
                            <option value="{{$row->id_barang}}"
                                    
                                    {{old('id_barang')}}
                                    
                                    @if(@$lelang->id_barang == $row->id_barang)
                                        selected
                                    @endif>

                                {{$row->nama_barang}}
                            </option>

                    @endforeach
                    </select>
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
