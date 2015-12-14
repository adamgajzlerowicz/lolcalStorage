<html>

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">

    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        .main {
            flex: 1 0 auto;
        }

        footer.page-footer {
            padding-top: 0;
        }

        textarea.materialize-textarea {
            min-height: 6rem;
        }
    </style>
</head>

<body>
<?php
$faker = Faker\Factory::create();
$sentence = $faker->sentence($nbWords = 6);
?>
<div class="app">
    @{{messages|json}}
    <div class="main">
        <div class="container">
            <form action="{{URL::route('notes.store')}}" method="get" id="form">
                <div class="row">
                    <form class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                            <textarea id="textarea1" class="materialize-textarea"
                                      name="content">{{$sentence}}</textarea>
                                <label for="textarea1">Textarea</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input id="submit" type="submit" class="waves-effect waves-light btn " value="send"
                               style="padding-top:8px">
                        <a href="{{URL::route('notes.delete')}}"
                           class="waves-effect waves-light btn red lighten-3">clear server</a>
                        <a href="#"
                           class="waves-effect waves-light btn red lighten-3 clear-queue">clear queue</a>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-xs-12">
                    <ul class="collection with-header" style="margin-top:50px">
                        <li class="collection-item">
                            Still to sync:
                            <div class="sync-container">

                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <hr>
                    <ul class="collection with-header old-items" style="margin-top:50px">
                        <li class="collection-item" v-repeat="messages">sdf</li>

                    </ul>
                    <div class="foo" v-repeat="messages">jlskdfklj</div>
                </div>
            </div>

        </div>
    </div>
</div>

<footer class="page-footer">
    <div class="footer-copyright">
        <div class="container">
            © 2015 Adam Gajzlerowicz
            <a class="grey-text text-lighten-4 right" href="http://github.com/adamgajzlerowicz/">See me on github</a>
        </div>
    </div>
</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
<script src="js/lockr.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.10/vue.min.js"></script>

<script>
    new Vue({
        el: '.app',
        data: {
            messages: []
        },
        ready:function(){
            this.fetchMessages();
        },
        methods:{
            fetchMessages:function(){
                $.get( "api/all", function( data ) {

                });
                this.messages = [1,2];
            }
        }

    });



</script>
</body>

</html>