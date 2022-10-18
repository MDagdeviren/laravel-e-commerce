function CartGet(){
    let CardList = $("#Card")
    CardList.children().remove();
    var ids = "";
    const cart = JSON.parse(localStorage.getItem("cart"));

    $.each(cart,function(index,value){
        if(index === cart.length -1){
            ids += value.id
        }else{
            ids += value.id + ","
        }
    })
    
    console.log(cart);

    if(cart == null){
        var data = "";
        data += '<div class="alert alert-warning d-flex align-items-center" role="alert">';
        data += '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>'
        data += '<div>'
        data += 'No product in cart add product <a href="/products" class="alert-link">products</a>.'
        data += '</div>'
        data += '</div>'
        CardList.append(data);
    }else{
        $.ajax({
            method:"get",
            url:"/carts/"+ids,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(result){
    
                const test = result.map(data => {
                    const cartProduct = cart.filter(product => {
                        return parseInt(product.id) === data.id
                    })
                    return {...data, qua: cartProduct[0].qua}
                })
    
                console.log({result, cart,test});
                
                test.map(item=>{
                    var data = "";
                    data += '<div class="row mt-2">'
                    data += '<div class="col-md-2">'
                    data += '<img src="./Image/'+item.image+'" style="width: 10rem"/>'
                    data += '</div>'
                    data += '<div class="col-md-2">'
                    data += '<p>Name</p>'
                    data += '<p>'+ item.name +'</p>'
                    data += '</div>'
                    data += '<div class="col-md-2">'
                    data += '<p>Price</p>'
                    data += '<p>$<span>'+ item.price +'</span></p>'
                    data += '</div>'
                    data += '<div class="col-md-2">'
                    data += '<p>Amount</p>'
                    data += '<button class="btn qua_int" id="'+ item.id +'">-</button>'    
                    data += '<input type="number" Value="'+ item.qua +'" min="1" style="width: 40px;"/>'
                    data += '<button class="btn qua_add" id="'+ item.id +'">+</button>'
                    data += '</div>'
                    data += '<div class="col-md-2">'
                    data += '<p>total Price</p>'
                    data += '<p>$<span>'+ item.price * item.qua +'</span></p>'
                    data += '</div>'
                    data += '<div class="col-md-2">'
                    data += '<button class="w-100 btn btn-danger remove" id="'+ item.id +'">remove</button>'
                    data += '</div>'
                    data += '</div>'
                    CardList.append(data);
                    
                })
    
    
            },
            error: function(){
                alert("hata oluştu tekrar deneme ");
            }
        })
    }
}

const url = baseUrl +"/cart";
if(window.location.href == url){
    CartGet();
}

$(document).on("click",'.qua_add',function(e){
    let id = $(e.currentTarget).attr('id')
    const cart = JSON.parse(localStorage.getItem("cart"));
    $.each(cart, function(index,value){
        if (value.id == id) {
            value.qua += 1;
        }
    })
    localStorage.setItem("cart", JSON.stringify(cart));
    CartGet();
})

$(document).on("click",'.qua_int',function(e){
    let id = $(e.currentTarget).attr('id')
    const cart = JSON.parse(localStorage.getItem("cart"));
    $.each(cart, function(index,value){
        if (value.id == id) {
            value.qua -= 1;
        }
    })
    localStorage.setItem("cart", JSON.stringify(cart));
    CartGet();
})

$(document).on("click",'.remove',function(e){
    let id = $(e.currentTarget).attr('id')
    let cart = JSON.parse(localStorage.getItem("cart"));
    console.log("cart",cart);
    console.log("id",id);
    cart = cart.filter(product => product.id != id)
    localStorage.setItem("cart", JSON.stringify(cart));
    let kontrol = localStorage.getItem("cart");
    console.log(kontrol.length);
    if(kontrol.length == 2){
        localStorage.clear();
        CartGet();
    }else{
        CartGet();
    }
})