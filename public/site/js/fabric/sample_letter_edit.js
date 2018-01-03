var canvas = new fabric.Canvas('tcanvas');
var tshirts = new Array(); //prototype: [{style:'x',color:'white',front:'a',back:'b',price:{tshirt:'12.95',frontPrint:'4.99',backPrint:'4.99',total:'22.47'}}]
var a;
var b;
var line1;
var line2;
var line3;
var line4;
$(document).ready(function () {
    doimportjson();
    //setup front side canvas
    // canvas = new fabric.Canvas('tcanvas', {
    //     hoverCursor: 'pointer',
    //     selection: true,
    //     selectionBorderColor: 'blue'
    // });
    canvas.on({
        'object:moving': function (e) {
            e.target.opacity = 0.5;
        },
        'object:modified': function (e) {
            e.target.opacity = 1;
        },
        'object:selected': onObjectSelected,
        'selection:cleared': onSelectedCleared
    });
    // piggyback on `canvas.findTarget`, to fire "object:over" and "object:out" events
    canvas.findTarget = (function (originalFn) {
        return function () {
            var target = originalFn.apply(this, arguments);
            if (target) {
                if (this._hoveredTarget !== target) {
                    canvas.fire('object:over', {target: target});
                    if (this._hoveredTarget) {
                        canvas.fire('object:out', {target: this._hoveredTarget});
                    }
                    this._hoveredTarget = target;
                }
            } else if (this._hoveredTarget) {
                canvas.fire('object:out', {target: this._hoveredTarget});
                this._hoveredTarget = null;
            }
            return target;
        };
    })(canvas.findTarget);

    canvas.on('object:over', function (e) {
        e.target.setFill('red');
        canvas.renderAll();
    });

    canvas.on('object:out', function (e) {
        e.target.setFill('green');
        canvas.renderAll();
    });

    document.getElementById('add-text').onclick = function () {
        var text = $("#text-string").val();
        var textSample = new fabric.IText(text, {
            left: fabric.util.getRandomInt(0, 200),
            top: fabric.util.getRandomInt(0, 400),
            fontFamily: 'helvetica',
            angle: 0,
            fill: '#000000',
            scaleX: 0.5,
            scaleY: 0.5,
            fontWeight: '',
            hasRotatingPoint: true,
            editable: true

        });
        canvas.add(textSample);
        canvas.item(canvas.item.length - 1).hasRotatingPoint = true;
        $("#texteditor").css('display', 'block');
        $("#imageeditor").css('display', 'block');
    };
    $("#text-string").keyup(function () {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.text = this.value;
            canvas.renderAll();
        }
    });
    $(".img-polaroid").click(function (e) {
        var el = e.target;
        /*temp code*/
        var offset = 50;
        var left = fabric.util.getRandomInt(0 + offset, 200 - offset);
        var top = fabric.util.getRandomInt(0 + offset, 400 - offset);
        var angle = fabric.util.getRandomInt(-20, 40);
        var width = fabric.util.getRandomInt(30, 50);
        var opacity = (function (min, max) {
            return Math.random() * (max - min) + min;
        })(0.5, 1);

        fabric.Image.fromURL(el.src, function (image) {
            image.set({
                left: left,
                top: top,
                angle: 0,
                padding: 10,
                cornersize: 10,
                hasRotatingPoint: true
            });
            //image.scale(getRandomNum(0.1, 0.25)).setCoords();
            canvas.add(image);
        });
    });
    document.getElementById('remove-selected').onclick = function () {
        var activeObject = canvas.getActiveObject(),
            activeGroup = canvas.getActiveGroup();
        if (activeObject) {
            canvas.remove(activeObject);
            $("#text-string").val("");
        } else if (activeGroup) {
            var objectsInGroup = activeGroup.getObjects();
            canvas.discardActiveGroup();
            objectsInGroup.forEach(function (object) {
                canvas.remove(object);
            });
        }
    };
    document.getElementById('bring-to-front').onclick = function () {
        var activeObject = canvas.getActiveObject(),
            activeGroup = canvas.getActiveGroup();
        if (activeObject) {
            activeObject.bringToFront();
        } else if (activeGroup) {
            var objectsInGroup = activeGroup.getObjects();
            canvas.discardActiveGroup();
            objectsInGroup.forEach(function (object) {
                object.bringToFront();
            });
        }
    };
    document.getElementById('send-to-back').onclick = function () {
        var activeObject = canvas.getActiveObject(),
            activeGroup = canvas.getActiveGroup();
        if (activeObject) {
            activeObject.sendToBack();
        } else if (activeGroup) {
            var objectsInGroup = activeGroup.getObjects();
            canvas.discardActiveGroup();
            objectsInGroup.forEach(function (object) {
                object.sendToBack();
            });
        }
    };
    $("#text-bold").click(function () {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontWeight = (activeObject.fontWeight == 'bold' ? '' : 'bold');
            canvas.renderAll();
        }
    });
    $("#text-italic").click(function () {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontStyle = (activeObject.fontStyle == 'italic' ? '' : 'italic');
            canvas.renderAll();
        }
    });
    $("#text-strike").click(function () {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textDecoration = (activeObject.textDecoration == 'line-through' ? '' : 'line-through');
            canvas.renderAll();
        }
    });
    $("#text-underline").click(function () {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textDecoration = (activeObject.textDecoration == 'underline' ? '' : 'underline');
            canvas.renderAll();
        }
    });
    $("#text-left").click(function () {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textAlign = 'left';
            canvas.renderAll();
        }
    });
    $("#text-center").click(function () {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textAlign = 'center';
            canvas.renderAll();
        }
    });
    $("#text-right").click(function () {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textAlign = 'right';
            canvas.renderAll();
        }
    });
    $("#font-family").change(function () {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontFamily = this.value;
            canvas.renderAll();
        }
    });
    $('#text-bgcolor').miniColors({
        change: function (hex, rgb) {
            var activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                activeObject.backgroundColor = this.value;
                canvas.renderAll();
            }
        },
        open: function (hex, rgb) {
            //
        },
        close: function (hex, rgb) {
            //
        }
    });
    $('#text-fontcolor').miniColors({
        change: function (hex, rgb) {
            var activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                activeObject.fill = this.value;
                canvas.renderAll();
            }
        },
        open: function (hex, rgb) {
            //
        },
        close: function (hex, rgb) {
            //
        }
    });

    $('#text-strokecolor').miniColors({
        change: function (hex, rgb) {
            var activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                activeObject.strokeStyle = this.value;
                canvas.renderAll();
            }
        },
        open: function (hex, rgb) {
            //
        },
        close: function (hex, rgb) {
            //
        }
    });

    //canvas.add(new fabric.fabric.Object({hasBorders:true,hasControls:false,hasRotatingPoint:false,selectable:false,type:'rect'}));
    $("#drawingArea").hover(
        function () {
            canvas.add(line1);
            canvas.add(line2);
            canvas.add(line3);
            canvas.add(line4);
            canvas.renderAll();
        },
        function () {
            canvas.remove(line1);
            canvas.remove(line2);
            canvas.remove(line3);
            canvas.remove(line4);
            canvas.renderAll();
        }
    );

    $('.color-preview').click(function () {
        var color = $(this).css("background-color");
        document.getElementById("shirtDiv").style.backgroundColor = color;
    });

    $('#flip').click(
        function () {
            if ($(this).attr("data-original-title") == "Show Back View") {
                $(this).attr('data-original-title', 'Show Front View');
                $("#tshirtFacing").attr("src", "img/crew_back.png");
                a = JSON.stringify(canvas);
                canvas.clear();
                try {
                    var json = JSON.parse(b);
                    canvas.loadFromJSON(b);
                } catch (e) {
                }

            } else {
                $(this).attr('data-original-title', 'Show Back View');
                $("#tshirtFacing").attr("src", "img/crew_front.png");
                b = JSON.stringify(canvas);
                canvas.clear();
                try {
                    var json = JSON.parse(a);
                    canvas.loadFromJSON(a);
                } catch (e) {
                }
            }
            canvas.renderAll();
            setTimeout(function () {
                canvas.calcOffset();
            }, 200);
        });
    $(".clearfix button,a").tooltip();
    line1 = new fabric.Line([30, 30, 449, 30], {
        "stroke": "#000000",
        "strokeWidth": 1,
        hasBorders: false,
        hasControls: false,
        hasRotatingPoint: false,
        selectable: false
    });
    line2 = new fabric.Line([449, 30, 449, 610], {
        "stroke": "#000000",
        "strokeWidth": 1,
        hasBorders: false,
        hasControls: false,
        hasRotatingPoint: false,
        selectable: false
    });
    line3 = new fabric.Line([30, 30, 30, 610], {
        "stroke": "#000000",
        "strokeWidth": 1,
        hasBorders: false,
        hasControls: false,
        hasRotatingPoint: false,
        selectable: false
    });
    line4 = new fabric.Line([30, 609, 449, 609], {
        "stroke": "#000000",
        "strokeWidth": 1,
        hasBorders: false,
        hasControls: false,
        hasRotatingPoint: false,
        selectable: false
    });
}); //doc ready


