@extends('layouts.panel')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body p2 pb-2">
                    <div class="row">
                        <div class="col-12">
                            <h5>Configuración de mesas</h5>
                            <hr>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="btn-group w-100 mb-3">
                                        <button class="btn btn-primary rectangle">+ &#9647; Mesa</button>
                                        <button class="btn btn-primary circle">+ &#9711; Mesa</button>
                                        <button class="btn btn-primary triangle">+ &#9651; Mesa</button>
                                        <button class="btn btn-primary chair">+ Silla</button>
                                        <button class="btn btn-primary bar">+ Bar / Barra</button>
                                        <button class="btn btn-default wall">+ Muro</button>
                                        <button class="btn btn-danger remove">Eliminar</button>
                                        <!--<button class="btn btn-warning customer-mode">Customer mode</button>-->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <a class="btn btn-primary btn-block d-none QrShow">Ver código QR</a>
                                </div>
                                <div class="form-group customer-menu" style="display: none;">
                                    <div class="btn-group">
                                        <button class="btn btn-success submit">Submit reservation</button>
                                        <button class="btn btn-warning admin-mode">Admin mode</button>
                                    </div>
                                    <br />
                                    <br />
                                    <div id="slider"></div>
                                    <div id="slider-value"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class='resizable mh-100 mw-100 mx-auto'
                                        style="width: {{ $branch->table->width }}px; height: {{ $branch->table->height }}px;">
                                        <div class='resizers'>
                                            <div class='resizer top-left'></div>
                                            <div class='resizer top-right'></div>
                                            <div class='resizer bottom-left'></div>
                                            <div class='resizer bottom-right'></div>
                                        </div>
                                        <canvas id="canvas"></canvas>
                                    </div>
                                </div>
                                <div class="col-sm-12">

                                </div>
                            </div>
                            <div class="row mt-3 text-center">
                                <div class="col-sm-12 text-center">
                                    <div class="btn btn-primary getObjects">Guardar configuración</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/fabric.js') }}"></script>
    <script>
        let canvas
        let number
        let widthResizable = parseInt("{{ $branch->table->width }}")
        heightResizable = parseInt("{{ $branch->table->height }}")
        const grid = 30
        let selectedTable;
        const backgroundColor = '#ccc'
        const lineStroke = '#ebebeb'
        const tableFill = 'rgba(150, 111, 51, 0.7)'
        const tableStroke = '#694d23'
        const tableShadow = 'rgba(0, 0, 0, 0.4) 3px 3px 7px'
        const chairFill = 'rgba(67, 42, 4, 0.7)'
        const chairStroke = '#32230b'
        const chairShadow = 'rgba(0, 0, 0, 0.4) 3px 3px 7px'
        const barFill = 'rgba(0, 93, 127, 0.7)'
        const barStroke = '#003e54'
        const barShadow = 'rgba(0, 0, 0, 0.4) 3px 3px 7px'
        const barText = 'Bar'
        const wallFill = 'rgba(136, 136, 136, 0.7)'
        const wallStroke = '#686868'
        const wallShadow = 'rgba(0, 0, 0, 0.4) 5px 5px 20px'

        var photoUrlLandscape = 'https://images8.alphacoders.com/292/292379.jpg',
            photoUrlPortrait =
            'https://presspack.rte.ie/wp-content/blogs.dir/2/files/2015/04/AMC_TWD_Maggie_Portraits_4817_V1.jpg'

        let canvasEl = document.getElementById('canvas')

        $(document).on('click', '.QrShow', function() {
            $.ajax({
                    url: "{{ url('/panel/mesas') }}/"+selectedTable.number,
                    type: 'GET',
                    success: function(data){
                        console.log(data)
                        $('#QRModal .modal-body').html(data.qrCode); 
                    $('#QRModal').modal('show')
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
        })

        function initCanvas() {
            if (canvas) {
                canvas.clear()
                canvas.dispose()
            }

            canvas = new fabric.Canvas('canvas', {
                //backgroundColor: 'rgb(190,100,200)',
                width: $('.resizable').width(),
                height: $('.resizable').height()
            })
            number = 1
            canvas.backgroundColor = backgroundColor
            /*canvas.setBackgroundImage(
                'https://img.freepik.com/free-photo/tile-wall-background_63047-967.jpg?size=626&ext=jpg',
                canvas.renderAll.bind(canvas));*/
            //canvas.backgroundColor = new fabric.Pattern({source: 'https://img.freepik.com/free-photo/tile-wall-background_63047-967.jpg?size=626&ext=jpg'})

            for (let i = 0; i < (canvas.height / (grid / 5)); i++) {
                const lineX = new fabric.Line([0, i * grid, canvas.width, i * grid], {
                    stroke: lineStroke,
                    selectable: false,
                    type: 'line'
                })
                const lineY = new fabric.Line([i * grid, 0, i * grid, canvas.height], {
                    stroke: lineStroke,
                    selectable: false,
                    type: 'line'
                })
                sendLinesToBack()
                canvas.add(lineX)
                canvas.add(lineY)
            }

            $('.canvas-container').css({
                position: ''
            });

            canvas.on('object:moving', function(e) {
                snapToGrid(e.target)
            })

            canvas.on('object:selected', function(e) {
                console.log(e.target)
                if (e.target.type == "table") {
                    selectedTable = e.target
                    $('.QrShow').removeClass('d-none')
                } else {
                    $('.QrShow').addClass('d-none')
                }
            });

            canvas.on('object:scaling', function(e) {
                /*if (e.target.scaleX > 5) {
                    e.target.scaleX = 5
                }
                if (e.target.scaleY > 5) {
                    e.target.scaleY = 5
                }
                if (!e.target.strokeWidthUnscaled && e.target.strokeWidth) {
                    e.target.strokeWidthUnscaled = e.target.strokeWidth
                }
                if (e.target.strokeWidthUnscaled) {
                    e.target.strokeWidth = e.target.strokeWidthUnscaled / e.target.scaleX
                    if (e.target.strokeWidth === e.target.strokeWidthUnscaled) {
                        e.target.strokeWidth = e.target.strokeWidthUnscaled / e.target.scaleY
                    }
                }*/
            })

            canvas.on('object:modified', function(e) {
                /*e.target.scaleX = e.target.scaleX >= 0.25 ? (Math.round(e.target.scaleX * 2) / 2) : 0.5
                e.target.scaleY = e.target.scaleY >= 0.25 ? (Math.round(e.target.scaleY * 2) / 2) : 0.5
                snapToGrid(e.target)*/
                if (e.target.type === 'table') {
                    canvas.bringToFront(e.target)
                } else {
                    canvas.sendToBack(e.target)
                }
                sendLinesToBack()
            })

            canvas.observe('object:moving', function(e) {
                checkBoudningBox(e)
            })
            canvas.observe('object:rotating', function(e) {
                checkBoudningBox(e)
            })
            canvas.observe('object:scaling', function(e) {
                //checkBoudningBox(e)
            })

        }

        initCanvas()

        function resizeCanvas() {
            canvasEl.width = $('.resizeble').width();
            canvasEl.height = $('.resizeble').height();
            const canvasContainerEl = document.querySelectorAll('.canvas-container')[0]
            canvasContainerEl.style.width = $('.resizeble').width();
            canvasContainerEl.style.height = $('.resizeble').height();
        }

        function generateId() {
            return Math.random().toString(36).substr(2, 8)
        }

        function addRect(left, top, width, height, scaleX, scaleY) {
            const id = generateId()
            const o = new fabric.Rect({
                width: width,
                height: height,
                scaleX: scaleX,
                scaleY: scaleY,
                fill: tableFill,
                stroke: tableStroke,
                strokeWidth: 2,
                shadow: tableShadow,
                originX: 'center',
                originY: 'center',
                centeredRotation: true,
                snapAngle: 45,
                selectable: true
            })
            const t = new fabric.IText(number.toString(), {
                fontFamily: 'Calibri',
                fontSize: 14,
                fill: '#fff',
                textAlign: 'center',
                originX: 'center',
                originY: 'center'
            })
            const g = new fabric.Group([o, t], {
                left: left,
                top: top,
                centeredRotation: true,
                snapAngle: 45,
                selectable: true,
                type: 'table',
                id: id,
                number: number
            })
            canvas.add(g)
            number++
            return g
        }

        function addCircle(left, top, radius) {
            const id = generateId()
            const o = new fabric.Circle({
                radius: radius,
                fill: tableFill,
                stroke: tableStroke,
                strokeWidth: 2,
                shadow: tableShadow,
                originX: 'center',
                originY: 'center',
                centeredRotation: true
            })
            const t = new fabric.IText(number.toString(), {
                fontFamily: 'Calibri',
                fontSize: 14,
                fill: '#fff',
                textAlign: 'center',
                originX: 'center',
                originY: 'center'
            })
            const g = new fabric.Group([o, t], {
                left: left,
                top: top,
                centeredRotation: true,
                snapAngle: 45,
                selectable: true,
                type: 'circle',
                id: id,
                number: number
            })
            canvas.add(g)
            number++
            return g
        }

        function addTriangle(left, top, radius) {
            const id = generateId()
            const o = new fabric.Triangle({
                radius: radius,
                fill: tableFill,
                stroke: tableStroke,
                strokeWidth: 2,
                shadow: tableShadow,
                originX: 'center',
                originY: 'center',
                centeredRotation: true
            })
            const t = new fabric.IText(number.toString(), {
                fontFamily: 'Calibri',
                fontSize: 14,
                fill: '#fff',
                textAlign: 'center',
                originX: 'center',
                originY: 'center'
            })
            const g = new fabric.Group([o, t], {
                left: left,
                top: top,
                centeredRotation: true,
                snapAngle: 45,
                selectable: true,
                type: 'triangle',
                id: id,
                number: number
            })
            canvas.add(g)
            number++
            return g
        }

        function addChair(left, top, width, height) {
            const o = new fabric.Rect({
                left: left,
                top: top,
                width: 30,
                height: 30,
                fill: chairFill,
                stroke: chairStroke,
                strokeWidth: 2,
                shadow: chairShadow,
                originX: 'left',
                originY: 'top',
                centeredRotation: true,
                snapAngle: 45,
                selectable: true,
                type: 'chair',
                id: generateId()
            })
            canvas.add(o)
            return o
        }

        function addBar(left, top, width, height) {
            const o = new fabric.Rect({
                width: width,
                height: height,
                fill: barFill,
                stroke: barStroke,
                strokeWidth: 2,
                shadow: barShadow,
                originX: 'center',
                originY: 'center',
                type: 'bar',
                id: generateId()
            })
            const t = new fabric.IText(barText, {
                fontFamily: 'Calibri',
                fontSize: 14,
                fill: '#fff',
                textAlign: 'center',
                originX: 'center',
                originY: 'center'
            })
            const g = new fabric.Group([o, t], {
                left: left,
                top: top,
                centeredRotation: true,
                snapAngle: 45,
                selectable: true,
                type: 'bar'
            })
            canvas.add(g)
            return g
        }

        function addWall(left, top, width, height) {
            const o = new fabric.Rect({
                left: left,
                top: top,
                width: width,
                height: height,
                fill: wallFill,
                stroke: wallStroke,
                strokeWidth: 2,
                shadow: wallShadow,
                originX: 'left',
                originY: 'top',
                centeredRotation: true,
                snapAngle: 45,
                selectable: true,
                type: 'wall',
                id: generateId()
            })
            canvas.add(o)
            return o
        }

        function snapToGrid(target) {
            target.set({
                left: Math.round(target.left / (grid / 2)) * grid / 2,
                top: Math.round(target.top / (grid / 2)) * grid / 2
            })
        }

        function checkBoudningBox(e) {
            const obj = e.target

            if (!obj) {
                return
            }
            obj.setCoords()

            const objBoundingBox = obj.getBoundingRect()
            if (objBoundingBox.top < 0) {
                obj.set('top', 0)
                obj.setCoords()
            }
            if (objBoundingBox.left > canvas.width - objBoundingBox.width) {
                obj.set('left', canvas.width - objBoundingBox.width)
                obj.setCoords()
            }
            if (objBoundingBox.top > canvas.height - objBoundingBox.height) {
                obj.set('top', canvas.height - objBoundingBox.height)
                obj.setCoords()
            }
            if (objBoundingBox.left < 0) {
                obj.set('left', 0)
                obj.setCoords()
            }
        }

        function sendLinesToBack() {
            canvas.getObjects().map(o => {
                if (o.type === 'line') {
                    canvas.sendToBack(o)
                }
            })
        }

        document.querySelectorAll('.rectangle')[0].addEventListener('click', function() {
            const o = addRect(0, 0, 60, 60, 1, 1, number)
            canvas.setActiveObject(o)
        })

        document.querySelectorAll('.circle')[0].addEventListener('click', function() {
            const o = addCircle(0, 0, 30, number)
            canvas.setActiveObject(o)
        })

        document.querySelectorAll('.triangle')[0].addEventListener('click', function() {
            const o = addTriangle(0, 0, 30, number)
            canvas.setActiveObject(o)
        })

        document.querySelectorAll('.chair')[0].addEventListener('click', function() {
            const o = addChair(0, 0)
            canvas.setActiveObject(o)
        })

        document.querySelectorAll('.bar')[0].addEventListener('click', function() {
            const o = addBar(0, 0, 180, 60)
            canvas.setActiveObject(o)
        })

        document.querySelectorAll('.wall')[0].addEventListener('click', function() {
            const o = addWall(0, 0, 60, 180)
            canvas.setActiveObject(o)
        })

        document.querySelectorAll('.remove')[0].addEventListener('click', function() {
            const o = canvas.getActiveObject()
            if (o) {
                o.remove()
                canvas.remove(o)
                canvas.discardActiveObject()
                canvas.renderAll()
            }
        })

        /*document.querySelectorAll('.customer-mode')[0].addEventListener('click', function() {
            canvas.getObjects().map(o => {
                o.hasControls = false
                o.lockMovementX = true
                o.lockMovementY = true
                if (o.type === 'chair' || o.type === 'bar' || o.type === 'wall') {
                    o.selectable = false
                }
                o.borderColor = '#38A62E'
                o.borderScaleFactor = 2.5
            })
            canvas.selection = false
            canvas.hoverCursor = 'pointer'
            canvas.discardActiveObject()
            canvas.renderAll()
            document.querySelectorAll('.admin-menu')[0].style.display = 'none'
            document.querySelectorAll('.customer-menu')[0].style.display = 'block'
        })*/

        document.querySelectorAll('.admin-mode')[0].addEventListener('click', function() {
            canvas.getObjects().map(o => {
                o.hasControls = true
                o.lockMovementX = false
                o.lockMovementY = false
                if (o.type === 'chair' || o.type === 'bar' || o.type === 'wall') {
                    o.selectable = true
                }
                o.borderColor = 'rgba(102, 153, 255, 0.75)'
                o.borderScaleFactor = 1
            })
            canvas.selection = true
            canvas.hoverCursor = 'move'
            canvas.discardActiveObject()
            canvas.renderAll()
            document.querySelectorAll('.admin-menu')[0].style.display = 'block'
            document.querySelectorAll('.customer-menu')[0].style.display = 'none'
        })

        function formatTime(val) {
            const hours = Math.floor(val / 60)
            const minutes = val % 60
            const englishHours = hours > 12 ? hours - 12 : hours

            const normal = hours + ':' + minutes + (minutes === 0 ? '0' : '')
            const english = englishHours + ':' + minutes + (minutes === 0 ? '0' : '') + ' ' + (hours > 12 ? 'PM' : 'AM')

            return normal + ' (' + english + ')'
        }

        $(document).on('click', '.getObjects', async function() {
            objs = []
            await canvas.getObjects().filter((item) => {
                return item.type !== 'line'
            }).map((item) => {
                objs.push({
                    width: item.width,
                    height: item.height,
                    type: item.type,
                    number: item.number,
                    left: item.left,
                    top: item.top,
                    scaleX: item.scaleX,
                    scaleY: item.scaleY,
                })
            })

            if (objs.length == 0) {
                console.log(canvas.getObjects())
                return false;
            }

            $.ajax({
                url: "{{ url('/panel/mesas/' . session()->get('branch')->id) }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "PUT",
                    type: "elements",
                    elements: objs,
                },
                success: function(data) {
                    tata.success('Éxito', data.msg)
                },
                error: function(error) {
                    console.log(error)
                }
            })
        })

        /*const slider = document.getElementById('slider')
        noUiSlider.create(slider, {
            start: 1200,
            step: 15,
            connect: 'lower',
            range: {
                min: 0,
                max: 1425
            }
        })

        const sliderValue = document.getElementById('slider-value')
        slider.noUiSlider.on('update', function(values, handle) {
            sliderValue.innerHTML = formatTime(values[handle])
        })*/

        function addDefaultObjects() {
            addChair(40, 75)
            addChair(80, 75)
            addChair(40, 135)
            addChair(80, 135)

            addChair(170, 75)
            addChair(210, 75)
            addChair(170, 135)
            addChair(210, 135)

            addRect(30, 90, 90, 60, 1, 1)
            addRect(160, 90, 90, 60, 1, 1)

            addBar(120, 0, 180, 60)
        }

        function getElements() {
            $.ajax({
                url: "{{ url('/panel/mesas') }}",
                method: "GET",
                success: function(data) {
                    if (data.data.elements.length > 0) {
                        data.data.elements.map((item) => {
                            switch (item.type) {
                                case "table":
                                    addRect(item.left, item.top, item.width, item.height, item.scaleX,
                                        item.scaleY);
                                    break;
                                case "circle":
                                    addCircle(item.left, item.top, item.width, item.height, 30)
                                    break;
                                case "triangle":
                                    addTriangle(item.left, item.top, item.width, item.height, 30)
                                    break;
                                case "bar":
                                    addBar(item.left, item.top, item.width, item.height)
                                    break;
                                case "chair":
                                    addChair(item.left, item.top)

                                    break;

                                default:
                                    break;
                            }
                        })

                    } else {
                        addDefaultObjects()
                    }
                }
            })
        }

        getElements();

        function debounce(func) {
            var timer;
            return function(event) {
                if (timer) clearTimeout(timer);
                timer = setTimeout(func, 1500, event);
            };
        }

        function makeResizableDiv(div) {
            const element = document.querySelector(div);
            const resizers = document.querySelectorAll(div + ' .resizer')
            const minimum_size = 20;
            let original_width = 0;
            let original_height = 0;
            let original_x = 0;
            let original_y = 0;
            let original_mouse_x = 0;
            let original_mouse_y = 0;
            for (let i = 0; i < resizers.length; i++) {
                const currentResizer = resizers[i];
                currentResizer.addEventListener('mousedown', function(e) {
                    e.preventDefault()
                    original_width = parseFloat(getComputedStyle(element, null).getPropertyValue('width').replace(
                        'px', ''));
                    original_height = parseFloat(getComputedStyle(element, null).getPropertyValue('height').replace(
                        'px', ''));
                    original_x = element.getBoundingClientRect().left;
                    original_y = element.getBoundingClientRect().top;
                    original_mouse_x = e.pageX;
                    original_mouse_y = e.pageY;
                    window.addEventListener('mousemove', resize)
                    window.addEventListener('mouseup', stopResize)
                })

                function resize(e) {
                    if (currentResizer.classList.contains('bottom-right')) {
                        const width = original_width + (e.pageX - original_mouse_x);
                        const height = original_height + (e.pageY - original_mouse_y)
                        if (width > minimum_size) {
                            element.style.width = width + 'px'
                        }
                        if (height > minimum_size) {
                            element.style.height = height + 'px'
                        }
                    } else if (currentResizer.classList.contains('bottom-left')) {
                        const height = original_height + (e.pageY - original_mouse_y)
                        const width = original_width - (e.pageX - original_mouse_x)
                        if (height > minimum_size) {
                            element.style.height = height + 'px'
                        }
                        if (width > minimum_size) {
                            element.style.width = width + 'px'
                            //element.style.left = original_x + (e.pageX - original_mouse_x) + 'px'
                        }
                    } else if (currentResizer.classList.contains('top-right')) {
                        const width = original_width + (e.pageX - original_mouse_x)
                        const height = original_height - (e.pageY - original_mouse_y)
                        if (width > minimum_size) {
                            element.style.width = width + 'px'
                        }
                        if (height > minimum_size) {
                            element.style.height = height + 'px'
                            //element.style.top = original_y + (e.pageY - original_mouse_y) + 'px'
                        }
                    } else {
                        const width = original_width - (e.pageX - original_mouse_x)
                        const height = original_height - (e.pageY - original_mouse_y)
                        if (width > minimum_size) {
                            element.style.width = width + 'px'
                            //element.style.left = original_x + (e.pageX - original_mouse_x) + 'px'
                        }
                        if (height > minimum_size) {
                            element.style.height = height + 'px'
                            //element.style.top = original_y + (e.pageY - original_mouse_y) + 'px'
                        }
                    }
                }

                function stopResize() {
                    console.log('dejo de moverse')
                    widthResizable = $('.resizable').width();
                    heightResizable = $('.resizable').height();

                    $.ajax({
                        url: "{{ url('/panel/mesas/' . session()->get('branch')->id) }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "PUT",
                            type: "size",
                            width: widthResizable,
                            height: heightResizable,
                        },
                        success: function(data) {
                            window.location.reload();
                        },
                        error: function(error) {
                            console.log(error)
                        }
                    })

                    /*window.removeEventListener('mousemove', resize)                    

                    initCanvas();
                    getElements();*/
                    //resizeCanvas();
                }
            }
        }

        makeResizableDiv('.resizable')
    </script>
@endsection
