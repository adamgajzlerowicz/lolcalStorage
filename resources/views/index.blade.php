<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.10/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.0.1/faker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.17/vue-resource.min.js"></script>

    <script src="js/lockr.js" type="text/javascript"></script>
</head>

<body>
<div class="app">
{{--<pre>@{{ messages|json }}</pre>--}}

    <input type="text" v-model="updateContent" v-on:keyup.enter="submit">
    Local messages:
    <ul>
        <li v-for="message in messages|unSynced">@{{message.id}} @{{message.content}}</li>
    </ul>
    <h5>Synced messages:</h5>
    <ul>
        <li v-for="message in messages|synced">@{{message.id}} @{{message.content}}</li>
    </ul>

</div>
<script src="js/script.js"></script>
</body>

</html>