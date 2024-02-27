@extends('producer.producer_dashboard')
@section('producer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item" ><a href="javascript:;" ><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter Vidéo  </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Ajouter Vidéo</h5>

            

            <form id="myForm" id="loading" action="{{ route('store.movie') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf

                <div id="loader" class="d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="progress mt-3">
                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p>Loading...</p>
                </div>

                

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Titre de la vidéo</label>
                    <input type="text" name="title" class="form-control" id="input1"  >
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Nom des acteurs </label>
                    <input type="text" name="actors" class="form-control" id="input1"  >
                </div>


                <div class="form-group col-md-6">
                    <label for="input2" class="form-label"> Image des acteurs  </label>
                    <input class="form-control" name="actor_image" type="file" id="image" accept="image/*" >
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Nom du producteur </label>
                    <input type="text" name="producer" class="form-control" id="input1"  >
                </div>


                <div class="form-group col-md-6">
                    <label for="input2" class="form-label"> Image du producteur </label>
                    <input class="form-control" name="producer_image" type="file" id="image" accept="image/*" >
                </div>

                <div class="form-group col-md-6">
                    <label for="input2" class="form-label"> Logo du film </label>
                    <input class="form-control" name="movie_logo" type="file" id="image" accept="image/*" >
                </div>

                <div class="form-group col-md-6">
                    <label for="input2" class="form-label"> image en portrait </label>
                    <input class="form-control" name="portrait_image" type="file" id="image" accept="image/*" >
                </div>

                <div class="form-group col-md-6">
                    <label for="input2" class="form-label"> image en paysage</label>
                    <input class="form-control" name="landscape_image" type="file" id="image" accept="image/*" >
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label"> Vidéo </label>
                    <input type="file" name="video" class="form-control"  accept="video/mp4, video/webm, video/avi, video/ovg " >
                </div>


                <div class="form-group col-md-6">
                    <label for="input1" class="form-label"> Bande Annonce </label>
                    <input type="file" name="trailer" class="form-control"  accept="video/mp4, video/webm" >
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Durée </label>
                    <input id="appt-time" type="time" name="appt-time" step="2" type="text" name="duration" class="form-control" id="input1">
                </div>

            <div class="form-group col-md-6">
                <label for="input1" class="form-label">Catégorie du film </label>
                <select name="category_id" class="form-select mb-3" aria-label="Default select example">
                    <option selected="" disabled>Ouvrir le menu</option>
                    @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="input1" class="form-label">Pays </label>
                <select name="country_id" class="form-select mb-3" aria-label="Default select example">
                    <option selected="" disabled>Ouvrir le menu</option>
                    @foreach ($countries as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->country_name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group col-md-12">
                <label for="input1" class="form-label"> Description </label>
                <textarea name="description" class="form-control" id="input11" placeholder="Description du film" rows="3"></textarea>
            </div>

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
          <button type="submit" id="submitBtn" style="background-color: #f67f00;" class="btn px-4">Enregistrer</button>

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

<script type="text/javascript">
    $(document).ready(function() {
        $('#loading').submit(function(event) {
            event.preventDefault(); // Prevent default form submission
            var form = $(this);
            var progressBar = $('#progressBar');
            $('#submitBtn').prop('disabled', true); // Disable the submit button to prevent multiple submissions
            $('#loader').removeClass('d-none'); // Show the loader

            // Start updating the progress bar
            var progress = 0;
            var interval = setInterval(function() {
                progress += 5; // Increment the progress bar
                progressBar.css('width', progress + '%').attr('aria-valuenow', progress);
                if (progress >= 100) {
                    clearInterval(interval); // Stop the progress when it reaches 100%
                }
            }, 500); // Adjust the interval as needed

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle success response here if needed
                    console.log(response);
                    clearInterval(interval); // Stop the progress when the response is received
                    $('#loader').addClass('d-none'); // Hide the loader
                    $('#submitBtn').prop('disabled', false); // Enable the submit button
                },
                error: function(xhr, status, error) {
                    // Handle error response here if needed
                    console.error(xhr.responseText);
                    clearInterval(interval); // Stop the progress in case of an error
                    $('#loader').addClass('d-none'); // Hide the loader
                    $('#submitBtn').prop('disabled', false); // Enable the submit button
                }
            });
        });
    });
</script>


<!-- 
<script type="text/javascript">
    $(document).ready(function() {
        $('#loading').submit(function(event) {
            event.preventDefault(); // Prevent default form submission
            var form = $(this);
            var progressBar = $('#progressBar');
            $('#submitBtn').prop('disabled', true); // Disable the submit button to prevent multiple submissions
            $('#loader').removeClass('d-none'); // Show the loader

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            progressBar.css('width', percentComplete + '%');
                            if (percentComplete === 100) {
                                // Hide the loader and enable the submit button when the loading is complete
                                $('#loader').addClass('d-none');
                                $('#submitBtn').prop('disabled', false);
                            }
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    // Handle success response here if needed
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle error response here if needed
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

-->



@endsection
