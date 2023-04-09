@extends('layouts.app')


@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.6/js/jsplumb.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.6/css/jsplumbtoolkit-defaults.css">
@endsection

@section('css')
    <style>
        :root{
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
                linear-gradient(-90deg, rgba(0,0,0,.05) 1px, transparent 1px),
                linear-gradient(rgba(0,0,0,.05) 1px, transparent 1px), 
                linear-gradient(-90deg, rgba(0, 0, 0, .04) 1px, transparent 1px),
                linear-gradient(rgba(0,0,0,.04) 1px, transparent 1px),
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
            left : 75vw;

        }
        #pageName{
            position: relative;
            display: flex;
            font-weight: bold;
            left: 5vw;
        }
        .sourcePoint{
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
            height:5vw;
            width: 5vw;
            background-color: white;
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4);
            border-radius: 10px; 
        }

        .draggable img{
            object-fit: contain;
            padding: 0;
            margin: 0;
            height: 100%;
            width: 100%;
        }

        .picture {
            position : relative;
            object-fit: contain;
            margin:6%;
            margin-left: auto;
            margin-right: auto;
            width: 7vw;
            height: 7vw; 
            border-radius: 20px;
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            z-index: 2;
            transition: all 0,1s ease-in-out;
        }
        .picture:hover{
            transform: translateY(-5px);
            box-shadow: 3 3px 7px rgba(0, 0, 0, 0.25);
        }
        .picture img{
            object-fit: contain;
            margin: 0;
            padding: 0;
            width: 100%; 
            height: 100%;
        }
        .overlay{
            position: absolute;
            text-align: center;
            width: 100%;
            height: 100%;
            color: white;
            background-color: #515940;
            opacity: 0; 
        }
        .text{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            font-weight: bold;
        }
        .picture:hover .overlay{
            opacity: 90%; 
        }
    </style>
@endsection

