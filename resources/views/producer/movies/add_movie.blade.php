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

            <form id="myForm" action="{{ route('store.category') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Titre de la vidéo</label>
                    <input type="text" name="title" class="form-control" id="input1"  >
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Nom des acteurs </label>
                    <input type="text" name="actors" class="form-control" id="input1"  >
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Pays </label>
                    <input type="text" name="country" class="form-control" id="input1"  >
                </div>

                <div class="form-group col-md-6">
                    <label for="input2" class="form-label"> Image des acteurs  </label>
                    <input class="form-control" name="actor_image" type="file" id="image">
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Nom du producteur </label>
                    <input type="text" name="producer" class="form-control" id="input1"  >
                </div>


                <div class="form-group col-md-6">
                    <label for="input2" class="form-label"> Image du producteur </label>
                    <input class="form-control" name="producer_image" type="file" id="image">
                </div>

                <div class="form-group col-md-6">
                    <label for="input2" class="form-label"> Logo du film </label>
                    <input class="form-control" name="movie_logo" type="file" id="image">
                </div>


                <div class="form-group col-md-6">
                    <label for="input1" class="form-label"> Vidéo </label>
                    <input type="file" name="video" class="form-control"  accept="video/mp4, video/webm" >
                </div>


                <div class="form-group col-md-6">
                    <label for="input1" class="form-label"> Bande Annonce </label>
                    <input type="file" name="trailer" class="form-control"  accept="video/mp4, video/webm" >
                </div>
                
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Durée </label>
                    <input type="text" name="duration" class="form-control" id="input1"  >
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


            <div class="form-group col-md-12">
                <label for="input1" class="form-label"> Description </label>
                <textarea name="description" class="form-control" id="input11" placeholder="Description du film" rows="3"></textarea>
            </div>

            <!-- 

            <div class="form-group col-md-12">
                <label for="input1" class="form-label"> Description </label>
                <textarea name="description" class="form-control" id="myeditorinstance"></textarea>
            </div>

            -->


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
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                category_name: {
                    required : true,
                },
                image: {
                    required : true,
                },

            },
            messages :{
                category_name: {
                    required : 'Veuillez saisir le nom de la catégorie',
                },
                image: {
                    required : 'Veuillez sélectionner une image',
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
