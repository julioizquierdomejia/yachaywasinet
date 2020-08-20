<div class="form-group row align-items-center" :class="{'has-danger': errors.has('title'), 'has-success': this.fields.title && this.fields.title.valid }">
    <label for="title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.grade.columns.title') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.title" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': this.fields.title && this.fields.title.valid}" id="title" name="title" placeholder="{{ trans('admin.grade.columns.title') }}">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('level_id'), 'has-success': this.fields.level_id && this.fields.level_id.valid }">
    <label for="level_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.grade.columns.level_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect v-model="form.level_id" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_options') }}" track-by="id" label="title" :options="{{ $level_type->toJson() }}" :searchable="false" :allow-empty="false" open-direction="bottom"></multiselect>
        <div v-if="errors.has('level_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('level_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('courses'), 'has-success': this.fields.courses && this.fields.courses.valid }">
    <label for="courses" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.grade.columns.courses') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <input type="hidden" id="courses" name="courses" v-model="form.courses">
            <multiselect v-model="selectedCourses" :options="{{ $courses->toJson() }}" open-direction="bottom" :searchable="false" :allow-empty="false" placeholder="{{ trans('admin.grade.columns.courses') }}" :multiple="true" :selected="selectedCourses" @input="updateCourses" :show-labels="true" track-by="id" label="title" key="id"></multiselect>
        </div>
        <div v-if="errors.has('courses')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('courses') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('enabled'), 'has-success': this.fields.enabled && this.fields.enabled.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-10'">
        <input class="form-check-input" id="enabled" type="checkbox" v-model="form.enabled" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element">
        <label class="form-check-label" for="enabled">
            {{ trans('admin.grade.columns.enabled') }}
        </label>
        <input type="hidden" name="enabled" :value="form.enabled">
        <div v-if="errors.has('enabled')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('enabled') }}</div>
    </div>
</div>