<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <title>Cocina</title>
</head>

<body>
    <div id="app_basic">
        <div class="jumbotron vertical-center">
            <div class="container">
                <h1 class="text-center" v-text="message"></h1>
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sucursal</th>
                            <th scope="col">Mesa</th>
                            <th scope="col">Estatus</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(order,index) in orders" :key="order.id">
                            <td scope="row" v-text="(index+1)"></td>
                            <td v-text="order.branch"></td>
                            <td v-text="order.table"></td>
                            <td v-text="order.status"></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm px-3">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
            message: "Lista de Ordenes",
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
                Object.keys(data).forEach(key => {
                    messages.push({
                        id: key,
                        branch: data[key].branch,
                        table: data[key].table,
                        status: data[key].status
                    });
                });
                this.orders = messages;
            });
        }
    })
</script>

</html>
