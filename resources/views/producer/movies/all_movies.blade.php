@extends('producer.producer_dashboard')
@section('producer')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter vidéo</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
           <a href="{{ route('add.movie') }}" class="btn px-5" style="background-color: #f67f00;" >Ajouter vidéo </a>
            </div>
        </div>
         
        <!-- 
        <div class="ms-auto">
            <div class="btn-group">
           <a href="{{ route('add.up') }}" class="btn btn-primary px-5">Ajouter test </a>
            </div>
        </div>
        -->
        
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Titre de la vidéo</th>
                            <th>Date d'ajout</th>
                            <th>Vues</th>
                            <!-- 
                            <th>Action</th>
                            -->
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($movies as $key=> $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                {{ $item->title }} 
                            </td>
                            <!-- 
                            <td>
                            <video width="200" height="70" controls>
                                <source src="{{ $item->video }}" type="video/ogg">  <source src="{{ $item->video }}" type=video/avi>   <source src="{{ $item->video }}" type="video/mp4, video/avi, video/webm, video/ogg">
                            </video>
                            </td>
                            -->
                            <td>{{ $item->created_at }}</td>
                            <td></td>
                            <!--
                            <td>
                            <a href="{{ route('edit.category',$item->id) }}" class="btn btn-info px-5">Modifier </a>
                            
                            <a href="{{ route('delete.category',$item->id) }}" class="btn btn-danger px-5" id="delete">Supprimer </a>
                            
                            </td>
                            -->
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>




</div>




@endsection