function getRandomNum(min, max) {
    return Math.random() * (max - min) + min;
}

function onObjectSelected(e) {
    var selectedObject = e.target;
    $("#text-string").val("");
    selectedObject.hasRotatingPoint = true
    if (selectedObject && selectedObject.type === 'text') {
        //display text editor
        $("#texteditor").css('display', 'block');
        $("#text-string").val(selectedObject.getText());
        $('#text-fontcolor').miniColors('value', selectedObject.fill);
        $('#text-strokecolor').miniColors('value', selectedObject.strokeStyle);
        $("#imageeditor").css('display', 'block');
    } else if (selectedObject && selectedObject.type === 'image') {
        //display image editor
        $("#texteditor").css('display', 'none');
        $("#imageeditor").css('display', 'block');
    }
}

function onSelectedCleared(e) {
    $("#texteditor").css('display', 'none');
    $("#text-string").val("");
    $("#imageeditor").css('display', 'none');
}

function setFont(font) {
    var activeObject = canvas.getActiveObject();
    if (activeObject && activeObject.type === 'text') {
        activeObject.fontFamily = font;
        canvas.renderAll();
    }
}

function removeWhite() {
    var activeObject = canvas.getActiveObject();
    if (activeObject && activeObject.type === 'image') {
        activeObject.filters[2] = new fabric.Image.filters.RemoveWhite({hreshold: 100, distance: 10}); //0-255, 0-255
        activeObject.applyFilters(canvas.renderAll.bind(canvas));
    }
}


