@extends('producer.producer_dashboard')
@section('producer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter Vidéo</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Ajouter Vidéo</h5>

            <form id="myForm" action="{{ route('store.up') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label"> Vidéo </label>
                    <input type="file" name="uploads" class="form-control"  accept="video/mp4, video/webm, video/avi, video/ovg " >
                </div>

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
          <button type="submit" class="btn btn-primary px-4">Enregistrer</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
       var counter = 0;
       $(document).on("click",".addeventmore",function(){
             var whole_extra_item_add = $("#whole_extra_item_add").html();
             $(this).closest(".add_item").append(whole_extra_item_add);
             counter++;
       });
       $(document).on("click",".removeeventmore",function(event){
             $(this).closest("#whole_extra_item_delete").remove();
             counter -= 1
       });
    });
 </script>
 <!--========== End of add multiple class with ajax ==============-->


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                title: {
                    required : true,
                },

            },
            messages :{
                title: {
                    required : 'Veuillez saisir le titre',
                },

            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
