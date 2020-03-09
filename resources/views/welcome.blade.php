<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
    </head>
    <body>
  
    <table>
        <tr>
            <th></th>
            <th></th>
            <th style='text-align:center'><h1>The TV Show</h1></th>
            <th></th>
            <th><button type="button" id="add" onclick='add()' class="btn btn-success">Add New </button></th>
        </tr>
        <tr>
            <th>Season</th>
            <th>Episode</th>
            <th>Qoute</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <h1>The challenge question 1</h1>
        @if(isset($tvshow))
           @for($i = 0; $i < count($tvshow); $i++)
            <tr>
                <th>{{$tvshow[$i]->season }}</th>
                <th>{{$tvshow[$i]->episode }}</th>
                <th>{{$tvshow[$i]->quote }}</th>
                <th><button type="button" onclick='update({{$tvshow}},{{$i}})' id="update"  class="btn btn-primary">Update</button></th>
                <th><button type="button" onclick='remove({{$tvshow}},{{$i}})'  class="btn btn-danger">Delete</button></th>
            <tr>
           @endfor 
        @endif  
    
  
           

           
      
        <div class="modal"  id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="TVShowForm" >
                        <input type="hidden" id="id" name="id" />
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Season&nbsp</span>
                                </div>
                                <input type="text" id="season" name='season' class="form-control inputSeason" aria-label="Text input with checkbox"/>
                            </div>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Episode</span>
                                </div>
                                <input type="text" id='episode' name='episode' class="form-control inputEpisode" aria-label="Text input with checkbox"/>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Quote&nbsp&nbsp&nbsp</span>
                                </div>
                                <input type="text" id="quote" name="quote" class="form-control inputQuote" aria-label="Text input with checkbox"/>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id='toggleButton' type="submit" class="btn btn-primary"></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </table>

     
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
    function add() {
        $(".modal-title").text("Add TV Show");
        $("#toggleButton").text("Add")
        $('#myModal').modal('show');
    }

    
    function update(TVShow,i) {
        
        $(".modal-title").text("Update TV Show");
        $("#toggleButton").text("update")
        $('#myModal').modal('show');
        $('#season').val(TVShow[i].season);
        $('#episode').val(TVShow[i].episode)
        $('#quote').val(TVShow[i].quote)
        $('#id').val(TVShow[i].id)
        
    }
    function remove(TVShow,i) {
        var id = TVShow[i].id;
        $.ajax({
                type: "POST",
                url: "{{url('delete')}}",
                data: {  id:id,_token: '{{csrf_token()}}' } , // serializes the form's elements.
                success: function(data)
                {
                     alert(data);
                     location.reload();
                },
                error: function (error) {
                    alert('error; ' + error);
                }
            });
    }
   
    $("#TVShowForm").on("submit",function(event){

        var season = $("#season").val();
        var episode = $("#episode").val();
        var quote = $("#quote").val();
        if($("#toggleButton").text()=="Add")
        {   $.ajax({
                type: "POST",
                url: "{{url('insert')}}",
                data: {  season:season,episode:episode,quote:quote,_token: '{{csrf_token()}}' } , // serializes the form's elements.
                success: function(data)
                {   alert(data)
                    location.reload();
                },
                error: function (error) {
                    alert('error; ' + error);
                }
            });
        }
        else{
            var id = $('#id').val()
            $.ajax({
                type: "POST",
                url: "{{url('update')}}",
                data: { id:id,season:season,episode:episode,quote:quote,_token: '{{csrf_token()}}' } , // serializes the form's elements.
                success: function(data)
                {   alert(data)
                    location.reload();
                },
                error: function (error) {
                    console.log('error; ' + error);
                }
            });


        }
    })
    
    </script>
</html>