function doclearjson() {

    canvas.clear();
}

function doimportjson() {
    // alert();
    canvas.loadFromJSON('{"objects":[{"type":"image","originX":"left","originY":"top","left":0,"top":0,"width":480,"height":640,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":0,"strokeDashArray":null,"strokeLineCap":"butt","selectable": false,"strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":1,"scaleY":1,"angle":0,"flipX":true,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","transformMatrix":null,"skewX":0,"skewY":0,"crossOrigin":"","cropX":0,"cropY":0,"src":"../img/email_template1.jpg","filters":[]},{"type":"image","originX":"left","originY":"top","left":42.65,"top":194.85,"width":1429,"height":954,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":0,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":0.28,"scaleY":0.28,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","transformMatrix":null,"skewX":0,"skewY":0,"crossOrigin":"","cropX":0,"cropY":0,"src":"../img/tem-1.jpeg","filters":[]},{"type":"i-text","originX":"left","originY":"top","left":75,"top":82,"width":2,"height":45.2,"fill":"#000000","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":0.5,"scaleY":0.5,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","transformMatrix":null,"skewX":0,"skewY":0,"text":"","fontSize":40,"fontWeight":"","fontFamily":"helvetica","fontStyle":"normal","lineHeight":1.16,"underline":false,"overline":false,"linethrough":false,"textAlign":"left","textBackgroundColor":"","charSpacing":0,"styles":{}},{"type":"i-text","originX":"left","originY":"top","left":104,"top":36,"width":559.47,"height":45.2,"fill":"#000000","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":0.5,"scaleY":0.5,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","transformMatrix":null,"skewX":0,"skewY":0,"text":"A letter To My Work Colleagues","fontSize":40,"fontWeight":"","fontFamily":"helvetica","fontStyle":"normal","lineHeight":1.16,"underline":false,"overline":false,"linethrough":false,"textAlign":"left","textBackgroundColor":"","charSpacing":0,"styles":{}},{"type":"i-text","originX":"left","originY":"top","left":44.83,"top":75.67,"width":1851.97,"height":569.52,"fill":"#000000","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":0.21,"scaleY":0.21,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","transformMatrix":null,"skewX":0,"skewY":0,"text":"Phew! This is a letter to all my fellow colleagues I spent time with. I am writing this to tell you how much \\nI miss you. Don’t be surprised to see this letter when you receive it, just know this is what I couldn’t have \\nwritten when I was with you. What is contained in this letter is a true reflection of the quality time that \\nwe spent together. You were a great team that I have no doubt we will meet again.\\n \\nA special thanks to the I.T team that saw all the computer related problems sorted promptly. The H.R \\nwithout you I couldn’t have made the career steps I took. Right from promotions, motivation talks, team \\nbuilding and career mentoring. I hold no regret for once receiving warning letters for being late at work, \\nI completely hold no grudge just the same way I didn’t hold any grudge after you consideration for \\nyearly bonus and salary reviews.\\n","fontSize":40,"fontWeight":"","fontFamily":"helvetica","fontStyle":"normal","lineHeight":1.16,"underline":false,"overline":false,"linethrough":false,"textAlign":"left","textBackgroundColor":"","charSpacing":0,"styles":{}},{"type":"i-text","originX":"left","originY":"top","left":43.38,"top":469.12,"width":1809.79,"height":621.95,"fill":"#000000","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":0.22,"scaleY":0.22,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","transformMatrix":null,"skewX":0,"skewY":0,"text":"Last but not least, the company directors. Allow me to express my gratitude for working with your \\ncompany. I had a nice time working for your company. I could only be a breadwinner because you \\ndecided I be part of your company. Without your focus on the company I could have been part of the \\nstatistics of job seekers.\\n\\nFinally to all the colleagues I met interacted and worked with. Just know that it was a blessing working \\nwith you. It is my wish that this news reach to you even in my absence.\\n\\nThank you,\\n\\nAmanda\\n","fontSize":40,"fontWeight":"","fontFamily":"helvetica","fontStyle":"normal","lineHeight":1.16,"underline":false,"overline":false,"linethrough":false,"textAlign":"left","textBackgroundColor":"","charSpacing":0,"styles":{}}]}')
}
