<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content=" {{ csrf_token() }} ">


    {{-- bootstap --}}
    <script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js" ></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.css" >
    
    {{-- datatables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"  >

    {{-- font awesome --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/regular.min.css') }}">

    <title>Display</title>
</head>
<body>
    <div id='app' class="container">
        <div class="row">
            <h3>The Dummies</h3>
        </div>
        <br>
        <br>
        <!-- Button trigger modal -->
        <div class="row">
            <button type="button" id="add_dummy_btn" class="btn btn-primary" data-toggle="modal" data-target="#modal"><i class="far fa-plus-square"></i> &nbsp; Add New</button>    
        </div>
        <br>
        <!-- Modal -->
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_title">Add Dummy</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {{-- Add dummy form --}}
            <form id="dummy_form" action="" >
                @csrf {{ method_field('POST') }}
            <div class="modal-body">
                <input type="text" name="dummy_id" hidden >
                <div class="form-group">
                    <label >Name:</label>
                    <input type="text" id="name" name="name" class="form-control" >
                </div>
                <div class="form-group">
                        <label >Email:</label>
                        <input type="text" id="email" name="email" class="form-control" >
                </div>
                <div class="form-group">
                    <label >Gender:</label>
                    <input type="text" id="gender" name="gender" class="form-control" >
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class=" btn btn-secondary" data-dismiss="modal">Close</button>
              <a id="dummy_btn" name="dummy" class="btn text-white" >Save Dummy</a>
            </div>
            </form>
          </div>
        </div>
      </div>
    
      <div class="row">
            <table id="my_table" class="table"> 
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                @include('sweet::alert')
            </div>
        </div>
    </div>

    <script>
        var showDummy, editDummy,deleteDummy;

        $(document).ready( function () {

            var table = $("#my_table").DataTable({
                "processing":true,
                "serverSide":true,
                "ajax": "{{route('resource')}}",
                "columns": [
                    {data:"id",name:"id"},
                    {data:"name",name:"name"},
                    {data:"email",name:"email"},
                    {data:"gender",name:"gender"},
                    {data:"action",name:"action", orderable:false,searchable:false}
                ]
            });

            //add dummy btn
            $('#add_dummy_btn').click(function(){
                $("#modal #modal_title").html('Add Dummy');
                $('#dummy_btn').html('Save dummy');
                $('#dummy_btn').attr('class','btn btn-primary text-white');
                $('#dummy_btn').attr('name','add_dummy_btn');
                $('#dummy_btn').show();

                $("#modal input").removeAttr('readonly'); 
                document.getElementById("dummy_form").reset();
            });

            //show dummy
            showData = function(id,operation)
            {
                $.ajax({
                    url: "{{route('dummy.show')}}",
                    type:"GET",
                    data:  {id: id},
                    success: function(response){
                        if(response!= null)
                        {
                            $("#modal #modal_title").html('Show Dummy');

                            $("#modal input[name='dummy_id']").val(id);
                            $("#modal input[name='name']").val(response.name);
                            $("#modal input[name='email']").val(response.email);
                            $("#modal input[name='gender']").val(response.gender);
                            
                            $("#modal input").attr('readonly','readonly'); 
                            $('#dummy_btn').hide();

                            if(operation==2)
                            {
                                $("#modal #modal_title").html('Edit Dummy');
                                $('#dummy_btn').html('Update');
                                $('#dummy_btn').attr('class','btn btn-warning text-white');
                                $('#dummy_btn').attr('name','update_dummy_btn');
                                $('#dummy_btn').show();

                                $("#modal input").removeAttr('readonly'); 
                                
                            }
                            else if(operation==3)
                            {
                                $("#modal #modal_title").html('Delete Dummy');
                                $('#dummy_btn').html('Delete');
                                $('#dummy_btn').attr('class','btn btn-danger text-white');
                                $('#dummy_btn').attr('name','delete_dummy_btn');
                                $('#dummy_btn').show();

                                $("#modal input").attr('readonly','readonly'); 
                            }

                            $('#modal').modal('toggle');
                        }
                        else
                            swal("Error!", "Data Not found!!", "error");
                    },
                    error : function(response){
                        swal("Error!", "Something wrong!!", "error");
                    }
                });    
            }
            
            //insert update delete 
            $("#dummy_btn").click(function(e){
                e.preventDefault();
                var btn_name = $(this).attr("name");

                //insert dummy
                if(btn_name=="add_dummy_btn"||btn_name=="update_dummy_btn")
                {
                    var url, message;
                    (btn_name=="add_dummy_btn")? (url = "{{route('dummy.add')}}", message="Data Inserted Successfully") : (url = "{{route('dummy.update')}}", message="Data Updated Successfully") ;

                    $.ajax({
                        url: url,
                        type:"POST",
                        data:  $('#dummy_form').serialize(),
                        success: function(response){
                            if(response)
                            {
                                $('#modal').modal('toggle');
                                swal("Job Done!", message, "success");
                                table.ajax.reload( null, false ); // user paging is not reset on reload 
                            }
                            else
                                swal("Error!", "Operation Not Completed!!", "error");
                        },
                        error : function(response){
                            swal("Error!", "Server not responded properly!!", "error");
                        }
                    });
                }
                //update dummy
                else if(btn_name=="update_dummy_btn")
                {
                    console.log('in update');
                }
                //delete dummy
                else if(btn_name=="delete_dummy_btn")
                {
                    console.log('in delete');
                }
                
            });
            

        });
        
    </script>

</body>
</html>