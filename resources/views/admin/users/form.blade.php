<form class="theme-form" id="{{$data == null ? "create-form" : "edit-form"}}" data-target="{{$data == null ? "" : url('user/update/'.$data->id)}}" onsubmit="return false;">
    {{ csrf_field() }}
    <div class="mb-3">
        <label class="form-label pt-0">Nama</label>
        <input class="form-control" id="nama" name="nama" value="{{ $data == null ? "" : $data->nama}}" type="text" required />
    </div>
    <div class="mb-3">
        <label class="form-label pt-0">Username</label>
        <input class="form-control" id="username" name="username" value="{{ $data == null ? "" : $data->username}}" type="text" required />
    </div>
    <div class="mb-3">
        <label class="form-label pt-0">Password</label>
        <div class="input-group">
            <input class="form-control" id="password" name="password" type="password"{{ $data == null ? "required" : ""}} />
            <div id="show-hide"><span data-state="show"></span></div>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label pt-0">Role</label>
        <select name="role" id="role" class="form-select" required>
            <option value="1" {{$data != null ? $data->role == 1 ? "selected" : "" : ""}}>Admin</option>
            <option value="2" {{$data != null ? $data->role == 2 ? "selected" : "" : ""}}>Kasir</option>
            <option value="3" {{$data != null ? $data->role == 3 ? "selected" : "" : ""}}>Koki</option>
            <option value="4" {{$data != null ? $data->role == 4 ? "selected" : "" : ""}}>Pelayan</option>            
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Kirim</button>
</form>