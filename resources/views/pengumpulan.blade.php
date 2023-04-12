@extends('layouts.app')


@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.6/js/jsplumb.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.6/css/jsplumbtoolkit-defaults.css">
@endsection

@section('css')
    <style>
        :root {
            --listHeight: 20vh;
        }

        body {
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 0%;
        }

        #wrapper {
            display: flex;
            justify-content: center;
            margin-top: 1vh;
            height: 70vh;
        }

        #parent {
            position: relative;
            background:
                linear-gradient(-90deg, rgba(0, 0, 0, .05) 1px, transparent 1px),
                linear-gradient(rgba(0, 0, 0, .05) 1px, transparent 1px),
                linear-gradient(-90deg, rgba(0, 0, 0, .04) 1px, transparent 1px),
                linear-gradient(rgba(0, 0, 0, .04) 1px, transparent 1px),
                linear-gradient(transparent 3px, #f2f2f2 3px, #f2f2f2 78px, transparent 78px),
                linear-gradient(-90deg, #aaa 1px, transparent 1px),
                linear-gradient(-90deg, transparent 3px, #f2f2f2 3px, #f2f2f2 78px, transparent 78px),
                linear-gradient(#aaa 1px, transparent 1px),
                #f2f2f2;
            background-size:
                16px 16px,
                16px 16px,
                80px 80px,
                80px 80px,
                80px 80px,
                80px 80px,
                80px 80px,
                80px 80px;
            margin-left: 5vw;
            margin-right: 0vw;
            height: 69.5vh;
            width: 50vw;
            border-radius: 20px;
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4);
            overflow-x: hidden;
        }

        #buttonExport {
            width: 5vw;
            position: relative;
            left: 75vw;

        }

        #pageName {
            position: relative;
            display: flex;
            font-weight: bold;
            left: 5vw;
        }

        .sourcePoint {
            fill: red;
        }

        h1:after {
            background-color: #000;
            content: "";
            display: inline-block;
            margin-top: auto;
            margin-bottom: auto;
            height: 2px;
            position: relative;
            vertical-align: middle;
            width: 50vw;
            left: 1rem;
        }

        .sidebar-nav {
            z-index: 1000;
            position: relative;
            overflow-y: scroll;
            background-color: #f2f2f2;
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4);
            padding-left: 0;
            border-radius: 20px;
            width: 9vw;
            height: 70vh;
        }

        .draggable {
            position: absolute;
            object-fit: contain;
            height: 5vw;
            width: 5vw;
            background-color: white;
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4);
            border-radius: 10px;
        }

        .draggable img {
            object-fit: contain;
            padding: 0;
            margin: 0;
            height: 100%;
            width: 100%;
        }

        .picture {
            position: relative;
            object-fit: contain;
            margin: 6%;
            margin-left: auto;
            margin-right: auto;
            width: 7vw;
            height: 7vw;
            border-radius: 20px;
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            z-index: 2;
            transition: all 0, 1s ease-in-out;
        }

        .picture:hover {
            transform: translateY(-5px);
            box-shadow: 3 3px 7px rgba(0, 0, 0, 0.25);
        }

        .picture img {
            object-fit: contain;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .overlay {
            position: absolute;
            text-align: center;
            width: 100%;
            height: 100%;
            color: white;
            background-color: #515940;
            opacity: 0;
        }

        .text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            font-weight: bold;
        }

        .picture:hover .overlay {
            opacity: 90%;
        }
    </style>
@endsection

