
  //--------------Add Sub Category---------------
  $('#addsubcategory').on('submit', function(e){
    e.preventDefault();
    // var categoryId = $('#selectcategory').val()
    // var subCategoryName = $('#subcategoryname').val()
    const data= new FormData(e.currentTarget);
    const formData = {
        category_id: data.get('select'),
        name: data.get('name'),
    }
    
    $.ajax({
        type: 'post',
        url:'/subcategory',
        data: formData,
        headers:  {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(response) {
            var data = ""
            data = data + '<tr sub_category_id='+response.id+' >'
            data = data + '<td>'+response.name+'</td>'
            data = data + '<td category_id='+response.category.id +' >'+response.category.name+'</td>'
            data = data + '<td><button class="btn btn-primary edit-button" sub_category_id='+response.id+' category_id='+response.category.id +' type="button" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button></td>'
            data = data + '</tr>'
            $('.tbody-category').append(data)
            $('#subModal').modal('toggle');
            toastr["success"]("Added Sub Category")



        },
        error: function(error){
            console.log(error);
            $('.err-mess').children('li').remove();
            $('.alert').closest('div').removeAttr('hidden')
            $.each(error.responseJSON.errors, function (key,value) {
                $('.err-mess').append('<li>'+value+'</li>')
            })
        }
    })
  })
//-----Hide/Show--------

  $('.editparent').hide();
  $('.e-sbctgry').on('click', function(e){
    $('.editsub').toggle();
    $('.editparent').hide();
})

//---------Edit Sub Category---------
$(document).on('click', '.edit-button', function(e){
    let sub_category_id = $(e.currentTarget).attr('sub_category_id')
    let category_id = $(e.currentTarget).attr('category_id')
    var deletesub= $(e.currentTarget).parent().parent()
    const sub_category_name = deletesub.children('td')[0].textContent
    const category_name = deletesub.children('td')[1].textContent
    $('#updatesubname').val(sub_category_name)
    $('#updatecategoryname').val(category_name)
    $('.deleteSub').val(sub_category_id)
    $('.updSub').val(sub_category_id)
    $('.getId').val(category_id)
})

//-----------Update Sub Category--------------
$('.editsub').on('submit', function(e){
    e.preventDefault();
    const data= new FormData(e.currentTarget);
    const formData = {
        name:data.get('name')
    }
    let sub_category_id = $('.updSub').val()
    const updatedata = $('tbody tr[sub_category_id="'+sub_category_id+'"]').children()[0]
    console.log(sub_category_id);
    $.ajax({
        type: 'put',
        url:'/subcategory/'+sub_category_id,
        data: formData,
        headers:  {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(response) {
            $('tbody tr[sub_category_id="'+sub_category_id+'"]').children()[0].textContent =data.get('name')
            $('#editModal').modal('toggle');
            toastr["success"]("Updated Sub Category")


        },
        error: function(error){
            console.log(error);
            $('.err-mess').children('li').remove();
            $('.alert').closest('div').removeAttr('hidden')
            $.each(error.responseJSON.errors, function (key,value) {
                $('.err-mess').append('<li>'+value+'</li>')
            })
        }
    })
  })
    //-----------Delete Sub Category--------------
    $('.deleteSub').on('click', function(e){
        const id = $('.deleteSub').val()
        var deletesub= ($('tbody tr[sub_category_id="'+id+'"]'))
        // console.log(deletesub);
            $.ajax({
                type: 'delete',
                url:'/subcategory/'+id ,
                data: id ,
                headers:  {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(response) {
                     deletesub.remove()
                     toastr["success"]("Deleted Sub Category")

                },
                error: function(error){
                    console.log(error);
                }
            })
    })
