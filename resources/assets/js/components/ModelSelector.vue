<template>

    <div>

        <slot name="label">

        </slot>

        <div :class="classes">
            <select class="form-control selectpicker show-tick"
                    v-model="selected"
                    id="inputModels"
                    :multiple="multiple"
                    :data-selected-text-format="mode"
                    v-el:select-input
            >
                <option v-for="element in models" :value="element.id">{{element.name}}</option>
                <option v-for="option in options" :value="option.id">
                    <template v-if="hasType">
                        <template v-if="option.plural">
                            {{trans(option.name) + " " + trans('schedule.'+this.type,option.plural).toLowerCase()}}
                        </template>
                        <template v-else>
                            {{trans(option.name) + " " + trans('schedule.'+this.type,option.id).toLowerCase()}}
                        </template>
                    </template>
                    <template v-else>
                        {{trans(option.name)}}
                    </template>
                </option>
            </select>
        </div>

    </div>

</template>

<script type="text/ecmascript-6">
    export default {

        name: 'ModelSelector',

        props: {
            selected: [Number, Object],
            model: {
                type: String
            },
            options: {
                type: Array,
                default: val => []
            },
            mode: {
                type: String,
                default: ''
            },
            multiple: {
                type: String,
                default: false
            },
            type: {
                type: String,
                default: ''
            },
            classes: {
                type: String,
                default: 'form-group'
            }
        },

        data: function () {
            return {
                models: []
            }
        },

        computed: {

            hasType(){
                return (this.type!=='');
            },

            isModel() {
                return (this.model!=='');
            }

        },

        methods: {

            getModels() {

                var self = this;

                // API uses modelnames in plural.
                var path = (self.model[self.model.length-1] == 'y') ?
                    '/'+ self.model.substring(0,self.model.length-1) + 'ies' :
                    '/'+ self.model + 's';

                client({ path: path }).then(

                    function (response) {

                        self.$set('models', response.entity.data);

                        self.setSelectPicker();

                    },

                    function (response) {

                        console.log(response);

                    }

                );

            },

            setSelectPicker() {

                var self = this;

                this.$nextTick(function() {

                    var target = $(this.$els.selectInput);

                    let g = target.selectpicker({
                        size: 4,
                        iconBase: 'fa',
                        tickIcon: 'fa-check',
                        multipleSeparator: ' ',
                        countSelectedText: function(){
                            var text = '';
                            for (var i=0; i<target[0].selectedOptions.length ; i++)
                                text += target[0].selectedOptions[i].label.substring(0,3) + ' ';
                            return text;
                        },
                        noneSelectedText: this.trans('general.nothing_selected'),
                    });


                    if (self.options.length > 0 || self.models.length > 0)
                            if (self.selected == null )
                                self.selected = self.models[0].id;

                    target.selectpicker('refresh');

                });

            }

        },

        created: function(){

            if (this.model)
                this.getModels();

            else
                this.setSelectPicker();

        }

    }
</script>
