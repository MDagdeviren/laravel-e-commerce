  // -----------Add Category------------
  $('#addForm').on('submit', function(e){
    e.preventDefault();
    const data= new FormData(e.currentTarget);
    const formData = {
        name: data.get('name')
    }

    $.ajax({
        type: 'post',
        url:'/category',
        data: formData,
        headers:  {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(response) {
            $('#parentmodal').modal('toggle');
            $('#selectcategory').append('<option value='+response.id+'>'+response.name+'</option>')
            toastr["success"]("Added Category")
        },
        error: function(error){
            $('.err-mess').children('li').remove();
            $('.alert').closest('div').removeAttr('hidden')
            $.each(error.responseJSON.errors, function (key,value) {
                $('.err-mess').append('<li>'+value+'</li>')
            })
            // console.log(error.responseJSON);
            
        }
    })
  })
//-----Hide/Show--------
  $('.editsub').hide();
  $('.e-ctgry').on('click', function(){
    $('.editsub').hide();
    $('.editparent').toggle();
})
$(document).on('click',['#parentmodal','#editModal','#exampleModal','#editproductmdl'],function () {
    $('.err-mess').children('li').remove();
    $('.alert').closest('div').attr('hidden',true)
})

 //-----------Update Main Category--------------
 $('.editparent').on('submit', function(e){
    e.preventDefault();
    const data= new FormData(e.currentTarget);
    const formData = {
        name: data.get('name')
    }
    let category_id = $('.getId').val()
    
    $.ajax({
        type: 'put',
        url:'/category/'+category_id,
        data: formData,
        headers:  {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(response) {
            $('#editModal').modal('toggle');
            $('tbody td[category_id="'+category_id+'"]').text(response.name)
            $('#selectcategory option[value="'+response.id+'"]').text(response.name)
            toastr["success"]("Updated Category")
        },
        error: function(error){
            $('.err-mess').children('li').remove();
            $('.alert').closest('div').removeAttr('hidden')

            $.each(error.responseJSON.errors.name, function (key,value) {
                
                $('.err-mess').append('<li>'+value+'</li>')
            })
        }
    })
  })

   //-----------Delete Main Category--------------
   $('#deleteMain').on('click', function(){
    let id = $('.getId').val()
    var deletemain= ($('tbody td[category_id="'+id+'"]').parent())
    $.ajax({
        type: 'delete',
        url:'/category/'+id,
        data: id,
        headers:  {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(response) {
            console.log(response);
            deletemain.remove()
            // console.log($('#selectcategory option[value="'+response.id+'"]'))
            $('#selectcategory option[value="'+response.id+'"]').remove()
            toastr["success"]("Deleted Category")

            
        },
        error: function(error){
            console.log(error);
            alert('Data not saved')
        }
    })
})
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "1000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }


