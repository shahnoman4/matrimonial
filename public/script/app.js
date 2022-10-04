
//for dataTable data
var InitTable = function(){
    $('#table_data').DataTable({
      "bDestroy": true,
      "processing":true,
      "serverSide":true,
      "ajax"   : dataTableRoute,
      "columns": data
    });
  }

// for Form insert data

$('#add-form-btn').on('click', function(e) {
  //var data = $('#add-form').serializeArray();
  var data = $('#add-form')[0];
  var formData = new FormData(data);
  event.preventDefault();
  $.ajax({
      data: formData,
      type: $('#add-form').attr('method'),
      url: $('#add-form').attr('action'),
      processData: false,
      contentType: false,
      success: function(response)
      {
      if(response.errors)
      {
      $.each(response.errors, function( index, value ) {
      $("."+index).html(value);
      $("."+index).fadeIn('slow', function(){
        $("."+index).delay(3000).fadeOut(); 
      });
      });
      var success = $("."+index);
      scrollTo(success,-100);
      }
      else
      {

      InitTable();
      $('.success').html(response);
      $('#success').show();
      $('#add-form')[0].reset();
      var succ = $('.success');
      scrollTo(succ,-100);

      }
      }
      });
});


// for edit form
$(document).on('click', '.edit', function()
{

    var id = $(this).attr('data-id');
    $.ajax({
        "url": editRoute,
        type: "POST",
        data: {'id': id,_token: token},
        dataType : "json",
        success: function(data)
        {
          $.each(data, function( index, value ) {
          $('#edit_'+index).val(value);
          
          });
                                
          var success = $('#add-form');
          scrollTo(success,-100);
        },
          error: function(){},          
      });
});

// code for add form modal show
$(document).on('click', '.addModelbtn', function()
{
    $('#addModel').modal('show');
    $('#edit_id').val('');
    $('#add_form')[0].reset();

});
// code for add form
$('#add_form_btn').on('click', function(e) {
  //var data = $('#add_form').serializeArray();
  e.preventDefault();
  var data = $('#add_form')[0];
  var formData = new FormData(data);
  $.ajax({
  data: formData,
  type: $('#add_form').attr('method'),
  url: $('#add_form').attr('action'),
  processData: false,
  contentType: false,
  success: function(response)
  {
  if(response.errors)
  {
  $.each(response.errors, function( index, value ) {
    $("."+index).html(value);
    $("."+index).fadeIn('slow', function(){
      $("."+index).delay(3000).fadeOut(); 
    });
  });

  }
  else
  {
    swal("Success",response, "success");
    InitTable();
    //$('.success').html(response);
    //$('#success').show();
    $('#add_form')[0].reset();
    $('#addModel').modal('hide');
  }
  }
  });
});


$(document).on('click', '.edit_model', function()
{

var id = $(this).attr('data-id');
$.ajax({
  "url": editRoute,
  type: "POST",
  data: {'id': id,_token: token},
  dataType : "json",
  success: function(data)
  {

    $.each(data, function( index, value ) {
    $('#edit_'+index).val(value);
    });

    $('#addModel').modal('show');
  },
    error: function(){},          
});

});

$(document).on('click', '.edit_diff_model', function()
{
  var id = $(this).attr('data-id');
  $.ajax({
  "url": editRoute,
  type: "POST",
  data: {'id': id,_token: token},
  dataType : "json",
  success: function(data)
  {

  $.each(data, function( index, value ) {
  $('#edit_'+index).val(value);
  });

  $('#edit_diff_model').modal('show');
  },
  error: function(){},          
  });
});

// code for add with different model form
function AddDifferentModel(AddDiffFormId, AddDiffFormModel){
var data = $(AddDiffFormId).serializeArray();
event.preventDefault();
$.ajax({
data: data,
type: $(AddDiffFormId).attr('method'),
url: $(AddDiffFormId).attr('action'),
success: function(response)
{
  if(response.errors)
  {
     $.each(response.errors, function( index, value ) {
      $("."+index).html(value);
      $("."+index).fadeIn('slow', function(){
        $("."+index).delay(3000).fadeOut(); 
      });
    });

  }
  else
  {
    InitTable();
    swal("Success",response, "success");
    //$('.success').html(response);
   // $('#success').show();
    $(AddDiffFormId)[0].reset();
    $(AddDiffFormModel).modal('hide');
    
  }
}
});
}

// code for edit different model form
function EditDifferentModel(editDiffFormId, editDiffFormModel){
var data = $(editDiffFormId).serializeArray();
event.preventDefault();
$.ajax({
data: data,
type: $(editDiffFormId).attr('method'),
url: $(editDiffFormId).attr('action'),
success: function(response)
{
  if(response.errors)
  {
     $.each(response.errors, function( index, value ) {
      $(".edit_"+index).html(value);
      $(".edit_"+index).fadeIn('slow', function(){
        $(".edit_"+index).delay(3000).fadeOut(); 
      });
    });

  }
  else
  {
    InitTable();
    $('.success').html(response);
    $('#success').show();
    $(editDiffFormId)[0].reset();
    $(editDiffFormModel).modal('hide');
    
  }
}
});
}


// code for active and disable

// $(document).on('click', '.disable', function()
// {
    
//     var id = $(this).attr('data-id');
//     $.ajax({
//         "url": disableRoute,
//         type: "POST",
//         data: {'id': id,_token: token},
//         dataType : "json",
//         success: function(response)
//         {
//           InitTable();
//           swal("Success",response, "error");
//           //$('.delete').html(response);
//           //$('#delete').show();
//         },
//           error: function(){},          
//       });
// });

$(document).on('click', '.disable', function () {
    swal({
        title: "Are you sure?",
        text: "You want to disable this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var id = $(this).attr('data-id');
            $.ajax({
                "url": disableRoute,
                type: "POST",
                data: {'id': id, _token: token},
                dataType: "json",
                success: function (response) {
                    InitTable();
                    swal("Success",response, "error");
                    //$('.delete').html(response);
                    //$('#delete').show();
                },
                error: function () {
                },
            });
        }
    });
});

$(document).on('click', '.active', function()
{

    var id = $(this).attr('data-id');
    $.ajax({
        "url": activeRoute,
        type: "POST",
        data: {'id': id,_token: token},
        dataType : "json",
        success: function(response)
        {
          InitTable();
          swal("Success",response, "success");
         // $('.success').html(response);
         // $('#success').show();
        },
          error: function(){},          
      });
});