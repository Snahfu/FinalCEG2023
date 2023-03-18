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
            width: 250px;
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
            padding-right: 10px;
            height: 150px;
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

        #canvas {
            position: relative;
            width: 100%;
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
                {{-- <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true"
                        ondragstart="drag(event)"></li>
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true"
                        ondragstart="drag(event)"></li>
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true"
                        ondragstart="drag(event)"></li>
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true"
                        ondragstart="drag(event)"></li> --}}
                <li class="picture"><img src="{{ 'assets' }}/users/dummy_pic.jpg" draggable="true"
                        ondragstart="drag(event)"></li>
                @foreach ($inventory as $item)
                    @for ($count = 1; $count <= $item->stock_barang; $count++)
                        <li class="picture" style="background-color: white; color: black; width: 100px; height: 100px; margin: 0 0 50px 0">
                            <img style="background-color: white; color: black;"><span>{{ $item->nama_barang }}</span></li>
                    @endfor
                @endforeach
            </ul>

        </div>

        <canvas id="canvas"></canvas>

    </div>

    <script>
        const canvas = new fabric.Canvas('canvas');
        canvas.setWidth('1000');
        canvas.setHeight('700');

        const rect1 = new fabric.Rect({
            left: 100,
            top: 100,
            fill: 'red',
            width: 50,
            height: 50
        });

        const rect2 = new fabric.Rect({
            left: 300,
            top: 200,
            fill: 'green',
            width: 50,
            height: 50
        });

        canvas.add(rect1, rect2);
        canvas.renderAll();

        jsPlumb.ready(function() {

            const endpoint1 = jsPlumb.addEndpoint(canvas, {
                anchor: 'BottomCenter',
                connector: 'Straight',
                endpoint: 'Rectangle'
            });

            const instance = jsPlumb.getInstance();

            instance.connect({
                source: endpoint1,
                anchors: ['Right', 'Left'],
                endpoint: 'Rectangle',
                paintStyle: {
                    strokeWidth: 2,
                    stroke: 'blue'
                }
            });
        });

        /* Drag and Drop Function*/
        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }
        canvas.on('drop', function(ev) {
            if (typeof ev.preventDefault === 'function') {
                ev.preventDefault();
            }
            const file = event.dataTransfer.files[0];
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = new Image();
                img.onload = function() {
                    const fabricImg = new fabric.Image(img);
                    fabricImg.left = ev.e.offsetX;
                    fabricImg.top = ev.e.offsetY;
                    canvas.add(fabricImg);
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file);
        });

        canvas.on('dragover', function(ev) {
            if (typeof ev.preventDefault === 'function') {
                ev.preventDefault();
            }
        });

        canvas.on('mousemove', function(event) {
            const mouseX = event.offsetX;
            const mouseY = event.offsetY;
        });

        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
@endsection
