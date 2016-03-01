<template id="schedule-template">
    <form id="schedule_form_{{ $item->id }}" action="/admin/{{ $model }}s/{{ $item->id }}" method="PATCH" role="form" v-on:submit.prevent="send_post">
        {{ csrf_field() }}

        <div class="col-lg-6 col-md-6">
            @include('shared.schedule.screengroup')


            <Tagger></Tagger>

            <legend>{{ trans('messages.datetime') }}</legend>
            @include('shared.schedule.datetime')
        </div>

        <div class="col-lg-6 col-md-6">

            <legend>{{ trans('messages.recurring') }}</legend>
            @include('shared.schedule.recurring.body')

        </div>

        <button type="submit" id="submitButton_@{{ id }}" class="" style="display: none;">{{ trans('messages.save') }}</button>

     </form>
</template>