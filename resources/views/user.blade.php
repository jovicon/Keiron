@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">TICKETS CRUD</div>

                <div class="card-body">
                    {{-- CRUD --}}
                    <form class="form-horizontal" id="form-edit-client">
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Editar ticket a usuario</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="ticket-user-name">Nombre de usuario</label>


                                <div class="col-md-4">

                                    <select name="ticket-user-name" id="ticket-user-name">
                                        @foreach ($users as $index_user => $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Prepended text-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="ticket-comment">Comentario de ticket</label>
                                <div class="col-md-4">
                                    <input id="ticket-comment" name="ticket-comment" class="form-control"
                                        placeholder="Comentario" type="text">
                                    <p class="help-block">Comentario para tu ticket</p>
                                </div>
                            </div>
                            <!-- Button -->


                        </fieldset>
                    </form>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="btn-save"></label>
                        <div class="col-md-4" id="saveupdate">
                            <button id="btn-save" name="btn-save" class="btn btn-success dn" onclick="addClient()">Guardar</button>
                        </div>
                    </div>


                    <!-- LIST -->
                    <div class=col-md-12>

                        <legend>Listado de clientes</legend>


                        <table class="table table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                    <td>id de ticket</td>
                                    <td>id de usuario</td>
                                    <td>nombre</td>
                                    <th>comentario de ticket</th>
                                    <th>Actions</th>
                                </tr>

                            </thead>
                            <tbody id="form-list-client-body">
                                @foreach ($tickets as $index_tickets => $ticket)
                                    <tr>
                                        <td>{{$ticket->id}}</td>
                                        <td>{{$ticket->user_id}}</td>
                                        <td>{{$ticket->user()->name}}</td>
                                        <th>{{$ticket->set_ticket}}</th>
                                        <th>
                                            <button class="btn btn-sm btn-primary" onclick="editClient({{$index_tickets}})">Editar</button>
                                        </th>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>

                {{-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
            </div>
            @endif

            You are logged in!
        </div> --}}



    </div>
</div>
</div>
</div>

<script>
    var clients = [];
    var myIndex;


        @foreach ($tickets as $index_tickets => $ticket)

            let ticket_{{$index_tickets}} = {
                ticket_id:"{{$ticket->id}}",
                user_id : "{{$ticket->user_id}}",
                user_name: "{{$ticket->user()->name}}",
                set_ticket: "{{$ticket->set_ticket}}"
            }

            clients.push(ticket_{{$index_tickets}})

        @endforeach

    function addClient() {

        var user_id = document.getElementById("ticket-user-name").value;
        var set_ticket = document.getElementById("ticket-comment").value;

        var select = document.getElementById("ticket-user-name");
        var user_name = select.options[select.selectedIndex].text;


        // usando ajax para actualiar base de datos
        $.ajax({
            url: "/api/ticket/create",
            method: "POST",
            data: {
                _token: "{{csrf_token()}}",
                user_id: user_id,
                set_ticket: set_ticket,
            },
            dataType: 'json',
            success: function (data) {
                console.log(data)
                if (data.status == 'success') {
                    alert(data.message); // mostrando mensaje de exito

                    var newTicket = {
                        ticket_id : data.result,
                        user_id : document.getElementById("ticket-user-name").value,
                        user_name: user_name,
                        set_ticket: document.getElementById("ticket-comment").value
                    }

                    clients.push(newTicket)
                    displayClients()
                }
                else {
                    alert(data.message); // mostrando error
                }
            }
        });

    }

    function displayClients() {
        document.getElementById("form-list-client-body").innerHTML = ""
        for (i = 0; i < clients.length; i++) {
            var myTr = document.createElement("tr")
            for (a in clients[i]) {
                var mytd = document.createElement("td")
                mytd.innerHTML = clients[i][a]
                myTr.appendChild(mytd)
            }
            var actionTd = document.createElement("td")
            var editBtn = document.createElement("button")
            editBtn.innerHTML = "Editar"
            editBtn.setAttribute("class", "btn btn-sm btn-primary")
            editBtn.setAttribute("onclick", "editClient(" + i + ")")

            actionTd.appendChild(editBtn)
            myTr.appendChild(actionTd)
            document.getElementById("form-list-client-body").appendChild(myTr)

        }
        document.getElementById("ticket-user-name").value = "2";
        document.getElementById("ticket-comment").value = ""
    }

    //Editing Client
    function editClient(i) {
        console.log(clients[i])
        myIndex = i;
        let ticket_id = clients[i].ticket_id;
        var updatebtn = document.createElement("button")
        updatebtn.innerHTML = "Actualizar";
        updatebtn.setAttribute("class", "btn btn-sm btn-success")
        updatebtn.setAttribute("onclick", "updClient("+ticket_id+")")
        document.getElementById("saveupdate").innerHTML = ""
        document.getElementById("saveupdate").appendChild(updatebtn);
        document.getElementById("ticket-user-name").value = clients[i].user_id
        document.getElementById("ticket-comment").value = clients[i].set_ticket
    }

    //Updating Client
    function updClient(ticket_id) {

        var user_id = document.getElementById("ticket-user-name").value;
        var set_ticket = document.getElementById("ticket-comment").value;

        var select = document.getElementById("ticket-user-name");
        var user_name = select.options[select.selectedIndex].text;

        var updatedClient = {
            ticket_id:ticket_id,
            user_id : document.getElementById("ticket-user-name").value,
            user_name: user_name,
            set_ticket: document.getElementById("ticket-comment").value
        }

                // usando ajax para actualiar base de datos
        $.ajax({
            url: "/api/ticket/update",
            method: "POST",
            data: {
                _token: "{{csrf_token()}}",
                ticket_id:ticket_id,
                user_id: user_id,
                set_ticket: set_ticket,
            },
            dataType: 'json',
            success: function (data) {
                console.log(data)
                if (data.status == 'success') {
                    alert(data.message); // mostrando mensaje de exito

                    clients[myIndex] = updatedClient;

                    var crbtn = document.createElement("button")
                    crbtn.innerHTML = "Save";
                    crbtn.setAttribute("onclick", "addClient()")
                    crbtn.setAttribute("class", "btn btn-sm btn-success dn")
                    document.getElementById("saveupdate").innerHTML = ""

                    document.getElementById("saveupdate").appendChild(crbtn);

                    displayClients()

                }
                else {
                    alert(data.message); // mostrando error
                }
            }
        });


    }

    //deleting client
    function deleteClient(i) {

        let ticket_id = clients[i].ticket_id;

        clients.splice(i, 1)


        // usando ajax para actualiar base de datos
        $.ajax({
            url: "/api/ticket/delete",
            method: "POST",
            data: {
                _token: "{{csrf_token()}}",
                ticket_id: ticket_id
            },
            dataType: 'json',
            success: function (data) {
                console.log(data)
                if (data.status == 'success') {
                    alert(data.message); // mostrando mensaje de exito

                    displayClients()
                }
                else {
                    alert(data.message); // mostrando error
                }
            }
        });
    }

</script>
@endsection
