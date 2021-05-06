<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesame -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <!-- bootstrap v4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- vue 2 -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x"></script>
    <!-- axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios@0.21.1/dist/axios.min.js"></script>
    <style>
        body {
            background: purple;
            color: white;
        }
        img {
            width: 100px;
            height: 100px;
        }
    </style>
    <script>
        function init() {
            new Vue({
                el: "#app",
                data: {
                  arrDisk:[],
                },
                mounted() {
                    axios.get('data.php')
                        .then(res => {
                            const disks = res.data;
                            this.arrDisks = disks;
                            console.log(this.arrDisks);
                        })
                        .catch(e => {
                            console.log(e);
                        })
                }
            });
        }
        document.addEventListener("DOMContentLoaded",init);
    </script>
    <title>PHP</title>
</head>
<body>
    <div id="app" class="container">
            <div v-for="disk in arrDisks"class="">
                <h1>{{ disk.title }}</h1>
                <img :src="" alt="">
            </div>
    </div>
</html>
