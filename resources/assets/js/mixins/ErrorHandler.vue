<script type="text/ecmascript-6">
    export default {
        methods: {
            errorHandler(response) {
                this.$root.errors = '404';
                console.error(response.entity.error);
            }
        }
    }
</script>
