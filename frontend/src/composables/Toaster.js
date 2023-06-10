import Swal from 'sweetalert2'

class Toaster {
  constructor() {
    this.toaster = Swal.mixin({
      toast: true,
      position: 'top',
      iconColor: 'white',
      customClass: {
        popup: 'colored-toast'
      },
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      showCloseButton: true
    })
  }

  error(message) {
    this.toaster.fire({
      icon: 'error',
      title: `${message}`
    })
  }

  warning(message) {
    this.toaster.fire({
      icon: 'warning',
      title: `${message}`
    })
  }

  success(message) {
    this.toaster.fire({
      icon: 'success',
      title: `${message}`
    })
  }

  info(message) {
    this.toaster.fire({
      icon: 'info',
      title: `${message}`
    })
  }
}

const toaster = new Toaster()

export default toaster
