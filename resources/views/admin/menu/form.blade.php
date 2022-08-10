<form class="theme-form" id="{{$data == null ? "create-form" : "edit-form"}}" data-target="{{$data == null ? "" : url('menu-makanan/update/'.$data->id)}}" onsubmit="return false;">
    {{ csrf_field() }}

    <div class="mb-3">
        <img src="{{ $data ? asset('uploads/'.$data->image) : '' }}" class="img-fluid mb-1" width="30%" alt="">
    </div>

    <div class="mb-3">
        <label>Foto Menu</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label pt-0">Nama Menu</label>
        <input class="form-control" id="nama" name="nama" value="{{ $data == null ? "" : $data->nama}}" type="text" required />
    </div>
    <div class="mb-3">
        <label class="form-label pt-0">Harga</label>
        <input class="form-control numeric comma" id="harga" name="harga" value="{{ $data == null ? "" : number_format($data->harga,0,"",".")}}" type="text" required />
    </div>
    <div class="mb-3">
        <label class="form-label pt-0">Stok</label>
        <input class="form-control" id="stok" name="stok" minlength="0" value="{{ $data == null ? "" : $data->stok}}" type="number" required />
    </div>
    <div class="mb-3">
        <label class="form-label pt-0">Jenis Menu</label>
        <select name="jenis_menu" id="jenis_menu" class="form-select" required>
            <option value="Minuman" {{$data != null ? $data->jenis_menu == "Minuman" ? "selected" : "" : ""}}>Minuman</option>
            <option value="Makanan" {{$data != null ? $data->jenis_menu == "Makanan" ? "selected" : "" : ""}}>Makanan</option>
            <option value="Dessert" {{$data != null ? $data->jenis_menu == "Dessert" ? "selected" : "" : ""}}>Dessert</option>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Kirim</button>
</form>