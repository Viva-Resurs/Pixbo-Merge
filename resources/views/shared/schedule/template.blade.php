<template id="schedule-template">
    <form id="schedule_form_{{ $item->id }}" action="/admin/{{ $model }}s/{{ $item->id }}" method="PATCH" role="form" v-on:submit.prevent="send_post">
        {{ csrf_field() }}

        <div class="col-lg-6">
            @include('shared.schedule.screengroup')

            <template v-if="model == 'screen'">
                @include('shared.schedule.tags')
            </template>

            <legend>{{ trans('messages.datetime') }}</legend>
            @include('shared.schedule.datetime')
        </div>

        <div class="col-lg-6">

            <legend>{{ trans('messages.recurring') }}</legend>
            @include('shared.schedule.recurring.body')

        </div>

        <button type="submit" class="btn btn-primary">{{ trans('messages.save') }}</button>

     </form>
</template>