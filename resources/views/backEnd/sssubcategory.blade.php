@extends('backEnd.layout')

@section('content')
<?php
use App\Ssubcategory;
?>
    <?php
          $uploadPath = "uploads/categories/";
    ?>
    <div class="padding">
        <div class="box">

            <div class="box-header dker">
                <h3>{{ Ssubcategory::find($category_id)->name }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    
                    <a href="">{{ trans('backLang.subcategory') }}</a> /
                    <a href="">{{ trans('backLang.subcategory') }}</a> /
                    <a href="">{{ trans('backLang.subcategory') }}</a>
                </small>
            </div>

            @if($Categories->total() >0)
                @if(@Auth::user()->permissionsGroup->webmaster_status)
                    <div class="row p-a pull-right" style="margin-top: -70px;">
                        <div class="col-sm-12">
                            <a class="btn btn-fw primary" href="{{route("sssubcategoriesCreate",["category_id"=>$category_id])}}">
                                <i class="fa fa-plus"></i>
                                &nbsp; {{ trans('backLang.addsubcategory') }}
                            </a>
                            <a class="btn btn-fw primary" href="{{route("categories")}}">
                                <i class="fa fa-list-alt"></i>
                                &nbsp; {{ trans('backLang.maincategory') }}
                            </a>
                        </div>
                    </div>
                     
                    
                @endif
            @endif
            <!-- @if($Categories->total() >0)
                @if(@Auth::user()->permissionsGroup->webmaster_status)
                   <div class="col-lg-4">
                        {{Form::open(array('url'=>'', 'files'=>true))}}
                            <div class="form-group">
                                <label for="">Categories</label>
                                <select name="" class="form-control input-sm" id="">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">SubCategories</label>
                                <select name="" class="form-control input-sm" id="">
                                    <option value=""></option>
                                </select>
                            </div>
                        {{Form::close()}}
                   </div>
                @endif
            @endif -->
            @if($Categories->total() == 0)
                <div class="row p-a">
                    <div class="col-sm-12">
                        <div class=" p-a text-center ">
                            {{ trans('backLang.noData') }}
                            <br>
                            @if(@Auth::user()->permissionsGroup->webmaster_status)
                                <br>
                                <a class="btn btn-fw primary" href="{{route("sssubcategoriesCreate",["category_id"=>$category_id])}}">
                                    <i class="fa fa-plus"></i>
                                    &nbsp; {{ trans('backLang.addsubcategory') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if($Categories->total() > 0)
                {{Form::open(['route'=>'categoriesUpdateAll','method'=>'post'])}}
                <div class="table-responsive" style="width:50%">
                    <table class="table table-striped  b-t">
                        <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll" type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>No</th>
                            
                            <th>{{ trans('backLang.title') }}</th>
                            <th class="text-center" style="width:200px;">{{ trans('backLang.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i = 0;
                        ?>
                        @foreach($Categories as $Category)
                            <?php $i++; ?>
                            <tr>
                                <td><label class="ui-check m-a-0">
                                        <input type="checkbox" name="ids[]" value="{{ $Category->id }}"><i
                                                class="dark-white"></i>
                                        {!! Form::hidden('row_ids[]',$Category->id, array('class' => 'form-control row_no')) !!}
                                    </label>
                                </td>
                                <td>
                                    {!! $i  !!}
                                </td>
                                
                                <td>
                                    <a href=" "
                                    <small>{!! $Category->name !!}</small>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm success"
                                       href="{{ route("ssubcategoriesEdit",["id"=>$Category->id,"$category_id"]) }}">
                                        <small><i class="material-icons">&#xe3c9;</i> {{ trans('backLang.edit') }}
                                        </small>
                                    </a>
                                    @if(@Auth::user()->permissionsGroup->webmaster_status)
                                        <button class="btn btn-sm warning" data-toggle="modal"
                                                data-target="#m-{{ $Category->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate">
                                            <small><i class="material-icons">&#xe872;</i> {{ trans('backLang.delete') }}
                                            </small>
                                        </button>
                                    @endif


                                </td>
                                <!-- <td>
                                    <a class="btn btn-sm primary"
                                       href="{{ route("sssubCategories",["category_id"=>$Category->id]) }}">
                                        <small><i class="fa fa-plus"></i> {{ trans('backLang.addsubcategory') }}
                                        </small>
                                    </a>
                                </td> -->
                            </tr>
                            <!-- .modal -->
                            <div id="m-{{ $Category->id }}" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ trans('backLang.confirmationDeleteMsg') }}
                                                <br>
                                                <!-- <strong>[ {{ $Category->category }} ]</strong> -->
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                            <a href="{{ route("sssubcategoriesDestroy",["id"=>$Category->id,"$category_id"]) }}"
                                               class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->
                        @endforeach

                        </tbody>
                    </table>

                </div>
                <footer class="dker p-a">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs">
                            <!-- .modal -->
                            <div id="m-all" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ trans('backLang.confirmationDeleteMsg') }}
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                            <button type="submit"
                                                    class="btn danger p-x-md">{{ trans('backLang.yes') }}</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->
                         
                        </div>

                         
                    </div>
                </footer>
                {{Form::close()}}

                <script type="text/javascript">
                    $("#checkAll").click(function () {
                        $('input:checkbox').not(this).prop('checked', this.checked);
                    });
                    $("#action").change(function () {
                        if (this.value == "delete") {
                            $("#submit_all").css("display", "none");
                            $("#submit_show_msg").css("display", "inline-block");
                        } else {
                            $("#submit_all").css("display", "inline-block");
                            $("#submit_show_msg").css("display", "none");
                        }
                    });
                </script>
            @endif
        </div>
    </div>
     
@endsection
@section('footerInclude')
    <script type="text/javascript">
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#action").change(function () {
            if (this.value == "delete") {
                $("#submit_all").css("display", "none");
                $("#submit_show_msg").css("display", "inline-block");
            } else {
                $("#submit_all").css("display", "inline-block");
                $("#submit_show_msg").css("display", "none");
            }
        });
    </script>
@endsection
