@extends('layouts.app')


@section('head')
    <script src="https://unpkg.com/fabric@5.3.0/dist/fabric.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.6/js/jsplumb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.6/css/jsplumbtoolkit-defaults.css">
<script>
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
</script>
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
            overflow y: scroll;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .sidebar-nav {
            position: absolute;
            overflow-y: scroll;
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
            padding-left: 140px; 
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
            background-color: white;
            border-radius: 10px; 
        }

        #flowchartImage{
            position: absolute; 
            object-fit: contain;
            padding: 0;
            margin: 0;
            height: 100px;
            width: 100px;
        }

        .picture {
            display: flex;
            object-fit: contain;
            justify-content: space-around;
            margin: 5px;
            margin-left: 40px;
            height: 120px;
            z-index: 2;
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
        #menu-toggle {
            position: static;
        }
        #wrapper.toggled #menu-toggle {
            padding-left: 30px;
            padding-top: 20px;
        }

        #parent { 
            height: 700px;
            width: 1000px;
            position: fixed;
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

            var x = ev.clientX; 
            var y = ev.clientY; 

            var newDiv = $("<div>").addClass("draggable").css({
                left: (x - 460) + "px",
                top: (y - 100) + "px"
            }).appendTo($("#parent"));
            var data = ev.dataTransfer.getData("text");
            var newImage = document.createElement("img");

            newImage.id = "flowchartImage";
            newImage.setAttribute("src", data);
            jsPlumb.ready(function() {
                
                jsPlumb.draggable($(".draggable"), {
                    containment: "#parent",
                    grid: [20, 20],
                    stop: function(event) {
                        jsPlumb.repaintEverything();
                    }
                });
                
            $(newImage).appendTo(newDiv);
            $(newDiv).append("<i id='deleteButton' class='fa-solid fa-trash' style='left: -20px; top:-20px; position:relative;' onClick='delImg(this)'></i>");

            jsPlumb.addEndpoint(newDiv,{
            }, targetPointOptions);

            jsPlumb.addEndpoint(newDiv, {
            }, sourcePointOptions);
            jsPlumb.repaintEverything();
        })
        }
        function delImg(btn)
        {
            console.log("Button Pressed");
            console.log(btn.parentElement);
            jsPlumb.removeAllEndpoints(btn.parentElement);
            btn.parentElement.remove();
        }
    </script>
    <div class="container" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">

                <li class="sidebar-brand">
                    <a id="menu-toggle" style="float:right;"> <i class="fa fa-bars "></i></a>
                </li>
                {{-- <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true" ondragstart="drag(event)"></li>
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true" ondragstart="drag(event)"></li>
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true" ondragstart="drag(event)"></li>
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true" ondragstart="drag(event)"></li>
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true" ondragstart="drag(event)"></li> --}}
                @foreach ($inventory_alat as $item)
                    @for ($count = 1; $count <= $item->stock_barang; $count++)
                        <li class="picture" style="background-color: white; color: black; object-fit: contain;" draggable="true" ondragstart="drag(event)">
                            <img src="{{ asset('assets/items/'.str_replace(" ", "_",$item->nama_barang).'.png') }}" style="object-fit: contain;"><span>{{ $item->nama_barang }}</span></li>
                    @endfor
                @endforeach
                @foreach ($inventory_bahan as $item)
                    @for ($count = 1; $count <= $item->stock_barang; $count++)
                        <li class="picture" style="background-color: white; color: black;"style="object-fit: contain;" draggable="true" ondragstart="drag(event)">
                            <img><span>{{ $item->nama_barang }}</span></li>
                    @endfor
                @endforeach
            </ul>
        </div>
        <div id="parent" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    </div>

    <script>
    $(document).ready(function(){
        jsPlumb.ready(function() {
            jsPlumb.draggable($(".draggable"), {
                containment: "#parent",
                grid: [20, 20],
                stop: function(event) {
                    jsPlumb.repaintEverything();
                }
            });
        });

        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    });
    </script>
@endsection
