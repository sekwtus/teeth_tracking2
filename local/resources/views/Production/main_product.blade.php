@extends('layouts.template')

@section('stylesheet')
    <style>
        /* The container */
        .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border: solid black;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
        background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
        background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
        display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        }

        .checkbox-toolbar {
            margin: 10px;
        }

        .checkbox-toolbar input[type="checkbox"] {
            display:none;
        }

        .checkbox-toolbar label {
                display:inline-block;
                background-color:#ddd;
                width: 100%;
                height: 15%;
                padding: 20px;
                font-size:14px;
                cursor: pointer;
                border: solid white;
                /* border: 2px solid #444; */
                /* border-radius: 4px;     */
            }
        .checkbox-toolbar label:hover {
            color: #212529;
                background-color: #cddde5;
                border-color: #c4d7e1;
        }

        .checkbox-toolbar input[type="checkbox"]:checked + label {
            color: #fff;
                background-color: #19d895;
                border-color: #19d895;
        }
    </style>
@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ชื่อแผนก</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_department as $out_data_department)
                                <tr>
                                    <td>{{$out_data_department->ID}}</td>
                                    <td>{{$out_data_department->Name}}</td>
                                    <td>                                                
                                        <a href="{{ url('/product').'/'.$out_data_department->ID }}">
                                            <button type="submit" class="btn btn-success" style="padding:10px;">รายละเอียด</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>
@stop
