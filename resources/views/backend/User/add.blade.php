@extends($layout)

@section('content')

<?php
$page_header_links = [
    ["title" => "Summary", "url" => route($routePrefix . ".index")]
];
?>

@include($partial_path . ".page_header")

<x-backend.form-errors />

<form action="{{ $form['url'] }}" method="POST">
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
                                    placeholder="Enter Name" 
                                    mandatory="true"
                                    />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <x-inputs.text-field type="email" name="email" label="Email" 
                                    placeholder="Enter Email" 
                                    mandatory="true"
                                    />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <x-inputs.drop-down name="roles[]" label="Roles" 
                                    :list="$role_list" 
                                    class="select2" 
                                    multiple="multiple"
                                    mandatory="true" 
                                    />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <x-inputs.text-field type="password" name="password" label="Password" 
                                    placeholder="Enter Password"
                                    mandatory="true"
                                    />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <x-inputs.text-field type="password" name="password_confirm" label="Confirm Password" 
                                    placeholder="Enter Confirm Password"
                                    mandatory="true"
                                    />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3 checkbox-checked">
                                <x-inputs.checkbox name="dont_send_email" label="Don't Send Email" :value="$model->dont_send_email" />
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