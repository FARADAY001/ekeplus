$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: '?',
                    text: "Êtes-vous sûr  ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f67f00',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Supprimé!',
                        'Votre fichier a été supprimé.',
                        'success'
                      )
                    }
                  })


    });

  });
