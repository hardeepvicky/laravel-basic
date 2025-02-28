@extends($layout)

@section('content')

<?php
$page_header_links = [
    ["title" => "Summary", "url" => route($routePrefix . ".index")]
];
?>

@include($partial_path . ".page_header")

<x-backend.form-errors />

<form action="{{ $form['url'] }}" method="POST" class="">
    {!! csrf_field() !!}
    {{ method_field($form['method']) }}

    <div class="row">
        <div class="offset-md-2 col-md-8">
            <div class="card">
                <div class="card-header card-no-border pb-0">
                    <h3>Basic</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <x-inputs.text-field name="name" label="Name" 
                                    :value="$model->name"
                                    placeholder="Enter Name" 
                                    autocomplete="off"
                                    mandatory="true"
                                    />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3 checkbox-checked">
                                <x-inputs.checkbox name="is_admin" label="Admin" :value="$model->is_admin" />
                                <x-inputs.checkbox name="is_active" label="Active" :value="$model->is_active" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-backend.form-common-footer-buttons />
        </div>
    </div>
</form>

@endsection