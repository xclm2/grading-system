require('bootstrap/dist/js/bootstrap')
require('bootstrap/js/src/toast')
require('bootstrap/js/src/popover')

var createToast = function (msg = null, type = null)
{
    var bg;
    switch (type) {
        case 'success': 
            bg = 'text-bg-success';
            break;
        case 'warning': 
            bg = 'text-bg-warning';
            break;
        case 'danger': 
            bg = 'text-bg-danger';
            break;
        default: 
            bg = 'text-bg-info';
            break;
            
    }
    // var toast = '<div class="toast-header">' +
    //                 '<strong class="me-auto">Bootstrap</strong>' +
    //                 '<small class="text-body-secondary">2 seconds ago</small>' +
    //                 '<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>' +
    //             '</div>' + 
    //             '<div class="toast-body">' +
    //             msg +
    //             '</div>';
    var toast = '<div class="d-flex">'+
    '<div class="toast-body">'+
     msg+
    '</div>'+
    '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>'+
 ' </div>'+
'</div>';
    var element = document.createElement('div');
    element.setAttribute('class', 'toast align-items-center border-0 ' + bg);
    element.setAttribute('role', 'alert');
    element.setAttribute('aria-live', 'assertive');
    element.setAttribute('aria-atomic', 'true');
    element.innerHTML = toast;
    document.getElementById('toasts').append(element);

    return element;
}

window.createToast = createToast;