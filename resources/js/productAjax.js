  // -----------Add Product Modal------------
  $('.modal-add-pr').on('click', function(e){
    $('#subSelect').hide()
    e.preventDefault();
  })
//-------------Show Sub Category in Modal------------
$('#categorySelect').on('change',function () {
    $('#subSelect').show()
    let id =$(this).val()
    console.log(id);
    $.ajax({
        type: 'get',
        url:'/api/getsubcategories/'+id,
        dataType: 'json',
        headers:  {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(response) {
            // console.log(response);
            $('#subSelect').children().remove()
            $('#subSelect').append('<option selected disabled hidden>Select Sub Category</option>')
            $.each(response.sub_categories, function(index,value){
                $('#subSelect').append('<option category-id='+value.category_id+' value='+value.id+'>'+value.name+'</option>')

            })
        },
        error: function(error){
            console.log(error);
            alert('Data not saved')
        }
    })
    
  })

  //---------Add Product---------------
  $('#addproduct').on('submit', function(e){
    e.preventDefault();
    const data= new FormData($('#addproduct')[0]);
    $.ajax({
        type: 'post',
        url:'/product',
        contentType: false,
        processData: false,
        data: data,
        headers:  {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(response) {
            // console.log(response);
            var data = ""
            data = data + '<tr product_id='+response.id+' >'
            data = data + '<td>'+response.name+'</td>'
            data = data + '<td>'+response.sub_category.name+'</td>'
            data = data + '<td>'+response.sub_category.category.name+'</td>'
            data = data + '<td><button class="btn btn-primary edit-product-btn" product_id='+response.id+' type="button" data-bs-toggle="modal" data-bs-target="#editproductmdl">Edit</button></td>'
            data = data + '</tr>'
            $('.tbody-product').append(data)
            $('#exampleModal').modal('toggle');
            toastr["success"]("Added Product")

        },
        error: function(error){
            $('.err-mess').children('li').remove();
            $('.alert').closest('div').removeAttr('hidden')
            $.each(error.responseJSON.errors, function (key,value) {
                $('.err-mess').append('<li>'+value+'</li>')
            })
        }
    })
  })

//---------Edit Product Click---------
$(document).on('click', '.edit-product-btn', function(e){
    let product_id = $(e.currentTarget).attr('product_id')
    const deletesub= $(e.currentTarget).parent().parent()
    const product_name = deletesub.children('td')[0].textContent
    $('.updProduct').val(product_id)
    $('#updproductname').val(product_name)
    $('.deleteProduct').val(product_id) 
    // console.log(product_id);
})
//---------Update Product---------
$('.editproduct').on('submit', function(e){
    e.preventDefault();
    const data= new FormData(e.currentTarget);
    const formData = {
        name:data.get('name'),
        price: data.get('price')
    }
    let product_id = $('.updProduct').val()
    // const updatedata = $('tbody tr[sub_category_id="'+sub_category_id+'"]').children()[0]
    console.log(product_id);
    $.ajax({
        type: 'put',
        url:'/product/'+product_id,
        data: formData,
        headers:  {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(response) {
            $('#editproductmdl').modal('toggle');
            $('tbody tr[product_id="'+product_id+'"]').children()[0].textContent = response.name
            toastr["success"]("Updated Product")


        },
        error: function(error){
            $('.err-mess').children('li').remove();
            $('.alert').closest('div').removeAttr('hidden')
            $.each(error.responseJSON.errors, function (key,value) {
                $('.err-mess').append('<li>'+value+'</li>')
            })

        }
    })
  })
      //-----------Delete Product--------------
      $('.deleteProduct').on('click', function(e){
        const id = $('.deleteProduct').val()
        var deleteproduct= ($('tbody tr[product_id="'+id+'"]'))
        // console.log(deletesub);
            $.ajax({
                type: 'delete',
                url:'/product/'+id ,
                data: id ,
                headers:  {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(response) {
                     deleteproduct.remove()
                     toastr["success"]("Deleted Product")

                },
                error: function(error){
                    console.log(error);
                }
            })
    })
 //-------------------------------------------------------PRODUCT LIST----------------------------------------------------------
 /*jQuery(function($){
 let searchKey = "";
 let arr = []
  cheks = ""
 const url = baseUrl +"/products";

 var urll = window.location.href
 var NewUrl = new URL(urll);
 var sub_categories_id = NewUrl.searchParams.get("sub_categories_id");
 var key = NewUrl.searchParams.get("key");
 if(key !== null){
     $('.search-key').val(key)
   }

 if(sub_categories_id !== null){
     const dizi = sub_categories_id.split(",")
     dizi.forEach(element => {
       arr.push(element);
         $('.sub-option#'+element).prop("checked",true)
     });
 }

$('input[type="checkbox"]').change(function(e) {

    var checked = $(this).prop("checked"),
        container = $(this).parent(),
        siblings = container.siblings();
  
    container.find('input[type="checkbox"]').prop({
      indeterminate: false,
      checked: checked
    });
  
    function checkSiblings(el) {
  
      var parent = el.parent().parent(),
          all = true;
  
      el.siblings().each(function() {
        let returnValue = all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
        return returnValue;
      });
      
      if (all && checked) {
  
        parent.children('input[type="checkbox"]').prop({
          indeterminate: false,
          checked: checked
        });
  
        checkSiblings(parent);
  
      } else if (all && !checked) {
  
        parent.children('input[type="checkbox"]').prop("checked", checked);
        parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
        checkSiblings(parent);
  
      } else {
  
        el.parents("li").children('input[type="checkbox"]').prop({
          indeterminate: true,
          checked: false
        });
  
      }
  
    }
  
    checkSiblings(container);    
  });

  $('input[type="checkbox"]').change(function(e){
    //  arr = []
    // var linkArgs = "";
    // console.log($('.sub-option'))
    var sub_option = $('.sub-option')
    // console.log(sub_option);
    $.each(sub_option,function (key,value) {
        if(value.checked){
        arr.push(value.id)
    };
    })
    // if(arr){
    //     linkArgs = "sub_categories_id="
    //     arr.forEach((item,index) => {
    //         if(index == arr.length -1){
    //             linkArgs = linkArgs + item
    //         }else
    //         linkArgs = linkArgs + item + ","
    //     })
    // }

    // const url = baseUrl +"/products";
    // window.location.href = url + "?" +linkArgs
    filter()
  });
  // let searchKey = "";
  $('.search-key').on("keyup",(e)=>{
    searchKey = e.target.value.toLowerCase()
    
    // $(".product-card").each((key,  product) => {
    //   const productName = $(product).find(".card-title").text();
    //   if(productName.toLowerCase().includes(searchKey)) {
    //     $(product).css("display", "block")
    //   } else {
    //     $(product).css("display", "none")
    //   }
    // })
    
    setTimeout(() => {
      filter();
    }, 1000);
  })

  //filter
  function filter(){

    console.log(arr.length);

    if(arr.length){
      arr.forEach((item,index) => {
        if(index === arr.length-1){
          cheks += item
        }else{
          cheks += item +","
        }
      })
    }

    if(arr.length && searchKey == ""){
      window.location.href = url + "?sub_categories_id=" + cheks
    }

    if(arr.length==0 && searchKey != ""){
      window.location.href = url + "?key=" + searchKey
    }

    if (arr.length && searchKey != "") {
      window.location.href = url + "?sub_categories_id=" + cheks + "&key=" + searchKey
    }

    if (arr.length == 0 && searchKey == "") {
      window.location.href = url
    }

  }
})*/

  //-------------------------------------------------------CART ------------------------------------------------------------
  $('.add-to-cart').on('click', function(e){
    console.log();
    var add = "";
    var kontrol=0
    const id = $(e.currentTarget).attr('data-id');
    add= {id:id,qua:1}

    if (localStorage.getItem('cart')) {
      const cart = JSON.parse(localStorage.getItem('cart'))
      
      $.each(cart, function( index, value ) {
        if (value.id === add.id) {
          value.qua += 1
          kontrol +=1 
        }
      
      })
      if(kontrol == 0){
        cart.push(add)
      }
      localStorage.setItem('cart',JSON.stringify(cart))
    } else {
      localStorage.setItem('cart',JSON.stringify([add]))
    }
    toastr["success"]($(this).parent().children()[0].textContent+ " Added To Cart")
  })