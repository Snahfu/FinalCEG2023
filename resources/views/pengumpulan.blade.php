@extends('layouts.app')


@section('head')
    <script src="https://unpkg.com/fabric@5.3.0/dist/fabric.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.6/js/jsplumb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js"></script>
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
            height: 775px; 
        }
        #parent { 
            position: relative;
            background-color : lightgrey;
            top: 100px;
            left: 60px;
            height: 600px;
            width: 65%;
            margin-bottom: 10px;
            border-radius: 20px;
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4);
            overflow-x: hidden;
            overflow-y: scroll;
        }
        .sidebar-nav {
            z-index: 1000;
            position: relative;
            overflow-y: scroll;
            background-color: lightgray;
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4);
            margin: 0;
            padding:0;
            margin-bottom: 10px;
            top: 100px;
            border-radius: 20px;
            left: 90px;
            width: 200px; 
            height: 600px;           
        }
        .draggable {
            position: absolute; 
            object-fit: contain;
            height: 100px;
            width: 100px;
            background-color: white;
            border-radius: 10px; 
        }

        .draggable img{
            object-fit: contain;
            padding: 0;
            margin: 0;
            height: 100px;
            width: 100px;
        }

        .picture {
            position : relative;
            display: flex;
            object-fit: contain;
            padding: 0;
            left: 15px; 
            margin: 10px;
            width: 150px;
            height: 120px;
            border-radius: 20px;
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4);
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
            width: 150px; 
            height: 120px;
        }

        /* Flowchart Style*/
    </style>
@endsection

@section('content')
    <script>
        const itemMap = new Map();

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
            console.log(data);
            newImage.setAttribute("src", "/assets/items/" + data.replace(/ /g, "_") + ".png");
            newImage.setAttribute("id", data);
            itemMap.set(data, itemMap.get(data) - 1);
            displayItems();
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
            jsPlumb.removeAllEndpoints(btn.parentElement);
            btn.parentElement.remove();
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
                    $(item).append("<img src='/assets/items/" + key.replace(/ /g, "_") + ".png'>").appendTo(sidebar);
                    // $(item).append("<img src='/assets/items/" + key.replace(/ /g, "_") + ".png'>", "<span style='text-align: center; padding-right: 20px;'>" + key + "</span>").appendTo(sidebar);
                }  
            }
        }
    </script>
    </div>
    <div class="container" id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar-nav" id="sidebar">
        @foreach ($inventory_alat as $item)
            <li class="picture" style="background-color: white; color: black; display: flex; flex-direction: column" draggable="true" ondragstart="drag(event, '{{$item->nama_barang}}')">
                <img src="{{ asset('assets/items/'.str_replace(" ", "_",$item->nama_barang).'.png') }}">
                {{-- <span style="text-align: center; padding-right: 20px;">{{$item->nama_barang}}</span> --}}
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
    });
    </script>
@endsection

