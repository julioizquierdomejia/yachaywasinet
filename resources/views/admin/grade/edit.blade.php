@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.grade.actions.edit', ['name' => $grade->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <grade-form
                :action="'{{ $grade->resource_url }}'"
                :data="{{ $grade->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.grade.actions.edit', ['name' => $grade->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.grade.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </grade-form>

        </div>
    
</div>

@endsection