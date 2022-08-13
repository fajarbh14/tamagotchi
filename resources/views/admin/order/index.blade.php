@extends('layouts.admin.master')

@section('title', 'DiResto')

@push('css')

@endpush

@section('content')
<div class="listcontent-area">
    @includeIf('admin.order.add')
    <div class="row">
        <div class="col-xl-12">
            <div class="row" id="item">
                
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function items() {
        $.ajax({
            type: 'get',
            url: "{{ Auth::user()->role == 2 ? url('kasir/menu') : url('order/menu') }}",
            success: function (response) {
                if (response.status_code == 200) {
                    var itemList = response.data;
                    let itemLi = '';
                    if(itemList.length > 0 ){
                        itemList.forEach(items => $('#item').html(itemLi += `<div class="col-xl-3 col-xxl-4 col-lg-6 col-md-12 col-sm-6">
                        <a href="javaScript:void(0)" data-target="${items.id}" id="addItems" onClick="addItems('{{'${items.id}'}}','{{ '${items.nama}' }}','{{ '${items.harga}' }}','{{ '${items.stok}' }}')">
                            <div class="card item-card">
                                <div class="card-body p-0">
                                    <img src="uploads/`+items.image+`" class="img-fluid" alt="">
                                    <div class="info">
                                        <h5 class="name">${items.nama}</h5>
                                        <h6 class="mb-0 price">Rp `+addCommas((items.harga))+`</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>`));
                    }else{
                        $('#item').html(`<div class="col-md-12 text-center">
                            <span>Tidak ada item</span>
                        </div>`);                        
                    }
                }
            },
            error: function () {
                $('.list').show();
                $('#item').html(`<div class="col-md-12 text-center">
                            <span>Tidak ada item</span>
                        </div>`);                        
                $('.loading').hide();
            }
        });
    }
    items()

    var x = 1;
    function addItems(id_menu,menu,price,stok){

        var id_menu = id_menu;
        var menu = menu;
        var price = price;
        var stok = stok;
        var subTotal = price; 
        var maxField = 25;
        var wrapper = $('#wrapper');
    

        if(x < maxField){ 
            var fieldHTML = `<tr data-target="${id_menu}" id="rowInput${x}">
            <td>${menu}
                <input type="hidden" class="menu_id" name="menu_id[]" value="${id_menu}">
            </td>
            <td>${price}</td>
            <td>
               <input type="hidden" class="stok" value="${stok}">
                <div class="quantity btn-quantity style-1">
                    <input id="jumlah" type="text" value="1" name="jumlah[]" class="form-control">
                </div>
            </td>
            <td>`+addCommas(subTotal)+`</td>
            <td style="display:none"><input id="subtotal[]" name="subtotal[]" type="text" value="${subTotal}" class="subtotal"></td>
            <td>
                <button class="btn btn-danger btn-sm text-white remove_button" id="${x}" type="button">Hapus</button>
            </td>
            </tr>`;
            x++;
            $(wrapper).append(fieldHTML);
        }
        var grandTotal = 0;
        $('.subtotal').each(function() {
            grandTotal += parseInt($(this).val());
        });
        $('.grandTotal').text(addCommas(grandTotal)).val(grandTotal);

        $(document).on("input", "#jumlah", function() {
            var jumlah = parseInt(this.value);
            var stok = parseInt($(this).parent().parent().parent().find('.stok').val());
            console.log(stok)
            if(jumlah > stok) {
                $(this).val(1)
            }
        });
    }

    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        var button_id = $(this).attr("id");   
        $('#rowInput'+button_id+'').remove();
        x--;
        var grandTotal = 0;
        $('.subtotal').each(function() {
            grandTotal = parseInt($(this).val());
        });
        $('.grandTotal').text(addCommas(grandTotal)).val(grandTotal);
    });

    $(wrapper).on('keyup','#jumlah',function(){
        var jumlah = $(this).val();
        var price = $(this).parent().parent().parent().find('td:nth-child(2)').text();
        var subTotal = jumlah * price;
        $(this).parent().parent().parent().find('td:nth-child(4)').text(addCommas(subTotal));
        $(this).parent().parent().parent().find('td:nth-child(5)').find('input').val(subTotal);
        var grandTotal = 0;
        $('.subtotal').each(function() {
            grandTotal += parseInt($(this).val());
        });
        $('.grandTotal').text(addCommas(grandTotal)).val(grandTotal);
    });


    $(document).on('submit', '#order', function() {
            $.ajax({
                url: $(this).data("target"),
                type: "post",
                data: new FormData(this),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend : function() {
                    $("button").attr("disabled", true);
                  },
                success: function(response) {
                    $("button").attr("disabled", false);
                    if(response.status_code == 200) {
                        toastAlert("success", response.message);
                        setTimeout(function() {
                            location.reload()
                        }, 1000)
                    }
                    else {
                        toastAlert("error", response.message);
                    }
                },
                error: function(reject) {
                    $("button").attr("disabled", false);
                    toastAlert("error", "Terjadi kesalahan pada server");
                }
            });
        });
                
</script>
@endpush
@endsection