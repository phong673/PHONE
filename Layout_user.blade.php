<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicons Icon -->
    
    <title>Thoi trang - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS Style -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" media="all">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery.mobile-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/revslider.css') }}">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600,800,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700' rel='stylesheet' type='text/css'>
    <!-- Toastr style -->
    <link href="{{ asset('backend/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body class="cms-index-index cms-home-page">
    <div id="page">
        <!-- Header -->
        @include('FrontEnd.header')
        <!-- end header -->
        @yield('content')
        <!-- Footer -->
        @include('FrontEnd.footer')
        <!-- End Footer -->
        
    </div>
         

        <!-- JavaScript -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
        <script src="{{ asset('frontend/js/revslider.js') }} "></script>
        <script src="{{ asset('frontend/js/common.js') }} "></script>
        <!-- Toastr script -->
        <script src="{{ asset('backend/js/plugins/toastr/toastr.min.js') }}"></script>

        @if (Session::get('message'))
            toastr.success(Session::get('message'), 'Notification');
        @endif
        @if (Session::get('message_err'))
            toastr.error(Session::get('message_err'), 'Notification');
        @endif
        <script>
            function loadSidebar() {
                $.ajax({
                    type: 'get',
                    url: '{{ route('home.create') }}',
                    dataType: 'json',
                    success: function(response) {
                        $('#countCart').html(response.countData);
                        $('#cart-sidebar').html(response.data);
                    }
                });
            }

            function loadShopping() {
                $.ajax({
                    type: 'get',
                    url: '{{ route('cart.index') }}',
                    dataType: 'json',
                    success: function(response) {
                        $('#loadShoppingcart').html(response.data);
                        $('#cartTotal').html(response.dataTotal);
                        $('#delButtonall').html(response.dataDel);
                    }
                });
            }

            function loadCompare() {
                $.ajax({
                    type: 'get',
                    url: '{{ route('product-detail.create') }}',
                    dataType: 'json',
                    success: function(response) {
                        $('#loadare').html(response.data);
                    }
                });
            }
            @if (Session::get('compare'))
                @foreach (Session::get('compare') as $com)
                    var id_session = {{ $com['id_pro'] }};

                    if(id_session){
                    $('a[data-compare_id='+id_session+']').addClass('wishcolor');
                    }else{
                    $('a[data-compare_id='+id_session+']').removeClass('wishcolor');
                    }
                @endforeach
            @endif
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
                loadSidebar();
                // Add Cart
                $(document).on('click', '.add_cart', function(e) {
                    e.preventDefault();
                    var id_procart = $(this).data('id_pro');

                    $.ajax({
                        type: 'post',
                        url: '{{ route('home.store') }}',
                        data: {
                            id_procart: id_procart
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 200) {
                                loadSidebar();
                                loadShopping();
                                toastr.success(response.message, 'Notification');
                            } else {
                                toastr.error(response.message, 'Notification');
                            }
                        }
                    });
                });
                // Delete Cart Sidebar Ajax
                $(document).on('click', '.remove_cart_rowId', function(e) {
                    var href_rowid = $(this).data('href_rowid');

                    $.ajax({
                        type: 'get',
                        url: href_rowid,
                        success: function(response) {
                            loadSidebar();
                            loadShopping();
                        }
                    });
                });
                // Add Wishlist
                $(document).on('click', '.add_Wishlist', function(e) {
                    e.preventDefault();
                    var id = $(this).attr('id');

                    $.ajax({
                        type: 'post',
                        url: '{{ route('wishlist.store') }}',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if (response.action == 'Add') {
                                $('a[id=' + id + ']').addClass('wishcolor');
                                toastr.success(response.message, 'Notification');
                            } else {
                                $('a[id=' + id + ']').removeClass('wishcolor');
                            }
                        }
                    });
                });
                // Add Compare
                $(document).on('click', '.add_compare', function(e) {
                    e.preventDefault();
                    var id = $(this).data('compare_id');

                    $.ajax({
                        type: 'get',
                        url: '{{ route('wishlist.create') }}',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.action == 'Add') {
                                $('a[data-compare_id=' + id + ']').addClass('wishcolor');
                                toastr.success(response.message, 'Notification');
                                loadCompare()
                            } else {
                                $('a[data-compare_id=' + id + ']').removeClass('wishcolor');
                                loadCompare()
                            }
                        }
                    });
                });
                // Add Cart Quickview
                @foreach ($product_modal as $pro_show)
                $(document).on('submit','#product_addtocart_form_quickview{{$pro_show->product_id}}', function(e){
                    e.preventDefault();
                    var id_pro = {{$pro_show->product_id}};
                    var qtycart = $('#qty{{$pro_show->product_id}}').val();

                    $.ajax({
                        type: 'post',
                        url: '{{ route('cart.store') }}',
                        data: {
                            qtycart:qtycart,
                            id_pro:id_pro
                        },
                        dataType: 'json',
                        success:function(response){
                            loadSidebar();
                            toastr.success(response.message, 'Notification');
                        }
                    });
                });
                @endforeach
                // Autocomplete Search
                $('#search').typeahead({

                    source: function(query, process){

                        $.ajax({
                            type: 'get',
                            url: "{{ route('home') }}",
                            data: {query:query},
                            dataType: 'JSON',
                            success:function(data){
                                process(data);
                            }
                        });

                    }

                });

            });
        </script>
        @yield('js')

</body>

</html>
