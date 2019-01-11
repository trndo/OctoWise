


<template>

    <p>{{ greeting }} World!</p>

</template>



<script>

    module.export = {
        data: function () {
            return
                greeting: '',
            }
        }
    }


</script>



<style scoped>

    p {
        font-size: 2em;
        text-align: center;
    }

    </style>