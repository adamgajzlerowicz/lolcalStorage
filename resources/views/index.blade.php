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
                    @foreach($notes as $note)
                        <li class="collection-item">{{$note->created_at}} | {{$note->content}}</li>
                    @endforeach
                </ul>
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
<script>


    $('document').ready(function () {
        function refreshData(){
            var updates = Lockr.get('updates');

            populateQueue();
            var oneHasFailed = false;
            //console.log('total size: '+updates.length);
            updates = $.makeArray(updates);



            if(updates.length>0) {
                jQuery.each(updates , function(key, val){
                    var url = '{{route('notes.store')}}?content=' + val;
                    $.ajax({
                        url: url,
                        success: function () {
                            updates = $(Lockr.get('updates')).queue(function(){
                                updates.splice(key, 1);
                            }).queue( function(){
                                Lockr.set('updates', updates)
                            }).queue(function(){
                                        populateQueue();
                            }).queue(function(){
                                        $('.old-items .collection-item').parent().first().prepend('<li class="collection-item"> now | '+val+'</li>')

                                    }
                            );

                            //console.info('Submitted');
                        },
                        error: function () {
                            oneHasFailed = true;
                            console.info('Error sending');
                        },
                        timeout: 2000,
                        async:false
                    });
                });
                {{--updates.each(function (key, val) {--}}
                    {{--var url = '{{route('notes.store')}}?content=' + val;--}}
                    {{--console.log(val);--}}
                    {{--console.log(key);--}}
//                    $.ajax({
//                        url: url,
//                        success: function () {
//                            updates.splice(key, 1);
//                            Lockr.set('updates', updates);
//                            populateQueue();
//                            //$('.old-items .collection-item').parent().first().prepend('<li class="collection-item"> NOW | '+val+'</li>');
//                            console.info('Submitted');
//                        },
//                        error: function () {
//                            oneHasFailed = true;
//                            console.info('Error sending');
//                        },
//                        timeout: 2000
//                    });
//                }, function () {
//                    //alert('foo');
//                });
            }


        }
        function populateQueue(){
            $('.sync-container').html('');
            updates = Lockr.get('updates');
            $(updates).reverse().each(function(key, val){
                $('.sync-container').append('<div class="card">' + val +"</div>");
            })
            return true;
        }
        var updates = Lockr.get('updates');
        if (typeof updates == "undefined") {
            updates = [];
        }
        populateQueue();
        $('.clear-queue').click(function(){
            Lockr.rm('updates')
        })
        $('#submit').click(function (e) {
            e.preventDefault();
            var updates = Lockr.get('updates');
            if (typeof updates == "undefined") {
                updates = [];
            }
            updates.push($('#textarea1').val());
            Lockr.set('updates',updates);
            populateQueue();
            refreshData();
        })
        setInterval(function() {
            refreshData();
            console.log('refreshing...');
        }, 1000);
    })

</script>
</body>

</html>