@section('content')
    <script>
        const itemMap = new Map()
        let count = 1; 
        let usedId = [];

        var instance = jsPlumb.getInstance();
            instance.importDefaults({
                Connector: ["Flowchart"],
                PaintStyle: { stroke: "black", strokeWidth: 1 },
                Endpoint: "Blank",
                    ConnectionOverlays: [
                [ "Arrow", {
                    location: 1,
                    visible:true,
                    width:11,
                    length:11,
                    id:"ARROW"
                } ]]
            });

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev, elementID) {
            event.dataTransfer.setData("text", elementID);
        }

        function drop(event) {
            event.preventDefault();

            var x = event.clientX; 
            var y = event.clientY; 

            var newDiv = $("<div>").addClass("draggable").css({
                left: (x-550) + "px",
                top: (y-230) + "px"
            }).appendTo($("#parent"));

            var data = event.dataTransfer.getData("text");
            var newImage = document.createElement("img");
            newImage.setAttribute("src", "/assets/items/" + data.replace(/ /g, "_") + ".png");
            newImage.setAttribute("id", data);
            itemMap.set(data, itemMap.get(data) - 1);
            while (usedId.includes(count)) {
                count++;
            }
            usedId.push(count);
            $(newDiv).attr("id", data + count);
            console.log(data + count);
            count++; 
            displayItems();
            jsPlumb.ready(function() {
                
                instance.draggable($(".draggable"), {
                    containment: "#parent",
                    grid: [16, 16],
                    stop: function(event) {
                        console.log(event.element.id);
                        instance.repaintEverything();
                    }
                });
                
            $(newImage).appendTo(newDiv);
            $(newDiv).append("<i id='deleteButton' class='fa-solid fa-trash' style='left: -1vw; top:-1vh; position:relative;' onClick='delImg(this)'></i>");

            var sourcePointOptions = {
                anchor: "Continuous",
                endpoint: 'Rectangle',
                isSource:true,
                maxConnections: -1,
                scope:"blueline",
                dragAllowedWhenFull: true
            }; 
            var targetPointOptions = { 
                anchor: "Continuous",
                endpoint: 'Dot',
                isTarget:true,
                maxConnections: -1,
                scope:"blueline",
                dragAllowedWhenFull: true
            };

            var targetPoint = instance.addEndpoint(newDiv,{
            }, targetPointOptions);

            var sourcePoint = instance.addEndpoint(newDiv, {
            }, sourcePointOptions);

            instance.repaintEverything();

        })
        }
        function delImg(btn)
        {
            count = 1; 
            let id = btn.parentElement.id.substr(-1, 1);
            let indexToRemove = usedId.indexOf(parseInt(id));
            usedId.splice(indexToRemove, 1);
            instance.remove(btn.parentElement);
            itemMap.set(btn.previousSibling.id, itemMap.get(btn.previousSibling.id) + 1);
            displayItems();
        }
        function displayItems()
        {
            const sidebar = document.getElementById("sidebar");
            sidebar.innerHTML = "";
            // const sidebarBrand = "<li class='sidebar-brand'>";
            // $(sidebarBrand).append('<a class="menu-toggle" style="float:right;" onclick="toggleSidebar()"> <i class="fa fa-bars "></i></a>').appendTo(sidebar);
            for (const [key, value] of itemMap.entries()) {
                if(value > 0)
                {
                    const item = "<li class='picture' style='background-color: white; color: black; display: flex; flex-direction: column' draggable='true' ondragstart='drag(event, \"" + key + "\")'>";
                    const overlay = "<div class='overlay'><div class='text'>" + key + "</div></div>";
                    $(item).append("<img src='/assets/items/" + key.replace(/ /g, "_") + ".png'>",overlay).appendTo(sidebar);
                }  
            }
        }

        function exportPNG()
        {
            const buttons = document.querySelectorAll("#deleteButton");
            const endPoints = jsPlumb.getSelector(".jtk-endpoint");
            console.log(buttons);
            endPoints.forEach(endpoint => {
                endpoint.style.opacity = "0"
            });
            buttons.forEach(button => {
                button.style.opacity = "0"
            });
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
                endPoints.forEach(endpoint => {
                    endpoint.style.opacity = "1"
                });
                buttons.forEach(button => {
                    button.style.opacity = "1"
                });
            })
            .catch(function (error) {
                console.error('oops, something went wrong!', error);
            });
        }
        function saveJSON()
        {
            var listDraggable = [];
            var listConnection = [];
            $(".draggable").each(function() {
                var id = $(this).attr('id');
                var left = $(this).css('left');
                var top = $(this).css('top');
                var source= $(this).find("img").attr('src');
                var draggableData = {
                    "id": id,
                    "left": left,
                    "top": top,
                    "source": source
                }
                listDraggable.push(draggableData);
            });
            var connections = instance.getAllConnections();
            connections.forEach(connection => {
                var source = connection.sourceId;
                var target = connection.targetId;
                var connectionData = {
                    "source": source,
                    "target": target,
                }
                listConnection.push(connectionData);
            });
            var draggableStr = JSON.stringify(listDraggable);
            var connectionStr = JSON.stringify(listConnection);
            console.log(draggableStr);
            console.log(connectionStr);
        }
        function loadJSON()
        {
            
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
                            <img src="{{ asset('assets/items/'.str_replace(" ", "_",$item->nama_barang).'.png') }}">
                            <div class='overlay'>
                                <div class='text'>{{$item->nama_barang}}
                            </div>
                        </li>
                        @for ($count = 1; $count <= $item->stock_barang; $count++)     
                            <script>
                            itemMap.set("{{$item->nama_barang}}", {{$count}});
                            console.log(itemMap);
                            </script>
                        @endfor        
                    @endforeach
                    @foreach ($inventory_bahan as $item)
                        <li class="picture" style="background-color: white; color: black;"style="object-fit: contain;" draggable="true" ondragstart="drag(event, '{{$item->nama_barang}}')">
                                <img src="{{ asset('assets/items/'.str_replace(" ", "_",$item->nama_barang).'.png') }}">
                        </li>
                        @for ($count = 1; $count <= $item->stock_barang; $count++)     
                            <script>
                            itemMap.set("{{$item->nama_barang}}", {{$count}});
                            console.log(itemMap);
                            </script>
                        @endfor      
                    @endforeach
                </ul>
            <div class="container" id="parent" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
            </div>
        </div>
        <button id="buttonExport" onclick="exportPNG()">Export</button>
        <button id="buttonSave" onclick="saveJSON()">Save</button>
        </div>
    </main>
@endsection

