@extends('layouts.app')


@section('head')
    <script src="https://unpkg.com/fabric@5.3.0/dist/fabric.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.6/js/jsplumb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.6/css/jsplumbtoolkit-defaults.css">
@endsection

@section('css')
    <style>
        body {
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 0%;
        }

        #wrapper {
            position: relative;
            display: flex;
            margin-top: 100px;
            height: 700px;
            width: 70%;
            background-color: lightgray;
            border-radius: 20px;
            overflow-x: hidden;

            -webkit-transition: all 0.6s ease;
            -moz-transition: all 0.6s ease;
            -o-transition: all 0.6s ease;
            transition: all 0.6s ease;

        }

        #sidebar-wrapper {
            z-index: 1000;
            position: relative;
            width: 200px;
            height: 100%;
            right: 15px;
            background-color: gray;
            overflow-y: scroll;
            overflow-x: hidden; 

            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .sidebar-nav {
            position: absolute;
            top: 0;
            right: 15px;
            width: 200px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .sidebar-nav li {
            text-indent: 20px;
            line-height: 40px;
        }

        .sidebar-nav li a {
            display: block;
            text-decoration: none;
            color: #999999;
        }

        .sidebar-nav>.sidebar-brand {
            height: 65px;
            font-size: 18px;
            line-height: 60px;
        }

        .sidebar-nav>.sidebar-brand a {
            color: #999999;
        }

        .sidebar-nav>.sidebar-brand a:hover {
            color: #fff;
            background: none;
        }
        .draggable {
            position: absolute;
            width: 100px;
            height: 100px;
            background-color: lightslategray;
            border-radius: 10px; 
            overflow: hidden;
        }

        #flowchartImage{
            position: absolute; 
            object-fit: cover;
            padding: 0;
            margin: 0;
            height: 100px;
            width: 100px;
        }

        .picture {
            display: flex;
            object-fit: cover;
            justify-content: space-around;
            padding: 5px;
            padding-left: 40px;
            height: 120px;
        }
        #wrapper.toggled #sidebar-wrapper {
            width: 50px;
            height: 50px;
            background-color: transparent;
        }

        #wrapper.toggled span {
            visibility: hidden;
        }

        #wrapper.toggled i {
            float: right;
        }

        #wrapper.toggled .picture {
            visibility: hidden;
        }

        #wrapper.toggled #menu-toggle {
            padding-top: 20px;
        }

        #parent { 
            height: 700px;
            width: 1000px;
            position: relative;
        }

        /* Flowchart Style*/
    </style>
@endsection

@section('content')
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }
        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }
    </script>
    <div class="container" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">

                <li class="sidebar-brand">
                    <a id="menu-toggle" style="float:right;"> <i class="fa fa-bars "></i></a>
                </li>
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true" ondragstart="drag(event)"></li>
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg"></li>
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg"></li>
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg"></li>
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg"></li>
                        
            </ul>

        </div>
        <div id="parent" ondrop="drop(event)" ondragover="allowDrop(event)">
            <div id="draggable1" class="draggable" style="top: 500px; left 500px">
                <img id="flowchartImage" src="{{ 'assets' }}/users/dummy_pic.jpg">
            </div>

            <div id="draggable2" class="draggable" style="top: 500px; left: 500px;">
            <p>Draggable 2</p>
            </div>

            <div id="draggable3" class="draggable" style="top: 500px; left: 500px;">
            <p>Draggable 3</p>
            </div>

            <div id="draggable4" class="draggable" style="top: 500px; left: 500px;">
            <p>Draggable 4</p>
            </div>
  </div>

    </div>

    <script>
    $(document).ready(function(){
        jsPlumb.ready(function() {
        // $('#picture').draggable({
        //     scroll: 'false',
        //     revert: 'invalid',
        //     helper: 'clone',
        //     cursor: 'move'
        // });
        // jsPlumb.draggable($("#picture"),{
        $('#parent').droppable({
            accept: '.picture',
            drop: function(event, ui) {
                event.preventDefault();
                var newDiv = $("<div>").addClass("draggable").appendTo($(this));
                // var img = $("<img>").addClass("draggable").appendTo($(this));
                // var droppedImage = ui.draggable.clone().attr('id', 'flowchartImage').appendTo(newDiv);
                // droppedImage.removeAttr('style');
                jsPlumb.draggable($(".draggable"), {
                containment: "#parent",
                grid: [20, 20],
                stop: function(event) {
                    jsPlumb.repaintEverything();
                }
                });
                jsPlumb.addEndpoint(newDiv, {
                }, targetPointOptions);

                jsPlumb.addEndpoint(newDiv, {
                }, sourcePointOptions);

                droppedImage.css({
                    'position': 'absolute', 
                    'object-fit': 'cover',
                    'padding': '0',
                    'margin': '0',
                    'height': '100px',
                    'width': '100px'
                });
            }
        });
            jsPlumb.draggable($(".draggable"), {
                containment: "#parent",
                grid: [20, 20],
                stop: function(event) {
                    jsPlumb.repaintEverything();
                }
            });
            var sourcePointOptions = { 
                anchor: "Continuous",
                endpoint: 'Rectangle',
                isSource:true,
                connector: "Flowchart",
                maxConnections: -1,
                connectorStyle: {strokeWidth:1, stroke:'black'},
                scope:"blueline",
                dragAllowedWhenFull: true
            }; 
            var targetPointOptions = { 
                anchor: "Continuous",
                endpoint: 'Dot',
                isTarget:true,
                connector: "Flowchart",
                maxConnections: -1,
                connectorStyle: {strokeWidth:1, stroke:'black'},
                scope:"blueline",
                dragAllowedWhenFull: true
            };

            jsPlumb.addEndpoint($("div.draggable"), {
            }, targetPointOptions);

            jsPlumb.addEndpoint($("div.draggable"), {
            }, sourcePointOptions);
        });

        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    });
    </script>
@endsection
