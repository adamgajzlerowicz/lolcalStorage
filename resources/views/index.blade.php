<html>

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">


    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <style>
        *{
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
        footer.page-footer{
            padding-top:0;
        }
        textarea.materialize-textarea{
            min-height: 6rem;
        }
    </style>
</head>

<body>
<div class="main">
    <div class="container">
        <form action="{{URL::route('notes.store')}}" method="get" id="form">
            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="textarea1" class="materialize-textarea" name="content"></textarea>
                            <label for="textarea1">Textarea</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input id="submit" type="submit" class="waves-effect waves-light btn " value="send" style="padding-top:8px">
                    <a href="{{URL::route('notes.delete')}}"  class="waves-effect waves-light btn red lighten-3"  >clear</a>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-xs-12">
                <ul class="collection with-header" style="margin-top:50px">
                    <li class="collection-header"><h5>Previous entries:</h5></li>
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
<script>
    $('document').ready(function(){
        $('#submit').click(function(e){
           e.preventDefault();
            var storage = localStorage.getItem('storage');
//            if(typeof storage == "object"){
//                var storage = [];
//            }
            var newValue = $('#textarea1').val();

            var allItems = ["newValue",'flll'];
//            storage = JSON.parse(allItems);
//            console.log(allItems);
//            storage.push($('#textarea1').val());
//            console.log(localItems);
//            if(localItems.count()==0){
//
//            }
//            localStorage.setItem('favoriteflavor',localItems);
            $('form').submit();
        })
    })

</script>
</body>

</html>