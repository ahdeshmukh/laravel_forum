<template>
    <div class="alert alert-success fade show alert-flash" role="alert" v-show="show">
        <strong>Success!</strong> {{ body }}
    </div>
</template>

<script>
    export default {
        name: "FlashComponent",
        props: ['message'],
        data() {
            return {
               body: this.message,
               show: false
            }
        },
        created() {
            if(this.message) {
                this.flash(this.message)
            }

            window.events.$on('flash', message => this.flash(message));
        },
        methods: {
            flash(message) {
                this.body = message;
                this.show = true;

                this.hide();
            },
            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    }
</script>

<style scoped>
    .alert-flash {
        position: fixed;
        bottom: 25px;
        right: 25px;
    }
</style>
