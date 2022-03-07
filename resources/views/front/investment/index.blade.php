@extends('layouts.page', ['body_class' => 'page-investment'])

@section('meta_title', 'Inwestycje w sprzedaży')

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
    <section>
        <div class="container">
            <div class="row flex-row-reverse position-relative">
                <div class="col-7">
                    <img src="https://placehold.co/940x720" alt="">
                </div>
                <div class="col-6 position-absolute pr-0 offset-absolute d-flex align-items-center">
                    <div class="offset-apla">
                        <div class="section-header text-center">
                            <span>MIASTO</span>
                            <h2>NAZWA INWESTYCJI</h2>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut porttitor velit. Pellentesque a ultrices lectus. Nullam sodales nulla at metus accumsan laoreet.</p>
                        <div class="d-flex justify-content-center">
                            <a href="" class="bttn">@lang('cms.goformore-button')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row position-relative">
                <div class="col-7">
                    <img src="https://placehold.co/940x720" alt="">
                </div>
                <div class="col-6 offset-6 position-absolute pl-0 offset-absolute d-flex align-items-center">
                    <div class="offset-apla">
                        <div class="section-header text-center">
                            <span>MIASTO</span>
                            <h2>NAZWA INWESTYCJI</h2>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut porttitor velit. Pellentesque a ultrices lectus. Nullam sodales nulla at metus accumsan laoreet.</p>
                        <div class="d-flex justify-content-center">
                            <a href="" class="bttn">@lang('cms.goformore-button')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

    </script>
@endpush
