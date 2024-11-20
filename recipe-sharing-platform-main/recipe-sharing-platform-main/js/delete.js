function confirmDelete(recipeId) {
    const swalWithBootstrapButtons = Swal.mixin({
        
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger",
            showClass: {
                popup: `
                  animate__animated
                  animate__fadeInUp
                  animate__faster
                `
              }
        },
       
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You wanna delete this recipe !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true,
       
    }).then((result) => {
        if (result.isConfirmed) {

            const formData = new FormData();
            formData.append('delete_recipe_id', recipeId);
            fetch('delete.php', {
                method: 'POST',
                body: formData
            }).then(response => {
                swalWithBootstrapButtons.fire({
                    title:"Deleted!",
                    text: "Your recipe has been deleted.",
                    icon: "success",
                    

                }).then(response => {
                    location.reload()                      
    
                    })


            }).catch(error => {
                console.error('Error:', error);
            });

            
        }
    });

}


