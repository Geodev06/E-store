<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
<script src="{{ asset('main/js/jquery-3.3.1.min.js') }}"></script>
<!-- Css Styles -->
<link rel="stylesheet" href="{{ asset('main/css/bootstrap.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('main/css/font-awesome.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('main/css/elegant-icons.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('main/css/nice-select.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('main/css/jquery-ui.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{ asset('main/css/owl.carousel.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('main/css/slicknav.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('main/css/style.css') }}" type="text/css">
<script>
    function showToast(msg, type) {

        var Bg = ''
        var Title = ''
        var Icon = ''
        var progressColor = ''
        var msgColor = ''
        var titleColor = ''
        var iconColor = ''

        switch (type) {
            case 1: // success

                Bg = '#5cb85c'
                Title = 'Success'
                Icon = 'mdi mdi-check-bold'
                progressColor = 'white'
                msgColor = 'white'
                titleColor = 'white'
                iconColor = 'white'

                break;
            case 2: // error

                Bg = '#f25a57'
                Title = 'Error'
                Icon = 'mdi mdi-alert-circle'
                progressColor = 'white'
                msgColor = 'white'
                titleColor = 'white'
                iconColor = 'white'
                break;
            case 3: // info
                Bg = 'rgb(150, 213, 232)'
                Title = 'Info'
                Icon = 'mdi mdi-check-circle-outline'
                progressColor = 'white'
                msgColor = 'white'
                titleColor = 'white'
                iconColor = 'white'
                break;
            default:
                break;
        }

        iziToast.show({
            theme: 'light',
            icon: Icon,
            titleColor: titleColor,
            iconColor: iconColor,
            titleSize: '17px',
            title: Title,
            message: msg,
            backgroundColor: Bg,
            messageColor: msgColor,
            maxWidth: 500,
            position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: progressColor,
            onOpening: function(instance, toast) {
                console.info('callback abriu!');
            },
            onClosing: function(instance, toast, closedBy) {
                console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
            }
        })
    }
</script>