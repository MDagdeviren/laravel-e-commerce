jQuery(function($){
    let searchKey = "";
    let arr = []
    let cheks = ""
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
  
    $('input[type="checkbox"]').on("change",function(e){
          arr = [];
          console.log($('.sub-option'))
          var sub_option = $('.sub-option')
          $.each(sub_option,function (key,value) {
              if(value.checked){
              arr.push(value.id)
          };
          })
  
          filter()
    });
  
  
    $('.search-key').on("keyup",(e)=>{
      searchKey = e.target.value.toLowerCase()
      setTimeout(() => {
        filter();
      }, 1000);
  
      
    })
  
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
  
  })