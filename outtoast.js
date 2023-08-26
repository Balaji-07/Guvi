document.addEventListener("DOMContentLoaded", function() {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            }
          });

          Toast.fire({
            icon: "success",
            title: "Logged out"
          });

          setTimeout(function() {
            history.pushState(null, "", "index.php");
          }, 3000);

        });