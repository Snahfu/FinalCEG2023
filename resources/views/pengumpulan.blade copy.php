@extends('layouts.app')


@section('head')
<script src="https://unpkg.com/fabric@5.3.0/dist/fabric.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.6/js/jsplumb.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js"></script>
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

    .picture {
        display: flex;
        object-fit: cover;
        justify-content: space-around;
        padding: 5px;
        padding-left: 10px;
        height: 120px;
    }

    .draggable {
        position: absolute;
        width: 100px;
        height: 100px;
        background-color: white;
        border-radius: 10px;
        padding: 0.5em;
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
<div class="container" id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">

            <li class="sidebar-brand">
                <a id="menu-toggle" style="float:right;"> <i class="fa fa-bars "></i></a>
            </li>
            <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true" ondragstart="drag(event)"></li>
            <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true" ondragstart="drag(event)"></li>
            <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true" ondragstart="drag(event)"></li>
            <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true" ondragstart="drag(event)"></li>
            <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true" ondragstart="drag(event)"></li>

        </ul>

    </div>
    <div id="parent">
        <div id="draggable1" class="draggable">
            <p>Draggable 1</p>
        </div>

        <div id="draggable2" class="draggable" style="top: 150px; left: 150px;">
            <p>Draggable 2</p>
        </div>
    </div>

</div>

<script>
    jsPlumb.ready(function() {

        $(function() {
            $(".draggable").draggable({
                containment: "#parent",
                stop: function(event, ui) {
                    jsPlumb.repaintEverything();
                }
            });
        });

        jsPlumb.ready(function() {
            jsPlumb.draggable($(".draggable"), {
                containment: "#parent",
                grid: [20, 20],
                stop: function(event) {
                    jsPlumb.repaintEverything();
                }
            });

            var sourcePointOptions = {
                endpoint: 'Rectangle',
                isSource: true,
                connector: "Flowchart",
                maxConnections: -1,
                connectorStyle: {
                    strokeWidth: 1,
                    stroke: 'black'
                },
                scope: "blueline",
                dragAllowedWhenFull: true
            };
            var targetPointOptions = {
                anchor: "Continuous",
                endpoint: 'Dot',
                isTarget: true,
                connector: "Flowchart",
                maxConnections: 1,
                connectorStyle: {
                    strokeWidth: 1,
                    stroke: 'black'
                },
                scope: "blueline",
                dragAllowedWhenFull: true
            };
            var box1TargetTop = jsPlumb.addEndpoint('draggable1', {
                anchor: "Top"
            }, targetPointOptions);
            var box1TargetBottom = jsPlumb.addEndpoint('draggable1', {
                anchor: "Bottom"
            }, targetPointOptions);
            var box1TargetLeft = jsPlumb.addEndpoint('draggable1', {
                anchor: "Left"
            }, targetPointOptions);
            var box1SourceRight = jsPlumb.addEndpoint('draggable1', {
                anchor: "Right"
            }, sourcePointOptions);
            var box2TargetTop = jsPlumb.addEndpoint('draggable2', {
                anchor: "Top"
            }, targetPointOptions);
            var box2TargetBottom = jsPlumb.addEndpoint('draggable2', {
                anchor: "Bottom"
            }, targetPointOptions);
            var box2TargetLeft = jsPlumb.addEndpoint('draggable2', {
                anchor: "Left"
            }, targetPointOptions);
            var box2SourceRight = jsPlumb.addEndpoint('draggable2', {
                anchor: "Right"
            }, sourcePointOptions);
        });

    });

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
@endsection