@section('content')
    <script>
        const itemMap = new Map();
        let count = 1;
        let usedId = [];
        var arrowStatus = false; 
        var canvas; 
        //Class Arrow
        fabric.LineArrow = fabric.util.createClass(fabric.Line, {

            type: 'lineArrow',

            initialize: function(element, options) {
            options || (options = {});
            this.callSuper('initialize', element, options);
            },

            toObject: function() {
            return fabric.util.object.extend(this.callSuper('toObject'));
            },

            _render: function(ctx) {
            this.ctx = ctx;
            this.callSuper('_render', ctx);
            let p = this.calcLinePoints();
            let xDiff = this.x2 - this.x1;
            let yDiff = this.y2 - this.y1;
            let angle = Math.atan2(yDiff, xDiff);
            this.drawArrow(angle, p.x2, p.y2, this.heads[0]);
            ctx.save();
            xDiff = -this.x2 + this.x1;
            yDiff = -this.y2 + this.y1;
            angle = Math.atan2(yDiff, xDiff);
            this.drawArrow(angle, p.x1, p.y1,this.heads[1]);
            },

            drawArrow: function(angle, xPos, yPos, head) {
            this.ctx.save();
            
            if (head) {
                this.ctx.translate(xPos, yPos);
                this.ctx.rotate(angle);
                this.ctx.beginPath();

                this.ctx.moveTo(this.strokeWidth, 0);
                this.ctx.lineTo(-this.strokeWidth*2, this.strokeWidth*2);
                this.ctx.lineTo(-this.strokeWidth*2, -this.strokeWidth*2);
                this.ctx.closePath();
            }
            
            this.ctx.fillStyle = this.stroke;
            this.ctx.fill();
            this.ctx.restore();
            }
            });

            fabric.LineArrow.fromObject = function(object, callback) {
            callback && callback(new fabric.LineArrow([object.x1, object.y1, object.x2, object.y2], object));
            };

            fabric.LineArrow.async = true;


            var Arrow = (function() {
            function Arrow(canvas) {
                this.canvas = canvas;
                this.className = 'Arrow';
                this.isDrawing = false;
                this.bindEvents();
            }

            Arrow.prototype.bindEvents = function() {
                var inst = this;
                inst.canvas.on('mouse:down', function(o) {
                    inst.onMouseDown(o);
                });
                inst.canvas.on('mouse:move', function(o) {
                    inst.onMouseMove(o);
                });
                inst.canvas.on('mouse:up', function(o) {
                    inst.onMouseUp(o);
                });
                inst.canvas.on('object:moving', function(o) {
                    inst.disable();
                })
            }

            Arrow.prototype.onMouseUp = function(o) {
                console.log("Mouse up");
                var inst = this;
                this.line.set({
                    dirty: true,
                    objectCaching: true
                });
                inst.canvas.renderAll();
                inst.disable();
            };

            Arrow.prototype.onMouseMove = function(o) {
                var inst = this;
                if (!inst.isEnable()) {
                    return;
                }

                var pointer = inst.canvas.getPointer(o.e);
                var activeObj = inst.canvas.getActiveObject();
                activeObj.set({
                    x2: pointer.x,
                    y2: pointer.y
                });
                activeObj.setCoords();
                inst.canvas.renderAll();
            };

            Arrow.prototype.onMouseDown = function(o) {
                var inst = this;
                inst.enable();
                console.log("Mouse down");
                var pointer = inst.canvas.getPointer(o.e);

                var points = [pointer.x, pointer.y, pointer.x, pointer.y];
                this.line = new fabric.LineArrow(points, {
                    strokeWidth: 5,
                    fill: 'black',
                    stroke: 'black',
                    originX: 'center',
                    originY: 'center',
                    objectCaching: false,
                    hasBorders: false,
                    hasControls: false,
                    perPixelTargetFind: true,
                    heads: [1, 0]
                });

                inst.canvas.add(this.line).setActiveObject(this.line);
            };

            Arrow.prototype.isEnable = function() {
                return this.isDrawing;
            }

            Arrow.prototype.enable = function() {
                this.isDrawing = true;
            }

            Arrow.prototype.disable = function() {
                console.log("Disabled");
                this.isDrawing = false;
            }

            return Arrow;
        }());
        var arrow;
        $(document).ready(function(){

            var parent  = document.getElementById('parent');
            var width = parent.clientWidth;
            var height = parent.clientHeight;

            canvas = new fabric.Canvas('parent')
            canvas.setWidth(width);
            canvas.setHeight(height);
            var upperCanvas = canvas.upperCanvasEl; 

            upperCanvas.style.left = "40px";
            //Object Arrow
            // arrow = new Arrow(canvas);

            canvas.on("drop", (ev) => {
                var data = event.dataTransfer.getData("id");
                var img = document.createElement("img");
                const parent = document.getElementById("parent");
                img.setAttribute("id", data);
                img.setAttribute("src", "/assets/items/" + data.replace(/ /g, "_") + ".png");
                    img.onload = function() {
                        const fabricImg = new fabric.Image(img);
                        fabricImg.left = ev.e.clientX - parent.getBoundingClientRect().left - 50;
                        fabricImg.top = ev.e.clientY- parent.getBoundingClientRect().top - 20;
                        fabricImg.scaleToWidth(50);
                        fabricImg.scaleToHeight(50);
                        fabricImg.id = data; 
                        canvas.add(fabricImg);
                        itemMap.set(data, itemMap.get(data) - 1);
                        displayItems();
                    };
                });
             });

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev, elementID) {
            event.dataTransfer.setData("id", elementID);
        }

        function delImg()
        {
            var activeObject = canvas.getActiveObject();
            if (activeObject) {
                canvas.remove(activeObject);
                itemMap.set(activeObject.id, itemMap.get(activeObject.id) + 1);
                console.log(activeObject.id);
                displayItems();
            }
        }

        function displayItems() {
            const sidebar = document.getElementById("sidebar");
            sidebar.innerHTML = "";
            for (const [key, value] of itemMap.entries()) {
                if (value > 0) {
                    const item =
                        "<li class='picture' style='background-color: white; color: black; display: flex; flex-direction: column' draggable='true' ondragstart='drag(event, \"" +
                        key + "\")'>";
                    const overlay = "<div class='overlay'><div class='text'>" + key + "</div></div>";
                    $(item).append("<img src='/assets/items/" + key.replace(/ /g, "_") + ".png'>", overlay).appendTo(
                        sidebar);
                }
            }
        }

        function addTextBox()
        {
            var text = new fabric.IText('Enter text here', {
                left: 100,
                top: 100,
                fontFamily: 'arial',
                fill: '#000000',
                scaleX: 1,
                scaleY: 1,
                hasRotatingPoint: true
            });
            canvas.add(text);
        }

        function addArrow()
        {
            arrow.disable();
        }

        function addLine()
        {

        }

        function exportPNG()
        {
            const element = document.getElementById('parent');
            htmlToImage.toPng(element,{
                backgroundColor: '#FFFFFF',
                style: {
                    margin: 0,
                }
            })
            .then(function (dataUrl) {
                var link = document.createElement('a');
                link.download = 'FlowchartDiagram.png';
                link.href = dataUrl;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            })
            .catch(function (error) {
                console.error('oops, something went wrong!', error);
            });
        }
        function saveJSON()
        {
           var JSONstr = JSON.stringify(canvas);
           localStorage.setItem("JSON", JSONstr);
           console.log(JSONstr);
        }
        function loadJSON()
        {
           var JSONStr = localStorage.getItem("JSON");
           console.log(JSONStr);
           canvas.loadFromJSON(JSONStr);
        }

    </script>
    <main class="d-block mx-md-4">
        <div class="container d-flex flex-column sm-p-0">
            <div class="row my-3">
                <div class="col">
                    <h1 class="p-0 m-0" id="pageName">Pengumpulan</h1>
                </div>
            </div>
            <div class="container" id="wrapper">
                <ul class="sidebar-nav" id="sidebar">
                    @foreach ($inventory_alat as $item)
                        <li class="picture" style="background-color: white; color: black; display: flex; flex-direction: column" draggable="true" ondragstart="drag(event, '{{$item->nama_barang}}')">
                            <img id="{{$item->nama_barang}}" src="{{ asset('assets/items/'.str_replace(" ", "_",$item->nama_barang).'.png') }}">
                            <div class='overlay'>
                                <div class='text'>{{ $item->nama_barang }}
                                </div>
                        </li>
                        @for ($count = 1; $count <= $item->stock_barang; $count++)
                            <script>
                                itemMap.set("{{ $item->nama_barang }}", {{ $count }});
                            </script>
                        @endfor
                    @endforeach
                    @foreach ($inventory_bahan as $item)
                        {{-- <li class="picture" style="background-color: white; color: black;"style="object-fit: contain;"
                            draggable="true" ondragstart="drag(event, '{{ $item->nama_barang }}')">
                            <img src="{{ asset('assets/items/' . str_replace(' ', '_', $item->nama_barang) . '.png') }}"> --}}
                        <li class="picture" style="background-color: white; color: black;"style="object-fit: contain;" draggable="true" ondragstart="drag(event, '{{$item->nama_barang}}')">
                                <img id="{{$item->nama_barang}}" src="{{ asset('assets/items/'.str_replace(" ", "_",$item->nama_barang).'.png') }}">
                        </li>
                        @for ($count = 1; $count <= $item->stock_barang; $count++)
                            <script>
                                itemMap.set("{{ $item->nama_barang }}", {{ $count }});
                            </script>
                        @endfor
                    @endforeach
                </ul>
            <canvas class="canvas-container" id="parent" ondrop="drop(event)" ondragover="allowDrop(event)"></canvas>
            </div>
        </div>
        <button id="buttonExport" onclick="exportPNG()">Export</button>
        <button id="buttonSave" onclick="saveJSON()">Save</button>
        <button id="buttonLoad" onclick="loadJSON()">Load</button>
        <button id="buttonAddTextBox" onclick="addTextBox()">Add Text Box</button>
        <button id="buttonAddArrow" onclick="addArrow()">Add Arrow</button>
        <button id="buttonAddLine" onclick="addLine()">Add Line</button>
        <button id="buttonDelImg" onclick="delImg()">Delete</button>
            
    </main>
@endsection
