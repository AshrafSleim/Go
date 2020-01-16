@include('admin.layouts.header')
@include('admin.layouts.navbar')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <ol class="breadcrumb">

                @yield('breadcrumb')
            </ol>
        </section>
<br>
    <section class="content">
        @include('admin.layouts.message')
        @yield('content')
    </section>
</div>


@include('admin.layouts.footer')
