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
        .my_container{
          width: calc(100% / 2 - 30px);
          padding: 15px;
          margin: 15px;
          text-align: center;
          display: inline-block;
          background-color: rgba(27, 35, 99);
        }
        .disk{
        }
        h1{
          color: black;
        }
        img {
            width: 200px;
            height: 200px;
        }
    </style>
    <title>PHP</title>
</head>
 <body>
   <div id="app" class="disk">
     <div class="">
       <select v-model='genreIndex' @change='filterGenre' class="" name="">
         <option v-for='(genere, index) in arrGenre' :value="index">{{ genere }}</option>
       </select>
     </div>
     <div v-for="disk in arrDisks" class="my_container">
         <h1>{{ disk.title }}</h1>
         <h2>{{ disk.author }}</h2>
         <img :src="disk.poster" alt="">
         <h3>{{ disk.genre }}</h3>
         <h4>{{ disk.year }}</h4>
     </div>
   </div>
   <script>
       function init() {
           new Vue({
               el: "#app",
               data: {
                 arrDisks:[],
                 arrGenre:[],
                 genreIndex: 0,
               },
               methods:{
                 filterGenre : function(){
                   const selectGenre = this.arrGenre[this.genreIndex];
                   console.log(selectGenre);
                   axios.get('data.php',{
                     params:{
                       genere: selectGenre,
                     }
                   })
                   .then(res => {
                     console.log(res);

                   })
                 }
               },
               mounted() {
                   axios.get('data.php')
                       .then(res => {
                           // const disks = res.data;
                           // console.log(this.arrDisks);
                           // this.arrGenre = ;
                           console.log(res.data);
                           this.arrGenre = res.data.generi;
                           this.arrDisks = res.data.disks;
                       })
                       .catch(e => {
                           console.log(e);
                       });
                }
           });
       }
       document.addEventListener("DOMContentLoaded",init);
   </script>
 </body>
</html>

<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@0.21.1/dist/axios.min.js"></script>
    <style>
        body {
            background: purple;
            color: white;
        }
        hr {
            background: white;
        }
        img {
            width: 100px;
        }
        .box {
            width: 150px;
            height: 350px;
            margin: 10px;
            background-color: grey;
        }
    </style>
    <script>
        function getRnd(min, max) {
            const localMin = min;
            const localMax = max - min + 1;
            return Math.floor(Math.random() * localMax) + localMin;
        }
        function init() {
            new Vue({
                el: "#app",
                data: {
                    cds: [],
                    genres: [],
                    genre: '-1'
                },
                methods: {
                    genreFilter: function() {
                        axios.get('data.php', {
                                params: {
                                    genre: this.genre
                                }
                            })
                            .then(r => {
                                const data = r.data;
                                this.cds = data;
                            })
                            .catch(e => console.log(e));
                    }
                },
                mounted() {
                    axios.get('data.php')
                        .then(r => {
                            const data = r.data;
                            this.cds = data;
                            for (i=0;i<this.cds.length;i++) {
                                const cd = this.cds[i];
                                const genre = cd.genre;
                                if (!this.genres.includes(genre)) {
                                    this.genres.push(genre);
                                }
                            }
                            console.log(this.genres);
                        })
                        .catch(e => console.log(e));
                }
            });
        }
        document.addEventListener("DOMContentLoaded",init);
    </script>
    <title>PHP</title>
</head>
<body>
    <div id="app" class="container text-center">
        <div class="row">
            <div class="col-12 mt-3">
                <h1>Dischi</h1>
            </div>
            <div class="col-12 mt-3">
                <select v-model='genre' @change="genreFilter">
                    <option value="-1">All</option>
                    <option v-for="genre in genres" :value="genre">{{ genre }}</option>
                </select>
            </div>
            <div v-for="cd in cds" class="col-3">
                <div class="box">
                    <h3>{{ cd.title }}</h3>
                    <img :src="cd.poster" alt="">
                    <p>{{ cd.author }}</p>
                    <p>{{ cd.genre }}</p>
                    <p>{{ cd.year }}</p>
                </div>
            </div>
        </div>
    </div>
</html> -->
