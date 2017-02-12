<template>
    <ul class="list-group">
        <li class="list-group-item" v-for="person in people">
            {{ person.name }}
        </li>
    </ul>
</template>

<script>

    export default {
        data() {
            console.log(window.Lemon.url);
            //this.$http.get(window.Lemon.url);

            return {
                people: []
            }
        },
        ready() {
            console.log('Component ready.');

//            this.$set('data.people', [{
//                name: 'Akung'
//            }])
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
