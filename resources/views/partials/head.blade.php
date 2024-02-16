 <!--     Fonts and icons     -->
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700" rel="stylesheet" />
 <!-- Nucleo Icons -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css">
 <!-- Font Awesome Icons -->
 <script src="https://kit.fontawesome.com/349ee9c857.js" crossorigin="anonymous"></script>
 <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
 <!-- CSS Files -->
 <link id="pagestyle" href="{{ asset('assets/css/corporate-ui-dashboard.css?v=1.0.0') }}" rel="stylesheet" />
 <style>
     .label_error {
         font-size: 12px;
         margin-bottom: 0;
         color: red;
     }
 </style>

 <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
 <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
 <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
 <link rel="stylesheet" href="{{ asset('iztoast/css/iziToast.min.css') }}">
 <script src="{{ asset('iztoast/js/iziToast.min.js') }}"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

     function loadTable(table_name, url, columns) {
         // Initialize a variable to store the DataTable instance
         var dataTableInstance;

         $(document).ready(function() {
             // Store the DataTable instance in the variable
             dataTableInstance = $(table_name).DataTable({
                 ajax: url,
                 columns: columns,
                 responsive: true,
                 serverSide: true,
                 search: {
                     return: true
                 }
             });
         });

         // Return the DataTable instance
         return {
             reload: function() {
                 if (dataTableInstance) {
                     dataTableInstance.ajax.reload();
                 }
             }
         };
     }

     function turn_selectize(element) {
         $(element).selectize({
             maxItems: 5,
             plugins: ["clear_button", "remove_button"]
         })
     }
 </script>