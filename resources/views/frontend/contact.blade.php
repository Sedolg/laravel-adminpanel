@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
    <div class="row justify-content-center my-4">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h4 class="mb-1">
                        <i class="fas fa-envelope-open-text text-primary mr-2"></i>
                        @lang('labels.frontend.contact.box_title')
                    </h4>
                    <p class="text-muted small mb-0">
                        Have a question or feedback? Fill out the form below and we will get back to you as soon as possible.
                    </p>
                </div><!--card-header-->

                <div class="card-body px-4 pb-4">
                    {{ html()->form('POST', route('frontend.contact.send'))->open() }}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="font-weight-bold small">@lang('validation.attributes.frontend.name') <span class="text-danger">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>

                                    {{ html()->text('name', old('name', optional(auth()->user())->name))
                                        ->class('form-control' . ($errors->has('name') ? ' is-invalid' : ''))
                                        ->placeholder(__('validation.attributes.frontend.name'))
                                        ->attribute('maxlength', 191)
                                        ->attribute('autocomplete', 'name')
                                        ->required()
                                        ->autofocus() }}

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div><!--input-group-->
                            </div><!--form-group-->

                            <div class="form-group col-md-6">
                                <label for="email" class="font-weight-bold small">@lang('validation.attributes.frontend.email') <span class="text-danger">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>

                                    {{ html()->email('email', old('email', optional(auth()->user())->email))
                                        ->class('form-control' . ($errors->has('email') ? ' is-invalid' : ''))
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->attribute('autocomplete', 'email')
                                        ->required() }}

                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div><!--input-group-->
                            </div><!--form-group-->
                        </div><!--form-row-->

                        <div class="form-group">
                            <label for="phone" class="font-weight-bold small">@lang('validation.attributes.frontend.phone')</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>

                                {{ html()->input('tel', 'phone', old('phone'))
                                    ->class('form-control' . ($errors->has('phone') ? ' is-invalid' : ''))
                                    ->placeholder(__('validation.attributes.frontend.phone'))
                                    ->attribute('maxlength', 191)
                                    ->attribute('autocomplete', 'tel') }}

                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div><!--input-group-->
                        </div><!--form-group-->

                        <div class="form-group">
                            <label for="message" class="font-weight-bold small">@lang('validation.attributes.frontend.message') <span class="text-danger">*</span></label>

                            {{ html()->textarea('message', old('message'))
                                ->class('form-control' . ($errors->has('message') ? ' is-invalid' : ''))
                                ->placeholder(__('validation.attributes.frontend.message'))
                                ->attribute('rows', 6)
                                ->required() }}

                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div><!--form-group-->

                        @if(config('access.captcha.contact'))
                            <div class="form-group">
                                @captcha
                                {{ html()->hidden('captcha_status', 'true') }}

                                @error('g-recaptcha-response')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div><!--form-group-->
                        @endif

                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mt-4">
                            <small class="text-muted mb-3 mb-sm-0">
                                <span class="text-danger">*</span> Required fields
                            </small>

                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-paper-plane mr-1"></i>
                                @lang('labels.frontend.contact.button')
                            </button>
                        </div>
                    {{ html()->form()->close() }}
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection

@push('after-scripts')
    @if(config('access.captcha.contact'))
        @captchaScripts
    @endif
@endpush
