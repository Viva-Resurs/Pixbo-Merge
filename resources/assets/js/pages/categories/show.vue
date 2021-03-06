<template>

    <div class="panel-heading">
        {{ (category && category.name) ? category.name : trans('category.edit') }}
    </div>

    <div class="panel-body" v-if="$loadingRouteData">
        <loading></loading>
    </div>

    <div v-else>

        <div class="panel-body">

            <form v-if="$root.isOwner(category)" class="form-horizontal" role="form" v-on:submit.prevent="attemptUpdateCategory" name="myform" v-form>

                <div class="form-group" v-validation-help>
                    <label for="name" class="model_label">{{ trans('general.name') }}</label>
                    <div class="model_input">
                        <input class="form-control"
                               name="name" id="name"
                               type="text"
                               v-model="category.name"
                               v-form-ctrl
                               v-is-unique:category
                               required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <div class="model_action">
                        <template v-if="$root.history.previous && $root.history.previous.indexOf('show')>0">
                            <button type="button" class="btn btn-default" @click="goUp" v-if="myform.$pristine">
                                <i class="fa fa-btn fa-undo"></i>{{ trans('general.back') }}
                            </button>
                            <button type="button" class="btn btn-default" @click="goUp" v-if="!myform.$pristine">
                                <i class="fa fa-btn fa-undo"></i>{{ trans('general.cancel') }}
                            </button>
                        </template>
                        <template v-else>
                            <button type="button" class="btn btn-default" @click="goBack" v-if="myform.$pristine">
                                <i class="fa fa-btn fa-undo"></i>{{ trans('general.back') }}
                            </button>
                            <button type="button" class="btn btn-default" @click="goBack" v-if="!myform.$pristine">
                                <i class="fa fa-btn fa-undo"></i>{{ trans('general.cancel') }}
                            </button>
                        </template>
                        <button type="submit" class="btn btn-primary" @keydown.enter.prevent="attemptUpdateCategory">
                            <i class="fa fa-btn fa-save"></i>{{ trans('general.save') }}
                        </button>
                    </div>
                </div>

            </form>

            <screen-list :screens="category.screens.data" from="categories">
            </screen-list>

        </div>

    </div>

</template>

<script type="text/ecmascript-6">
    import ScreenList from '../../components/ScreenList.vue'
    import SweetAlert from '../../mixins/SweetAlert.vue'
    import IsUnique from '../../directives/IsUnique.vue'
    import ValidationHelp from '../../directives/ValidationHelp.vue'

    export default {

        name: 'Show',

        mixins: [ SweetAlert ],

        components: { ScreenList },

        directives: { IsUnique, ValidationHelp },

        data: function () {
            return {
                category: {},
                myform: []
            }
        },

        methods: {

            attemptUpdateCategory() {

                if(this.myform.$valid)
                    this.updateCategory();

            },

            updateCategory() {

                var self = this;

                client({ path: '/categories/' + self.category.id, entity: self.category, method: 'PUT'}).then(
                    
                    function (response) {

                        self.$dispatch('alert', {
                            message: self.trans('category.updated'),
                            options: {theme: 'success'}
                        });

                        self.$route.router.go('/categories');

                    },

                    function (response) {

                        self.$dispatch('alert', {
                            message: self.trans('category.updated_fail'),
                            options: {theme: 'error'}
                        });

                    }

                );

            },

            attemptDeleteScreen(screen) {

                this.confirm({
                    callback:this.deleteScreen, arg:screen,
                    text: this.trans('category.remove_association')
                });

            },

            deleteScreen(screen) {

                var self = this;

                client({ path: '/categories/' + self.category.id + '/screen/' + screen.id, method: 'DELETE' }).then(
                    
                    function (response) {

                        screen.removed = true;
                        self.category.screens.data.reverse();

                        self.$dispatch('alert', {
                            message: self.trans('category.screen_association_removed'),
                            options: {theme: 'success'}
                        });

                    },

                    function (response) {

                        self.$dispatch('alert', {
                            message: self.trans('category.screen_association_removed_fail'),
                            options: {theme: 'error'}
                        });

                    }

                );

            }

        },

        ready : function() {
            this.$on('remove-screen', function (screen) {
                this.attemptDeleteScreen(screen);
            });
        },

        route: {
            data: function (transition) {
                client({ path: '/categories/' + this.$route.params.id }).then(
                    function (response) {
                        transition.next({category: response.entity.data});
                    },
                    function (response){
                        transition.next();
                        console.error(response.entity.error);
                    }
                );
            }
        }

    }
</script>
