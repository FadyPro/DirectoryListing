<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>{{ config('settings.site_name') }}</title>
    <link rel="icon" type="image/png" href="{{ config('settings.favicon') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
    <style>
        :root {
            --colorPrimary: {{ config('settings.site_default_color') }};
        }
    </style>

    @stack('styles')
    <script>
        var PUSHER_APP_KEY = "{{ config('settings.pusher_app_key') }}";
        var PUSHER_APP_CLUSTER = "{{ config('settings.pusher_cluster') }}";
        var USER = {
            id: "{{ auth()->user()?->id }}",
            name: "{{ auth()->user()?->name }}",
            avatar: "{{ asset(auth()->user()?->avatar) }}"
        }
    </script>
    @vite(['resources/js/app.js', 'resources/js/frontend.js'])
</head>

<body>

    <!--==========================
        Navbar Start
    ===========================-->
    <livewire:layout.frontend.navbar />

    <!--==========================
        Navbar End
    ===========================-->

    <!--==========================
        Contents Start
    ===========================-->
    {{$slot}}
    <!--==========================
        Contents End
    ===========================-->

    <!--==========================
        FOOTER PART START
    ===========================-->
    @include('layouts.frontend.footer')
    <!--==========================
        FOOTER PART END
    ===========================-->

    <!--==========================
        Listing Modal
    ===========================-->
    <section id="wsus__map_popup">
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close popup_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="far fa-times"></i></button>
                    <div class="modal-body modal-listing-content">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==========================
        Listing Modal END
    ===========================-->


    <!--=============SCROLL BTN==============-->
    <div class="scroll_btn">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--=============SCROLL BTN==============-->


    <!--jquery library js-->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
    <!--slick js-->
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <!--venobox js-->
    <script src="{{ asset('frontend/js/venobox.min.js') }}"></script>
    <!--counter js-->
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
    <!--nice select js-->
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <!--isotope js-->
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <!--summer_note js-->
    <script src="{{ asset('frontend/js/summernote.min.js') }}"></script>
    <!--select js-->
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.tiny.cloud/1/ibjqsfqbq2j50f5cvgx7pc4neteoxtwotttkk9lhqam9rkew/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <!--main/custom js-->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <script>
        window.addEventListener('alert', event => {
            toastr[event.detail[0].types](event.detail[0].message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });
    </script>

    <script>
        $(document).ready(function () {

            $('body').on('click', '.delete-item', function (e) {
                e.preventDefault()

                let url = $(this).attr('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {_token: "{{ csrf_token() }}"},
                            success: function (response) {
                                if (response.status === 'success') {
                                    toastr.success(response.message)

                                    window.location.reload();

                                } else if (response.status === 'error') {
                                    toastr.error(response.message)
                                }
                            },
                            error: function (error) {
                                console.error(error);
                            }
                        })
                    }
                })
            })
        })
    </script>

    @stack('scripts')
</body>

</html>
