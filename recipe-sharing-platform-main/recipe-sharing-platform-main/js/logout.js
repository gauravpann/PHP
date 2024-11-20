function loggingOut() {


    Swal.fire({
        title: "You Sure You wanna Log Out?",
        showDenyButton: true,
        confirmButtonText: "yes",
        denyButtonText: `Don't Log Out`
      }).then((result) => {
        
        if (result.isConfirmed) {
          fetch('logout.php').then(response => {
            location.reload()                      

            }).catch(error => {
        console.error('Error:', error);
    });
        }
      });

    

}