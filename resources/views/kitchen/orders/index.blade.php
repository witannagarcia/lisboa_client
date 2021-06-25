<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <audio src="{{}}"></audio>
    <div id="app_basic">
        <h1 v-text="message"></h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estatus</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.id">
                    <td v-text="order.id"></td>
                    <td v-text="order.status"></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-database.js"></script>
<script>
    new Vue({
        el: "#app_basic",
        data: {
            fire: null,
            message: "🐵 Hello World 🔮",
            firebaseConfig: {
                apiKey: "AIzaSyBjQrgPenNglpegK3mI14owZ6rJSQAsnZI",
                authDomain: "lafinca-2370d.firebaseapp.com",
                databaseURL: "https://lafinca-2370d-default-rtdb.firebaseio.com",
                projectId: "lafinca-2370d",
                storageBucket: "lafinca-2370d.appspot.com",
                messagingSenderId: "735388722910",
                appId: "1:735388722910:web:8317ee6bd314626fc8044f",
                measurementId: "G-NP8EZ7QL2M"
            },
            orders: []
        },
        mounted() {
            fire = firebase.initializeApp(this.firebaseConfig);
            itemsRef = fire.database().ref("orders");
            itemsRef.on("value", snapshot => {
                let data = snapshot.val();
                let messages = [];
                var snd = new Audio('{{ asset("sounds/bell.mp3") }}');
        snd.play();
                Object.keys(data).forEach(key => {
                    messages.push({
                        id: key,
                        user_id: data[key].user_id,
                        status: data[key].status
                    });
                });
                this.orders = messages;
            });
        }
    })
</script>

</html>
