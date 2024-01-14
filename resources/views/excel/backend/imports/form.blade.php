@extends('backend.layouts.main')

@section('content')
<main id="main-container">
<!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{$form['title']}}</h3>
            </div>
            <div class="block-content pb-4">
                <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" id="btabs-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-home" role="tab" aria-controls="btabs-static-home" aria-selected="false" tabindex="-1">
                            {{ __('basic_data') }}
                        </button>
                    </li>
                    @if($show??false)
                    <li class="nav-item audit-tab" role="presentation">
                        <button type="button" class="nav-link" id="btabs-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-profile" role="tab" aria-controls="btabs-static-profile" aria-selected="false" tabindex="-1">
                            {{ __('audit') }}
                        </button>
                    </li>
                    @endif
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabs-static-home" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                        <form action="{{$form['action']}}" method="POST" name="{{$form['name']}}" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="{{$form['method']}}">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <x-backend.select 
                                        :children="($form['fields']['model']['children']??[])" 
                                        :options="$form['fields']['model']['options']" 
                                        :text="$form['fields']['model']['text']" 
                                        :name="$form['fields']['model']['name']" 
                                        :placeholder="$form['fields']['model']['placeholder']"
                                        :required="$form['fields']['model']['required']??false"
                                        :disabled="($form['fields']['model']['disabled']??false)"
                                        :multiple="($form['fields']['model']['multiple']??false)"
                                        :value="($form['fields']['model']['value']??'')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-4" id="file-col">
                                    <x-backend.input 
                                        :tag="$form['fields']['file']['tag']" 
                                        :type="$form['fields']['file']['type']" 
                                        :text="$form['fields']['file']['text']" 
                                        :name="$form['fields']['file']['name']" 
                                        :placeholder="$form['fields']['file']['placeholder']"
                                        :required="($form['fields']['file']['required']??false)"
                                        :disabled="($form['fields']['file']['disabled']??false)"
                                        :value="($form['fields']['file']['value']??'')" />
                                </div>
                                <span class="text-danger mb-4">(只支援.csv檔案類型)</span>
                            </div>
                            <div class="row">
                                <div class="mb-4">
                                    @if(!($show??false))
                                    <button type="submit" class="btn btn-primary">{{__('backend.common.sent')}}</button>
                                    @endif
                                    @if($form['back'] !== false)
                                    <a href="{{$form['back']}}" class="btn btn-secondary">{{__('backend.common.back')}}</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <div id="template_area" class="d-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- END Page Content -->
</main>
@stop
@push('style')
<style>
    [id="file-col"] > div {
        margin-bottom: 0!important;
    }

    [id="file-col"] > div > p {
        margin-bottom: 0!important;
    }
</style>
@endpush