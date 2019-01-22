


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

* {
    box-sizing: border-box;
    padding: 0;
    margin: 0;
}

body {
    box-sizing: border-box;
}


    p {
        font-size: 2em;
        text-align: center;
    }

    </style>