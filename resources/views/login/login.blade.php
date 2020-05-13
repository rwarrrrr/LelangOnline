
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">

            <!-- Remove This Before You Start -->
            <h1>PETUGAS LOGIN</h1>
            <hr>
            <!--ini buat cek doang-->
            <!-- bacaan 'alert' diambil dari with pass redirect -->
            @if(\Session::has('alert'))
                <div class="alert alert-danger">
                    <div>{{Session::get('alert')}}</div>
                </div>
            @endif
            <!-- bacaan 'alert' diambil dari with pass redirect -->
            @if(\Session::has('alert-success'))
                <div class="alert alert-success">
                    <div>{{Session::get('alert-success')}}</div>
                </div>
            @endif
            <!-- ini buat login -->
            <!-- yg penting mah di tag input name sama id harus sama di controller atau field di tabel / DB  -->
            <form action="{{ url('petugas/loginPost') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="pass">Password:</label>
                    <input type="password" class="form-control" id="pass" name="pass"></input>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary">Login</button>

                </div>
            </form>
        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
