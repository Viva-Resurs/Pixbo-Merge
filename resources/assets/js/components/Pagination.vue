<template>
    <div class="pagination">

        <div v-if="total>limit" class="pagination_left">

            <template v-if="showPagination">

                <div class="btn-group" role="group">
                    <button class="btn btn-default" @click="firstPage"><span class="fa fa-btn fa-angle-double-left"></span></button>
                    <button class="btn btn-default" @click="prevPage"><span class="fa fa-btn fa-angle-left"></span></button>

                    <button v-for="n in totalPages" class="btn btn-{{(n+1==currentPage)?'primary':'default'}}" @click="toPage(n)">{{n+1}}
                    </button>

                    <button class="btn btn-default" @click="nextPage"><span class="fa fa-btn fa-angle-right"></span></button>
                    <button class="btn btn-default" @click="lastPage"><span class="fa fa-btn fa-angle-double-right"></span></button>
                </div>

            </template>
            <template v-else>

                <slot name="replacePagination">

                </slot>

            </template>
        </div>

        <div v-else class="pagination_left">
        </div>


        <div v-show="total>limit && showPagination" class="pagination_right"> 
            <div class="input-group">
                <select class="form-control selectpicker show-tick"
                        v-model="limit"
                        id="limit"
                        v-el:select-input
                >
                    <option v-for="option in limitOptions" :value="option">{{option}}</option>
                </select>
                <span class="input-group-addon">
                    <span class="fa fa-list"></span>
                </span>

            </div>
        </div>

    </div>
</template>

<script type="text/ecmascript-6">
/**
 *  @author ToxicTree
 */
    export default {

        name: 'Pagination',

        props: [ 'total', 'offset', 'limit', 'showPagination' ],

        data: function(){
            return {
                limitOptions: [ 10, 50, 100, 500 ]
            }
        },

        computed: {

            currentPage(){
                var p = 1;
                for (var i=0, c=0 ; i<this.total ; i++, c++){
                    if (i==this.offset)
                        return p;
                    if (c+1==this.limit && i<this.total-p){
                        p++; c=0;
                    }
                }
            },

            totalPages(){
                var p = 1;
                for (var i=0, c=0 ; i<this.total ; i++, c++){
                    if (c+1==this.limit && i<this.total-p){
                        p++; c=0;
                    }
                }
                return p;
            }

        },

        filters: {
            rangeFilter(ob,index,scope){
                scope.limitOffBtn = false;

                // Show results in range
                if (scope.search!=''){
                    if (!scope.limitOff){
                        
                        if (index<scope.limit)
                            return true;
                        
                        scope.limitOffBtn=true;
                        return false;
                    }
                    else
                        return true;
                }

                // Show contents in range
                return (index >= scope.offset && index < scope.offset+scope.limit)
            }
        },

        methods: {

            firstPage(){
                this.offset = 0;
            },

            prevPage(){
                if (this.offset-this.limit<0)
                    return this.firstPage();
                this.offset -= this.limit;
            },

            toPage(p){
                this.offset = p*this.limit;
            },

            nextPage(){
                if (this.offset>this.total-this.limit)
                    return this.lastPage();
                this.offset += this.limit;
            },

            lastPage(){
                this.offset = this.total-(((this.total-1)%this.limit)+1);
            }

        },

        created: function(){

            this.$nextTick(function() {

                var target = $(this.$els.selectInput);

                let g = target.selectpicker({
                    size: 4,
                    iconBase: 'fa',
                    tickIcon: 'fa-check'
                });

                target.selectpicker('refresh');

            });

            window.onkeyup = (function(e) {
                var key = e.which || e.keyCode;
                if (key == 37)
                    this.prevPage();
                if (key == 39)
                    this.nextPage();
            }).bind(this);
  
        },

        beforeDestroy: function () {
            window.onkey = false;
        }

    }
</script>
