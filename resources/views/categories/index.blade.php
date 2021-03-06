@extends('layouts.app')
@push('title', 'Category') 
@section('content')
    <div class="card">
        <div class="card-header clearfix">
            <div class="float-left">
                {{__('global.categories')}}
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="#item" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fa fa-filter" aria-hidden="true"></i> {{__('global.number_of_items')}}</a>
                <a href="#search" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fa fa-search" aria-hidden="true"></i> {{__('global.search')}}</a>
                <a href="{{ route('category.create') }}" class="btn btn-success" title="Create New Category"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
            </div>
        </div>
        <div class="card-body ">
            <div id="item" class="collapse">
                <form method="get" action="{{route('category.index')}}">
                    <div class="form-group">
                        <label for="edit_page_per_page">{{__('global.number_of_items')}}</label>
                        <div class="input-group mb-3">            
                            <input min="1" max="999" class="form-control" name="number" id="number" maxlength="3" placeholder="10" type="number" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">{{__('global.apply')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
		
            <!--Search-->
            <div id="search" class="collapse">
                <form method="get" action="{{route('category.index')}}">
                    <div class="form-group">
                        <div class="input-group mb-3">            
                            <input class="form-control" name="search" id="search" placeholder="{{__('global.search')}}" type="text" value="{{ old('search')}}" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">{{__('global.apply')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--Search-->

            @if (count($categories) > 0)
            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{__('global.title')}}</th>
                            <th>{{__('global.status')}}</th>
                            <th colspan="3">{{__('global.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ ($category->is_active) ? __('global.active') : __('global.inactive') }}</td>
                            <td>
                                <form method="POST" action="{!! route('category.destroy', $category->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('category.show', $category->id ) }}" class="btn btn-info btn-sm" title="{{__('global.view')}}">
                                            <i class="far fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('category.edit', $category->id ) }}" class="btn btn-primary btn-sm" title="{{__('global.edit')}}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger btn-sm" title="{{__('global.delete')}}" onclick="return confirm(&quot;Click Ok to delete Category.&quot;)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @elseif(count($categories) == 0)
                <div class="alert alert-warning" role="alert">{{__('global.no_results')}}</a></div>
            @else
                <div class="alert alert-warning" role="alert">{{__('global.empty_results')}}</div>
            @endif        
        </div>

        <div class="card-footer">
            {!! $categories->render() !!}
        </div>
            
    </div>
@endsection